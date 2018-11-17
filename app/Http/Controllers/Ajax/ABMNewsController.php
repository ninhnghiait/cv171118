<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NECmt;
use Illuminate\Support\Facades\Auth;
use App\Model\News\NENews;
use Validator;
class ABMNewsController extends Controller
{
	public function __construct(NECmt $objmNECmt, NENews $objmNENews){
        $this->objmNECmt = $objmNECmt;
        $this->objmNENews = $objmNENews;
    }
    //cmt No log
    public function cmtNlog(Request $request) {
        $now = date('H:i:s d/m/Y');
        // validator
        $validatedData = \Validator::make($request->all(),
          [
            'anameNlog' => 'required',
            'aemailNlog' => 'required|email',
            'acontentNlog' => 'required',
          ],
          [
            'required' => ':attribute không được để trống!',
            'email' => ':attribute không đúng định dạng email!',
          ],
          [
            'anameNlog' => 'Tên',
            'aemailNlog' => 'Email',
            'acontentNlog' => 'Nội dung',
          ]
        );

        if ($validatedData->fails())
        {
          return response()->json(['errors'=>$validatedData->errors()->all()]);
        }
        //
        if ($this->objmNECmt->addItemNlog($request)) {
            return 'Bình luận của bạn đang được phê duyệt, Thank you!';
        } else {
            return 'Có lỗi xảy ra';
        }
    }
    //cmt Log
    public function cmtLog(Request $request) {
        $now = date('H:i:s d/m/Y');
        // validator
        $validatedData = \Validator::make($request->all(),
          [
            'acontentLog' => 'required',
          ],
          [
            'required' => ':attribute Không được để trống',
          ],
          [
            'acontentLog' => 'Nội dung',
          ]
        );

        if ($validatedData->fails())
        {
          return response()->json(['errors'=>$validatedData->errors()->all()]);
        }
        if (Auth::check()) {
        $id = Auth::user()->id;
        $id_news = $request->aid;
        $content = $request->acontentLog;
          $avatarUser = Auth::user()->avatar ? asset('storage/app/media/files/users/'.$Auth::user()->avatar) : asset('storage/app/media/files/users/ico.png');
          if ($this->objmNECmt->addItemLog($id,$id_news,$content)) {
              return '<div class="item"> <div class="user"> <figure> <img src="'.$avatarUser.'"> </figure> <div class="details"> <h5 class="name">'.$request->name.'</h5> <div class="time">'.$now.'</div> <div class="description"> '.$request->acontentLog.'</div> </div> </div></div>';
          }
        }

    }
    //cmt No log lv2
    public function cmtNlog2(Request $request) {
        $now = date('H:i:s d/m/Y');
        // validator
        $validatedData = \Validator::make($request->all(),
          [
            'namenloglv' => 'required',
            'emailnLoglv' => 'required|email',
            'acontentnlog2' => 'required',
          ],
          [
            'required' => ':attribute không được để trống!',
            'email' => ':attribute không đúng định dạng email!',
          ],
          [
            'namenloglv' => 'Tên',
            'emailnLoglv' => 'Email',
            'acontentnlog2' => 'Nội dung',
          ]
        );
        if ($validatedData->fails())
        {
          return response()->json(['errors'=>$validatedData->errors()->all()]);
        }
        if ($this->objmNECmt->addItemNlog2($request)) {
            return 'Bình luận của bạn đang được phê duyệt, Thank you!';
        } else {
            return 'Có lỗi xảy ra';
        }
    }
    //cmt log lv2
    public function cmtLog2(Request $request) {

      $validatedData = \Validator::make($request->all(),
          [
            'acontentlog2' => 'required',
          ],
          [
            'required' => ':attribute Không được để trống',
          ],
          [
            'acontentlog2' => 'Nội dung',
          ]
        );

        if ($validatedData->fails())
        {
          return response()->json(['errors'=>$validatedData->errors()->all()]);
        }

        if (Auth::check()) {
          $request->user_id = Auth::user()->id;
          $now = date('H:i:s d-m-Y');
          if ($this->objmNECmt->addItemLog2($request)) {
            $avatarUser = Auth::user()->avatar ? asset('storage/app/media/files/users/'.$Auth::user()->avatar) : asset('storage/app/media/files/users/ico.png');
            $username = Auth::user()->fullname;
            return '<div class="reply-list"> <div class="item"> <div class="user"> <figure> <img src="'.$avatarUser.'"> </figure> <div class="details"> <h5 class="name">'.$username.'<span class="namert">&nbsp;&nbsp;@ '.$request->anamertlog2.'</span></h5> <div class="time">'.$now.'</div> <div class="description"> '.$request->acontentlog2.'</div> </div> </div> </div> </div>'; 
          }
        }
    }

      //
    public function post(Request $request) {
      $cr = $request->cr;
      $resultNews = $this->objmNENews->getItemsPl($cr);
      $arNews = $resultNews[0];
      $cr = $resultNews[2];
      return view('aboutme.abmnews.post', compact('arNews','cr')); 
    }

    public function postcat(Request $request) {
      $cr = $request->cr;
      $id = $request->id;
      $resultNews = $this->objmNENews->getItemsPlByCat($id,$cr);
      $arNews = $resultNews[0];
      $cr = $resultNews[2];
      return view('aboutme.abmnews.post', compact('arNews','cr')); 
    }

}
