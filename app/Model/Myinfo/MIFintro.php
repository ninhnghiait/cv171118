<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;

class MIFintro extends Model
{
    protected $table = "myinfo";
    protected $primaryKey = "id_if";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('id_if', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // get item
    public function getItem($id) {
        return $this->find($id);
    }
    // get first item
    public function getFirstItem($lang) {
        return $this->where('language_code',$lang)->first();
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->birthday = $request->birthday;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->confirm = 1;
        $this->content = $request->content;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        $objItem->email = $request->email;
        $objItem->birthday = $request->birthday;
        $objItem->address = $request->address;
        $objItem->phone = $request->phone;
        $objItem->fb = $request->fb;
        $objItem->gg = $request->gg;
        $objItem->tt = $request->tt;
        $objItem->ig = $request->ig;
        $objItem->content = $request->content;
        if (!empty($request->avatar)) {
            $objItem->avatar = $request->avatar; 
        }
        if (!empty($request->picture)) {
            $objItem->picture = $request->picture; 
        }
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }
    //ajax confirm
    public function confirm($id) {
        $objItem = $this->findOrFail($id);
        if ($objItem->confirm == 1) {
            $objItem->confirm = 0;
            $objItem->save();
            return 1;
        } else {
            $objItem->confirm = 1;
            $objItem->save();
            return 0;
        }

    }

}
