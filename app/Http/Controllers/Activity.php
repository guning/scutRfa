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
}
