@extends('admin.main')

@section('position', '首页编辑 -> 首页协会动态')

@section('content')
    <div>
        <form id="dataform">
            <table class="table">
                <thead>
                <tr>
                    <th>图片</th>
                    <th>标题</th>
                    <th>摘要</th>
                    <th>跳转链接</th>
                </tr>
                </thead>
                <tbody>
                @if(count($results) != 0)
                    @foreach($results as $result)
                        <tr>
                            <th>
                                <div>
                                    <button type="button" class="btn btn-default" onclick="$(this).next().click();">上传图片</button>
                                    <input type="file" accept="image/*" onchange="uploadfile(this)" style="display: none"/>
                                    <input style="display: none" name="imgpath[]" value="{{$result->imgpath}}"/>
                                    <input style="display: none" name="id[]" value="{{$result->id}}"/>
                                </div>
                            </th>
                            <th><input type="text" name="title[]" value="{{$result->title}}"/></th>
                            <th><input type="text" name="summary[]" value="{{$result->summary}}"/></th>
                            <th><input type="text" name="acturl[]" value="{{$result->acturl}}"/></th>
                        </tr>
                    @endforeach
                @else
                    @for($i=0;$i<=2;$i++)
                        <tr>
                            <th>
                                <div>
                                    <button type="button" class="btn btn-default" onclick="$(this).next().click();">上传图片</button>
                                    <input type="file" accept="image/*" onchange="uploadfile(this)" style="display: none"/>
                                    <input style="display: none" name="imgpath[]" value=""/>
                                    <input style="display: none" name="id[]" value=""/>
                                </div>
                            </th>
                            <th><input type="text" name="title[]" value=""/></th>
                            <th><input type="text" name="summary[]" value=""/></th>
                            <th><input type="text" name="acturl[]" value=""/></th>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
            <br/>
            <div>
                <button type="button" class="btn btn-primary btn-submit" onclick="sendData();">提交</button>
                {{--<button type="button" class="btn btn-primary btn-review">预览</button>--}}
            </div>
        </form>
    </div>
@endsection