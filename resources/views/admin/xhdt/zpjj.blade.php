@extends('admin.main')

@section('position', '协会动态 -> 作品集锦')

@section('content')
    <div>
        <form action="">
            <table class="table">
                <thead>
                <tr>
                    <th>作品名称</th>
                    <th>作品简介</th>
                    <th>图片</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr id="1" class="add">
                    <th><input type="text" class="input-sm"/></th>
                    <th><textarea rows="10"></textarea></th>
                    <th>
                        <div>
                            <button type="button" class="btn btn-default" onclick="$(this).next().click();">上传图片</button>
                            <input type="file" accept="image/*" onchange="uploadfile(this)" style="display: none"/>
                            <input style="display: none" name="xxxUrl" value=""/>
                        </div>
                    </th>
                    <th><button type="button" class="btn btn-default" onclick="deleteEle(this);">删除</button></th>
                </tr>
                </tbody>
            </table>
            <br/>
            <div>
                <button type="button" class="btn btn-primary btn-submit">提交</button>
                <button type="button" class="btn btn-primary btn-review">预览</button>
                <button type="button" class="btn btn-primary btn-add" onclick="add();">增加作品</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        function add(){
            var elelast = $(".add:last");
            var nextid = (elelast.length != 0)?Number(elelast.attr("id")) + 1:1;
            var nexthtml = '<tr id="'+nextid+'" class="add"><th><input type="text" class="input-sm"/></th> <th><textarea rows="10"></textarea></th> <th><input type="file"></th> <th><button type="button" class="btn btn-default" onclick="deleteEle(this);">删除</button></th> </tr>'
            if(nextid == 1){
                $("tbody").append(nexthtml);
            }else {
                elelast.parent().append(nexthtml);
            }
        }
        function deleteEle(btn){
            $(btn).parent().parent().remove();
        }
    </script>
@endsection