<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'title_en' => 'ATL & BTL Campaign Services',
                'title_id' => 'Jasa Kampanye ATL & BTL',
                'category' => 'ATL & BTL',
                'description_en' => 'Our services are specialized for both Above The Line (ATL) and Below The Line (BTL) marketing and advertising solutions, offering integrated and comprehensive coverage to reach target audiences effectively.',
                'description_id' => 'Layanan kami berspesialisasi dalam solusi pemasaran dan periklanan baik Above The Line (ATL) maupun Below The Line (BTL), menawarkan cakupan yang terintegrasi dan komprehensif untuk menjangkau audiens target secara efektif.'
            ],
            [
                'title_en' => 'Creative & Media Concept',
                'title_id' => 'Konsep Kreatif & Media',
                'category' => 'Concept',
                'description_en' => 'Development campaign of TVC (Television Commercial), print advertisements, POS (Point of Sale) materials, radio ads, and corporate/video profiles.',
                'description_id' => 'Pengembangan kampanye TVC (Iklan Televisi), iklan cetak, materi POS (Point of Sale), iklan radio, dan video profil perusahaan.'
            ],
            [
                'title_en' => 'Graphic Design Concept',
                'title_id' => 'Konsep Desain Grafis',
                'category' => 'Graphic Design Concept',
                'description_en' => 'Full graphic design development including logo & icon device campaign creation, storyboards development, and simple yet impactful packaging design.',
                'description_id' => 'Pengembangan desain grafis lengkap termasuk pembuatan logo & ikon kampanye, pengembangan storyboard, dan desain kemasan yang simpel namun berdampak kuat.'
            ]
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title_en' => $service['title_en']],
                [
                    'title_id' => $service['title_id'],
                    'category' => $service['category'],
                    'description_en' => $service['description_en'],
                    'description_id' => $service['description_id']
                ]
            );
        }
    }
}
