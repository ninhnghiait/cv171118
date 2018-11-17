<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NECmt;
class ADCmtController extends Controller
{
	public function __construct(NECmt $objmNECmt){
        $this->objmNECmt = $objmNECmt;
    }
    public function index() {
    	$objItems = $this->objmNECmt->getItems();
    	return view('admin.adnews.cmt.index', compact('objItems'));
    }

    public function destroy($id) {
        $result = $this->objmNECmt->delItem($id);
        $msg = $this->result_method($result);
        return redirect()->route('cmt_admin.index')->with('msg',$msg);
    }
    //delete more
    public function delmore(Request $request) {
        if (!is_null($request->cmtdel)) {
            $result = $this->objmNECmt->delMorreItem($request->cmtdel);
            $msg = $this->result_method($result);
            return redirect()->route('cmt_admin.index')->with('msg',$msg);
        }
        return redirect()->route('cmt_admin.index')->with('msg','Không chọn xóa dòng nào!');
    }
    public function result_method($result)
    {
        return $result ? 'Success!' : 'Fail!';
    }
}
