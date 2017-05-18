<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity as ActivityModel;

class Activity extends Controller
{
    //
    protected $pageNumber;

    protected $paginate;

    public function __construct(Request $request)
    {
        $this->pageNumber = $request->input('page');
        $this->paginate = $request->input('num');
    }

    public function preview()
    {
        if (! $this->pageNumber && ! $this->paginate) {
            return response()->json(array(
                'state' => false
            ));
        }
        $offset = ($this->pageNumber - 1) * $this->paginate;
        $totalPage = ActivityModel::count('id') / $this->paginate;
        $activities = ActivityModel::orderBy('id', 'desc')->offset($offset)
            ->limit($this->paginate)
            ->get();
        return $this->makePreviewMessageBag($totalPage, $activities);
    }

    protected function makePreviewMessageBag($totalPage, $activities)
    {
        $messageBag['state'] = true;
        $messageBag['totalPage'] = $totalPage;
        foreach ($activities as $key => $activitie) {
            $schedules = unserialize($activitie->schedule);
            foreach ($schedules as $schedule) {
                $schedule->beginTime = $schedule->begin_time;
                $schedule->endTime = $schedule->end_time;
                unset($schedule->begin_time);
                unset($schedule->end_time);
            }
            $messageBag['activity'][$key]['id'] = $activitie->id;
            $messageBag['activity'][$key]['title'] = $activitie->title;
            $messageBag['activity'][$key]['content'] = $activitie->abstract;
            $messageBag['activity'][$key]['schedule'] = $schedules;
            $messageBag['activity'][$key]['signUpLink'] = $activitie->sign_up_url;
        }
        return $messageBag;
    }

    /**
     * 近期活动海报上传接口
     * 已注册uploadPoster作为中间件
     * Admin，后台接口
     *
     * @param Request $request
     * @return string
     */
    public function uploadPoster(Request $request){
        $image = $request->file('picture');
        $ext = $image->getClientOriginalExtension();
        $tempFileName = 'pending'.'-'.date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
        $response = new \stdClass();

        try{
            Image::make($image)->save('img/poster/'.$tempFileName);
        }catch(\Exception $e){
            $response->status = 'fail';
            return json_encode($response);
        }

        $response->state = 'success';
        $response->surfacePlot = $tempFileName;
        return json_encode($response);
    }

    /**
     * 管理员用文章上传
     * 已注册release作为中间件
     *      type-$id
     *
     * @param Request $request
     * @return string
     */
    public function release(Request $request){
        $poster = $request->input('poster');
        $title = $request->input('title');
        $schedule = $request->input('schedule');
        $content = $request->input('content');
        $signUpLink = $request->input('signUpLink');
        $ext = self::getExtend($poster);
        $response = new \stdClass();

        //我的锅，用了MyISAM，开不了事务了
        //DB::beginTransaction();//开启事务
        try{
            $ormObj = new ActivityModel();
            $ormObj->title = $title;
            $ormObj->abstract = $content;
            $ormObj->schedule = serialize(json_decode($schedule));
            $ormObj->sign_up_url = ($signUpLink == false) ? false : $signUpLink;
            $ormObj->save();

            $id = $ormObj->id;//获取文章索引插入数据表后的id

            rename('img/poster/'.$poster,'img/poster/'.$id.'.'.$ext);
        }catch(\Exception $e) {
            //DB::rollBack();//回滚数据库
            $response->status = 'fail';
            return json_encode($response);
        }

        $response->state = 'success';
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
