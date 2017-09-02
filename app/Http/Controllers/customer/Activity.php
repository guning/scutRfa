<?php
namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Activity as ActivityModel;
use App\Http\Controllers\Controller;

class Activity extends Controller
{
    //前端请求api接口，返回status=1的活动
    public function active(Request $request)
    {

    }

    public function tmpDataActive(){
        $data = array();
        for ($i=0; $i <= 3 ; $i++) {
            $data[] = array(
                'id' => $i,
                'title' => 'xxoo',
                'abstract' => 'xxooxxooxxooxxooxxooxxooxxooxxooxxoo',
                'way' => array(
                    array(
                        'title' => 'xxoo',
                        'content' => 'xxooxxooxxooxxooxxooxxooxxooxxooxxooxxoo'
                    ),
                    array(
                        'title' => 'xxoo',
                        'content' => 'xxooxxooxxooxxooxxooxxooxxooxxooxxooxxoo'
                    ),
                    array(
                        'way' => 'xxoo',
                        'content' => 'xxooxxooxxooxxooxxooxxooxxooxxooxxooxxoo'
                    )
                ),
                'poster' => 'zxcxcxzcxcx.png'
            );
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function tmpCollection(){

    }
}
