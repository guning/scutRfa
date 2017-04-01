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
     * 管理员用文章上传接口
     * 文章的原始html字符串会保留在uploadHtml盘内，文件命名：
     *      type-$id
     *
     * @param Request $request
     * @return string
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

        $id = $ormObj->id;

        $bool = Storage::disk('uploadHtml')->put($type.'-'.$id,$content);

        $response = new \stdClass();

        if($bool){
            $response->status = 'success';
        }else{
            $response->status = 'fail';
        }

        return json_encode($response);
    }

    public function getHtml(Request $request){
        $response = new \stdClass();

        //我在犹豫这些要不要写到中间件里
        if (
            !$request->exists('type')
            ||!$request->exists('id')
        ){
            $response->status = 'fail';
            return json_encode($response);
        }
        $type = $request->input('type');
        $id = $request->input('id');

        if (!preg_match('/^((report)|(repairSkill)|(share))$/',$type)){
            $response->status = 'fail';
            return json_encode($response);
        }

        $response->status = 'success';
        $response->content = Storage::disk('uploadHtml')->get($type.'-'.$id);
        return json_encode($response);
    }
}