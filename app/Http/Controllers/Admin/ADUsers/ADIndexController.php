<?php

namespace App\Http\Controllers\Admin\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Contact\CTContact;

class ADContactController extends Controller
{
	public function __construct(CTContact $objmCTContact){
        $this->objmCTContact = $objmCTContact;
    }
    public function index() {
    	$objItems = $this->objmCTContact->getItems();
    	return view('admin.adcontact.index', compact('objItems'));
    }
    public function del($id, Request $request) {
        if ($this->objmCTContact->delItem($id)) {
            $request->session()->flash('msg','Xóa thành công!');
            return redirect()->route('admin.adcontact.index');
        } else {
            $request->session()->flash('msg','Lỗi khi xóa!');
            return redirect()->route('admin.adcontact.index');
        }
    }
    
}
