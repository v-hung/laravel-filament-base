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
            ['slug' => 'home', 'title' => 'Trang Chủ'],
            ['slug' => 'about', 'title' => 'Giới Thiệu'],
            ['slug' => 'contact', 'title' => 'Liên Hệ'],
            ['slug' => 'partner', 'title' => 'Đối Tác Liên Hệ'],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug->vi' => $page['slug']],
                [
                    'title' => ['vi' => $page['title'], 'en' => $page['title']],
                    'slug' => ['vi' => $page['slug'], 'en' => $page['slug']],
                    'page_type' => PageType::System,
                    'status' => ContentStatus::Published,
                ]
            );
        }
    }
}
