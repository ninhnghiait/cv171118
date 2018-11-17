<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NECmt;

class ADCmtController extends Controller
{
	public function __construct(NECmt $objmNECmt){
        $this->objmNECmt = $objmNECmt;
    }
    public function getConfirm(Request $request) {
        $id = $request->aid;
        if ($this->objmNECmt->confirm($id) == 1) {
        	return '<i class="fa fa-times-circle"></i>';
        } else {
        	return '<i class="fa fa-check-square"></i>';
        }
    }
    
}
