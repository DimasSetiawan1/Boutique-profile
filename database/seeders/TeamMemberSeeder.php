<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = [
            [
                'name' => 'Enung Kosasih',
                'role_en' => 'Director',
                'role_id' => 'Direktur',
                'phone' => '0856 9317 4242',
                'quote_en' => 'Brave to tell myself I\'m creative, when I\'m making a creation.',
                'quote_id' => 'Berani mengatakan pada diri sendiri bahwa saya kreatif, ketika saya membuat sebuah karya.',
                'description_en' => 'Starting his career on advertising in (1990) at POWER BRAND COMMUNICATION as Art Director and ADVISINDO as Senior Art Director. With decades of creative leadership, he guides the agency\'s strategic vision.',
                'description_id' => 'Memulai karirnya di bidang periklanan pada tahun (1990) di POWER BRAND COMMUNICATION sebagai Art Director dan ADVISINDO sebagai Senior Art Director. Dengan kepemimpinan kreatif selama beberapa dekade, beliau mengarahkan visi strategis agensi.',
                'photo_path' => 'uploads/team/enung.jpg',
                'priority' => 1
            ],
            [
                'name' => 'Oleh Wijayana',
                'role_en' => 'Creative Director',
                'role_id' => 'Direktur Kreatif',
                'phone' => '0858 9111 8571',
                'quote_en' => 'Idea are everywhere, I\'m just transferring it.',
                'quote_id' => 'Ide ada di mana-mana, saya hanya menyalurkannya saja.',
                'description_en' => 'Newly enter advertising for 20 years. Becoming a Graphic Designer is his pride. Was in POWER BRAND COM handling major accounts like Aquaproof, Indofarma, and Giant Hypermarket.',
                'description_id' => 'Baru memasuki dunia periklanan selama 20 tahun. Menjadi Desainer Grafis adalah kebanggaannya. Pernah di POWER BRAND COM menangani akun-akun besar seperti Aquaproof, Indofarma, dan Giant Hypermarket.',
                'photo_path' => 'uploads/team/oleh.jpg',
                'priority' => 2
            ],
            [
                'name' => 'Jajat Sujana',
                'role_en' => 'Art Director',
                'role_id' => 'Art Director',
                'phone' => '+62 811-929-247',
                'quote_en' => 'Visualizing concepts into breathing masterpieces.',
                'quote_id' => 'Memvisualisasikan konsep menjadi mahakarya yang hidup.',
                'description_en' => 'Dedicated Art Director overseeing layout execution and graphic integrity across advertising campaigns.',
                'description_id' => 'Art Director yang berdedikasi mengawasi eksekusi tata letak dan integritas grafis di seluruh kampanye periklanan.',
                'photo_path' => 'uploads/team/jajat.jpg',
                'priority' => 3
            ],
            [
                'name' => 'Lomri Amiruddin',
                'role_en' => 'Art Director',
                'role_id' => 'Art Director',
                'phone' => '+62 812-8825-524',
                'quote_en' => 'Art is the bridge between market demand and pure imagination.',
                'quote_id' => 'Seni adalah jembatan antara permintaan pasar dan imajinasi murni.',
                'description_en' => 'Co-directs the visual identity and structural designs for print media and branding items.',
                'description_id' => 'Mengarahkan bersama identitas visual dan desain struktural untuk media cetak dan produk branding.',
                'photo_path' => 'uploads/team/lomri.jpg',
                'priority' => 4
            ],
            [
                'name' => 'Asep Saepudin',
                'role_en' => 'Production Manager',
                'role_id' => 'Manajer Produksi',
                'phone' => '+62 813-8034-1092',
                'quote_en' => 'Bridging the creative spark with technical production precision.',
                'quote_id' => 'Menghubungkan percikan kreatif dengan presisi produksi teknis.',
                'description_en' => 'Manages the production floor, print manufacturing, machinery schedule, and delivery logistics.',
                'description_id' => 'Mengelola lantai produksi, manufaktur cetak, jadwal mesin, dan logistik pengiriman.',
                'photo_path' => 'uploads/team/asep.jpg',
                'priority' => 5
            ],
            [
                'name' => 'Andi Supriadi',
                'role_en' => 'Graphic Designer',
                'role_id' => 'Desainer Grafis',
                'phone' => '+62 877-7408-7727',
                'quote_en' => 'Designing details that make products stand out.',
                'quote_id' => 'Mendesain detail-detail yang membuat produk menonjol.',
                'description_en' => 'Focuses on campaign layout, vector design, device mockup, and promotional material illustration.',
                'description_id' => 'Berfokus pada tata letak kampanye, desain vektor, mockup perangkat, dan ilustrasi materi promosi.',
                'photo_path' => 'uploads/team/andi.jpg',
                'priority' => 6
            ],
            [
                'name' => 'Iwan Setiawan',
                'role_en' => 'Purchasing Manager',
                'role_id' => 'Manajer Pembelian',
                'phone' => '+62 856-9292-1200',
                'quote_en' => 'Sourcing quality materials to bring designs to life.',
                'quote_id' => 'Mencari bahan berkualitas untuk menghidupkan desain.',
                'description_en' => 'Responsible for procurement of raw materials, print components, neon box materials, and supplier management.',
                'description_id' => 'Bertanggung jawab atas pengadaan bahan baku, komponen cetak, bahan neon box, dan manajemen pemasok.',
                'photo_path' => 'uploads/team/iwan.jpg',
                'priority' => 7
            ],
            [
                'name' => 'Ma\'sum Permana',
                'role_en' => 'Production Supervisor',
                'role_id' => 'Supervisor Produksi',
                'phone' => '+62 858-9224-6784',
                'quote_en' => 'Quality control is in the details of the assembly line.',
                'quote_id' => 'Kontrol kualitas ada pada detail jalur perakitan.',
                'description_en' => 'Supervises print outputs, cutting alignments, packaging finishes, and logistics coordination.',
                'description_id' => 'Mengawasi hasil cetak, keselarasan pemotongan, penyelesaian kemasan, dan koordinasi logistik.',
                'photo_path' => 'uploads/team/masum.jpg',
                'priority' => 8
            ],
            [
                'name' => 'Putri W Ramadhania',
                'role_en' => 'Finance & Accounting',
                'role_id' => 'Keuangan & Akuntansi',
                'phone' => '+62 857-7968-3340',
                'quote_en' => 'Balancing creativity with financial soundness and efficiency.',
                'quote_id' => 'Menyeimbangkan kreativitas dengan kesehatan finansial dan efisiensi.',
                'description_en' => 'Handles account billing, vendor invoices, tax compliance (NPWP), and financial reporting.',
                'description_id' => 'Menangani penagihan akun, faktur vendor, kepatuhan pajak (NPWP), dan pelaporan keuangan.',
                'photo_path' => 'uploads/team/putri.jpg',
                'priority' => 9
            ]
        ];

        foreach ($team as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                [
                    'role_en' => $member['role_en'],
                    'role_id' => $member['role_id'],
                    'phone' => $member['phone'],
                    'quote_en' => $member['quote_en'],
                    'quote_id' => $member['quote_id'],
                    'description_en' => $member['description_en'],
                    'description_id' => $member['description_id'],
                    'photo_path' => $member['photo_path'],
                    'priority' => $member['priority']
                ]
            );
        }
    }
}
