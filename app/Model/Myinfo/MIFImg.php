<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;

class MIFImg extends Model
{
    protected $table = "images";
    protected $primaryKey = "img_id";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('img_id', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    public function getItemsAll() {
        return $this->orderBy('img_id', 'DESC')->get();
    }
    public function get8Items() {
        return $this->orderBy('img_id', 'DESC')->take(8)->get();
    }
    public function getItemsByGlr($id) {
        return $this->where('gallery_id', $id)->get()->toArray();
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // add items
    public function addItems($ar) {
        return $this->insert($ar);
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }

    
}
