<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TranslationService;

class TranslationController extends Controller
{
    public function translate(Request $request)
    {
        $text = $request->input('text', '');
        $from = $request->input('from', 'id');
        $to = $request->input('to', 'en');

        if (trim($text) === '') {
            return response()->json([
                'success' => true,
                'translated' => ''
            ]);
        }

        $translated = TranslationService::translate($text, $from, $to);

        return response()->json([
            'success' => true,
            'translated' => $translated
        ]);
    }
}
