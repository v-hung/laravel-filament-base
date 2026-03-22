<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GeminiTranslationService
{
    private const API_BASE_URL = 'https://generativelanguage.googleapis.com/v1beta/models';

    private const LOCALE_NAMES = [
        'vi' => 'Vietnamese',
        'en' => 'English',
        'zh' => 'Chinese (Simplified)',
        'cn' => 'Chinese (Simplified)',
        'ja' => 'Japanese',
        'ko' => 'Korean',
        'fr' => 'French',
        'de' => 'German',
    ];

    /**
     * Translate fields from a source locale to multiple target locales.
     *
     * @param  array<string, mixed>  $fields  Translatable field values from source locale
     * @param  string  $sourceLocale  e.g. 'vi'
     * @param  array<string>  $targetLocales  e.g. ['en', 'cn']
     * @param  array<string>  $htmlFields  Fields that contain HTML (preserve tags)
     * @param  array<string>  $slugFields  Fields that should be auto-slugified from a name field
     * @return array<string, array<string, mixed>> Keyed by locale → field → translated value
     */
    public function translate(
        array $fields,
        string $sourceLocale,
        array $targetLocales,
        array $htmlFields = ['content'],
        array $slugFields = ['slug'],
    ): array {
        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-2.0-flash');

        // Exclude slug from fields sent to Gemini — we generate it ourselves
        $fieldsForApi = array_filter(
            $fields,
            fn ($key) => ! in_array($key, $slugFields, true),
            ARRAY_FILTER_USE_KEY
        );

        // Remove null/empty fields
        $fieldsForApi = array_filter($fieldsForApi, fn ($value) => ! is_null($value) && $value !== '' && $value !== []);

        if (empty($fieldsForApi) || empty($targetLocales)) {
            return [];
        }

        $prompt = $this->buildPrompt($fieldsForApi, $sourceLocale, $targetLocales, $htmlFields);

        $url = self::API_BASE_URL."/{$model}:generateContent?key={$apiKey}";

        $response = Http::timeout(60)->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
                'temperature' => 0.1,
            ],
        ]);

        $rawText = $response->json('candidates.0.content.parts.0.text', '{}');
        $translations = json_decode($rawText, true) ?? [];

        // Auto-generate slugs from translated name if slug field exists in source
        if (isset($fields['slug']) || isset($fields['name'])) {
            foreach ($targetLocales as $locale) {
                $translatedName = $translations[$locale]['name'] ?? null;

                if ($translatedName) {
                    $translations[$locale]['slug'] = Str::slug($translatedName);
                }
            }
        }

        return $translations;
    }

    /**
     * @param  array<string, mixed>  $fields
     * @param  array<string>  $targetLocales
     * @param  array<string>  $htmlFields
     */
    private function buildPrompt(array $fields, string $sourceLocale, array $targetLocales, array $htmlFields): string
    {
        $sourceLangName = self::LOCALE_NAMES[$sourceLocale] ?? $sourceLocale;

        $targetList = implode(', ', array_map(
            fn ($locale) => '"'.$locale.'" ('.(self::LOCALE_NAMES[$locale] ?? $locale).')',
            $targetLocales
        ));

        // Build expected output structure
        $structure = [];
        foreach ($targetLocales as $locale) {
            foreach (array_keys($fields) as $key) {
                $structure[$locale][$key] = '...';
            }
        }
        $structureJson = json_encode($structure, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $fieldsJson = json_encode($fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $htmlFieldNames = implode(', ', $htmlFields);

        return <<<PROMPT
You are a professional translator for an e-commerce website.
Translate the following product content from {$sourceLangName} to: {$targetList}.

Return ONLY a valid JSON object with this exact structure:
{$structureJson}

Translation rules:
- Translate each field naturally and professionally for an e-commerce context.
- Fields that are HTML ({$htmlFieldNames}): preserve ALL HTML tags exactly as-is, only translate the visible text inside tags.
- "specifications" field: it is a key-value JSON object — keep the keys unchanged, only translate the values.
- Translate naturally. Do not add explanation, notes, or markdown code blocks.
- Return ONLY the raw JSON object.

Content to translate ({$sourceLangName}):
{$fieldsJson}
PROMPT;
    }
}
