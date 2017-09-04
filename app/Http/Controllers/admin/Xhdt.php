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
    private function getModelView($page){
        $data = array();
        switch ($page) {
            case 'activity' :
                $data['model'] = new Activity();
                $data['view'] = 'actlist';
                break;
        }
    }
    public function qList($page)
    {
        $mymodel = new Activity();
        $result = $mymodel->getList();
        return view('admin/xhdt/allJqhd', ['results' => $result]);
    }
    public function changeActStatus($id,$status){
        $mymodel = new Activity();
        if ($mymodel->changeStatus($id, $status + 1) >= 1) {
            $data['state'] = true;
        } else {
            $data['state'] = false;
        }
    }

    public function del(Request $request)
    {
        $mymodel = new Activity();
        if ($mymodel->deleteData($request->input('id')) >= 1) {
            $data['state'] = true;
        } else {
            $data['state'] = false;
        }
        return $data;
    }

    public function newAct()
    {
        $data = array(
            'id' => '',
            'title' => '',
            'abstract' => '',
            'schedule' => array(
                'stage' => '',
                'beginTime' => '',
                'endTime' => '',
                'place' => ''
            ),
            'way' => array(
                'wayname' => '',
                'waycontent' => ''
            ),
            'poster' => ''
        );
        return view('admin/xhdt/modifyJqhd', ['result', $data]);
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

}