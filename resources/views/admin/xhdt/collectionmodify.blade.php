@extends('admin.main')

@section('position', '协会动态 -> 作品集锦')

@section('content')
    <div>
        <form action="up" method="post">
            <table class="table">
                <tbody>
                    <tr>
                        <th>作品名称</th>
                        <th>
                            <input style="display: none" name="id" value="{{$result['id']}}"/>
                            <input type="text" name="title" value="{{$result['title']}}" />
                        </th>
                    </tr>
                    <tr>
                        <th>作品简介</th>
                        <th>
                            <textarea name="" id="" cols="30" rows="10">{{$result['abstract']}}</textarea>
                        </th>
                    </tr>
                    <tr>
                        <th>图片</th>
                        <th>
                            <div>
                                <button type="button" class="btn btn-default" onclick="$(this).next().click();">上传图片</button>
                                <input type="file" accept="image/*" onchange="uploadfile(this)" style="display: none"/>
                                <input style="display: none" name="poster" value="{{$result['imgPath']}}"/>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary btn-submit">提交</button>
        </form>
    </div>
    <script type="text/javascript">
    </script>
@endsection