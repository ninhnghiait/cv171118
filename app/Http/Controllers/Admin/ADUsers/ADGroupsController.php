<?php

namespace App\Http\Controllers\Admin\ADUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group;
use App\Http\Requests\ADUsers\ADGroupRequest;

class ADGroupsController extends Controller
{
	public function __construct(Group $objmGroup){
        $this->objmGroup = $objmGroup;
    }
    public function index() {
    	$objItems = $this->objmGroup->getItems();
    	return view('admin.adusers.groups.index', compact('objItems'));
    }

    public function create() {
        return view('admin.adusers.groups.add');
    }
    public function store(ADGroupRequest $request) {
        $msg = $this->objmGroup->addItem($request) ? 'Success!' : 'Fail!';
        return redirect()->route('groups_admin.index')->with('msg', $msg);
    }

    public function edit($id) {
        $objItem = $this->objmGroup->getItem($id);
        return view('admin.adusers.groups.edit', compact('objItem'));
    }
    public function update($id, ADGroupRequest $request) {
        $msg = $this->objmGroup->editItem($id, $request) ? 'Success!' : 'Fail!';
        return redirect()->route('groups_admin.index')->with('msg', $msg);
    }
    public function destroy($id) {
        $msg = $this->objmGroup->delItem($id) ? 'Success!' : 'Fail!';
        return redirect()->route('groups_admin.index')->with('msg', $msg);
    }
}
