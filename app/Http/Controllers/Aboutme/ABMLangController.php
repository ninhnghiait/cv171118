<?php

namespace App\Http\Controllers\Aboutme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ABMLangController extends Controller
{
	public function lang(Request $request)
    {
        $request->session()->put('locale', $request->language_code);
        $request->session()->put('checklocale', $request->language_code);
        return redirect()->back();
    }
    public function langClose(Request $request) {
    	$request->session()->put('checklocale', $request->lang);
    }
}
