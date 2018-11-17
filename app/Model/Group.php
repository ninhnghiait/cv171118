<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
    protected $table = "groups";
    protected $primaryKey = "id_group";
    public $timestamps = false;
    // get all items
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // get all items
    public function getItems() {
    	return $this->orderBy('id_group', 'ASC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // get all items
    public function getItemsNP() {
    	return $this->orderBy('id_group', 'ASC')->get();
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->code = $request->code;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        $objItem->code = $request->code;
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }

    //lấy mảng các group khi có uid
    public function getItemsAll(){
        return $this->orderBy('id_group', 'ASC')->get();
    }
    public function getItemsByUid($uid){
        return DB::table('users_groups')->where('uId', $uid)->pluck('gId')->toArray();
    }
    public function getItemsAllByUid($uid){
        return DB::table('users as u')->join('users_groups as ug', 'u.id', '=', 'ug.uId')
            ->join('groups as g', 'ug.gId', '=', 'g.id_group')
            ->select('g.*')
            ->where('ug.uId', $uid)
            ->orderBy('g.id_group', 'ASC')->get()->toArray();

    }
}
