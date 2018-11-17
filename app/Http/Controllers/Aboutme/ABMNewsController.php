<?php

namespace App\Http\Controllers\Aboutme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\News\NENews;
use App\Model\News\NECat;
use App\Model\News\NECmt;
use App\Model\News\NETag;
use App\Model\User;
use Illuminate\Support\Facades\View;
use App\Events\Event\viewNews;

class ABMNewsController extends Controller
{
	public function __construct(NENews $objmNENews, NECat $objmNECat, NECmt $objmNECmt, User $objmUser,NETag $objmNETag){
        $this->objmNENews = $objmNENews;
        $this->objmNECat = $objmNECat;
        $this->objmNECmt = $objmNECmt;
        $this->objmUser = $objmUser;
        $this->objmNETag = $objmNETag;
        $arFiveCmt = $this->objmNECmt->getFiveItems();
        View::share('arFiveCmt', $arFiveCmt);
    }
    public function index() {
        $firstItem =  $this->objmNENews->getFirstIt();
        $arNews = $this->objmNENews->getItemsPl(1);
        $arNewssc = $this->objmNENews->getItemsPl(3);
        $arNewsAll = $this->objmNENews->getItemsPlAll();
    	return view('aboutme.abmnews.index', compact('arNews','arNewssc','firstItem','arNewsAll'));
    }
    public function cat($slug, $cid) {
        $objCatCr =  $this->objmNECat->getItem($cid);
        $arNews = $this->objmNENews->getItemsPlByCat($cid);
        return view('aboutme.abmnews.cat', compact('arNews','objCatCr')); 
    }
    public function detail($slug, $id) {
        $objItem = $this->objmNENews->getItemDetail($id);
        //get comment
        $resultCmt = $this->objmNECmt->getItemsByNews($id);
        $arCmt = $resultCmt[0];
        $totalCmt = $resultCmt[1];
        //
        $userInfo = $this->objmUser->getItemPl($objItem->id);
        $objItemsCat = $this->objmNECat->getItemsAll();
        //
        $ar3Items = $this->objmNENews->get3Items($id, $objItem->id_cat);
        event(new viewNews($id));
        return view('aboutme.abmnews.detail', compact('objItem','arCmt','totalCmt','objItemsCat','userInfo','ar3Items'));
    }
    public function tags($slug)
    {
        $objtag = $this->objmNETag->getItemByTag($slug);
        if(is_null($objtag)) {
            return redirect()->route('aboutme.abmnews.index');
        }
        $arNews = $this->objmNETag->getItemPl($slug);
        return view('aboutme.abmnews.tag', compact('arNews','objtag'));
    }
    public function search(Request $request)
    {
        $text = $request->q;
        $arNews = $this->objmNENews->getItemSearchPl($text);
        return view('aboutme.abmnews.search', compact('arNews','text'));
    }

}
