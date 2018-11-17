<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News\NECat;
use App\Http\Requests\News\ADCatRequest;

class ADCatController extends Controller
{
	public function __construct(NECat $objmNECat){
        $this->middleware('abmauth:admin')->only('create', 'edit', 'delete');
        $this->objmNECat = $objmNECat;
    }

    public function index() {
    	$arItems = $this->objmNECat->getItemsAll();
    	return view('admin.adnews.cat.index', compact('arItems'));
    }

    public function create() {
        $arItems = $this->objmNECat->getItemsPr();
        return view('admin.adnews.cat.add', compact('arItems'));
    }
    public function store(ADCatRequest $request) {
        $result = $this->objmNECat->addItem($request);
        $msg = $this->result_method($result);
        return redirect()->route('cat_admin.index')->with(['msg' => $msg]);
    }

    public function edit($id) {
        $objItem = $this->objmNECat->getItem($id);
        $arItems = $this->objmNECat->getItemsPr();
    	return view('admin.adnews.cat.edit', compact('objItem','arItems'));
    }

    public function update($id, ADCatRequest $request) {
        $result = $this->objmNECat->editItem($id, $request);
        $msg = $this->result_method($result);
        return redirect()->route('cat_admin.index')->with(['msg' => $msg]);
    }

    public function destroy($id, Request $request) {
        $result = $this->objmNECat->delItem($id);
        $msg = $this->result_method($result);
        return redirect()->route('cat_admin.index')->with(['msg' => $msg]);
    }

    public function result_method($result)
    {
        return $result ? 'Success!' : 'Fail!';
    }
    
}
