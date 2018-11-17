<?php

namespace App\Http\Controllers\Aboutme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Contact\CTContact;
use App\Http\Requests\Contact\ContactRequest;
use Illuminate\Support\Facades\App;

class ABMContactController extends Controller
{
	public function __construct(CTContact $objmCTContact){
        $this->objmCTContact = $objmCTContact;
    }
    public function postContact(ContactRequest $request) {
        $locale = $request->session()->get('locale');
        App::setLocale($locale);
        if ($this->objmCTContact->addItem($request)) {
            $request->session()->flash('msg',trans('index.contactsuccess'));
            return redirect('/#ContactForm');
        } else {
            $request->session()->flash('msg','Fail!');
            return redirect('/#ContactForm');
        }
    }

}
