@extends('selfcenter/selfcenter')
@section('subtitle')
    回收站
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/mypage.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">回收站--笔记</p></div>
            <div class="col-md-offset-8">
                <a href="{{url('recycle/note/restore')}}" onclick="if (confirm('确定恢复所有笔记吗？') == false) return false;"
                   class="btn btn-md btn-info">全部恢复</a>
                <a href="{{url('recycle/note/completely')}}" onclick="if (confirm('确定清空回收站吗？') == false) return false;"
                   class="btn btn-md btn-warning" data-toggle="modal">清空回收站</a>
            </div>
        </div>
        <hr/>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>内容</th>
                <th>所属笔记本</th>
                <th>删除时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
                <tr>
                    <td style="white-space:nowrap; overflow:hidden; text-overflow: ellipsis; width: 60%">
                        {{ $note->content }}</td>
                    <td>{{ $note->bookid }}</td>
                    <td>{{ $note->deleted_at }}</td>
                    <td>
                        <a href="{{url('recycle/note/restore', ['id' => $note->noteid])}}"
                           onclick="if (confirm('确定恢复该笔记吗？') == false) return false;">恢复</a>
                        <a href="{{url('recycle/note/completely', ['id' => $note->noteid])}}"
                           onclick="if (confirm('确定永久删除该笔记吗？') == false) return false;">彻底删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop