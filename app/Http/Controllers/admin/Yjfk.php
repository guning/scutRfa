<?php
/**
 * Created by PhpStorm.
 * User: guning
 * Date: 2017/9/4
 * Time: 22:19
 */
namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class Yjfk extends Controller {
    public function qList() {
        $data = array(
            array(
                'id' => '1',
                'user' => '',
                'question' => 'this is my question',
                'time' => '2017-09-08 22:22:22',
                'status' => 0
            ),
            array(
                'id' => '2',
                'user' => '',
                'question' => 'this is my question',
                'time' => '2017-09-08 22:22:22',
                'status' => 1
            ),
        );
        return view('admin/yjfk/list', ['results' => $data]);
    }

    public function reply(Request $request) {
        $flag = $request->input('reply');
        if ($flag == 1){
            $data['state'] = false;
        }else{
            $data['state'] = true;
        }
        return $data;
    }
}