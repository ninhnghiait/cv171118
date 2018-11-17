<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Requests\MyInfo\ADIntroRequest;
use App\Http\Controllers\Controller;
use App\Model\Myinfo\MIFintro;
use Illuminate\Support\Facades\Storage;

class ADIntroController extends Controller
{
	public function __construct(MIFintro $objmMIFintro){
        $this->objmMIFintro = $objmMIFintro;
    }
    public function index() {
    	$objItems = $this->objmMIFintro->getItems();
    	return view('admin.admyinfo.intro.index', compact('objItems'));
    }

    public function edit($id) {
        $objItem = $this->objmMIFintro->getItem($id);
    	return view('admin.admyinfo.intro.edit', compact('objItem'));
    }
    public function update($id, ADIntroRequest $request) {
       
        $objItem = $this->objmMIFintro->getItem($id);
        if(!is_null($request->file('avatar'))) {
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('media/files/myinfo');
                $tmp = explode('/', $path);
                $request->avatar = end($tmp);
                if ($objItem->avatar != null) {
                    Storage::delete("media/files/myinfo/".$objItem->avatar);
                }
            }
        }

        if(!is_null($request->file('picture'))) {
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('media/files/myinfo');
                $tmp = explode('/', $path);
                $request->picture = end($tmp);
                if ($objItem->picture != null) {
                    Storage::delete("media/files/myinfo/".$objItem->picture);
                }
            }
        }
        $result = $this->objmMIFintro->editItem($id, $request);
        $msg = $this->result_method($result);
        return redirect()->route('intro_admin.index')->with('msg',$msg);
    }

     public function result_method($result)
    {
        return $result ? 'Success!' : 'Fail!';
    }
}
