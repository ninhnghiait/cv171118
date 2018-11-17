<?php

namespace App\Model\Contact;

use Illuminate\Database\Eloquent\Model;

class CTContact extends Model
{
    protected $table = "contact";
    protected $primaryKey = "id_ct";
    public $timestamps = false;
    // get all items
    public function getItems() {
    	return $this->orderBy('id_ct', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }
    // add item
    public function addItem($request) {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->content = $request->content;
        return $this->save();
    }
}
