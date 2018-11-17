<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Myinfo\MIFintro;
use App\Model\Myinfo\MIFSkills;
use App\Model\Myinfo\MIFImg;
class ADIndexController extends Controller
{
	public function __construct(MIFintro $objmMIFintro, MIFSkills $objmMIFSkills, MIFImg $objmMIFImg){
        $this->objmMIFintro = $objmMIFintro;
        $this->objmMIFSkills = $objmMIFSkills;
        $this->objmMIFImg = $objmMIFImg;
    }
    public function index($lang = 'vi') {
    	$objItemIntro = $this->objmMIFintro->getFirstItem($lang);
    	$objItemSkills = $this->objmMIFSkills->getItems();
    	$objImg = $this->objmMIFImg->getItemsAll();
    	return view('admin.adindex.index', compact('objItemIntro','objItemSkills','objImg'));
    }
}
