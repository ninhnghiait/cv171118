<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Myinfo\MIFImg;
use App\Model\Myinfo\MIFGlr;
use Illuminate\Support\Facades\Storage;
class ADImgController extends Controller
{
	public function __construct(MIFImg $objmMIFImg,MIFGlr $objmMIFGlr){
        $this->objmMIFImg = $objmMIFImg;
        $this->objmMIFGlr = $objmMIFGlr;
    }
    public function index() {
    	$arGlr = $this->objmMIFGlr->getItemsAll();
        foreach ($arGlr as $key => $v) {
            $arGlr[$key]['img'] = $this->objmMIFImg->getItemsByGlr($v['gallery_id']);
        }
    	return view('admin.admyinfo.image.index', compact('arGlr'));
    }

    public function create() {
        return view('admin.admyinfo.image.add');
    }
    public function store(Request $request) {
        $result = $this->objmMIFGlr->addItem($request);
        $msg = $this->result_method($result);
        return redirect()->route('img_admin.index')->with('msg',$msg);
    }

    public function getAddPic($id) {
        return view('admin.admyinfo.image.addpic',compact('id'));
    }

    public function postAddPic($id,Request $request) {
        $ar = array();
        if ($request->img != null) {
            foreach ($request->img as $key => $v) {
                if (!is_null($request->file('img')[$key])) {
                $path = $request->file('img')[$key]->store('media/files/gallery');
                $tmp = explode('/', $path);
                $ar[$key]['image'] = end($tmp);
                $ar[$key]['gallery_id'] = $id;
                }
            }
        }
        $result = $this->objmMIFImg->addItems($ar);
        $msg = $this->result_method($result);
        return redirect()->route('img_admin.index')->with('msg',$msg);
    }

    public function edit($id) {
        $objItem = $this->objmMIFGlr->getItem($id);
        return view('admin.admyinfo.image.edit',compact('objItem'));
    }
    public function update($id, Request $request) {
        $result = $this->objmMIFGlr->editItem($id, $request);
        $msg = $this->result_method($result);
        return redirect()->route('img_admin.index')->with('msg',$msg);
    }

    public function destroy($id) {
        $ar = $this->objmMIFImg->getItemsByGlr($id);
        foreach ($ar as $key => $v) {
            if ($v['image'] != null) {
                Storage::delete("media/files/gallery/".$v['image']);
            }
        }
        $result = $this->objmMIFGlr->delItem($id);
        $msg = $this->result_method($result);
        return redirect()->route('img_admin.index')->with('msg',$msg);
    }

    public function delall(Request $request) {
        if ($request->img != null) {
            foreach ($request->img as $key => $v) {
               $mItem = $this->objmMIFImg->getItem($v);
                if ($mItem->image != null) {
                  Storage::delete("media/files/gallery/".$mItem->image);
                }
                $this->objmMIFImg->delItem($v);
            }
        }
        $request->session()->flash('msg','Xóa thành công!');
        return redirect()->route('img_admin.index');
    }
    public function result_method($result)
    {
        return $result ? 'Success!' : 'Fail!';
    }

}
