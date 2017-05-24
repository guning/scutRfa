@extends('admin.main')

@section('position', '协会动态 -> 活动报道')

@section('content')

@include('UEditor::head');

    <div>
        <form action="">
            <table class="table">
                <tbody>
                <tr>
                    <th>报道标题</th>
                    <th><input type="text"/></th>
                </tr>
                <tr>
                    <th>报道摘要</th>
                    <th><textarea name="" id="" rows="5"></textarea></th>
                </tr>
                <tr>
                    <th>报道图片</th>
                    <th>
                        <div>
                            <button type="button" class="btn btn-default" onclick="$(this).next().click();">上传图片</button>
                            <input type="file" accept="image/*" onchange="uploadfile(this)" style="display: none"/>
                            <input style="display: none" name="xxxUrl" value=""/>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>报道内容</th>
                    <th></th>
                </tr>
                <tr>

                </tr>
                </tbody>
            </table>
            <script id="containers" type="text/plain" style="height:500px;"></script>
            <br/><br/><br/><br/>
            <div>
                <button type="button" class="btn btn-primary btn-submit">提交</button>
                <button type="button" class="btn btn-primary btn-review">预览</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('containers');
    </script>
@endsection