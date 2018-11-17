<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Myinfo\MIFintro;

class ADIntroController extends Controller
{
	public function __construct(MIFintro $objmMIFintro){
        $this->objmMIFintro = $objmMIFintro;
    }
    public function getConfirm(Request $request) {
        $id = $request->aid;
        if ($this->objmMIFintro->confirm($id) == 1) {
        	return '<i class="fa fa-times-circle"></i>';
        } else {
        	return '<i class="fa fa-check-square"></i>';
        }
    }
    
}
