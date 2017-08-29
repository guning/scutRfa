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
        $this->pageNumber = $request->input('page');
        $this->paginate = $request->input('num');
        //$this->pageNumber = 1;
        //$this->paginate = 3;
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

}
