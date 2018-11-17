<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NENews;

class ADNewsController extends Controller
{
	public function __construct(NENews $objmNENews){
        $this->objmNENews = $objmNENews;
    }
    public function getConfirm(Request $request) {
        $id = $request->aid;
        if ($this->objmNENews->confirm($id) == 1) {
        	return '<i class="fa fa-times-circle"></i>';
        } else {
        	return '<i class="fa fa-check-square"></i>';
        }
    }
    
}
