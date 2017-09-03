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
}