<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response;
use Illuminate\Support\Facades\DB;

class ADCVController extends Controller
{
    public function index() {
    	$objItems = DB::table('cv')->orderBy('id')->get();
    	return view('admin.admyinfo.cv.index', compact('objItems'));
    }
    public function readcv($id) {
    	$objItem = DB::table('cv')->where('id',$id)->first();
    	$file_name = $objItem->file_name;
    	$filepath = 'app/media/files/cv/'.$file_name;
    	$path = storage_path($filepath);
    	return Response::make(file_get_contents($path), 200, [
    		'Content-Type' => 'application/pdf',
    		'Content-Disposition' => 'inline; filename="'.$filename.'"'
    	]);
    }
    public function upload(Request $request) {
    	if (!is_null($request->file1)) {
    		$objItem = DB::table('cv')->where('id','1')->first();
    		$request->file('file1')->move(storage_path('app/media/files/cv'), 'cv_vi.pdf');
    	} else {
    		$objItem = DB::table('cv')->where('id','2')->first();
    		$request->file('file2')->move(storage_path('app/media/files/cv'), 'cv_en.pdf');
    	}
    	return redirect()->route('admin.admyinfo.cv.index');
    }
    public function edit($id, Request $request) {
        $link = $request->link;
        $ar = ['link'=>$link];
        $objItem = DB::table('cv')->where('id',$id)->update($ar);
        return redirect()->route('admin.admyinfo.cv.index');
    }
}
