@extends('admin.main')

@section('position', '协会动态 -> 近期活动')

@section('content')
    <div>
        <form action="">
            <table class="table">
               <tbody>
                    <tr>
                        <th>活动名称</th>
                        <th>
                            <input type="text"/>
                            <div>
                                <button type="button" class="btn btn-default" onclick="$(this).next().click();">上传海报</button>
                                <input type="file" accept="image/*" onchange="uploadfile(this)" style="display: none"/>
                                <input style="display: none" name="imgpath[]" value=""/>
                                <input style="display: none" name="id[]" value=""/>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>活动介绍</th>
                        <th><textarea name="" id="" rows="7"></textarea></th>
                    </tr>
                    <tr>
                        <th>活动日程表</th>
                        <th>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>阶段</th>
                                    <th>时间</th>
                                    <th>地点</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                    <th><input type="text"></th>
                                    <th><input type="text"></th>
                                    <th><input type="text"></th>
                                    <th><button type="button" class="btn btn-default" onclick="deleteEle(this)">删除</button></th>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-default btn-add" id="schedule" onclick="add(this)">添加</button>
                        </th>
                    </tr>
                    <tr>
                        <th>报名方式</th>
                        <th>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>途径</th>
                                    <th>具体方法</th>
                                    <th>链接</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                    <th><input type="text"></th>
                                    <th><input type="text"></th>
                                    <th><input type="text"></th>
                                    <th><button type="button" class="btn btn-default" onclick="deleteEle(this)">删除</button></th>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-default btn-add" id="way" onclick="add(this)">添加</button>
                        </th>
                    </tr>
               </tbody>
            </table>

            <div>
                <button type="button" class="btn btn-primary btn-submit">提交</button>
                <button type="button" class="btn btn-primary btn-review">预览</button>
            </div>
            <br/><br/><br/><br/><br/>
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
                                    <tr>
                                        <th><p class="text-info">huodong</p></th>
                                        <th><button type="button" class="btn btn-default" onclick="deleteEle(this)">删除</button></th>
                                    </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>
                </table>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        function add(addbtn){
            var item = addbtn.id;
            var lastItem = $(addbtn).prev().children(":last").children(":last");
            var nextId = (lastItem.length != 0)?(Number(lastItem.attr("id")) + 1) : 1;
            switch (item){
                case "schedule" :
                    var nextHTML = '<tr id="'+nextId+'"> <th><input type="text"></th> <th><input type="text"></th> <th><input type="text"></th> <th><button type="button" class="btn btn-default" onclick="deleteEle(this)">删除</button></th> </tr>';
                    break;
                case "way" :
                    var nextHTML = '<tr id="'+nextId+'"> <th><input type="text"></th> <th><input type="text"></th> <th><input type="text"></th> <th><button type="button" class="btn btn-default" onclick="deleteEle(this)">删除</button></th> </tr>';
                    break;
            }
            if (nextId == 1){
                $(addbtn).prev().children(":last").append(nextHTML);
            }else {
                lastItem.parent().append(nextHTML);
            }
        }
        function deleteEle(btn){
            $(btn).parent().parent().remove();
        }
    </script>
@endsection