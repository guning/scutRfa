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
                <tr>
                    <th><p class="text-info">111</p></th>
                    <th><p class="text-info">111</p></th>
                    <th><p class="text-info">111</p></th>
                    <th><p class="text-info">111</p></th>
                    <th><botton type="botton" class="btn btn-default">回复</botton></th>
                </tr>

                </tbody>
            </table>
            <br/>
            <div>
                <button type="button" class="btn btn-primary btn-submit">提交</button>
                <button type="button" class="btn btn-primary btn-review">预览</button>
            </div>
        </form>
    </div>
@endsection