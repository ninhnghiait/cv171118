<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NETag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ADTagController extends Controller
{
	public function __construct(NETag $objmNETag){
        $this->objmNETag = $objmNETag;
    }
    public function index() {
    	$objItems = $this->objmNETag->getItemsAd();
    	return view('admin.adnews.tag.index', compact('objItems'));
    }
    public function getAdd()
    {
        return view('admin.adnews.tag.add');
    }
    public function postAdd(Request $request)
    {
        $ar = [
            'name' => trim($request->name),
            'tag' => str_slug($request->name)
        ];
        if($this->objmNETag->addItem($ar)) {
            $request->session()->flash('msg','Success!');
        } else {
            $request->session()->flash('msg','Fail!');
        }
        return redirect()->route('admin.adnews.tag.index');
    }
    public function getEdit($id)
    {
        $objItem = $this->objmNETag->getItem($id);
        return view('admin.adnews.tag.edit', compact('objItem'));
    }
    public function postEdit($id, Request $request)
    {
        $ar = [
            'name' => trim($request->name),
            'tag' => str_slug($request->name)
        ];
        if($this->objmNETag->editItem($id, $ar)) {
            $request->session()->flash('msg','Success!');
        } else {
            $request->session()->flash('msg','Success!');
        }
        return redirect()->route('admin.adnews.tag.index');
    }
    public function del($id, Request $request)
    {
        if($this->objmNETag->delItem($id)) {
            $request->session()->flash('msg','Success!');
        } else {
            $request->session()->flash('msg','Success!');
        }
        return redirect()->route('admin.adnews.tag.index');
    }
}
