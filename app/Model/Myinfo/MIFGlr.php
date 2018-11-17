<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MIFGlr extends Model
{
    protected $table = "gallery";
    protected $primaryKey = "gallery_id";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('gallery_id', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    public function getItemsAll() {
        return $this->orderBy('gallery_id', 'DESC')->get()->toArray();
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        DB::table('images')->where('gallery_id',$id)->delete();
        return $this->findOrFail($id)->delete();
    }
    public function getItemsAr($id) {
        return $this->findOrFail($id)->toArray();
    }
    
}
