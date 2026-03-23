<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
     * @param  array<string>  $jsonFields  Fields that are key-value JSON objects (keep keys, translate values only)
     * @return array<string, array<string, mixed>> Keyed by locale → field → translated value
     */
    public function translate(
        array $fields,
        string $sourceLocale,
        array $targetLocales,
        array $htmlFields = ['content'],
        array $slugFields = ['slug'],
        array $jsonFields = ['specifications'],
    ): array {
        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model');

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

        $prompt = $this->buildPrompt($fieldsForApi, $sourceLocale, $targetLocales, $htmlFields, $jsonFields);

        $url = self::API_BASE_URL."/{$model}:generateContent?key={$apiKey}";

        try {
            /** @var \Illuminate\Http\Client\Response $response */
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
        } catch (ConnectionException $e) {
            Log::error('Gemini translation connection failed', ['error' => $e->getMessage()]);

            return [];
        }

        if ($response->failed()) {
            Log::error('Gemini translation API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        }

        $rawText = $response->json('candidates.0.content.parts.0.text', '{}');
        $translations = json_decode($rawText, true) ?? [];

        // Restore array values for JSON fields that Gemini may have returned as strings
        foreach ($targetLocales as $locale) {
            foreach ($jsonFields as $field) {
                $value = $translations[$locale][$field] ?? null;

                if (is_string($value)) {
                    $decoded = json_decode($value, true);

                    if (is_array($decoded)) {
                        $translations[$locale][$field] = $decoded;
                    }
                }
            }
        }

        // Auto-generate slugs from translated name/title if slug field exists in source
        $slugSourceField = match (true) {
            isset($fields['name']) => 'name',
            isset($fields['title']) => 'title',
            default => null,
        };

        if ($slugSourceField !== null) {
            foreach ($targetLocales as $locale) {
                $translatedTitle = $translations[$locale][$slugSourceField] ?? null;

                if ($translatedTitle) {
                    foreach ($slugFields as $slugField) {
                        $translations[$locale][$slugField] = Str::slug($translatedTitle);
                    }
                }
            }
        }

        return $translations;
    }

    /**
     * @param  array<string, mixed>  $fields
     * @param  array<string>  $targetLocales
     * @param  array<string>  $htmlFields
     * @param  array<string>  $jsonFields
     */
    private function buildPrompt(array $fields, string $sourceLocale, array $targetLocales, array $htmlFields, array $jsonFields): string
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
        $jsonFieldNames = implode(', ', $jsonFields);

        return <<<PROMPT
You are a professional translator for an e-commerce website.
Translate the following product content from {$sourceLangName} to: {$targetList}.

Return ONLY a valid JSON object with this exact structure:
{$structureJson}

Translation rules:
- Translate each field naturally and professionally for an e-commerce context.
- Fields that are HTML ({$htmlFieldNames}): preserve ALL HTML tags exactly as-is, only translate the visible text inside tags.
- Fields that are key-value JSON objects ({$jsonFieldNames}): keep the keys unchanged, only translate the values. Return them as JSON objects, not as strings.
- Translate naturally. Do not add explanation, notes, or markdown code blocks.
- Return ONLY the raw JSON object.

Content to translate ({$sourceLangName}):
{$fieldsJson}
PROMPT;
    }
}
