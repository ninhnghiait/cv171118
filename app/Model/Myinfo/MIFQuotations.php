<?php

namespace App\Model\Myinfo;

use Illuminate\Database\Eloquent\Model;

class MIFQuotations extends Model
{
    protected $table = "quotations";
    protected $primaryKey = "id_quo";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('id_quo', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // get 3 item
    public function get3Item() {
        return $this->inRandomOrder()->take(3)->get();
    }
    // get random item
     public function getRandomItem($lang) {
        return $this->where('language_code',$lang)->inRandomOrder()->take(1)->get();
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->job = $request->job;
        $this->content = $request->content;
        $this->picture = $request->picture;
        $this->language_code = $request->language_code;
        return $this->save();
    }
    // edit item
    public function editItem($id, $request) {
        $objItem = $this->findOrFail($id);
        $objItem->name = $request->name;
        $objItem->job = $request->job;
        $objItem->content = $request->content;
        if ($request->picture != '') {
            $objItem->picture = $request->picture;
        }
        $objItem->language_code = $request->language_code;
        return $objItem->save();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }


}
