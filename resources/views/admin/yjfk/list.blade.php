@extends('admin.main')

@section('position', '意见反馈')

@section('content')
    <div>
        <form action="">
            <table class="table">
                <thead>
                <tr>
                    <th>用户</th>
                    <th>信息</th>
                    <th>时间</th>
                    <th>处理状态</th>
                    <th>进行回复</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $r)
                <tr>
                    <th><p class="text-info">{{$r['user']}}</p></th>
                    <th><p class="text-info">{{$r['question']}}</p></th>
                    <th><p class="text-info">{{$r['time']}}</p></th>
                    <th><p class="text-info">{{$r['status']}}</p></th>
                    <th><botton type="botton" class="btn btn-default">回复</botton></th>
                </tr>
                @endforeach
                </tbody>
            </table>
            <br/>
        </form>
    </div>
@endsection