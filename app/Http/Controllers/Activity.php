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
                'state' => 'fail'
            ));
        }
        $offset = ($this->pageNumber - 1) * $this->paginate;
        $totalPage = ceil(ActivityModel::count('id') / $this->paginate);
        $activities = ActivityModel::orderBy('id', 'desc')->offset($offset)
            ->limit($this->paginate)
            ->where('status', 1)
            ->get();
        if ($activities->count() == 0) {
            return response()->json(array(
                'state' => 'success',
                'totalPage' => 0
            ));
        }
        return $this->makePreviewMessageBag($totalPage, $activities);
    }

    protected function makePreviewMessageBag($totalPage, $activities)
    {
        $messageBag['state'] = 'success';
        $messageBag['totalPage'] = $totalPage;
        foreach ($activities as $key => $activitie) {
            $messageBag['activity'][$key]['id'] = $activitie->id;
            $messageBag['activity'][$key]['title'] = $activitie->title;
            $messageBag['activity'][$key]['content'] = $activitie->abstract;
            $messageBag['activity'][$key]['schedule'] = json_decode($activitie->schedule, true);;
            $messageBag['activity'][$key]['way'] = json_decode($activitie->way, true);
            $messageBag['activity'][$key]['poster'] = json_decode($activitie->poster, true);
        }
        return json_encode($messageBag);
    }


    /**
     * 插入活动数据
     * @param Request $request
     * @return string
     */
    public function release(Request $request){
        $poster = $request->input('poster');
        $title = $request->input('title');
        $schedule = $request->input('schedule');
        $abstract = $request->input('abstract');
        $way = $request->input('way');
        $response = new \stdClass();

        try{
            $ormObj = new ActivityModel();
            $ormObj->title = $title;
            $ormObj->abstract = $abstract;
            $ormObj->schedule = serialize(json_decode($schedule));
            $ormObj->way = $way;
            $ormObj->status = 0; //默认插入时未开启
            $ormObj->save();

            $id = $ormObj->id;//获取文章索引插入数据表后的id

        }catch(\Exception $e) {
            $response->status = 'fail';
            return json_encode($response);
        }

        $response->state = 'success';
        return json_encode($response);
    }


    /**
     * 文章的更新
     *
     * @param Request $request
     * @return string
     */
    public function modify(Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $schedule = $request->input('schedule');
        $content = $request->input('content');
        $signUpLink = $request->input('signUpLink');
        $response = new \stdClass();

        if($request->has('poster')){
            $newPoster = true;
            $poster = $request->input('poster');//标题图临时文件名
            $ext = self::getExtend($poster);
        }else{
            $newSurfacePlot = false;
        }
        //我的锅，用了MyISAM，开不了事务了
        //DB::beginTransaction();//开启事务
//        try{
            $ormObj = ActivityModel::find($id);
            $ormObj->title = $title;
            $ormObj->abstract = $content;
            $ormObj->schedule = serialize(json_decode($schedule));
            $ormObj->sign_up_url = ($signUpLink == false) ? false : $signUpLink;
            $ormObj->save();

            if($newPoster){
                rename('img/poster/'.$poster,'img/poster/'.$id.'.'.$ext);
            }//标题图重命名
//        }catch(\Exception $e) {
//            //DB::rollBack();//回滚数据库
//            $response->state = 'fail';
//            return json_encode($response);
//        }

        $response->state = 'success';
        return json_encode($response);
    }

}
