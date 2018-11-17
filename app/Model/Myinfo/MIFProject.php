<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;

class MIFProject extends Model
{
    protected $table = "projects";
    protected $primaryKey = "id_prj";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('sort', 'DESC')->orderBy('id_prj', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    public function getItemsPl($lang) {
        return $this->where('lang','=',$lang)->orderBy('sort', 'DESC')->orderBy('id_prj', 'DESC')->get();
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->link = $request->link;
        $this->lang = $request->lang;
        $this->picture = $request->pic;
        $this->sort = $request->sort;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        $objItem->link = $request->link;
        $objItem->lang = $request->lang;
        $objItem->sort = $request->sort;
        if ($request->pic != '') {
            $objItem->picture = $request->pic;
        }
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }


}
