<?php
/**
 * Created by PhpStorm.
 * User: 罟宁
 * Date: 2017/8/22
 * Time: 21:03
 */
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\xhdt\Activity;

class Xhdt extends Controller
{

    public function actList()
    {
        $mymodel = new Activity();
        $result = $mymodel->getList();
        return view('admin/xhdt/allJqhd', ['results' => $result]);
    }
    public function changeActStatus(){

    }

    public function actUpdate(Request $request)
    {
        $mymodel = new Activity();
        if ($mymodel->updateData($request->all()) >= 1) {
            $data['state'] = true;
        } else {
            $data['state'] = false;
        }
        return $data;
    }

    public function del(Request $request)
    {
        $mymodel = new Activity();
        if ($mymodel->delData($request->input('id')) >= 1) {
            $data['state'] = true;
        } else {
            $data['state'] = false;
        }
    }
}