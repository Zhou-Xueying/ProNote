@extends('selfcenter/selfcenter')
@section('subtitle')
    笔记本列表
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/mypage.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">
                    收到的分享
                </p>
            </div>
        </div>
        <hr/>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>标题</th>
                <th>简介</th>
                <th>标签</th>
                <th>作者</th>
                <th>创建日期</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notebooks as $notebook)
                <tr>
                    <td>{{ $notebook->bookname }}</td>
                    <td>{{ $notebook->summary }}</td>
                    <td>{{ $notebook->tag }}</td>
                    <td>{{ $notebook->username }}</td>
                    <td>{{ $notebook->created_at }}</td>
                    <td>
                        <a href="{{url('notebook/detail',['id' => $notebook->bookid])}}">详情</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('modal-fade')
    <div class="modal fade" id="newBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">新建笔记本</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-newBookModal" method="post" action="{{route('createBook')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputBookName" class="control-label">笔记本名</label>
                            <input id="inputBookName" class="form-control" placeholder="给你的笔记本取个名字吧" required="" autofocus="" type="text" name="bookname">
                        </div>
                        <div class="form-group">
                            <label for="inputBookDescription" class="control-label">描述</label>
                            <textarea id="inputBookDescription" class="form-control" placeholder="用几句话描述一下你的笔记本吧" required="" type="text" name="summary"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputBookTag" class="control-label">标签</label>
                            <input id="inputBookTag" class="form-control" placeholder="设置一个便于搜索的标签吧" required="" autofocus="" type="text" name="tag">
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="authority" id="optionsRadios1" value="公开" checked>公开
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="authority" id="optionsRadios2" value="好友可见">好友可见
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="authority" id="optionsRadios3" value="私密">私密
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">发布</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop