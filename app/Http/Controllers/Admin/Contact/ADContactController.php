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
    public function destroy($id, Request $request) {
        $result = $this->objmCTContact->delItem($id);
        $msg = $result ? 'Success!' : 'Fail!';
        return redirect()->route('contact_admin.index')->with('msg',$msg);
    }
    
}
