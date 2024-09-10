<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
{
    $categories = [
        ['code' => '000', 'name' => 'Komputer, Informasi dan Referensi Umum', 'icon' => 'fas fa-desktop', 'background' => '#1abc9c'], // Turquoise
        ['code' => '100', 'name' => 'Filsafat dan Psikologi', 'icon' => 'fas fa-brain', 'background' => '#3498db'], // Peter River
        ['code' => '200', 'name' => 'Agama', 'icon' => 'fas fa-praying-hands', 'background' => '#9b59b6'], // Amethyst
        ['code' => '300', 'name' => 'Ilmu Sosial', 'icon' => 'fas fa-users', 'background' => '#e74c3c'], // Alizarin
        ['code' => '400', 'name' => 'Bahasa', 'icon' => 'fas fa-language', 'background' => '#f1c40f'], // Sun Flower
        ['code' => '500', 'name' => 'Sains dan Matematika', 'icon' => 'fas fa-flask', 'background' => '#2ecc71'], // Emerald
        ['code' => '600', 'name' => 'Teknologi', 'icon' => 'fas fa-cogs', 'background' => '#e67e22'], // Carrot
        ['code' => '700', 'name' => 'Kesenian dan Rekreasi', 'icon' => 'fas fa-palette', 'background' => '#d35400'], // Pumpkin
        ['code' => '800', 'name' => 'Sastra', 'icon' => 'fas fa-book', 'background' => '#34495e'], // Wet Asphalt
        ['code' => '900', 'name' => 'Sejarah dan Geografi', 'icon' => 'fas fa-globe', 'background' => '#16a085'], // Green Sea
    ];        

    foreach ($categories as $category) {
        Category::updateOrCreate(
            ['code' => $category['code']],
            [
                'name' => $category['name'],
                'icon' => $category['icon'],
                'background' => $category['background']
            ]
        );
    }
}

}
