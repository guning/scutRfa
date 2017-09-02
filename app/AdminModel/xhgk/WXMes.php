<?php

namespace App\AdminModel\xhgk;

use Illuminate\Database\Eloquent\Model;

class WXMes extends Model
{
    protected $table = 'wxmes';
    public $timestamps = false;

    //
    public function selectNeed($mode = 0){
        $res = $this->select('intro', 'introimgpath', 'activity', 'actimgpathf', 'actimgpaths')->first();
        if ($mode == 1) {
            if (!is_null($res)) {
                $text = array('intro' => $res->intro, 'activity' => $res->activity);
                $img = array('intro' => $res->introimgpath,
                    'activity1' => $res->actimgpathf,
                    'activity2' => $res->actimgpaths
                );
                $data['leftcontent'] = $text;
                $data['rightcontent'] = $img;
            } else {
                $data['introduce'] = '';
                $data['introImg'] = '';
                $data['activity'] = '';
                $data['activityImg1'] = '';
                $data['activityImg2'] = '';
            }
        } else {
            $data = $res;
        }
        return $data;
    }

    public function updateData($updatedata){
        $result = $this->first();
        $data['intro'] = $updatedata['intro'];
        $data['activity'] = $updatedata['activity'];
        $data['introimgpath'] = $updatedata['introimgpath'];
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
