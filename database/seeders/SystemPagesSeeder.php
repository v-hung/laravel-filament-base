<?php

namespace Database\Seeders;

use App\Enums\ContentStatus;
use App\Enums\PageType;
use App\Models\Page;
use Illuminate\Database\Seeder;

class SystemPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => ['vi' => 'home', 'en' => 'home'],
                'title' => ['vi' => 'Trang chủ', 'en' => 'Home'],
            ],
            [
                'slug' => ['vi' => 'about', 'en' => 'about'],
                'title' => ['vi' => 'Giới thiệu', 'en' => 'About'],
            ],
            [
                'slug' => ['vi' => 'contact', 'en' => 'contact'],
                'title' => ['vi' => 'Liên hệ', 'en' => 'Contact'],
            ],
            [
                'slug' => ['vi' => 'partner', 'en' => 'partner'],
                'title' => ['vi' => 'Đối tác', 'en' => 'Partner'],
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug->vi' => $page['slug']['vi']],
                [
                    'title' => $page['title'],
                    'slug' => $page['slug'],
                    'page_type' => PageType::System,
                    'status' => ContentStatus::Published,
                ]
            );
        }
    }
}
