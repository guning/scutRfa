<?php
/**
 * Created by PhpStorm.
 * User: guning
 * Date: 2017/9/2
 * Time: 23:20
 */
namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;

class Home extends Controller {
    public function tmpCaro(){
        $data = array();
        for ($i = 0; $i <= 4; $i++) {
            $data[] = array(
                'id' => $i,
                'title' => 'xxoo',
                'content' => 'xxoo/xxoo',
                'image' => 'xxooxxooxxooxxooxxoo.png',
                'url' => 'http://xxooxxooxxooxxoo'
            );
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function tmpDynamic(){
        $data = array();
        for ($i = 0; $i <= 5; $i++) {
            $data[] = array(
                'id' => $i,
                'title' => 'xxoo',
                'abstract' => 'xxooxxooxxooxxoo',
                'image' => 'xasdasfsaf.png',
                'url' => 'http://xxooxxooxxoo'
            );
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}