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
    public function create()
    {
        return view('admin.adnews.tag.add');
    }
    public function store(Request $request)
    {
        $ar = [
            'name' => trim($request->name),
            'tag' => str_slug($request->name)
        ];
        $result = $this->objmNETag->addItem($ar);
        $msg = $this->result_method($result);
        return redirect()->route('tags_admin.index')->with('msg',$msg);
    }
    public function edit($id)
    {
        $objItem = $this->objmNETag->getItem($id);
        return view('admin.adnews.tag.edit', compact('objItem'));
    }
    public function update($id, Request $request)
    {
        $ar = [
            'name' => trim($request->name),
            'tag' => str_slug($request->name)
        ];
        $result = $this->objmNETag->editItem($id, $ar);
        $msg = $this->result_method($result);
        return redirect()->route('tags_admin.index')->with('msg',$msg);
    }
    public function destroy($id, Request $request)
    {
        $result = $this->objmNETag->delItem($id);
        $msg = $this->result_method($result);
        return redirect()->route('tags_admin.index')->with('msg',$msg);
    }
    public function result_method($result)
    {
        return $result ? 'Success!' : 'Fail!';
    }
}
