<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalogs = [
            [
                'isbn' => '978-623-118-376-7',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Bahasa_Indonesia_BS_KLS_X_Rev_Cover.png',
                'category_id' => 4,
                'title' => 'Bahasa Indonesia: untuk SMA/SMK/MA/MAK',
                'writer' => 'Fadillah Tri Aulia, Sefi Indra Gumilar, Alvian Kurniawan',
                'publisher' => 'Pusat Kurikulum dan Perbukuan',
                'release_year' => '2023',
                'price' => '14750',
                'edition' => 'Revisi',
                'classification_id' => 1
            ],
            [
                'isbn' => '978-602-244-897-6',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Bahasa-Inggris-BS-KLS-X-cover.png',
                'category_id' => 4,
                'title' => 'Bahasa Inggris: Work in Progress untuk SMA/SMK/MA',
                'writer' => 'Budi Hermawan, Dwi Haryanti, Nining Suryaningsih',
                'publisher' => 'Pusat Perbukuan',
                'release_year' => '2022',
                'price' => '15700',
                'edition' => '1',
                'classification_id' => 1
            ],
            [
                'isbn' => '978-623-118-461-0',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/IPA_BS_KLS_X_Rev_Cover.png',
                'category_id' => 4,
                'title' => 'Ilmu Pengetahuan Alam untuk SMA/MA Kelas',
                'writer' => 'Niken Resminingpuri Krisdianti, Elizabeth Tjahjadarmawan, Ayuk Ratna Puspaningsih',
                'publisher' => 'Pusat Kurikulum dan Perbukuan',
                'release_year' => '2023',
                'price' => '26200',
                'edition' => 'Revisi',
                'classification_id' => 1
            ],
            [
                'isbn' => '978-602-427-115-2',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/thumbnail/Cover_Kelas_X_Matematika_BS.png',
                'category_id' => 4,
                'title' => 'Matematika',
                'writer' => 'Bornok Sinaga, Pardomuan N.J.M Sinambela, Andri Kristianto Sitanggang, Tri Andri Hutapea, Sudianto Manulang, Lasker Pengarapan Sinaga, Mangara Simanjorang',
                'publisher' => 'Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud',
                'release_year' => '2017',
                'price' => null,
                'edition' => '2017',
                'classification_id' => 1
            ],
            [
                'isbn' => '978-623-472-721-0',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Fisika-BS-KLS-XI-Cover.png',
                'category_id' => 4,
                'title' => 'Fisika untuk SMA/MA',
                'writer' => 'Marianna Magdalena Radjawane, Alvius Tinambunan, Suntar Jono',
                'publisher' => 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'release_year' => '2022',
                'price' => '19000',
                'edition' => '1',
                'classification_id' => 2
            ],
            [
                'isbn' => '978-602-427-923-3',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Kimia-BS-KLS-XI-Cover.png',
                'category_id' => 4,
                'title' => 'Kimia untuk SMA/MA',
                'writer' => 'Munasprianto Ramli, Nanda Saridewi, Tiktik Mustika Budhi, Aang Suhendar',
                'publisher' => 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'release_year' => '2022',
                'price' => '18300',
                'edition' => '1',
                'classification_id' => 2
            ],
            [
                'isbn' => '978-602-427-893-9',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Biologi-BS-KLS-XI-Cover.png',
                'category_id' => 4,
                'title' => 'Biologi untuk SMA/MA',
                'writer' => 'Rini Solihat, Eris Rustandi, Wandi Herpiandi, Zamzam Nursani',
                'publisher' => 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'release_year' => '2022',
                'price' => '23400',
                'edition' => '1',
                'classification_id' => 2
            ],
            [
                'isbn' => '978-623-194-623-2',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Pendidikan-Pancasila-BS-KLS-XI-Cover.png',
                'category_id' => 4,
                'title' => 'Pendidikan Pancasila untuk SMA/MA/SMK/MAK',
                'writer' => 'Sri Cahyati, Siti Nurjanah, Ali Usman',
                'publisher' => 'Pusat Perbukuan',
                'release_year' => '2023',
                'price' => '15700',
                'edition' => '1',
                'classification_id' => 2
            ],
            [
                'isbn' => '978-602-427-949-3',
                'cover' => 'https://static.buku.kemdikbud.go.id/content/image/coverteks/coverkurikulum21/Informatika_BG_KLS_XII_Cover.png',
                'category_id' => 4,
                'title' => 'Buku Panduan Guru Informatika untuk SMA/MA',
                'writer' => 'Budi Permana, Kurweni Ukar, Dela Chaerani, Solehkun Kodir',
                'publisher' => 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'release_year' => '2022',
                'price' => '96400',
                'edition' => '1',
                'classification_id' => 4
            ],
        ];

        foreach ($catalogs as $catalog) {
            Catalog::create($catalog);
        }
    }
}
