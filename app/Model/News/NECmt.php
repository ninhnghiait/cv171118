<?php

namespace App\Model\News;

use Illuminate\Database\Eloquent\Model;


class NECmt extends Model
{
    protected $table = "comment";
    protected $primaryKey = "id_cmt";
    public $timestamps = true;
    //get items
    public function getItems() {
        return $this->orderBy('id_cmt', 'DESC')
        ->select('comment.*','news.name as nname')
        ->join('news','comment.id_news','=','news.id_news')
        ->paginate(getenv('ADMIN_MYINFO'));
    }
    public function getFiveItems() {
        return $this->select('users.fullname','users.id','users.avatar','comment.*','news.name as nname')
        ->leftjoin('users','users.id','=','comment.id')
        ->join('news','news.id_news','=','comment.id_news')
        ->where('comment.confirm','=','1')
        ->take(5)->get()->toArray();
    }
    //delete item
    public function delItem($id) {
        return $this->findOrFail($id)->delete();
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
    //delete item
    public function getItemsByNews($id) {
        try {
            $result = $this->select('users.fullname','users.id','users.avatar','comment.*')->leftjoin('users','users.id','=','comment.id')->where('confirm','=','1')->where('id_news','=', $id);
            $total = $result->count();
            $arr = $result->where('idcmtrt','=','0')->orderBy('id_cmt', 'DESC')->get()->toArray();
            foreach ($arr as $key => $v) {
                $arr[$key]['child'] = $this->select('users.fullname','users.id','users.avatar','comment.*')->leftjoin('users','users.id','=','comment.id')
                                           ->where('confirm','=','1')
                                           ->where('id_news','=',$id)
                                           ->where('idcmtrt','=',$v['id_cmt'])
                                           ->orderBy('id_cmt', 'DESC')->get()->toArray();
            }
            return [$arr,$total];

        }catch(\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
        }
        return [null,0];

    }
    //addcmtNlog
    public function addItemNlog($request) {
        $this->id_news = $request->aid;
        $this->name = $request->anameNlog;
        $this->email = $request->aemailNlog;
        $this->content = $request->acontentNlog;
        $this->confirm = 0;
        $this->idcmtrt = 0;
        return $this->save();
    }
    //addcmtNlog
    public function addItemLog($id,$id_news,$content) {
        $this->id_news = $id_news;
        $this->content = $content;
        $this->id = $id;
        $this->confirm = 1;
        $this->idcmtrt = 0;
        $this->namert = '';
        return $this->save();
    }
    //addcmtNlog2
    public function addItemNlog2($request) {
        $this->id_news = $request->aid;
        $this->name = $request->namenloglv;
        $this->email = $request->emailnLoglv;
        $this->content = $request->acontentnlog2;
        $this->confirm = 0;
        $this->idcmtrt = $request->aidcmtrtlog2;
        $this->namert = $request->anamertlog2;
        return $this->save();
    }
    //addcmtLog2
    public function addItemLog2($request) {
        $this->id_news = $request->aid;
        $this->content = $request->acontentlog2;
        $this->confirm = 1;
        $this->idcmtrt = $request->aidcmtrtlog2;
        $this->namert = $request->anamertlog2;
        $this->id = $request->user_id;
        return $this->save();
    }

    // 
    public function countCmt($id) {
        try {
           return $this->where('id_news','=',$id)->where('confirm','=','1')->count();
        } catch(\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
        }
        return 0;
    }
   public function delMorreItem($ar)
   {
       return $this->whereIn('id_cmt',$ar)->delete();
   }

}
