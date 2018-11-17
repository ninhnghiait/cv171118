<?php

namespace App\Model\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NETag extends Model
{
    protected $table = "tags";
    protected $primaryKey = "id_tag";
    public $timestamps = false;
    public function news()
    {
    	return $this->belongsTomany('App\Model\News\NENews','news_tags','id_tag','id_news')->where('confirm',1);
    }
    public function getItemPl($slug)
    {
    	return $this->where('tag',$slug)->first()->news()->paginate(10);
    }
    public function getItemByTag($slug)
    {
    	return $this->where('tag',$slug)->first();
    }
    public function getItemsAd()
    {
        return $this->paginate(10);
    }
    public function addItem($ar)
    {
        return $this->insert($ar);
    }
    public function editItem($id, $ar)
    {
        return $this->where('id_tag',$id)->update($ar);
    }
    public function getItem($id)
    {
        return $this->find($id);
    }
    public function delItem($id)
    {
        return $this->where('id_tag',$id)->delete();
    }
    public function getItemsAll()
    {
        return $this->orderBy('id_tag','DESC')->get()->toArray();
    }

}
