<?php

namespace App\AdminModel\sybj;

use Illuminate\Database\Eloquent\Model;

class Dynam extends Model
{
    protected $table = 'dynamics';
    public $timestamps = false;

    //
    public function selectNeed(){
        return $this->select('id', 'imgpath', 'title', 'summary', 'acturl')->get();
    }

    public function updateData($data){
        $requestdata = $data;
        foreach($requestdata as $key => $value){
            foreach($value as $k => $v){
                $result[$k][$key] = $v;
            }
        }

        $res[1] = 0;
        foreach($result as $item){
            if($item['id'] == ''){
                $insert[] = $item;
            }else{
                $res[1] += $this->where('id', '=', $item['id'])->update($item);
            }
        }

        if(!empty($insert)) {
            $res[0] = $this->insert($insert);
        }

        return true;
    }
}
