<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\MyInfo\ADQuotationsRequest;
use App\Model\Myinfo\MIFQuotations;
use Illuminate\Support\Facades\Storage;

class ADQuotationsController extends Controller
{
	public function __construct(MIFQuotations $objmMIFQuotations){
        $this->objmMIFQuotations = $objmMIFQuotations;
    }
    public function index() {
    	$objItems = $this->objmMIFQuotations->getItems();
    	return view('admin.admyinfo.quotations.index', compact('objItems'));
    }

    public function create() {
        return view('admin.admyinfo.quotations.add');
    }
    public function store(ADQuotationsRequest $request) {
        if (!is_null($request->file('picture'))) {
            //upload picture
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('media/files/quotations');
                $tmp = explode('/', $path);
                $request->picture = end($tmp);
            } else {
                echo "Lỗi upload file!";
            }
        } else {
            $request->picture = '';
        }
        $msg = $this->objmMIFQuotations->addItem($request) ? 'Success!' : 'Fail!';
        return redirect()->route('quotations_admin.index')->with('msg', $msg);
    }

    public function edit($id) {
        $objItem = $this->objmMIFQuotations->getItem($id);
    	return view('admin.admyinfo.quotations.edit', compact('objItem'));
    }
    public function update($id, ADQuotationsRequest $request) {
        $objItem = $this->objmMIFQuotations->getItem($id);
        if(!is_null($request->file('picture'))) {
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('media/files/quotations');
                $tmp = explode('/', $path);
                $request->picture = end($tmp);
                if ($objItem->picture != null) {
                    Storage::delete("media/files/quotations/".$objItem->picture);
                }
            }
        }
        $msg = $this->objmMIFQuotations->editItem($id, $request) ? 'Success!' : 'Fail!';
        return redirect()->route('quotations_admin.index')->with('msg', $msg);
    }

    public function destroy($id) {
        $objItem = $this->objmMIFQuotations->getItem($id);
        if ($objItem->picture != null) {
            Storage::delete("media/files/quotations/".$objItem->picture);
        }
        $msg = $this->objmMIFQuotations->delItem($id) ? 'Success!' : 'Fail!';
        return redirect()->route('quotations_admin.index')->with('msg', $msg);
    }
    
}
