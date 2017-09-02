@extends('admin.main')

@section('position', '协会动态 -> 近期活动')

@section('content')
<div>
    <table class="table">
        <tr>
            <th>当前活动列表</th>
            <th>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>活动名称</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($results) != 0)
                        @foreach($results as $result)
                        <tr>
                            <th>
                                <p class="text-info">{{$result['title']}}</p>
                                <input style="display: none" value="{{$result['id']}}"/>
                            </th>
                            <th>
                                <button type="button" class="btn btn-default" onclick="deleteEle(this)">删除</button>
                                @if($result['status'] == 1)
                                    <button type="button" class="btn btn-success" onclick="changeStatus(this)">进行中</button>
                                @elseif($result['status'] ==2)
                                    <button type="button" class="btn btn-danger" onclick="changeStatus(this)">已结束</button>
                                @else
                                    <button type="button" class="btn btn-warning" onclick="changeStatus(this)">未开始</button>
                                @endif
                            </th>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </th>
        </tr>
    </table>
</div>

<script type="text/javascript">
    function addway(btn){
        var nexthtml = '';
        $("#addway").append(nexthtml);
    }
    function addschedule(btn){
        var nexthtml = '<tr> <th><input type="text" name="stage[]"/></th> <th><input type="text" name="beginTime[]"/></th> <th><input type="text" name="endTime[]"/></th> <th><input type="text" name="place[]"/></th> <th><button type="button" class="btn btn-default" onclick="rmEle(this)">删除</button></th> </tr>';
        $("#addschedule").append(nexthtml);
    }
    function rmEle(btn){
        $(btn).parent().parent().remove();
    }
    function changeStatus(status) {
        var actId = $(status).parent().parent().find("input").attr("value");
        var formdata = new FormData();
        if ($(status).hasClass('btn-warning')) {
            newAjax(0, window.location.host + '/admin/xhdt/changeActStatus/' + actId, '', ajaxDeal);
            $(status).removeClass('btn-warning');
            $(status).addClass('btn-success');
            $(status).html('进行中');
            return;
        }
        if ($(status).hasClass('btn-success')) {
            $(status).removeClass('btn-success');
            $(status).addClass('btn-danger');
            $(status).html('已结束');
            return;
        }
        if ($(status).hasClass('btn-danger')) {
            $(status).removeClass('btn-danger');
            $(status).addClass('btn-warning');
            $(status).html('未开始');
            return;
        }

    }
</script>
@endsection