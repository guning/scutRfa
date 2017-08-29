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

class Xhdt extends Controller {
    private $viewPage;

    private function getModelName($page){
        switch($page){
            case 'actlist' :
                $result['model'] = new Activity();
                $result['state'] = true;
                $this->viewPage = 'admin/xhdt/allJqhd';
                break;
            default:
                $result['state'] = false;
        }
        return $result;
    }

    public function show($page){
        $getResult = $this->getModelName($page);
        //return $getResult;
        if($getResult['state']){
            $mymodel = $getResult['model'];
            $result = $mymodel->getList();
            return view($this->viewPage, ['results' => $result]);
        }else{
            abort(404);
        }

    }

    public function update(Request $request, $page){
        $getResult = $this->getModelName($page);
        if($getResult['state']){
            $mymodel = $getResult['model'];
            $data['state'] = $mymodel->updateData($request->all());
            return $data;
        }else{
            abort(404);
        }
    }

    public function del(Request $request, $page){
        $getResult = $this->getModelName($page);
        if($getResult['state']) {
            $mymodel = $getResult['model'];
            if ($mymodel->delData($request->input('id')) >= 1) {
                $data['state'] = true;
            } else {
                $data['state'] = false;
            }
            return $data;
        }else{
            abort(404);
        }
    }
}