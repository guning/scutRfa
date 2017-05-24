<?php

namespace App\AdminModel\xhgk;

use Illuminate\Database\Eloquent\Model;

class WXMes extends Model
{
    protected $table = 'wxmes';
    public $timestamps = false;

    //
    public function selectNeed(){
        return $this->select('intro', 'introimgpath', 'activity', 'actimgpathf', 'actimgpaths')->first();
    }

    public function updateData($updatedata){
        $result = $this->first();
        $data['intro'] = $updatedata['intro'];
        $data['introimgpath'] = $updatedata['intro'];
        $data['activity'] = $updatedata['activity'];
        $data['actimgpathf'] = $updatedata['actimgpathf'];
        $data['actimgpaths'] = $updatedata['actimgpaths'];
        $data['update_time'] = time();

        if (!isset($result->id)){
            $this->insert($data);
        }else{
            $this->where('id', $result->id)->update($data);
        }
        return true;
    }
}
