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

    public function create() {
        $arAllTags = $this->objmNETag->getItemsAll();
        $arItems = $this->objmNECat->getItemsAll();
        return view('admin.adnews.news.add', compact('arItems','arAllTags'));
    }
    public function store(ADNewsRequest $request) {
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
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('media/files/news');
                $tmp = explode('/', $path);
                $ar['picture'] = end($tmp);
            } else {
                echo "Lỗi upload file!";
            }
        }
        $result = $this->objmNENews->addItem($ar,$arTag);
        $msg = $this->result_method($result);
        return redirect()->route('news_admin.index')->with(['msg' => $msg]);
    }

    public function edit($id) {
        $objItem = $this->objmNENews->getItemAd($id);
        $arItems = $this->objmNECat->getItemsAll();
        $arAllTags = $this->objmNETag->getItemsAll();
    	return view('admin.adnews.news.edit', compact('objItem','arItems','arAllTags'));
    }
    public function update($id, ADNewsRequest $request) {
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
        $result = $this->objmNENews->editItem($id, $ar, $arTag);
        $msg = $this->result_method($result);
        return redirect()->route('news_admin.index')->with(['msg' => $msg]);
    }

    public function destroy($id, Request $request) {
        $objItem = $this->objmNENews->getItem($id);
        if ($objItem->picture != null) {
            Storage::delete("media/files/news/".$objItem->picture);
        }
        $result = $this->objmNENews->delItem($id);
        $msg = $this->result_method($result);
        return redirect()->route('news_admin.index')->with(['msg' => $msg]);
    }
    public function destroy_all(Request $request) {
        $objItem = $this->objmNENews->getItem($id);
        
    }
    public function result_method($result)
    {
        return $result ? 'Success!' : 'Fail!';
    }
    
}
