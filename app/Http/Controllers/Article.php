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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Article extends Controller{

    /**
     * 管理员用标题图上传接口
     * 当前使用中间件
     *
     * @param Request $request
     * @return string
     */
    public function uploadSurfacePlot(Request $request){
        $image = $request->file('picture');
        $realPath  = $image->getRealPath();
        $ext = $image->getClientOriginalExtension();
        $tempFileName = 'pending'.'-'.date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
        $response = new \stdClass();

        try{
            //如果要存到public目录下，这个public一定不能加，what the mother fucker?
            Image::make($image)->resize(300, 200)->save('img/surfacePlot/'.$tempFileName);
        }catch(\Exception $e){
            $response->status = 'fail';
            return json_encode($response);
        }

        $response->status = 'success';
        $response->surfacePlot = $tempFileName;
        return json_encode($response);
    }

    /**
     * 管理员用文章上传
     * 当前使用中间件uploadHtml,后续还会加上Admin中间件
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
        $surfacePlot = $request->input('surfacePlot');//标题图临时文件名
        $ext = self::getExtend($surfacePlot);
        $response = new \stdClass();

        //我的锅，用了MyISAM，开不了事务了
        //DB::beginTransaction();//开启事务
        try{
            //文章索引存放至数据库
            if($type == 'repairSkill'){
                $ormObj = new RepairTrick();
            }elseif($type == 'report'){
                $ormObj = new Report();
            }/*elseif($type = 'share'){
            $DB = new Chapter();
        }*/
            $ormObj->title = $title;
            $ormObj->abstract = $abstract;
            $ormObj->save();

            $id = $ormObj->id;//获取文章索引插入数据表后的id

            Storage::disk('uploadHtml')->put($type.'-'.$id,$content);//文章内容存放至磁盘
            rename('imgd/surfacePlot/'.$surfacePlot,'img/surfacePlot/'.$type.'-'.$id.'.'.$ext);//标题图重命名
        }catch(\Exception $e) {
            //DB::rollBack();//回滚数据库
            $response->status = 'fail';
            return json_encode($response);
        }

        $response->status = 'success';
        return json_encode($response);
    }

    /**
     * 相对应的，文章的更新
     *
     * @param Request $request
     * @return string
     */
    public function updateHtml(Request $request){
        $response = new \stdClass();



        $response->status = 'success';
        return json_encode($response);
    }

    /**
     * 富文本请求
     * 参数过滤那个部分后期再考虑要不要加入中间件
     * 采用文件存储读取好慢啊，妈的好方
     *
     * @param Request $request
     * @return string
     */
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

    /**
     * 正则搜索文件名中的拓展名
     * @param $fileName
     * @return mixed
     */
    static private function getExtend($fileName){
        $array  = [];
        preg_match('/(?<=\.)[a-zA-Z]+$/',$fileName,$array);
        return $array[0];//蜜汁自信，匹配出来一定只有一个结果
    }
}