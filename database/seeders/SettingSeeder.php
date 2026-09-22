<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'company_name' => 'Boutique Design Indonesia',
            'address' => 'Jl. Persatuan No.5C, RT.2/RW.4, Sukabumi Sel., Kec. Kebayoran Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 11560',
            'phone' => '021-53668592',
            'email' => 'boutique.design@yahoo.co.id',
            'npwp' => '70.007.006.3-035.000',
            'slogan_main_en' => 'When you are thirsty for ideas, when you need something makes you fresh, Boutique Design Indonesia',
            'slogan_main_id' => 'Ketika Anda haus akan ide, ketika Anda butuh sesuatu yang membuat Anda segar, Boutique Design Indonesia',
            'slogan_sub_en' => 'grab even bigger ideas with us',
            'slogan_sub_id' => 'raih ide yang lebih besar bersama kami',
            'slogan_philosophy_en' => 'Boutique Design Indonesia, Beyond Sky.',
            'slogan_philosophy_id' => 'Boutique Design Indonesia, Menembus Langit.',
            'contact_person_1_name' => 'E. Kosasih',
            'contact_person_1_phone' => '0856 9317 4242',
            'contact_person_2_name' => 'Oleh Wijayana',
            'contact_person_2_phone' => '0858 9111 8571',
            'contact_person_3_name' => 'Lomri Amiruddin',
            'contact_person_3_phone' => '0812 8825 524',
            'contact_person_4_name' => 'Jajat Sujana (Didin)',
            'contact_person_4_phone' => '0816 909 549',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
