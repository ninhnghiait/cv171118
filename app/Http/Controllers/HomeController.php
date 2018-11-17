<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Myinfo\MIFintro;
use App\Model\Myinfo\MIFSkills;
use App\Model\Myinfo\MIFImg;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MIFintro $objmMIFintro, MIFSkills $objmMIFSkills, MIFImg $objmMIFImg)
    {
        $this->middleware('auth');
        $this->objmMIFintro = $objmMIFintro;
        $this->objmMIFSkills = $objmMIFSkills;
        $this->objmMIFImg = $objmMIFImg;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang = 'vi')
    {
        $objItemIntro = $this->objmMIFintro->getFirstItem($lang);
        $objItemSkills = $this->objmMIFSkills->getItems();
        $objImg = $this->objmMIFImg->getItemsAll();
        return view('admin.adindex.index', compact('objItemIntro','objItemSkills','objImg'));
    }
}
