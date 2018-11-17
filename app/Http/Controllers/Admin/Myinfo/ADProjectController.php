<?php

namespace App\Http\Controllers\Admin\Myinfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\MyInfo\ADProjectRequest;
use App\Model\Myinfo\MIFProject;
use Illuminate\Support\Facades\Storage;

class ADProjectController extends Controller
{
	public function __construct(MIFProject $objmMIFProject){
        $this->objmMIFProject = $objmMIFProject;
    }
    public function index() {
    	$objItems = $this->objmMIFProject->getItems();
    	return view('admin.admyinfo.project.index', compact('objItems'));
    }

    public function create() {
        return view('admin.admyinfo.project.add');
    }
    public function store(ADProjectRequest $request) {
        $request->pic = '';
        if (!is_null($request->picture)) {
            //upload picture
            foreach ($request->picture as $key => $v) {
                if (!is_null($request->file('picture')[$key])) {
                    $path = $request->file('picture')[$key]->store('media/files/project');
                    $tmp = explode('/', $path);
                    $request->pic .= end($tmp).'|';
                }
            }
        }
        $msg = $this->objmMIFProject->addItem($request) ? 'Success!' : 'Fail!';
        return redirect()->route('project_admin.index')->with('msg', $msg);
    }

    public function edit($id) {
        $objItem = $this->objmMIFProject->getItem($id);
    	return view('admin.admyinfo.project.edit', compact('objItem'));
    }
    public function update($id, ADProjectRequest $request) {
        if ($request->status == 'add') {
            $request->pic = '';
            if (!is_null($request->picture)) {
                //upload picture
                foreach ($request->picture as $key => $v) {
                    if (!is_null($request->file('picture')[$key])) {
                        $path = $request->file('picture')[$key]->store('media/files/project');
                        $tmp = explode('/', $path);
                        $request->pic .= end($tmp).'|';
                    }
                }
            }
            $msg = $this->objmMIFProject->addItem($request) ? 'Success!' : 'Fail!';
            return redirect()->route('project_admin.index')->with('msg', $msg);
        } else {
            $objItem = $this->objmMIFProject->getItem($id);
            $request->pic = '';
            if (!is_null($request->picture)) {
                //upload picture
                foreach ($request->picture as $key => $v) {
                    if (!is_null($request->file('picture')[$key])) {
                        $path = $request->file('picture')[$key]->store('media/files/project');
                        $tmp = explode('/', $path);
                        $request->pic .= end($tmp).'|';
                    }
                }
                if ($objItem->picture != null) {
                    $ar = explode('|', $objItem->picture);
                    foreach ($ar as $key => $v) {
                        if ($v != '') {
                            Storage::delete("media/files/project/".$v);
                        }
                    }
                    Storage::delete("media/files/project/".$objItem->picture);
                }
            }
            $msg = $this->objmMIFProject->editItem($id, $request) ? 'Success!' : 'Fail!';
            return redirect()->route('project_admin.index')->with('msg', $msg);
        }
    }

    public function destroy($id) {
        $objItem = $this->objmMIFProject->getItem($id);
        if ($objItem->picture != null) {
            Storage::delete("media/files/project/".$objItem->picture);
        }
        $msg = $this->objmMIFProject->delItem($id) ? 'Success!' : 'Fail!';
        return redirect()->route('project_admin.index')->with('msg', $msg);
    }
    
}
