<?php

namespace App\Services;

class PhoneVerifier
{
    /**
     * Known Indonesian cellular provider prefixes (4 digits).
     */
    protected static array $operatorPrefixes = [
        // Telkomsel (Halo, SimPATI, As, By.U)
        '0811' => 'Telkomsel', '0812' => 'Telkomsel', '0813' => 'Telkomsel',
        '0821' => 'Telkomsel', '0822' => 'Telkomsel', '0823' => 'Telkomsel',
        '0851' => 'Telkomsel', '0852' => 'Telkomsel', '0853' => 'Telkomsel',

        // Indosat Ooredoo (IM3, Mentari, Matrix)
        '0814' => 'Indosat', '0815' => 'Indosat', '0816' => 'Indosat',
        '0855' => 'Indosat', '0856' => 'Indosat', '0857' => 'Indosat', '0858' => 'Indosat',

        // XL Axiata & AXIS
        '0817' => 'XL', '0818' => 'XL', '0819' => 'XL', '0859' => 'XL',
        '0877' => 'XL', '0878' => 'XL', '0831' => 'AXIS', '0832' => 'AXIS',
        '0833' => 'AXIS', '0838' => 'AXIS',

        // Smartfren
        '0881' => 'Smartfren', '0882' => 'Smartfren', '0883' => 'Smartfren',
        '0884' => 'Smartfren', '0885' => 'Smartfren', '0886' => 'Smartfren',
        '0887' => 'Smartfren', '0888' => 'Smartfren', '0889' => 'Smartfren',

        // Tri (3)
        '0895' => 'Tri (3)', '0896' => 'Tri (3)', '0897' => 'Tri (3)',
        '0898' => 'Tri (3)', '0899' => 'Tri (3)',
    ];

    /**
     * Validate and detect if a phone number is genuine or fake/ngasal.
     *
     * @param string $phone
     * @return array ['valid' => bool, 'status' => string, 'badge' => string, 'message' => string, 'operator' => string|null]
     */
    public static function check(string $phone): array
    {
        $raw = trim($phone);

        if (empty($raw)) {
            return [
                'valid' => false,
                'status' => 'empty',
                'badge' => '',
                'message' => 'Nomor telepon wajib diisi.',
                'operator' => null,
            ];
        }

        // Clean characters: keep only digits and leading plus
        $hasPlus = str_starts_with($raw, '+');
        $clean = preg_replace('/[^\d]/', '', $raw);

        // Cannot contain alphabets or random special chars
        if (preg_match('/[a-zA-Z]/', $raw)) {
            return [
                'valid' => false,
                'status' => 'contains_alpha',
                'badge' => 'No. Telp Tidak Sesuai',
                'message' => 'Nomor telepon tidak boleh mengandung huruf.',
                'operator' => null,
            ];
        }

        // Length validation: standard phone numbers are 9 to 15 digits
        if (strlen($clean) < 9 || strlen($clean) > 15) {
            return [
                'valid' => false,
                'status' => 'invalid_length',
                'badge' => 'No. Telp Tidak Sesuai',
                'message' => 'Panjang nomor telepon tidak sesuai (harus 10 - 13 digit angka).',
                'operator' => null,
            ];
        }

        // 1. Detect repetitive spam (e.g. 081111111111, 0000000000, 11111111111)
        if (preg_match('/(\d)\1{5,}/', $clean)) {
            return [
                'valid' => false,
                'status' => 'repetitive',
                'badge' => 'No. Telp Tidak Sesuai',
                'message' => 'Nomor telepon terdeteksi asal-asalan (angka berulang). Harap gunakan nomor asli.',
                'operator' => null,
            ];
        }

        // 2. Detect sequential spam (e.g. 123456789, 081234567890, 987654321)
        $sequences = [
            '12345678', '23456789', '34567890',
            '87654321', '98765432', '76543210',
            '123123123', '12341234'
        ];
        foreach ($sequences as $seq) {
            if (str_contains($clean, $seq)) {
                return [
                    'valid' => false,
                    'status' => 'sequential',
                    'badge' => 'No. Telp Tidak Sesuai',
                    'message' => 'Nomor telepon terdeteksi asal-asalan (angka berurutan). Harap gunakan nomor asli.',
                    'operator' => null,
                ];
            }
        }

        // 3. Normalize Indonesian number format
        $normalizedId = $clean;
        if (str_starts_with($normalizedId, '62')) {
            $normalizedId = '0' . substr($normalizedId, 2);
        }

        // Indonesian mobile number check (starts with 08)
        if (str_starts_with($normalizedId, '08')) {
            if (strlen($normalizedId) < 10 || strlen($normalizedId) > 13) {
                return [
                    'valid' => false,
                    'status' => 'invalid_id_mobile_length',
                    'badge' => 'No. Telp Tidak Sesuai',
                    'message' => 'Panjang nomor HP Indonesia harus 10 s/d 13 digit (contoh: 0812-3456-7890).',
                    'operator' => null,
                ];
            }

            $prefix = substr($normalizedId, 0, 4);

            if (!isset(self::$operatorPrefixes[$prefix])) {
                return [
                    'valid' => false,
                    'status' => 'invalid_prefix',
                    'badge' => 'No. Telp Tidak Sesuai',
                    'message' => 'Awalan nomor ' . $prefix . ' tidak terdaftar pada operator seluler manapun di Indonesia.',
                    'operator' => null,
                ];
            }

            $operator = self::$operatorPrefixes[$prefix];

            return [
                'valid' => true,
                'status' => 'valid',
                'badge' => 'No. Telp Sesuai',
                'message' => 'Nomor telepon sesuai & valid (' . $operator . ').',
                'operator' => $operator,
            ];
        }

        // Indonesian Landline (starts with 02x, 03x, etc.)
        if (str_starts_with($normalizedId, '0') && strlen($normalizedId) >= 9 && strlen($normalizedId) <= 12) {
            return [
                'valid' => true,
                'status' => 'valid_landline',
                'badge' => 'No. Telp Sesuai',
                'message' => 'Nomor telepon rumah/kantor sesuai & valid.',
                'operator' => 'Telepon Tetap (PSTN)',
            ];
        }

        // International number check (started with + and non-62)
        if ($hasPlus && !str_starts_with($clean, '62')) {
            if (strlen($clean) >= 8 && strlen($clean) <= 15) {
                return [
                    'valid' => true,
                    'status' => 'valid_international',
                    'badge' => 'No. Telp Sesuai',
                    'message' => 'Nomor telepon internasional sesuai & valid.',
                    'operator' => 'Internasional',
                ];
            }
        }

        return [
            'valid' => false,
            'status' => 'unrecognized',
            'badge' => 'No. Telp Tidak Sesuai',
            'message' => 'Nomor telepon tidak sesuai format resmi. Gunakan nomor HP aktif (contoh: 0812-xxxx-xxxx).',
            'operator' => null,
        ];
    }
}
