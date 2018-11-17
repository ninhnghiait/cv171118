<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Myinfo\MIFSkills;
use App\Http\Requests\MyInfo\ADSkillsRequest;
class ADSkillsController extends Controller
{
	public function __construct(MIFSkills $objmMIFSkills){
        $this->objmMIFSkills = $objmMIFSkills;
    }
    public function index() {
    	$objItems = $this->objmMIFSkills->getItems();
    	return view('admin.admyinfo.skills.index', compact('objItems'));
    }

    public function create() {
        return view('admin.admyinfo.skills.add');
    }
    public function store(ADSkillsRequest $request) {
        $msg = $this->objmMIFSkills->addItem($request) ? 'Success!' : 'Fail!';
        return redirect()->route('skills_admin.index')->with('msg', $msg);
    }

    public function edit($id) {
        $objItem = $this->objmMIFSkills->getItem($id);
    	return view('admin.admyinfo.skills.edit', compact('objItem'));
    }

    public function update($id, ADSkillsRequest $request) {
        $msg = $this->objmMIFSkills->editItem($id, $request) ? 'Success!' : 'Fail!';
        return redirect()->route('skills_admin.index')->with('msg', $msg);
    }

    public function destroy($id) {
        $msg = $this->objmMIFSkills->delItem($id) ? 'Success!' : 'Fail!';
        return redirect()->route('skills_admin.index')->with('msg', $msg);
    }
    
}
