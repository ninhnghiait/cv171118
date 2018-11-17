<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;

class MIFExperiences extends Model
{
    protected $table = "experiences";
    protected $primaryKey = "id_exp";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('date_create', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // get all items
    public function getItemsAll($type, $lang) {
        return $this->where('type',$type)->where('language_code',$lang)->orderBy('date_create', 'ASC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->content = $request->content;
        $this->date_create = $request->date_create;
        $this->type = $request->type;
        $this->address = $request->address;
        $this->language_code = $request->language_code;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        $objItem->content = $request->content;
        $objItem->date_create = $request->date_create;
        $objItem->type = $request->type;
        $objItem->address = $request->address;
        $objItem->language_code = $request->language_code;
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }

    
}
