<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Requests\MyInfo\ADExperiencesRequest;
use App\Http\Controllers\Controller;

use App\Model\MyInfo\MIFexperiences;
use Illuminate\Support\Facades\Storage;

class ADExperiencesController extends Controller
{
	public function __construct(MIFexperiences $objmMIFExperiences){
        $this->objmMIFExperiences = $objmMIFExperiences;
    }
    public function index() {
    	$objItems = $this->objmMIFExperiences->getItems();
    	return view('admin.admyinfo.experiences.index', compact('objItems'));
    }

    public function create() {
        return view('admin.admyinfo.experiences.add');
    }
    public function store(ADExperiencesRequest $request) {
        $msg = $this->objmMIFExperiences->addItem($request) ? 'Success!' : 'Fail!';
        return redirect()->route('experiences_admin.index')->with('msg',$msg);
    }

    public function edit($id) {
        $objItem = $this->objmMIFExperiences->getItem($id);
    	return view('admin.admyinfo.experiences.edit', compact('objItem'));
    }
    public function update($id, ADExperiencesRequest $request) {
        $msg = $this->objmMIFExperiences->editItem($id, $request) ? 'Success!' : 'Fail!';
        return redirect()->route('experiences_admin.index')->with('msg',$msg);
    }

    public function destroy($id, Request $request) {
        $msg = $this->objmMIFExperiences->delItem($id) ? 'Success!' : 'Fail!';
        return redirect()->route('experiences_admin.index')->with('msg',$msg);
    }
    
}
