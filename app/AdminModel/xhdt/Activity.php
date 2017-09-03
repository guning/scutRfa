<?php
/**
 * Created by PhpStorm.
 * User: guning
 * Date: 2017/8/25
 * Time: 19:42
 */
namespace App\AdminModel\xhdt;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
    protected $table = 'activity';
    public $timestamps = false;

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

    public function getApiData(){
        $rawData = $this->select('id', 'title', 'abstract', 'schedule', 'way', 'poster')->where('status', '=', 1)->get();
        $data = array();
        foreach ($rawData as $r) {
            $data[] = array(
                'id' => $r->id,
                'title' => $r->title,
                'abstract' => $r->abstract,
                'schedule' => json_decode($r->schedule, true),
                'way' => json_decode($r->way, true),
                'poster' => $r->poster
            );
        }
        return $data;
    }

    public function insertActivity($requestData){
        return $this->insert($requestData);
    }

    public function updateActivity($id, $newActivity){
        return $this->where('id', '=', $id)->update($newActivity);
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