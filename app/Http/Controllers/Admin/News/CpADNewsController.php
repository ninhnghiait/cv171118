<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NENews;
use App\Model\News\NECat;
use App\Model\News\NETag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\News\ADNewsRequest;

class ADNewsController extends Controller
{
	public function __construct(NENews $objmNENews, NECat $objmNECat, NETag $objmNETag){
        $this->objmNENews = $objmNENews;
        $this->objmNECat = $objmNECat;
        $this->objmNETag = $objmNETag;
    }
    public function index() {
    	$objItems = $this->objmNENews->getItemsAll();
    	return view('admin.adnews.news.index', compact('objItems'));
    }

    public function getAdd() {
        $arAllTags = $this->objmNETag->getItemsAll();
        $arItems = $this->objmNECat->getItemsAll();
        return view('admin.adnews.news.add', compact('arItems','arAllTags'));
    }
    public function postAdd(ADNewsRequest $request) {
        $ar = [
            'name' => trim($request->name),
            'id_cat' => trim($request->id_cat),
            'preview_text' => trim($request->preview_text),
            'detail_text' => trim($request->detail_text),
            'id' => Auth::user()->id,
            'count_number' => 0,
            'confirm' => 1
        ];
        $arTag = !is_null($request->tag) ? $request->tag : [];
        if (!is_null($request->file('picture'))) {
            //upload picture
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('media/files/news');
                $tmp = explode('/', $path);
                $ar['picture'] = end($tmp);
            } else {
                echo "Lỗi upload file!";
            }
        }
        //
        if ($this->objmNENews->addItem($ar,$arTag)) {
            $request->session()->flash('msg','Thêm thành công!');
            return redirect()->route('admin.adnews.news.index');
        } else {
            $request->session()->flash('msg','Lỗi khi thêm!');
            return redirect()->route('admin.adnews.news.index');
        }
    }

    public function getEdit($id) {
        $objItem = $this->objmNENews->getItemAd($id);
        $arItems = $this->objmNECat->getItemsAll();
        $arAllTags = $this->objmNETag->getItemsAll();
    	return view('admin.adnews.news.edit', compact('objItem','arItems','arAllTags'));
    }
    public function postEdit($id, ADNewsRequest $request) {
        $objItem = $this->objmNENews->getItem($id);
        $ar = [
            'name' => trim($request->name),
            'id_cat' => trim($request->id_cat),
            'preview_text' => trim($request->preview_text),
            'detail_text' => trim($request->detail_text),
            'id' => Auth::user()->id,
            'count_number' => 0,
            'confirm' => 1
        ];
        $arTag = !is_null($request->tag) ? $request->tag : [];
        if(!is_null($request->file('picture'))) {
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('media/files/news');
                $tmp = explode('/', $path);
                $ar['picture'] = end($tmp);
                if ($objItem->picture != null) {
                    Storage::delete("media/files/news/".$objItem->picture);
                }
            }
        }
        //
        if ($this->objmNENews->editItem($id, $ar, $arTag)) {
            $request->session()->flash('msg','Sửa thành công!');
            return redirect()->route('admin.adnews.news.index');
        } else {
            $request->session()->flash('msg','Lỗi khi sửa!');
            return redirect()->route('admin.adnews.news.index');
        }
    }

    public function del($id, Request $request) {
        $objItem = $this->objmNENews->getItem($id);
        if ($objItem->picture != null) {
            Storage::delete("media/files/news/".$objItem->picture);
        }
        //
        if ($this->objmNENews->delItem($id)) {
            $request->session()->flash('msg','Xóa thành công!');
            return redirect()->route('admin.adnews.news.index');
        } else {
            $request->session()->flash('msg','Lỗi khi xóa!');
            return redirect()->route('admin.adnews.news.index');
        }
    }
    
    
}
