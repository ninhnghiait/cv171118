<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NECat;

use App\Http\Requests\News\ADCatRequest;

class ADCatController extends Controller
{
	public function __construct(NECat $objmNECat){
        $this->objmNECat = $objmNECat;
    }
    public function index() {
    	$arItems = $this->objmNECat->getItemsAll();
    	return view('admin.adnews.cat.index', compact('arItems'));
    }

    public function getAdd() {
        $arItems = $this->objmNECat->getItemsPr();
        return view('admin.adnews.cat.add', compact('arItems'));
    }
    public function postAdd(ADCatRequest $request) {
        if ($this->objmNECat->addItem($request)) {
            $request->session()->flash('msg','Thêm thành công!');
            return redirect()->route('admin.adnews.cat.index');
        } else {
            $request->session()->flash('msg','Lỗi khi thêm!');
            return redirect()->route('admin.adnews.cat.index');
        }
    }

    public function getEdit($id) {
        $objItem = $this->objmNECat->getItem($id);
        $arItems = $this->objmNECat->getItemsPr();
    	return view('admin.adnews.cat.edit', compact('objItem','arItems'));
    }
    public function postEdit($id, ADCatRequest $request) {
        if ($this->objmNECat->editItem($id, $request)) {
            $request->session()->flash('msg','Sửa thành công!');
            return redirect()->route('admin.adnews.cat.index');
        } else {
            $request->session()->flash('msg','Lỗi khi sửa!');
            return redirect()->route('admin.adnews.cat.index');
        }
    }

    public function del($id, Request $request) {
        if ($this->objmNECat->delItem($id)) {
            $request->session()->flash('msg','Xóa thành công!');
            return redirect()->route('admin.adnews.cat.index');
        } else {
            $request->session()->flash('msg','Lỗi khi xóa!');
            return redirect()->route('admin.adnews.cat.index');
        }
    }
    
}
