@extends('admin.main')

@section('position', '意见反馈')

@section('content')
    <div>
        <form action="">
            <table class="table">
                <thead>
                <tr>
                    <th style="width:10%;">用户</th>
                    <th style="width:20%;">信息</th>
                    <th style="width:20%;">时间</th>
                    <th style="width:10%;">进行回复</th>
                    <th style="width:35%;">回复输入框</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                <tr>
                    <th><p class="text-info">{{$result['user']}}</p></th>
                    <th><p class="text-info">{{$result['question']}}</p></th>
                    <th><p class="text-info">{{$result['time']}}</p></th>
                    <th>
                    @if($result['status'] == 0)
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-{{ $result['id'] }}" data-toggle="modal" data-target="#myModal" onclick="reply( {{ $result['id'] }} )">
                            回复
                        </button>
                    @else
                    <botton type="botton" class="btn btn-success">已回复</botton>
                    @endif
                    </th>
                    <th id="{{ $result['id'] }}" style="display:none;">
                        <textarea name="" id="text-{{ $result['id'] }}" cols="30" rows="3"></textarea>
                        <button id="btn-{{ $result['id'] }}">提交</button>
                    </th>
                </tr>
                @endforeach
                </tbody>
            </table>
            <br/>
        </form>
    </div>
    <script type="text/javascript">
        function reply(id) {
            $("#" + id ).css("display", "table")
            $("#btn-" + id ).click(function() {
                new newAjax(1, 'reply', {"id": id, "reply": $('#text-' + id).val() }, function(res) {
                    $('.btn-' + id ).removeClass('btn-danger')
                    $('.btn-' + id).addClass('btn-success')
                })
            })
        }
    </script>
@endsection