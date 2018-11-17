<?php

namespace App\Model\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NECat extends Model
{
    protected $table = "category";
    protected $primaryKey = "id_cat";
    public $timestamps = false;

    protected $fillable = ['name', 'parent_id', 'sort'];

    public function newsThrough()
    {
        return $this->hasManyThrough('App\Model\News\NENews','App\Model\News\NECat','parent_id','id_cat','id_cat')->take(3)->orderBy('id_news','DESC');
    }

    public function child()
    {
        return $this->hasMany('App\Model\News\NECat','parent_id','id_cat')->orderBy('sort', 'ASC');
    }

    public function getItems() {
        return $this->orderBy('sort', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    
    public function getItemsAll() {
        return $this->with('child','newsThrough')->where('parent_id','0')->orderBy('sort', 'ASC')->get()->toArray();
    }

    public function getItemsPr() {
        return $this->where('parent_id','0')->orderBy('sort', 'ASC')->get()->toArray();
    }

    public function getItem($id) {
        return $this->findOrFail($id);
    }

    public function getItemsPL() {
        return $this->orderBy('sort', 'ASC')
        ->select('news.*','category.name as cname')
        ->join('news','category.id_cat','=','news.id_cat')
        ->get();
    }

    public function addItem($request) {
        return $this->create($request->all());
    }

    public function editItem($id, $request) {
        return $this->find($id)->update($request->all());
    }

    public function delItem($id) {
        return $this->findOrFail($id)->delete();
    }

    public function getCatIdPr($id) {
        return $this->findOrFail($id)->parent_id;
    }
    
}
