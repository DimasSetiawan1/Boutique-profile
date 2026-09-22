<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolios = [
            [
                'title_en' => 'Print x-Banner Standard',
                'title_id' => 'Cetak x-Banner Standar',
                'category_en' => 'Print x -Banner',
                'category_id' => 'Print x -Banner',
                'description_en' => 'Lightweight, portable x-banners printed on high-grade PVC material with rich gloss finishing. Perfect for events and promotional booth stands.',
                'description_id' => 'X-banner portabel yang ringan, dicetak pada bahan PVC bermutu tinggi dengan finishing gloss yang kaya. Sangat cocok untuk acara dan stan promosi.',
                'image_path' => null
            ],
            [
                'title_en' => 'Custom LED Neon Box',
                'title_id' => 'Neon Box LED Kustom',
                'category_en' => 'Neon Box',
                'category_id' => 'Neon Box',
                'description_en' => 'Illuminated storefront sign boxes with dual-side LED illumination. Energy-efficient, weatherproof, and designed to make brands shine at night.',
                'description_id' => 'Neon box etalase dengan pencahayaan LED dua sisi. Hemat energi, tahan cuaca, dan dirancang untuk membuat merek Anda bersinar di malam hari.',
                'image_path' => null
            ],
            [
                'title_en' => 'Roadside Highway Billboard',
                'title_id' => 'Baliho Jalan Tol Raya',
                'category_en' => 'Billboard',
                'category_id' => 'Billboard',
                'description_en' => 'Large scale steel structure highway billboard installations. High quality wide-format solvent printing that withstands sunlight and rain.',
                'description_id' => 'Instalasi baliho jalan tol berstruktur baja skala besar. Cetak solvent format lebar berkualitas tinggi yang tahan terhadap sinar matahari dan hujan.',
                'image_path' => null
            ],
            [
                'title_en' => 'Office Acrylic Sign Board',
                'title_id' => 'Papan Nama Akrilik Kantor',
                'category_en' => 'Sign Board',
                'category_id' => 'Sign Board',
                'description_en' => 'Premium layered acrylic wall-mount signs with custom stainless steel standoffs. Styled specifically for modern corporate lobbies and meeting rooms.',
                'description_id' => 'Papan nama dinding akrilik berlapis premium dengan penyangga baja tahan karat kustom. Didesain khusus untuk lobi perusahaan modern dan ruang pertemuan.',
                'image_path' => null
            ],
            [
                'title_en' => 'Packaging and Brochure Printing',
                'title_id' => 'Percetakan Kemasan dan Brosur',
                'category_en' => 'Printing',
                'category_id' => 'Printing',
                'description_en' => 'High volume offset printing for corporate catalog brochures, letterheads, business cards, and customized cardboard packaging box designs.',
                'description_id' => 'Pencetakan offset volume tinggi untuk brosur katalog perusahaan, kop surat, kartu nama, dan desain kotak kemasan karton kustom.',
                'image_path' => null
            ],
            [
                'title_en' => 'Brand Merchandise and Gimmick',
                'title_id' => 'Merchandise Merek dan Gimmick',
                'category_en' => 'Gimmick',
                'category_id' => 'Gimmick',
                'description_en' => 'Custom printed brand merchandise including hand towels, headband accessories, mugs, keychains, and premium promotional giveaway packages.',
                'description_id' => 'Merchandise merek cetak kustom termasuk handuk tangan, aksesori ikat kepala, cangkir, gantungan kunci, dan paket hadiah promosi premium.',
                'image_path' => null
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::updateOrCreate(
                ['title_en' => $portfolio['title_en']],
                [
                    'title_id' => $portfolio['title_id'],
                    'category_en' => $portfolio['category_en'],
                    'category_id' => $portfolio['category_id'],
                    'description_en' => $portfolio['description_en'],
                    'description_id' => $portfolio['description_id'],
                    'image_path' => $portfolio['image_path']
                ]
            );
        }
    }
}
