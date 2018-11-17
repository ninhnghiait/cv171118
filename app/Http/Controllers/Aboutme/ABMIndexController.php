<?php

namespace App\Http\Controllers\Aboutme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Myinfo\MIFSkills;
use App\Model\Myinfo\MIFProject;
use App\Model\Myinfo\MIFExperiences;
use App\Model\News\NENews;
use App\Model\Myinfo\MIFImg;
use App\Model\Myinfo\MIFGlr;
use PDF;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class ABMIndexController extends Controller
{
	public function __construct( MIFSkills $objmMIFSkills, MIFProject $objmMIFProject, MIFExperiences $objmMIFExperiences,NENews $objmNENews, MIFImg $objmMIFImg ,MIFGlr $objmMIFGlr){
        
        $this->objmMIFSkills = $objmMIFSkills;
        $this->objmMIFProject = $objmMIFProject;
        $this->objmMIFExperiences = $objmMIFExperiences;
        $this->objmNENews = $objmNENews;
        $this->objmMIFImg = $objmMIFImg;
        $this->objmMIFGlr = $objmMIFGlr;
    }
    public function index(Request $request) {
            $lang = $request->session()->get('locale');
        //
    	// $objItemIntro = $this->objmMIFintro->getFirstItem($lang);
    	$objItemSkills = $this->objmMIFSkills->getItems();
        $objItemProjects = $this->objmMIFProject->getItemsPl($lang);
        $objItemEducation = $this->objmMIFExperiences->getItemsAll('education', $lang);
        $objItemEmployement = $this->objmMIFExperiences->getItemsAll('work', $lang);
        $obj8Img = $this->objmMIFImg->get8Items();
        $arGlr = $this->objmMIFGlr->getItemsAll();
        foreach ($arGlr as $key => $v) {
            $arGlr[$key]['img'] = $this->objmMIFImg->getItemsByGlr($v['gallery_id']);
        }
    	return view('aboutme.abmindex.index', compact('objItemSkills','objItemProjects','objItemEducation','objItemEmployement','obj8Img','arGlr'));
    }

    public function works($id) {
        $objImg = $this->objmMIFImg->getItem($id);
        return view('aboutme.abmindex.works.work1',compact('objImg'));
    }
    public function gallery($id) {
        $arGlr = $this->objmMIFGlr->getItemsAr($id);
        $arGlr['img'] = $this->objmMIFImg->getItemsByGlr($arGlr['gallery_id']);
        return view('aboutme.abmindex.works.workgallery',compact('arGlr'));
    }

    public function cvvi(Request $request, Response $response) {
        return response()->download(storage_path('app/media/files/cv/cv_vi.pdf'));
    }
    public function cven(Request $request, Response $response) {
        return response()->download(storage_path('app/media/files/cv/cv_en.pdf'));
    }
}
