<?php
/**
 * Created by PhpStorm.
 * User: mtfl1
 * Date: 2017/3/31
 * Time: 23:11
 */
namespace App\Http\Controllers;

use App\RepairTrick;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Article extends Controller{

    /**
     * 管理员上传Html代码用，到时候还需要一个admin中间件
     *
     */
    public function uploadHtml(Request $request){
        $type = $request->input('type');
        $title = $request->input('title');
        $abstract = $request->input('abstract');
        $content = $request->input('content');

        if($type == 'repairSkill'){
            $ormObj = new RepairTrick();
        }elseif($type == 'report'){
            $ormObj = new Report();
        }/*elseif($type = 'share'){
            $DB = new Chapter();
        }*/

        //文章索引存放至数据库
        $ormObj->title = $title;
        $ormObj->abstract = $abstract;
        $ormObj->save();
        //获取id
        $id = $ormObj->id;


        //文章存放至文件中
        $bool = Storage::disk('uploadHtml')->put($type.'-'.$id,$content);

        $response = new \stdClass();
        if($bool){
            $response->status = 'success';
        }else{
            $response->status = 'fail';
        }

        return json_encode($response);



    }
}