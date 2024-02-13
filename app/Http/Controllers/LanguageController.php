<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $language = $request->input('language');

        // Dil seçimini oturuma kaydet
        Session::put('preferred_language', $language);

        return response()->json(['message' => 'Dil değiştirildi.']);
    }
}
