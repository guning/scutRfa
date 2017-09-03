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
}