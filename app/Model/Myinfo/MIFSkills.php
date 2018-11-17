<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;

class MIFSkills extends Model
{
    protected $table = "skills";
    protected $primaryKey = "id_skill";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('id_skill', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->value = $request->value;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        $objItem->value = $request->value;
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }

    
}
