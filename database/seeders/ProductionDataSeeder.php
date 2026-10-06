<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionDataSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Table: settings (50 rows)
        $data_settings = array (
  0 => 
  array (
    'id' => 1,
    'key' => 'company_name',
    'value' => 'Boutique Design Indonesia',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
  1 => 
  array (
    'id' => 2,
    'key' => 'address',
    'value' => 'Jl. persatuan No.5C, RT.2RW.4, Sukabumi Sel., Kec. kebayoran Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota jakarta 11560',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 15:00:56',
  ),
  2 => 
  array (
    'id' => 3,
    'key' => 'phone',
    'value' => '021 1234567',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-24 23:47:24',
  ),
  3 => 
  array (
    'id' => 4,
    'key' => 'email',
    'value' => 'boutiquedesign48@gmail.com',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 20:17:21',
  ),
  4 => 
  array (
    'id' => 5,
    'key' => 'npwp',
    'value' => '70.007.006.3-035.000',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
  5 => 
  array (
    'id' => 6,
    'key' => 'slogan_main_en',
    'value' => 'When you are thirsty for ideas, when you need something makes you fresh, Boutique Design Indonesia',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 18:06:44',
  ),
  6 => 
  array (
    'id' => 7,
    'key' => 'slogan_main_id',
    'value' => 'Ketika Anda haus akan ide, ketika Anda butuh sesuatu yang membuat Anda segar, Boutique Design Indonesia',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 18:06:44',
  ),
  7 => 
  array (
    'id' => 8,
    'key' => 'slogan_sub_en',
    'value' => 'grab even bigger ideas with us',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 18:07:07',
  ),
  8 => 
  array (
    'id' => 9,
    'key' => 'slogan_sub_id',
    'value' => 'raih ide yang lebih besar bersama kami',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 18:07:07',
  ),
  9 => 
  array (
    'id' => 10,
    'key' => 'slogan_philosophy_en',
    'value' => 'Quality is Priority',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-24 23:47:24',
  ),
  10 => 
  array (
    'id' => 11,
    'key' => 'slogan_philosophy_id',
    'value' => 'Kualitas adalah Prioritas',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-24 23:47:24',
  ),
  11 => 
  array (
    'id' => 12,
    'key' => 'contact_person_1_name',
    'value' => '(Direktur) Enung Kosasih',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-11 04:18:59',
  ),
  12 => 
  array (
    'id' => 13,
    'key' => 'contact_person_1_phone',
    'value' => '0856 9317 4242',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
  13 => 
  array (
    'id' => 14,
    'key' => 'contact_person_2_name',
    'value' => '(Direktur Kreatif) Oleh Wijayana',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-11 04:18:59',
  ),
  14 => 
  array (
    'id' => 15,
    'key' => 'contact_person_2_phone',
    'value' => '0858 9111 8571',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
  15 => 
  array (
    'id' => 16,
    'key' => 'contact_person_3_name',
    'value' => '',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 15:01:05',
  ),
  16 => 
  array (
    'id' => 17,
    'key' => 'contact_person_3_phone',
    'value' => '',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-10-05 15:01:05',
  ),
  17 => 
  array (
    'id' => 18,
    'key' => 'contact_person_4_name',
    'value' => '',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  18 => 
  array (
    'id' => 19,
    'key' => 'contact_person_4_phone',
    'value' => '',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  19 => 
  array (
    'id' => 20,
    'key' => 'instagram_url',
    'value' => 'https://www.instagram.com/boutiquedesign_indonesia?stkn=a2RnMG51Z2FjZDg0',
    'created_at' => '2026-09-22 18:13:53',
    'updated_at' => '2026-09-22 18:13:53',
  ),
  20 => 
  array (
    'id' => 21,
    'key' => 'philosophy_image',
    'value' => '',
    'created_at' => '2026-09-24 17:16:12',
    'updated_at' => '2026-09-24 17:16:42',
  ),
  21 => 
  array (
    'id' => 22,
    'key' => 'philosophy_desc_en',
    'value' => 'We look at designs not as static layouts, but as complex cognitive connections. Our design philosophy bridges human neurons, emotional body responses, and social problem-solving into a cohesive structural campaign.',
    'created_at' => '2026-09-24 17:16:52',
    'updated_at' => '2026-09-24 17:16:52',
  ),
  22 => 
  array (
    'id' => 23,
    'key' => 'philosophy_desc_id',
    'value' => 'Kami memandang desain bukan sekadar tata letak statis, melainkan hubungan kognitif yang kompleks. Filosofi desain kami menjembatani neuron manusia, respons emosional tubuh, dan pemecahan masalah sosial ke dalam kampanye struktural yang kohesif.',
    'created_at' => '2026-09-24 17:16:52',
    'updated_at' => '2026-09-24 17:16:52',
  ),
  23 => 
  array (
    'id' => 24,
    'key' => 'direct_contacts',
    'value' => '[{"name":"(Direktur) Enung Kosasih","phone":"0856 9317 4242"},{"name":"(Direktur Kreatif) Oleh Wijayana","phone":"0858 9111 8571"}]',
    'created_at' => '2026-09-24 23:47:24',
    'updated_at' => '2026-10-05 15:01:05',
  ),
  24 => 
  array (
    'id' => 25,
    'key' => 'contact_person_5_name',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  25 => 
  array (
    'id' => 26,
    'key' => 'contact_person_5_phone',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  26 => 
  array (
    'id' => 27,
    'key' => 'contact_person_6_name',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  27 => 
  array (
    'id' => 28,
    'key' => 'contact_person_6_phone',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  28 => 
  array (
    'id' => 29,
    'key' => 'contact_person_7_name',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  29 => 
  array (
    'id' => 30,
    'key' => 'contact_person_7_phone',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  30 => 
  array (
    'id' => 31,
    'key' => 'contact_person_8_name',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  31 => 
  array (
    'id' => 32,
    'key' => 'contact_person_8_phone',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  32 => 
  array (
    'id' => 33,
    'key' => 'contact_person_9_name',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  33 => 
  array (
    'id' => 34,
    'key' => 'contact_person_9_phone',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  34 => 
  array (
    'id' => 35,
    'key' => 'contact_person_10_name',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  35 => 
  array (
    'id' => 36,
    'key' => 'contact_person_10_phone',
    'value' => '',
    'created_at' => '2026-09-25 00:07:09',
    'updated_at' => '2026-09-25 00:07:09',
  ),
  36 => 
  array (
    'id' => 37,
    'key' => 'hero_bg_video_url',
    'value' => '',
    'created_at' => '2026-10-05 19:15:15',
    'updated_at' => '2026-10-05 19:15:15',
  ),
  37 => 
  array (
    'id' => 38,
    'key' => 'hero_overlay_opacity',
    'value' => '34',
    'created_at' => '2026-10-05 19:15:15',
    'updated_at' => '2026-10-05 19:37:53',
  ),
  38 => 
  array (
    'id' => 39,
    'key' => 'hero_overlay_color',
    'value' => 'light',
    'created_at' => '2026-10-05 19:15:15',
    'updated_at' => '2026-10-05 19:15:15',
  ),
  39 => 
  array (
    'id' => 40,
    'key' => 'hero_bg_type',
    'value' => 'image',
    'created_at' => '2026-10-05 19:15:15',
    'updated_at' => '2026-10-05 19:15:15',
  ),
  40 => 
  array (
    'id' => 41,
    'key' => 'services_bg_video_url',
    'value' => '',
    'created_at' => '2026-10-05 19:15:53',
    'updated_at' => '2026-10-05 19:15:53',
  ),
  41 => 
  array (
    'id' => 42,
    'key' => 'services_overlay_opacity',
    'value' => '53',
    'created_at' => '2026-10-05 19:15:53',
    'updated_at' => '2026-10-05 19:15:53',
  ),
  42 => 
  array (
    'id' => 43,
    'key' => 'services_overlay_color',
    'value' => 'light',
    'created_at' => '2026-10-05 19:15:53',
    'updated_at' => '2026-10-05 19:15:53',
  ),
  43 => 
  array (
    'id' => 44,
    'key' => 'services_bg_type',
    'value' => 'image',
    'created_at' => '2026-10-05 19:15:53',
    'updated_at' => '2026-10-05 19:15:53',
  ),
  44 => 
  array (
    'id' => 45,
    'key' => 'about_bg_type',
    'value' => 'image',
    'created_at' => '2026-10-05 19:21:01',
    'updated_at' => '2026-10-05 19:21:01',
  ),
  45 => 
  array (
    'id' => 46,
    'key' => 'about_bg_image',
    'value' => 'uploads/about-bg.jpg',
    'created_at' => '2026-10-05 19:21:01',
    'updated_at' => '2026-10-05 19:21:01',
  ),
  46 => 
  array (
    'id' => 47,
    'key' => 'about_overlay_opacity',
    'value' => '37',
    'created_at' => '2026-10-05 19:21:01',
    'updated_at' => '2026-10-05 19:30:47',
  ),
  47 => 
  array (
    'id' => 48,
    'key' => 'about_overlay_color',
    'value' => 'light',
    'created_at' => '2026-10-05 19:21:01',
    'updated_at' => '2026-10-05 19:21:01',
  ),
  48 => 
  array (
    'id' => 49,
    'key' => 'about_bg_video_url',
    'value' => '',
    'created_at' => '2026-10-05 19:30:47',
    'updated_at' => '2026-10-05 19:30:47',
  ),
  49 => 
  array (
    'id' => 50,
    'key' => 'company_emails',
    'value' => '["boutiquedesign48@gmail.com","boutique.design@yahoo.co.id"]',
    'created_at' => '2026-10-05 20:08:00',
    'updated_at' => '2026-10-05 20:18:33',
  ),
);
        if (!empty($data_settings)) {
            DB::table('settings')->truncate();
            foreach (array_chunk($data_settings, 100) as $chunk) {
                DB::table('settings')->insert($chunk);
            }
        }

        // Table: philosophies (15 rows)
        $data_philosophies = array (
  0 => 
  array (
    'id' => 1,
    'key' => 'philosophy',
    'title_en' => 'PHILOSOPHY',
    'title_id' => 'FILOSOFI',
    'subtitle_en' => 'Creative Foundation',
    'subtitle_id' => 'Fondasi Pemikiran Kreatif',
    'icon' => 'bi-lightbulb-fill',
    'image_path' => 'uploads/philosophy/1789103131_6aa38c1b36bb6.jpg',
    'description_en' => 'Our philosophy views design not just as static aesthetics, but as a deep cognitive bridge connecting brand messaging with audience perception.',
    'description_id' => 'Filosofi kami memandang desain bukan sekadar estetika visual statis, melainkan jembatan kognitif mendalam yang menyatukan pesan brand dengan persepsi audiens.',
    'is_highlighted' => 0,
    'sort_order' => 1,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-09-11 05:05:31',
  ),
  1 => 
  array (
    'id' => 2,
    'key' => 'collective',
    'title_en' => 'Collective',
    'title_id' => 'Kolektif',
    'subtitle_en' => 'Synergy of Team & Clients',
    'subtitle_id' => 'Kekuatan Sinergi Tim & Klien',
    'icon' => 'bi-people-fill',
    'image_path' => 'uploads/philosophy/1791206503_6ac3a4679996a.webp',
    'description_en' => 'Great ideas are born from collective collaboration. We bring diverse perspectives together to create powerful, market-relevant strategies.',
    'description_id' => 'Ide-ide besar lahir dari kolaborasi kolektif. Kami menyatukan perspektif beragam untuk menghasilkan strategi yang kuat dan relevan bagi pasar.',
    'is_highlighted' => 0,
    'sort_order' => 2,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-05 20:21:43',
  ),
  2 => 
  array (
    'id' => 3,
    'key' => 'mental',
    'title_en' => 'Mental',
    'title_id' => 'Mental',
    'subtitle_en' => 'Mindset & Creative Agility',
    'subtitle_id' => 'Kesiapan & Ketahanan Pola Pikir',
    'icon' => 'bi-heart-pulse-fill',
    'image_path' => 'uploads/philosophy/1791262101_6ac47d952c1ff.jpg',
    'description_en' => 'Building mental agility to stay receptive to new challenges, future creative trends, and out-of-the-box solutions.',
    'description_id' => 'Membangun ketajaman mental untuk selalu terbuka terhadap tantangan baru, tren kreatif masa depan, dan solusi out-of-the-box.',
    'is_highlighted' => 0,
    'sort_order' => 3,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:48:21',
  ),
  3 => 
  array (
    'id' => 4,
    'key' => 'think',
    'title_en' => 'Think',
    'title_id' => 'Pikir',
    'subtitle_en' => 'Analytical & Strategic Thinking',
    'subtitle_id' => 'Proses Analitis & Strategis',
    'icon' => 'bi-gear-wide-connected',
    'image_path' => 'uploads/philosophy/1791262071_6ac47d7749aaa.jpg',
    'description_en' => 'Before executing visuals, we think deeply about business goals, audience personas, and brand differentiation.',
    'description_id' => 'Sebelum mengeksekusi visual, kami berpikir secara mendalam mengenai tujuan bisnis, persona target audiens, dan diferensiasi brand Anda.',
    'is_highlighted' => 0,
    'sort_order' => 4,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:47:51',
  ),
  4 => 
  array (
    'id' => 5,
    'key' => 'cognitive',
    'title_en' => 'Cognitive',
    'title_id' => 'Kognitif',
    'subtitle_en' => 'Perception & Memory Response',
    'subtitle_id' => 'Respons Persepsi & Memori',
    'icon' => 'bi-cpu-fill',
    'image_path' => 'uploads/philosophy/1791262017_6ac47d418e200.jpg',
    'description_en' => 'Understanding how audiences capture, process, and retain your message through structured visual hierarchy and brand narrative.',
    'description_id' => 'Memahami bagaimana audiens menangkap, memproses, dan mengingat pesan Anda melalui hierarki visual dan narasi brand yang terarah.',
    'is_highlighted' => 0,
    'sort_order' => 5,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:46:57',
  ),
  5 => 
  array (
    'id' => 6,
    'key' => 'mind',
    'title_en' => 'MIND',
    'title_id' => 'PIKIRAN',
    'subtitle_en' => 'Limitless Exploration',
    'subtitle_id' => 'Ruang Eksplorasi Tanpa Batas',
    'icon' => 'bi-stars',
    'image_path' => 'uploads/philosophy/1791261988_6ac47d244347d.jpg',
    'description_en' => 'The mind is the laboratory where wild imagination is distilled into high-impact commercial concepts with real results.',
    'description_id' => 'Pikiran adalah laboratorium tempat imajinasi liar diramu menjadi konsep komersial yang berdaya tarik tinggi dan menghasilkan dampak nyata.',
    'is_highlighted' => 1,
    'sort_order' => 6,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:46:28',
  ),
  6 => 
  array (
    'id' => 7,
    'key' => 'problem',
    'title_en' => 'Problem',
    'title_id' => 'Masalah',
    'subtitle_en' => 'Catalyst for Innovation',
    'subtitle_id' => 'Peluang untuk Inovasi',
    'icon' => 'bi-patch-question-fill',
    'image_path' => 'uploads/philosophy/1791261966_6ac47d0eab50d.jpg',
    'description_en' => 'We do not avoid market problems; we dissect them to find the best creative angles that solve your brand barriers.',
    'description_id' => 'Kami tidak menghindari masalah pasar; kami membedahnya untuk menemukan sudut pandang kreatif terbaik yang memecahkan hambatan brand Anda.',
    'is_highlighted' => 0,
    'sort_order' => 7,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:46:06',
  ),
  7 => 
  array (
    'id' => 8,
    'key' => 'psychology',
    'title_en' => 'Psychology',
    'title_id' => 'Psikologi',
    'subtitle_en' => 'Consumer Emotional Touch',
    'subtitle_id' => 'Sentuhan Emosional Konsumen',
    'icon' => 'bi-person-heart',
    'image_path' => 'uploads/philosophy/1791261514_6ac47b4a213b1.jpg',
    'description_en' => 'Analyzing consumer behavior, emotion, and psychological motivation to create campaigns that resonate deeply and trigger action.',
    'description_id' => 'Menganalisis perilaku, emosi, dan motivasi psikologis konsumen untuk menciptakan kampanye yang menyentuh hati dan menggerakkan tindakan.',
    'is_highlighted' => 0,
    'sort_order' => 8,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:38:34',
  ),
  8 => 
  array (
    'id' => 9,
    'key' => 'human',
    'title_en' => 'Human',
    'title_id' => 'Manusia',
    'subtitle_en' => 'Human-Centric Approach',
    'subtitle_id' => 'Pendekatan Human-Centric',
    'icon' => 'bi-person-badge',
    'image_path' => 'uploads/philosophy/1791261937_6ac47cf1cdb0a.jpg',
    'description_en' => 'The best designs are human-centric. We craft work that is intuitive, empathetic, and meaningful in everyday life.',
    'description_id' => 'Desain terbaik berpusat pada manusia. Kami menciptakan karya yang ramah, berempati, dan bermakna bagi kehidupan sehari-hari.',
    'is_highlighted' => 0,
    'sort_order' => 9,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:45:37',
  ),
  9 => 
  array (
    'id' => 10,
    'key' => 'brain',
    'title_en' => 'BRAIN',
    'title_id' => 'OTAK',
    'subtitle_en' => 'Logic & Creative Artistry',
    'subtitle_id' => 'Integrasi Logika & Seni Kreatif',
    'icon' => 'bi-diagram-3-fill',
    'image_path' => 'uploads/philosophy/1791262679_6ac47fd73fd50.jpg',
    'description_en' => 'Harmoniously balancing left-brain logic (data analysis, business calculation) with right-brain artistry (art aesthetics, visual emotion).',
    'description_id' => 'Menyeimbangkan fungsi otak kiri (analisis data, kalkulasi bisnis) dan otak kanan (estetika seni, emosi visual) secara harmonis.',
    'is_highlighted' => 1,
    'sort_order' => 10,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:57:59',
  ),
  10 => 
  array (
    'id' => 11,
    'key' => 'neurons',
    'title_en' => 'Neurons',
    'title_id' => 'Neuron',
    'subtitle_en' => 'Spark of Idea Connections',
    'subtitle_id' => 'Percikan Koneksi Ide',
    'icon' => 'bi-lightning-charge-fill',
    'image_path' => 'uploads/philosophy/1791262382_6ac47eae24032.webp',
    'description_en' => 'Each neuron represents a synapse of creative ideas interconnecting to form a comprehensive campaign ecosystem (ATL, BTL & Digital).',
    'description_id' => 'Setiap neuron merepresentasikan sinapsis ide kreatif yang saling terhubung membentuk kesatuan kampanye komprehensif (ATL, BTL & Digital).',
    'is_highlighted' => 0,
    'sort_order' => 11,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:53:02',
  ),
  11 => 
  array (
    'id' => 12,
    'key' => 'body',
    'title_en' => 'Body',
    'title_id' => 'Tubuh',
    'subtitle_en' => 'Physical Execution & Touchpoint',
    'subtitle_id' => 'Realisasi & Eksekusi Nyata',
    'icon' => 'bi-activity',
    'image_path' => 'uploads/philosophy/1791261486_6ac47b2ede5c1.jpg',
    'description_en' => 'Great concepts demand solid real-world execution—from premium print materials to physical field activations.',
    'description_id' => 'Konsep hebat memerlukan eksekusi nyata yang solid—mulai dari materi cetak berkualitas premium hingga aktivasi fisik di lapangan.',
    'is_highlighted' => 0,
    'sort_order' => 12,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:38:06',
  ),
  12 => 
  array (
    'id' => 13,
    'key' => 'ego',
    'title_en' => 'Ego',
    'title_id' => 'Ego',
    'subtitle_en' => 'Unique Brand Character',
    'subtitle_id' => 'Karakter & Diferensiasi Brand',
    'icon' => 'bi-shield-shaded',
    'image_path' => 'uploads/philosophy/1791261462_6ac47b16aa0a5.webp',
    'description_en' => 'Building a bold and distinctive brand character that stands out with confidence and strong differentiation in competitive markets.',
    'description_id' => 'Membangun karakter dan ciri khas brand yang berani tampil beda, percaya diri, dan memiliki diferensiasi kuat di pasar kompetitif.',
    'is_highlighted' => 0,
    'sort_order' => 13,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:37:42',
  ),
  13 => 
  array (
    'id' => 14,
    'key' => 'individual',
    'title_en' => 'Individual',
    'title_id' => 'Individu',
    'subtitle_en' => 'Tailored Bespoke Solutions',
    'subtitle_id' => 'Sentuhan Personal & Kustom',
    'icon' => 'bi-person-check-fill',
    'image_path' => 'uploads/philosophy/1791261909_6ac47cd5e9190.jpg',
    'description_en' => 'Every brand and client is unique. We provide tailored approaches crafted specifically to your unique requirements.',
    'description_id' => 'Setiap brand dan klien memiliki keunikan tersendiri. Kami menyediakan pendekatan yang dipersonalisasi sesuai kebutuhan spesifik Anda.',
    'is_highlighted' => 0,
    'sort_order' => 14,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:45:09',
  ),
  14 => 
  array (
    'id' => 15,
    'key' => 'see',
    'title_en' => 'See',
    'title_id' => 'Lihat',
    'subtitle_en' => 'Vision & Fresh Perspectives',
    'subtitle_id' => 'Visi & Perspektif Masa Depan',
    'icon' => 'bi-eye-fill',
    'image_path' => 'uploads/philosophy/1791259901_6ac474fdefbf4.jpg',
    'description_en' => 'Looking beyond standard industry boundaries—discovering fresh perspectives that keep your brand ahead of the curve.',
    'description_id' => 'Melihat melampaui batas standar industri—menemukan sudut pandang baru yang membuat brand Anda selalu relevan dan terdepan.',
    'is_highlighted' => 0,
    'sort_order' => 15,
    'created_at' => '2026-09-11 04:55:46',
    'updated_at' => '2026-10-06 11:11:41',
  ),
);
        if (!empty($data_philosophies)) {
            DB::table('philosophies')->truncate();
            foreach (array_chunk($data_philosophies, 100) as $chunk) {
                DB::table('philosophies')->insert($chunk);
            }
        }

        // Table: services (3 rows)
        $data_services = array (
  0 => 
  array (
    'id' => 1,
    'title_en' => 'ATL & BTL Campaign Services',
    'title_id' => 'Jasa Kampanye ATL & BTL',
    'category' => 'ATL & BTL',
    'description_en' => 'Our services are specialized for both Above The Line (ATL) and Below The Line (BTL) marketing and advertising solutions, offering integrated and comprehensive coverage to reach target audiences effectively.',
    'description_id' => 'Layanan kami berspesialisasi dalam solusi pemasaran dan periklanan baik Above The Line (ATL) maupun Below The Line (BTL), menawarkan cakupan yang terintegrasi dan komprehensif untuk menjangkau audiens target secara efektif.',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
  1 => 
  array (
    'id' => 2,
    'title_en' => 'Creative & Media Concept',
    'title_id' => 'Konsep Kreatif & Media',
    'category' => 'Concept',
    'description_en' => 'Development campaign of TVC (Television Commercial), print advertisements, POS (Point of Sale) materials, radio ads, and corporate/video profiles.',
    'description_id' => 'Pengembangan kampanye TVC (Iklan Televisi), iklan cetak, materi POS (Point of Sale), iklan radio, dan video profil perusahaan.',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
  2 => 
  array (
    'id' => 3,
    'title_en' => 'Graphic Design Concept',
    'title_id' => 'Konsep Desain Grafis',
    'category' => 'Graphic Design Concept',
    'description_en' => 'Full graphic design development including logo & icon device campaign creation, storyboards development, and simple yet impactful packaging design.',
    'description_id' => 'Pengembangan desain grafis lengkap termasuk pembuatan logo & ikon kampanye, pengembangan storyboard, dan desain kemasan yang simpel namun berdampak kuat.',
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:33:55',
  ),
);
        if (!empty($data_services)) {
            DB::table('services')->truncate();
            foreach (array_chunk($data_services, 100) as $chunk) {
                DB::table('services')->insert($chunk);
            }
        }

        // Table: portfolios (18 rows)
        $data_portfolios = array (
  0 => 
  array (
    'id' => 1,
    'title_en' => 'Brochure',
    'title_id' => 'Brosur',
    'category_en' => 'Brochure',
    'category_id' => 'Brosur',
    'image_path' => 'uploads/portfolio/1791212981_6ac3bdb5c64c0.jpg',
    'description_en' => 'Printed using a tri-fold brochure format with a neat multi-column layout, harmoniously combining elements of solid text information, scientific graphics, and product photos',
    'description_id' => 'Dicetak menggunakan format brosur lipat tiga  dengan tata letak multi-kolom yang rapi, memadukan elemen informasi teks padat, grafik ilmiah, serta foto produk secara harmonis',
    'created_at' => '2026-10-05 22:09:41',
    'updated_at' => '2026-10-05 22:09:41',
  ),
  1 => 
  array (
    'id' => 2,
    'title_en' => 'Pouch',
    'title_id' => 'Kantong',
    'category_en' => 'Pouch',
    'category_id' => 'Kantong',
    'image_path' => 'uploads/portfolio/1791213518_6ac3bfcedb673.jpg',
    'description_en' => 'Enhance your brand identity and appreciation for your clients through our exclusive Custom Pouch collection from our printing service. Designed with a modern aesthetic and practical functionality in mind, these pouches are an ideal medium for souvenirs or corporate merchandise for a variety of promotional needs.',
    'description_id' => 'Tingkatkan citra merek (brand identity) dan apresiasi kepada klien Anda melalui koleksi Custom Pouch eksklusif dari layanan percetakan kami. Dirancang dengan memadukan estetika modern dan fungsi praktis, pouch ini adalah media suvenir atau merchandise korporat yang sangat ideal untuk berbagai kebutuhan promosi.',
    'created_at' => '2026-10-05 22:18:38',
    'updated_at' => '2026-10-05 22:18:38',
  ),
  2 => 
  array (
    'id' => 3,
    'title_en' => 'Brochure',
    'title_id' => 'Brosur',
    'category_en' => 'Brochure',
    'category_id' => 'Brosur',
    'image_path' => 'uploads/portfolio/1791213639_6ac3c04749781.jpg',
    'description_en' => 'Ideal for the promotional needs of beauty clinics, pharmaceutical products, fashion, and large corporations that demand aesthetic standards and uncompromising print quality.',
    'description_id' => 'Sangat ideal untuk kebutuhan promosi klinik kecantikan, produk farmasi, fashion, maupun korporat besar yang menuntut standar estetika dan kualitas cetak tanpa kompromi.',
    'created_at' => '2026-10-05 22:20:39',
    'updated_at' => '2026-10-05 22:20:39',
  ),
  3 => 
  array (
    'id' => 4,
    'title_en' => 'Mockup dummy giant product',
    'title_id' => 'Mockup dummy giant product',
    'category_en' => 'Mockup dummy giant product',
    'category_id' => 'Mockup dummy giant product',
    'image_path' => 'uploads/portfolio/1791213737_6ac3c0a99cf70.jpg',
    'description_en' => 'Promotional display media with attractive and professional designs, made to support the needs of branding, product promotion, events, and marketing activities. With its print quality and neat finish, the standee provides a strong visual appearance while strengthening the brand identity in the promotional area.',
    'description_id' => 'Media display promosi dengan desain yang menarik dan profesional, dibuat untuk mendukung kebutuhan branding, promosi produk, event, dan aktivitas marketing. Dengan kualitas cetak dan finishing yang rapi, standee memberikan tampilan visual yang kuat sekaligus memperkuat identitas brand di area promosi.',
    'created_at' => '2026-10-05 22:22:17',
    'updated_at' => '2026-10-05 22:22:17',
  ),
  4 => 
  array (
    'id' => 5,
    'title_en' => 'Mockup dummy giant product',
    'title_id' => 'Mockup dummy giant product',
    'category_en' => 'Mockup dummy giant product',
    'category_id' => 'Mockup dummy giant product',
    'image_path' => 'uploads/portfolio/1791213781_6ac3c0d53c157.jpg',
    'description_en' => 'Custom product displays with designs resembling product packaging, equipped with tiered shelves to display and organize products neatly. The combination of premium materials, colors, and finishes provides an elegant look while strengthening product branding in promotional, retail, clinic, and event areas.',
    'description_id' => 'Display produk custom dengan desain menyerupai kemasan produk, dilengkapi rak bertingkat untuk menampilkan dan menata produk secara rapi. Perpaduan material, warna, dan finishing premium memberikan tampilan elegan sekaligus memperkuat branding produk di area promosi, retail, klinik, maupun event.',
    'created_at' => '2026-10-05 22:23:01',
    'updated_at' => '2026-10-05 22:23:01',
  ),
  5 => 
  array (
    'id' => 6,
    'title_en' => 'Ritrama Sticker Cut Out Mockup',
    'title_id' => 'Mockup Sticker Cut Out berbahan Ritrama',
    'category_en' => 'Ritrama Sticker Cut Out Mockup',
    'category_id' => 'Mockup Sticker Cut Out berbahan Ritrama',
    'image_path' => 'uploads/portfolio/1791214710_6ac3c4769d108.jpg',
    'description_en' => 'High-quality Ritrama cut out stickers are an elegant, durable, and professional vehicle aesthetic and promotional media solution. Specially designed for installation on windshields or rear windshields of vehicles (such as SUVs, commercial cars, or company operations), these stickers provide a sharp and classy branding look.',
    'description_id' => 'Sticker cut out berbahan Ritrama berkualitas tinggi merupakan solusi media promosi dan estetika kendaraan yang elegan, tahan lama, dan profesional. Dirancang khusus untuk pemasangan pada kaca depan maupun kaca belakang kendaraan (seperti mobil SUV, komersial, atau operasional perusahaan), stiker ini memberikan tampilan branding yang tajam dan berkelas.',
    'created_at' => '2026-10-05 22:38:30',
    'updated_at' => '2026-10-05 22:38:30',
  ),
  6 => 
  array (
    'id' => 7,
    'title_en' => 'Ritrama Sticker Cut Out Mockup',
    'title_id' => 'Mockup Sticker Cut Out berbahan Ritrama',
    'category_en' => 'Ritrama Sticker Cut Out Mockup',
    'category_id' => 'Mockup Sticker Cut Out berbahan Ritrama',
    'image_path' => 'uploads/portfolio/1791217069_6ac3cdad2f7b1.jpg',
    'description_en' => 'Ritrama\'s Sticker Cut Out design mockup and manufacturing services for full-body side wrapping/decals deliver dynamic, strong character and professional mobile branding, campaign or visual identity solutions.',
    'description_id' => 'Layanan pembuatan dan mockup desain Sticker Cut Out Ritrama untuk bodi samping kendaraan (full-body side wrapping/decals) menghadirkan solusi mobile branding, kampanye, atau identitas visual yang dinamis, berkarakter kuat, dan profesional.',
    'created_at' => '2026-10-05 22:49:10',
    'updated_at' => '2026-10-05 23:39:12',
  ),
  7 => 
  array (
    'id' => 8,
    'title_en' => 'event desk portable table',
    'title_id' => 'meja portabel event desk',
    'category_en' => 'event desk portable table',
    'category_id' => 'meja portabel event desk',
    'image_path' => 'uploads/portfolio/1791227217_6ac3f55161a77.jpg',
    'description_en' => 'Event Desk is a portable promotional media that is ideal and efficient for exhibition purposes, bazaars, product sampling, brand promotion, to indoor and outdoor event activities.',
    'description_id' => 'Event Desk adalah media promosi portabel yang sangat ideal dan efisien untuk keperluan pameran, bazaar, sampling produk, promosi brand, hingga kegiatan event indoor maupun outdoor.',
    'created_at' => '2026-10-06 02:06:57',
    'updated_at' => '2026-10-06 02:06:57',
  ),
  8 => 
  array (
    'id' => 9,
    'title_en' => 'puppet gimmick',
    'title_id' => 'gimik boneka',
    'category_en' => 'puppet gimmick',
    'category_id' => 'gimik boneka',
    'image_path' => 'uploads/portfolio/1791227359_6ac3f5df34cd6.jpg',
    'description_en' => 'Present a visual representation of your brand in its most adorable and unforgettable form. Our corporate doll gimmick making service is the perfect solution to create a deeper emotional connection with clients, business partners and employees. Not just dolls, these are small ambassadors of your company printed with high precision.',
    'description_id' => 'Hadirkan representasi visual brand Anda dalam wujud yang paling menggemaskan dan tak terlupakan. Layanan pembuatan gimmick boneka korporat kami adalah solusi sempurna untuk menciptakan hubungan emosional yang lebih dalam dengan klien, mitra bisnis, dan karyawan. Bukan sekadar boneka, ini adalah duta kecil perusahaan Anda yang dicetak dengan presisi tinggi.',
    'created_at' => '2026-10-06 02:09:19',
    'updated_at' => '2026-10-06 02:09:19',
  ),
  9 => 
  array (
    'id' => 10,
    'title_en' => 'Highway Billboards',
    'title_id' => 'Baliho Jalan Tol Raya',
    'category_en' => 'Highway Billboards',
    'category_id' => 'Baliho Jalan Tol Raya',
    'image_path' => 'uploads/portfolio/1791227450_6ac3f63a261e9.jpg',
    'description_en' => 'Installation of large-scale steel-structured toll road billboards. Print high-quality wide-format solvents that are resistant to sunlight and rain.',
    'description_id' => 'Instalasi baliho jalan tol berstruktur baja skala besar. Cetak solvent format lebar berkualitas tinggi yang tahan terhadap sinar matahari dan hujan.',
    'created_at' => '2026-10-06 02:10:50',
    'updated_at' => '2026-10-06 02:10:50',
  ),
  10 => 
  array (
    'id' => 11,
    'title_en' => 'Zippered canvas tote bag',
    'title_id' => 'tote bag berbahan canvas beritsleting',
    'category_en' => 'Zippered canvas tote bag',
    'category_id' => 'tote bag berbahan canvas beritsleting',
    'image_path' => 'uploads/portfolio/1791227577_6ac3f6b931bca.jpg',
    'description_en' => 'Enhance the prestige and visibility of your client\'s brand through a collection of high-quality Custom Tote Bags from our printing production line. Designed to combine function, durability and modern aesthetics, this bag is an ideal souvenir or corporate merchandise for various professional events, seminars and product launches.',
    'description_id' => 'Tingkatkan prestise dan visibilitas merek klien Anda melalui koleksi Custom Tote Bag berkualitas tinggi dari lini produksi percetakan kami. Dirancang dengan memadukan fungsi, ketahanan, dan estetika modern, tas ini merupakan media suvenir atau merchandise korporat yang sangat ideal untuk berbagai acara profesional, seminar, maupun peluncuran produk.',
    'created_at' => '2026-10-06 02:12:57',
    'updated_at' => '2026-10-06 02:12:57',
  ),
  11 => 
  array (
    'id' => 12,
    'title_en' => 'acrylic plaque',
    'title_id' => 'plakat akrilik',
    'category_en' => 'acrylic plaque',
    'category_id' => 'plakat akrilik',
    'image_path' => 'uploads/portfolio/1791227659_6ac3f70b339df.jpg',
    'description_en' => 'The best choice for corporations, institutions and event organizers who want to provide highly memorable souvenirs for their best partners, clients or employees.',
    'description_id' => 'Pilihan terbaik bagi korporasi, institusi, maupun penyelenggara acara yang ingin memberikan cinderamata berkesan tinggi untuk mitra, klien, atau karyawan terbaik mereka.',
    'created_at' => '2026-10-06 02:14:19',
    'updated_at' => '2026-10-06 02:14:19',
  ),
  12 => 
  array (
    'id' => 13,
    'title_en' => 'display box/stand',
    'title_id' => 'kotak/ stand pajangan',
    'category_en' => 'display box/stand',
    'category_id' => 'kotak/ stand pajangan',
    'image_path' => 'uploads/portfolio/1791228119_6ac3f8d74d275.jpg',
    'description_en' => 'Skincare industry, cosmetics, snacks, medicines, supplements, souvenir products and accessories.',
    'description_id' => 'Industri skincare, kosmetik, makanan ringan, obat-obatan, suplemen, hingga produk suvenir dan aksesoris.',
    'created_at' => '2026-10-06 02:21:59',
    'updated_at' => '2026-10-06 02:21:59',
  ),
  13 => 
  array (
    'id' => 14,
    'title_en' => 'Mockup dummy giant product',
    'title_id' => 'Mockup dummy giant product',
    'category_en' => 'Mockup dummy giant product',
    'category_id' => 'Mockup dummy giant product',
    'image_path' => 'uploads/portfolio/1791228285_6ac3f97d232dd.jpg',
    'description_en' => 'product branding mockup, PVC material',
    'description_id' => 'mockup branding produk, bahan PVC',
    'created_at' => '2026-10-06 02:24:45',
    'updated_at' => '2026-10-06 02:24:45',
  ),
  14 => 
  array (
    'id' => 15,
    'title_en' => 'Mockup dummy giant product',
    'title_id' => 'Mockup dummy giant product',
    'category_en' => 'Mockup dummy giant product',
    'category_id' => 'Mockup dummy giant product',
    'image_path' => 'uploads/portfolio/1791228328_6ac3f9a840ae3.jpg',
    'description_en' => 'MockUp Giant Product Vial Bottle',
    'description_id' => 'MockUp Giant Product Botol Vial',
    'created_at' => '2026-10-06 02:25:28',
    'updated_at' => '2026-10-06 02:25:28',
  ),
  15 => 
  array (
    'id' => 16,
    'title_en' => 'Brochure',
    'title_id' => 'Brosur',
    'category_en' => 'Brochure',
    'category_id' => 'Brosur',
    'image_path' => 'uploads/portfolio/1791228460_6ac3fa2c3640b.jpg',
    'description_en' => 'Very suitable for the pharmaceutical industry, beauty clinics, personal care products, and MSMEs who want to raise the level of their product class on the market.',
    'description_id' => 'Sangat cocok untuk industri farmasi, klinik kecantikan, produk personal care, hingga UMKM yang ingin menaikkan level kelas produknya di pasaran.',
    'created_at' => '2026-10-06 02:27:40',
    'updated_at' => '2026-10-06 02:27:40',
  ),
  16 => 
  array (
    'id' => 17,
    'title_en' => 'Brochure',
    'title_id' => 'Brosur',
    'category_en' => 'Brochure',
    'category_id' => 'Brosur',
    'image_path' => 'uploads/portfolio/1791228502_6ac3fa563454d.jpg',
    'description_en' => 'It is ideal for promotional needs for aesthetic clinics, exhibitions, indoor/outdoor advertising, as well as national scale product campaigns that demand uncompromising visual quality standards.',
    'description_id' => 'Sangat ideal digunakan untuk kebutuhan promosi klinik estetika, pameran, indoor/outdoor advertising, maupun kampanye produk berskala nasional yang menuntut standar kualitas visual tanpa kompromi.',
    'created_at' => '2026-10-06 02:28:22',
    'updated_at' => '2026-10-06 02:28:22',
  ),
  17 => 
  array (
    'id' => 18,
    'title_en' => 'Brochure',
    'title_id' => 'Brosur',
    'category_en' => 'Brochure',
    'category_id' => 'Brosur',
    'image_path' => 'uploads/portfolio/1791228546_6ac3fa82400f4.jpg',
    'description_en' => 'Ideal Solution for Beauty Clinics & Corporate Exhibitions: Very suitable for promotional needs for medical devices, modern aesthetic clinics, new product launches, and exhibition booth wall decorations that demand world-class visual standards.',
    'description_id' => 'Solusi Ideal untuk Klinik Kecantikan & Pameran Korporat: Sangat cocok digunakan untuk kebutuhan promosi perangkat medis, klinik estetika modern, peluncuran produk baru, hingga dekorasi dinding pameran (exhibition booth) yang menuntut standar visual kelas dunia.',
    'created_at' => '2026-10-06 02:29:06',
    'updated_at' => '2026-10-06 02:29:06',
  ),
);
        if (!empty($data_portfolios)) {
            DB::table('portfolios')->truncate();
            foreach (array_chunk($data_portfolios, 100) as $chunk) {
                DB::table('portfolios')->insert($chunk);
            }
        }

        // Table: portfolio_images (15 rows)
        $data_portfolio_images = array (
  0 => 
  array (
    'id' => 8,
    'portfolio_id' => 7,
    'image_path' => 'uploads/portfolio/1791217069_6ac3cdad2f7b1.jpg',
    'created_at' => '2026-10-05 23:17:49',
    'updated_at' => '2026-10-05 23:17:49',
  ),
  1 => 
  array (
    'id' => 9,
    'portfolio_id' => 7,
    'image_path' => 'uploads/portfolio/1791222650_6ac3e37ae3f09.jpg',
    'created_at' => '2026-10-06 00:50:50',
    'updated_at' => '2026-10-06 00:50:50',
  ),
  2 => 
  array (
    'id' => 10,
    'portfolio_id' => 7,
    'image_path' => 'uploads/portfolio/1791222669_6ac3e38d08073.jpg',
    'created_at' => '2026-10-06 00:51:09',
    'updated_at' => '2026-10-06 00:51:09',
  ),
  3 => 
  array (
    'id' => 11,
    'portfolio_id' => 7,
    'image_path' => 'uploads/portfolio/1791222684_6ac3e39c7a555.jpg',
    'created_at' => '2026-10-06 00:51:24',
    'updated_at' => '2026-10-06 00:51:24',
  ),
  4 => 
  array (
    'id' => 12,
    'portfolio_id' => 8,
    'image_path' => 'uploads/portfolio/1791227217_6ac3f55161a77.jpg',
    'created_at' => '2026-10-06 02:06:57',
    'updated_at' => '2026-10-06 02:06:57',
  ),
  5 => 
  array (
    'id' => 13,
    'portfolio_id' => 9,
    'image_path' => 'uploads/portfolio/1791227359_6ac3f5df34cd6.jpg',
    'created_at' => '2026-10-06 02:09:19',
    'updated_at' => '2026-10-06 02:09:19',
  ),
  6 => 
  array (
    'id' => 14,
    'portfolio_id' => 10,
    'image_path' => 'uploads/portfolio/1791227450_6ac3f63a261e9.jpg',
    'created_at' => '2026-10-06 02:10:50',
    'updated_at' => '2026-10-06 02:10:50',
  ),
  7 => 
  array (
    'id' => 15,
    'portfolio_id' => 11,
    'image_path' => 'uploads/portfolio/1791227577_6ac3f6b931bca.jpg',
    'created_at' => '2026-10-06 02:12:57',
    'updated_at' => '2026-10-06 02:12:57',
  ),
  8 => 
  array (
    'id' => 16,
    'portfolio_id' => 12,
    'image_path' => 'uploads/portfolio/1791227659_6ac3f70b339df.jpg',
    'created_at' => '2026-10-06 02:14:19',
    'updated_at' => '2026-10-06 02:14:19',
  ),
  9 => 
  array (
    'id' => 17,
    'portfolio_id' => 13,
    'image_path' => 'uploads/portfolio/1791228119_6ac3f8d74d275.jpg',
    'created_at' => '2026-10-06 02:21:59',
    'updated_at' => '2026-10-06 02:21:59',
  ),
  10 => 
  array (
    'id' => 18,
    'portfolio_id' => 14,
    'image_path' => 'uploads/portfolio/1791228285_6ac3f97d232dd.jpg',
    'created_at' => '2026-10-06 02:24:45',
    'updated_at' => '2026-10-06 02:24:45',
  ),
  11 => 
  array (
    'id' => 19,
    'portfolio_id' => 15,
    'image_path' => 'uploads/portfolio/1791228328_6ac3f9a840ae3.jpg',
    'created_at' => '2026-10-06 02:25:28',
    'updated_at' => '2026-10-06 02:25:28',
  ),
  12 => 
  array (
    'id' => 20,
    'portfolio_id' => 16,
    'image_path' => 'uploads/portfolio/1791228460_6ac3fa2c3640b.jpg',
    'created_at' => '2026-10-06 02:27:40',
    'updated_at' => '2026-10-06 02:27:40',
  ),
  13 => 
  array (
    'id' => 21,
    'portfolio_id' => 17,
    'image_path' => 'uploads/portfolio/1791228502_6ac3fa563454d.jpg',
    'created_at' => '2026-10-06 02:28:22',
    'updated_at' => '2026-10-06 02:28:22',
  ),
  14 => 
  array (
    'id' => 22,
    'portfolio_id' => 18,
    'image_path' => 'uploads/portfolio/1791228546_6ac3fa82400f4.jpg',
    'created_at' => '2026-10-06 02:29:06',
    'updated_at' => '2026-10-06 02:29:06',
  ),
);
        if (!empty($data_portfolio_images)) {
            DB::table('portfolio_images')->truncate();
            foreach (array_chunk($data_portfolio_images, 100) as $chunk) {
                DB::table('portfolio_images')->insert($chunk);
            }
        }

        // Table: team_members (9 rows)
        $data_team_members = array (
  0 => 
  array (
    'id' => 1,
    'name' => 'Enung Kosasih',
    'role_en' => 'Director',
    'role_id' => 'Direktur',
    'phone' => '0856 9317 4242',
    'quote_en' => 'Brave to tell myself I\'m creative, when I\'m making a creation.',
    'quote_id' => 'Berani mengatakan pada diri sendiri bahwa saya kreatif, ketika saya membuat sebuah karya.',
    'description_en' => 'Starting his career on advertising in (1990) at POWER BRAND COMMUNICATION as Art Director and ADVISINDO as Senior Art Director. With decades of creative leadership, he guides the agency\'s strategic vision.',
    'description_id' => 'Memulai karirnya di bidang periklanan pada tahun (1990) di POWER BRAND COMMUNICATION sebagai Art Director dan ADVISINDO sebagai Senior Art Director. Dengan kepemimpinan kreatif selama beberapa dekade, beliau mengarahkan visi strategis agensi.',
    'photo_path' => 'uploads/team/enung.jpg',
    'priority' => 1,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  1 => 
  array (
    'id' => 2,
    'name' => 'Oleh Wijayana',
    'role_en' => 'Creative Director',
    'role_id' => 'Direktur Kreatif',
    'phone' => '0858 9111 8571',
    'quote_en' => 'Idea are everywhere, I\'m just transferring it.',
    'quote_id' => 'Ide ada di mana-mana, saya hanya menyalurkannya saja.',
    'description_en' => 'Newly enter advertising for 20 years. Becoming a Graphic Designer is his pride. Was in POWER BRAND COM handling major accounts like Aquaproof, Indofarma, and Giant Hypermarket.',
    'description_id' => 'Baru memasuki dunia periklanan selama 20 tahun. Menjadi Desainer Grafis adalah kebanggaannya. Pernah di POWER BRAND COM menangani akun-akun besar seperti Aquaproof, Indofarma, dan Giant Hypermarket.',
    'photo_path' => 'uploads/team/oleh.jpg',
    'priority' => 2,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  2 => 
  array (
    'id' => 3,
    'name' => 'Jajat Sujana',
    'role_en' => 'Art Director',
    'role_id' => 'Art Director',
    'phone' => '+62 858-8289-1454',
    'quote_en' => 'Visualizing concepts into breathing masterpieces.',
    'quote_id' => 'Memvisualisasikan konsep menjadi mahakarya yang hidup.',
    'description_en' => 'Dedicated Art Director overseeing layout execution and graphic integrity across advertising campaigns.',
    'description_id' => 'Art Director yang berdedikasi mengawasi eksekusi tata letak dan integritas grafis di seluruh kampanye periklanan.',
    'photo_path' => 'uploads/team/jajat.jpg',
    'priority' => 3,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:54:43',
  ),
  3 => 
  array (
    'id' => 4,
    'name' => 'Lomri Amiruddin',
    'role_en' => 'Art Director',
    'role_id' => 'Art Director',
    'phone' => '+62 812-8825-524',
    'quote_en' => 'Art is the bridge between market demand and pure imagination.',
    'quote_id' => 'Seni adalah jembatan antara permintaan pasar dan imajinasi murni.',
    'description_en' => 'Co-directs the visual identity and structural designs for print media and branding items.',
    'description_id' => 'Mengarahkan bersama identitas visual dan desain struktural untuk media cetak dan produk branding.',
    'photo_path' => 'uploads/team/lomri.jpg',
    'priority' => 4,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  4 => 
  array (
    'id' => 5,
    'name' => 'Asep Saepudin',
    'role_en' => 'Production Manager',
    'role_id' => 'Manajer Produksi',
    'phone' => '+62 813-8034-1092',
    'quote_en' => 'Bridging the creative spark with technical production precision.',
    'quote_id' => 'Menghubungkan percikan kreatif dengan presisi produksi teknis.',
    'description_en' => 'Manages the production floor, print manufacturing, machinery schedule, and delivery logistics.',
    'description_id' => 'Mengelola lantai produksi, manufaktur cetak, jadwal mesin, dan logistik pengiriman.',
    'photo_path' => 'uploads/team/asep.jpg',
    'priority' => 5,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  5 => 
  array (
    'id' => 6,
    'name' => 'Andi Supriadi',
    'role_en' => 'Graphic Designer',
    'role_id' => 'Desainer Grafis',
    'phone' => '+62 877-7408-7727',
    'quote_en' => 'Designing details that make products stand out.',
    'quote_id' => 'Mendesain detail-detail yang membuat produk menonjol.',
    'description_en' => 'Focuses on campaign layout, vector design, device mockup, and promotional material illustration.',
    'description_id' => 'Berfokus pada tata letak kampanye, desain vektor, mockup perangkat, dan ilustrasi materi promosi.',
    'photo_path' => 'uploads/team/andi.jpg',
    'priority' => 6,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  6 => 
  array (
    'id' => 7,
    'name' => 'Iwan Setiawan',
    'role_en' => 'Purchasing Manager',
    'role_id' => 'Manajer Pembelian',
    'phone' => '+62 856-9292-1200',
    'quote_en' => 'Sourcing quality materials to bring designs to life.',
    'quote_id' => 'Mencari bahan berkualitas untuk menghidupkan desain.',
    'description_en' => 'Responsible for procurement of raw materials, print components, neon box materials, and supplier management.',
    'description_id' => 'Bertanggung jawab atas pengadaan bahan baku, komponen cetak, bahan neon box, dan manajemen pemasok.',
    'photo_path' => 'uploads/team/iwan.jpg',
    'priority' => 7,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  7 => 
  array (
    'id' => 9,
    'name' => 'Putri W Ramadhania',
    'role_en' => 'Finance & Accounting',
    'role_id' => 'Keuangan & Akuntansi',
    'phone' => '+62 857-7968-3340',
    'quote_en' => 'Balancing creativity with financial soundness and efficiency.',
    'quote_id' => 'Menyeimbangkan kreativitas dengan kesehatan finansial dan efisiensi.',
    'description_en' => 'Handles account billing, vendor invoices, tax compliance (NPWP), and financial reporting.',
    'description_id' => 'Menangani penagihan akun, faktur vendor, kepatuhan pajak (NPWP), dan pelaporan keuangan.',
    'photo_path' => 'uploads/team/putri.jpg',
    'priority' => 9,
    'created_at' => '2026-07-04 07:33:55',
    'updated_at' => '2026-07-04 07:48:15',
  ),
  8 => 
  array (
    'id' => 10,
    'name' => 'Zida Urwa',
    'role_en' => 'web developer',
    'role_id' => 'web developer',
    'phone' => '08984215781',
    'quote_en' => 'Developing rapidly with an integrated system',
    'quote_id' => 'Berkembang pesat dengan adanya sistem yang sudah terintegrasi',
    'description_en' => 'Starting development in 2026',
    'description_id' => 'Memulai develop pada tahun 2026',
    'photo_path' => 'uploads/team/1790181495_6ab40077003f6.jpg',
    'priority' => 10,
    'created_at' => '2026-09-23 23:38:15',
    'updated_at' => '2026-10-05 19:40:40',
  ),
);
        if (!empty($data_team_members)) {
            DB::table('team_members')->truncate();
            foreach (array_chunk($data_team_members, 100) as $chunk) {
                DB::table('team_members')->insert($chunk);
            }
        }

        // Table: clients (12 rows)
        $data_clients = array (
  0 => 
  array (
    'id' => 1,
    'name' => 'PT. Galderma',
    'logo' => 'uploads/clients/1789978084_Logo Galderma.png',
    'created_at' => '2026-09-21 07:43:15',
    'updated_at' => '2026-09-25 00:34:22',
    'products' => NULL,
    'logo_width' => 230,
    'logo_height' => 49,
  ),
  1 => 
  array (
    'id' => 3,
    'name' => 'Merz Aesthetics',
    'logo' => 'uploads/clients/1789978756_Merz Aesthetics.png',
    'created_at' => '2026-09-21 08:19:16',
    'updated_at' => '2026-09-21 09:38:51',
    'products' => NULL,
    'logo_width' => 200,
    'logo_height' => 200,
  ),
  2 => 
  array (
    'id' => 4,
    'name' => 'Naos',
    'logo' => 'uploads/clients/1789979135_Logo Naos.png',
    'created_at' => '2026-09-21 08:25:35',
    'updated_at' => '2026-09-21 09:39:20',
    'products' => NULL,
    'logo_width' => 200,
    'logo_height' => 200,
  ),
  3 => 
  array (
    'id' => 5,
    'name' => 'Novell Phamaceutical Laboratories',
    'logo' => 'uploads/clients/1789979302_logo Novell.png',
    'created_at' => '2026-09-21 08:28:22',
    'updated_at' => '2026-09-21 09:37:51',
    'products' => NULL,
    'logo_width' => 200,
    'logo_height' => 200,
  ),
  4 => 
  array (
    'id' => 6,
    'name' => 'DiscountMAX',
    'logo' => 'uploads/clients/1789979687_Logo DIscountMAX.png',
    'created_at' => '2026-09-21 08:34:47',
    'updated_at' => '2026-09-25 00:53:54',
    'products' => NULL,
    'logo_width' => 125,
    'logo_height' => 66,
  ),
  5 => 
  array (
    'id' => 7,
    'name' => 'MEdmix',
    'logo' => 'uploads/clients/1789979936_Logo MEdmix.png',
    'created_at' => '2026-09-21 08:38:56',
    'updated_at' => '2026-09-21 08:38:56',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
  6 => 
  array (
    'id' => 8,
    'name' => 'PARVUS',
    'logo' => 'uploads/clients/1789980025_Logo Parvus.png',
    'created_at' => '2026-09-21 08:40:25',
    'updated_at' => '2026-09-21 08:40:25',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
  7 => 
  array (
    'id' => 9,
    'name' => 'PROMED',
    'logo' => 'uploads/clients/1789980141_logo Promed.png',
    'created_at' => '2026-09-21 08:42:21',
    'updated_at' => '2026-09-21 08:42:21',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
  8 => 
  array (
    'id' => 10,
    'name' => 'PYRIDAM FARMA',
    'logo' => 'uploads/clients/1789980219_Logo Pyridam.png',
    'created_at' => '2026-09-21 08:43:39',
    'updated_at' => '2026-09-21 08:43:39',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
  9 => 
  array (
    'id' => 11,
    'name' => 'REGENESIS',
    'logo' => 'uploads/clients/1789980284_logo Regenesis.png',
    'created_at' => '2026-09-21 08:44:44',
    'updated_at' => '2026-09-21 08:44:44',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
  10 => 
  array (
    'id' => 12,
    'name' => 'Viva COSMETICS',
    'logo' => 'uploads/clients/1789980354_Logo Viva Cosmetics.png',
    'created_at' => '2026-09-21 08:45:54',
    'updated_at' => '2026-09-21 08:45:54',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
  11 => 
  array (
    'id' => 13,
    'name' => 'YUA CLINIC',
    'logo' => 'uploads/clients/1789980437_Logo YUA Clinic.png',
    'created_at' => '2026-09-21 08:47:17',
    'updated_at' => '2026-09-21 08:47:17',
    'products' => NULL,
    'logo_width' => 80,
    'logo_height' => 80,
  ),
);
        if (!empty($data_clients)) {
            DB::table('clients')->truncate();
            foreach (array_chunk($data_clients, 100) as $chunk) {
                DB::table('clients')->insert($chunk);
            }
        }

        // Table: client_products (5 rows)
        $data_client_products = array (
  0 => 
  array (
    'id' => 1,
    'client_id' => 1,
    'image' => 'uploads/clients/products/1789977553_6ab0e3d10a541_Logo Cetaphil.png',
    'created_at' => '2026-09-21 07:59:13',
    'updated_at' => '2026-09-25 00:35:35',
    'width' => 120,
    'height' => 33,
  ),
  1 => 
  array (
    'id' => 3,
    'client_id' => 1,
    'image' => 'uploads/clients/products/1789978240_6ab0e6809d6da_Logo Sculptra-01-01.png',
    'created_at' => '2026-09-21 08:10:40',
    'updated_at' => '2026-09-21 08:10:40',
    'width' => 120,
    'height' => 100,
  ),
  2 => 
  array (
    'id' => 6,
    'client_id' => 3,
    'image' => 'uploads/clients/products/1789978792_6ab0e8a8803e1_Logo Ultherapy Prime.ai.png',
    'created_at' => '2026-09-21 08:19:52',
    'updated_at' => '2026-09-21 08:19:52',
    'width' => 120,
    'height' => 100,
  ),
  3 => 
  array (
    'id' => 7,
    'client_id' => 3,
    'image' => 'uploads/clients/products/1789978820_6ab0e8c43d041_Radiesse-01.png',
    'created_at' => '2026-09-21 08:20:20',
    'updated_at' => '2026-09-21 08:20:20',
    'width' => 120,
    'height' => 100,
  ),
  4 => 
  array (
    'id' => 8,
    'client_id' => 4,
    'image' => 'uploads/clients/products/1789979135_6ab0e9ffababa_Logo Bioderma.png',
    'created_at' => '2026-09-21 08:25:35',
    'updated_at' => '2026-09-21 08:25:35',
    'width' => 120,
    'height' => 100,
  ),
);
        if (!empty($data_client_products)) {
            DB::table('client_products')->truncate();
            foreach (array_chunk($data_client_products, 100) as $chunk) {
                DB::table('client_products')->insert($chunk);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
