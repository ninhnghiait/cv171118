<?php

namespace App\Model\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NENews extends Model
{
    protected $table = "news";
    protected $primaryKey = "id_news";
    public $timestamps = true;

    public function tags()
    {
        return $this->belongsToMany('App\Model\News\NETag','news_tags','id_news','id_tag');
    }
    // get all items with cat,user
    public function getItems() {
        return $this->orderBy('id_news', 'DESC')
        ->select('news.*','category.name as cname','users.*')
        ->join('category','news.id_cat','=','category.id_cat')
        ->join('users','news.id','=','users.id')
        ->where('confirm','1')
        ->paginate(getenv('ADMIN_MYINFO'));
    }
    //
    public function getItemsAll() {
        return $this->with('tags')->orderBy('id_news', 'DESC')
        ->select('news.*','category.name as cname','users.*')
        ->join('category','news.id_cat','=','category.id_cat')
        ->join('users','news.id','=','users.id')
        ->paginate(getenv('ADMIN_MYINFO'));
    }
    // get items pl
    public function getItemsPl($sk) {
        return $this->select('news.*','category.name as cname')
        ->where('confirm','1')
        ->join('category','news.id_cat','=','category.id_cat')
        ->orderBy('id_news', 'DESC')
        ->take(2)->skip($sk)->get()->toArray();
    }
    public function getItemsPlAll() {
        return $this->select('news.*','category.name as cname')
        ->where('confirm','1')
        ->join('category','news.id_cat','=','category.id_cat')
        ->orderBy('id_news', 'DESC')
        ->take(12)->get()->toArray();
    }
    // get items pl by cat
    public function getItemsPlByCat($id) {
        return $this->select('news.*','category.name as cname')
        ->where('confirm','1')
        ->where('news.id_cat','=',$id)
        ->join('category','news.id_cat','=','category.id_cat')
        ->orderBy('id_news', 'DESC')
        ->paginate(10);
    }
    // get 3 news 
    public function get3Items($id, $cid) {
        return $this->select('news.*','category.name as cname')
        ->where('confirm','1')
        ->where('news.id_cat','=',$cid)
        ->where('news.id_news','!=',$id)
        ->join('category','news.id_cat','=','category.id_cat')
        ->orderBy('id_news', 'DESC')->take(2)->get()->toArray();
    }

    // get news in cat
    public function getItemsCat($cid) {
        return $this->orderBy('news.id_news', 'DESC')
        ->select('news.*','category.name as cname','users.*')
        ->join('category','news.id_cat','=','category.id_cat')
        ->join('users','news.id','=','users.id')
        ->where('news.id_cat', $cid)
        ->where('confirm','1')
        ->paginate(getenv('ADMIN_MYINFO'));
    }
    // get item
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // get item
    public function getItemAd($id) {
        return $this->with('tags')->find($id);
    }
    //
    public function getFirstIt() {
        try {
            return $this->select('category.name as cname','news.*','users.fullname')->join('category','category.id_cat','=','news.id_cat')->join('users','users.id','=','news.id')->orderBy('id_news','DESC')->where('confirm','1')->firstOrFail()->toArray();
        }catch(\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
        }
        return null;
    }
    //
    public function getFirstItCat($id) {
        try {
            return $this->select('category.name as cname','news.*','users.fullname')->join('category','category.id_cat','=','news.id_cat')->where('news.id_cat','=',$id)->join('users','users.id','=','news.id')->orderBy('id_news','DESC')->where('confirm','1')->firstOrFail()->toArray();
        }catch(\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
        }
        return null;
    }
    // get item join cat,user
    public function getItemDetail($id) {
        return $this->with('tags')->select('news.*','category.name as cname','users.fullname','users.avatar')
        ->join('category','news.id_cat','=','category.id_cat')
        ->join('users','news.id','=','users.id')
        ->findOrFail($id);
    }
    // add item
    public function addItem($ar,$arTag) {
        try{
        $id = $this->insertGetId($ar);
        $ob = $this->find($id);
        $ob->tags()->attach($arTag);
        return true;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
    // edit item
    public function editItem($id, $ar, $arTag) {
        try{
        $this->where('id_news',$id)->update($ar);
        $ob = $this->find($id);
        $ob->tags()->sync($arTag);
        return true;
        } catch (Exception $e) {
            return false;
        }
        return false;

    }
    //delete item
    public function delItem($id) {
        try{
           $ob = $this->find($id);
           $ob->tags()->detach();
           $ob->delete();
        return true;
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
    //ajax confirm
    public function confirm($id) {
        $objItem = $this->findOrFail($id);
        if ($objItem->confirm == 1) {
            $objItem->confirm = 0;
            $objItem->save();
            return 1;
        } else {
            $objItem->confirm = 1;
            $objItem->save();
            return 0;
        }

    }
    public function getCookieNews($ar)
    {
        return $this->whereIn('id_news',$ar)->get()->toArray();
    }
    public function getItemSearchPl($text)
    {
        return $this->select('news.*','category.name as cname')
        ->join('category','news.id_cat','=','category.id_cat')
        ->where('confirm',1)
        ->where(function ($query) use ($text) {
                $query->where('news.name', 'like', "%$text%")
                ->orWhere('category.name', 'like', "%$text%");
            })
        ->orderBy('id_news', 'DESC')
        ->paginate(10);
    }
    public function incrementView($id)
    {
        $this->find($id)->increment('count_number');
    }
}
