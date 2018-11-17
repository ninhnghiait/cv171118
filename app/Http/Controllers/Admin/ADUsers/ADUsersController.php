<?php

namespace App\Http\Controllers\Admin\ADUsers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Group;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ADUsers\ADUsersRequest;
use App\Http\Requests\ADUsers\ADProfileRequest;

class ADUsersController extends Controller
{
	public function __construct(User $objmUser, Group $objmGroup){
        $this->objmUser = $objmUser;
        $this->objmGroup = $objmGroup;
    }
    public function index() {
        $objItems = $this->objmUser->getItems();
        View::share('objmGroup', $this->objmGroup);
        return view('admin.adusers.users.index', compact('objItems'));
    }

    public function create() {
        $objItemsGroup = $this->objmGroup->getItemsAll();
        return view('admin.adusers.users.add', compact('objItemsGroup'));
    }
    public function store(ADUsersRequest $request){
        $arItem = [
            'username'      => trim($request->username),
            'password'      => bcrypt(trim($request->password)),
            'fullname'      => trim($request->fullname),
            'email'         => trim($request->email),
            'active'         => 1,
            'vgroup'        => $request->vgroup,
        ];
        $msg = $this->objmUser->addItem($arItem) ? 'Success!' : 'Fail!';
        return redirect()->route('users_admin.index')->with('msg', $msg);
    }

    public function edit($id){
        $arItem = $this->objmUser->getItem($id);
        $objItemsGroup = $this->objmGroup->getItemsAll();
        //lấy các group của $uid=$id này
        $arGroupOld = $this->objmGroup->getItemsByUid($id);
        return view('admin.adusers.users.edit', compact('arItem','objItemsGroup', 'arGroupOld'));
    }
    public function update($id, ADUsersRequest $request){
        $arItem = [
            'username'      => trim($request->username),
            'fullname'      => trim($request->fullname),
            'email'         => trim($request->email),
            'vgroup'        => $request->vgroup,
        ];
        if (trim($request->password) != "") {
            $arItem['password'] = bcrypt(trim($request->password));
        }
        
        $msg = $this->objmUser->editItem($id, $arItem) ? 'Success!' : 'Fail!';
        return redirect()->route('users_admin.index')->with('msg', $msg);
    }

    public function destroy($id){
        $msg = $this->objmUser->delItem($id) ? 'Success!' : 'Fail!';
        return redirect()->route('users_admin.index')->with('msg', $msg);
    }
    //dell more
    public function delAll(Request $request){
        if (count($request->vnedel) > 0) {
            foreach ($request->vnedel as $key => $uid) {
                $this->objmUser->delItem($uid);
            }
        }

        $request->session()->flash('msg', 'Success');
        return redirect()->route('users_admin.index');
    }
    //get profile
    public function getProfile($id){
        $arItem = $this->objmUser->getItem($id);
        $objItemsGroup = $this->objmGroup->getItemsAll();
        //lấy các group của $uid=$id này
        $arGroupOld = $this->objmGroup->getItemsByUid($id);
        return view('admin.adusers.users.profile', compact('arItem','objItemsGroup', 'arGroupOld'));
    }
    public function postProfile($id, ADProfileRequest $request){
        $arItem = [
            'fullname'=> trim($request->fullname),
        ];
        if (trim($request->password) != "") {
            $arItem['password'] = bcrypt(trim($request->password));
        }
        
        $msg = $this->objmUser->editProfile($id, $arItem) ? 'Success!' : 'Fail!';
        return redirect()->route('admin.adusers.users.profile', $id)->with('msg', $msg);
    }

}
