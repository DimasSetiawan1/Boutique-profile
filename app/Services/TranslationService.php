<?php

namespace App\Services;

class TranslationService
{
    /**
     * Translate text from one language to another (default: Indonesian to English).
     */
    public static function translate($text, $from = 'id', $to = 'en')
    {
        $trimmed = trim($text);
        if (empty($trimmed)) {
            return '';
        }

        // Method 1: Google Translate API (GTX)
        try {
            $url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=' . $from . '&tl=' . $to . '&dt=t&q=' . urlencode($trimmed);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36');
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && !empty($response)) {
                $data = json_decode($response, true);
                if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                    $result = '';
                    foreach ($data[0] as $segment) {
                        if (isset($segment[0])) {
                            $result .= $segment[0];
                        }
                    }
                    if (!empty(trim($result))) {
                        return trim($result);
                    }
                }
            }
        } catch (\Throwable $e) {
            // proceed to fallback
        }

        // Method 2: MyMemory API Fallback
        try {
            $url = 'https://api.mymemory.translated.net/get?q=' . urlencode($trimmed) . '&langpair=' . $from . '|' . $to;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            if (!empty($response)) {
                $data = json_decode($response, true);
                if (isset($data['responseData']['translatedText']) && !empty($data['responseData']['translatedText'])) {
                    $trans = $data['responseData']['translatedText'];
                    if (strpos($trans, 'MYMEMORY WARNING') === false) {
                        return html_entity_decode($trans, ENT_QUOTES, 'UTF-8');
                    }
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }

        return $trimmed;
    }
}
