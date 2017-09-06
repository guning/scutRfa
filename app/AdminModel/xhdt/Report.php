<?php
/**
 * Created by PhpStorm.
 * User: guning
 * Date: 2017/9/3
 * Time: 21:48
 */
namespace App\AdminModel\xhdt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Report extends Model {
    protected $table = 'report';

    public function getApiData($pageIndex, $pageSize){
        Request::offsetSet('page', $pageIndex);
        $rawData = $this->select('id', 'title', 'abstract', 'updated_at as updateTime', 'imgpath as picUrl')->paginate($pageSize)->toJson();
        $tmpData = json_decode($rawData, true);
        $data['pageIndex'] = (int)$pageIndex;
        $data['totalPage'] = $tmpData['last_page'];
        $data['report'] = $tmpData['data'];
        return $data;
    }


    public function getList() {
        $tableDatas = $this->select('id', 'title', 'status')->get();
        $data = array();
        foreach ($tableDatas as $tableData) {
            $tmp['id'] = $tableData['id'];
            $tmp['title'] = $tableData['title'];
            $tmp['status'] = $tableData['status'];
            $data[] = $tmp;
        }
        return $data;
    }

    public function getModify($id){
        $rawData = $this->select('id', 'title', 'abstract', 'schedule', 'way', 'poster')->where('id', '=', $id)->first();
        $data = array(
            'id' => $rawData->id,
            'title' => $rawData->title,
            'abstract' => $rawData->abstract,
            'schedule' => json_decode($rawData->schedule, true),
            'way' => json_decode($rawData->way, true),
            'poster' => $rawData->poster
        );
        return $data;
    }

    public function getNullData(){
        return array(
            'id' => '',
            'title' => '',
            'abstract' => '',
            'schedule' => array(
                array(
                    'stage' => '',
                    'beginTime' => '',
                    'endTime' => '',
                    'place' => ''
                ),
            ),
            'way' => array(
                array(
                    'wayname' => '',
                    'waycontent' => ''
                ),
            ),
            'poster' => ''
        );
    }
    private function scheduleFilter($stages, $beginTimes, $endTimes, $places){
        $schedule = array();
        foreach ($stages as $key => $stage) {
            if (trim($stage) == '' && trim($beginTimes[$key]) == '' && trim($endTimes[$key]) == '' && trim($places[$key]) == '') {
                continue;
            }
            $schedule[] = array(
                'stage' => $stage,
                'beginTime' => $beginTimes[$key],
                'endTime' => $endTimes[$key],
                'place' => $places[$key]
            );
        }
        return $schedule;
    }

    private function wayFilter($waynames, $waycontents) {
        $way = array();
        foreach ($waynames as $key => $wayname) {
            if (trim($wayname) == '' && trim($waycontents[$key])) {
                continue;
            }
            $way[] = array(
                'wayname' => $wayname,
                'waycontent' => $waycontents[$key]
            );
        }
        return $way;
    }
    public function updateData($rawData){
        $schedule = $this->scheduleFilter($rawData['stage'], $rawData['beginTime'], $rawData['endTime'], $rawData['place']);
        $way = $this->wayFilter($rawData['wayname'], $rawData['waycontent']);
        $data = array(
            'title' => $rawData['title'],
            'abstract' => $rawData['abstract'],
            'schedule' => json_encode($schedule),
            'way' => json_encode($way),
            'poster' => $rawData['poster']
        );
        if (isset($rawData['id'])) {
            $id = $rawData['id'];
            return $this->where('id', '=', $id)->update($data);
        } else {
            if(!empty($data)) {
                return $this->insert($data);
            } else {
                return 0;
            }
        }
    }

    public function changeStatus($id, $status){
        if ($status >= 3 || $status < 0) {
            $status = 0;
        }
        return $this->where('id', '=', $id)->update(array('status' => $status));
    }

    public function deleteData($id) {
        return $this->where('id', '=', $id)->delete();
    }
}