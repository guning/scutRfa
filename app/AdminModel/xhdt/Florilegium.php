<?php
/**
 * Created by PhpStorm.
 * User: guning
 * Date: 2017/9/3
 * Time: 22:42
 */
namespace App\AdminModel\xhdt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Florilegium extends Model {
    protected $table = 'florilegium';

    public function getApiData($pageIndex, $pageSize){
        Request::offsetSet('page', $pageIndex);
        $rawData = $this->select('id', 'title', 'abstract', 'updated_at as updateTime', 'imgpath as picUrl')->paginate($pageSize)->toJson();
        $tmpData = json_decode($rawData, true);
        $data['pageIndex'] = (int)$pageIndex;
        $data['totalPage'] = $tmpData['last_page'];
        $data['collection'] = $tmpData['data'];
        return $data;
    }

    public function getList() {
        $tableDatas = $this->select('id', 'title', 'abstract','imgPath')->get();
        $data = array();
        foreach ($tableDatas as $tableData) {
            $tmp['id'] = $tableData['id'];
            $tmp['title'] = $tableData['title'];
            $tmp['abstract'] = $tableData['abstract'];
            $tmp['imgPath'] = $tableData['imgPath'];
            $data[] = $tmp;
        }
        return $data;
    }

    public function getModify($id){
        $rawData = $this->select('id', 'title', 'imgPath', 'abstract')->where('id', '=', $id)->first();
        $data = array(
            'id' => $rawData->id,
            'title' => $rawData->title,
            'abstract' => $rawData->abstract,
            'imgPath' => $rawData->imgPath
        );
        return $data;
    }
}

