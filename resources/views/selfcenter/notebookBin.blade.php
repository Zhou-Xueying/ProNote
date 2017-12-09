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
            <div class="col-md-6"><p class="title-page">回收站--笔记本</p></div>
            <div class="col-md-offset-8">
                <a href="{{url('recycle/book/restore')}}" onclick="if (confirm('确定恢复所有笔记本吗？') == false) return false;"
                   class="btn btn-md btn-info">全部恢复</a>
            <a href="{{url('recycle/book/completely')}}" onclick="if (confirm('确定清空回收站吗？') == false) return false;"
               class="btn btn-md btn-warning" data-toggle="modal">清空回收站</a>
            </div>
        </div>
        <hr/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>标题</th>
                <th>简介</th>
                <th>删除时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notebooks as $notebook)
                <tr>
                    <td>{{ $notebook->bookname }}</td>
                    <td>{{ $notebook->summary }}</td>
                    <td>{{ $notebook->deleted_at }}</td>
                    <td>
                        <a href="{{url('recycle/book/restore', ['id' => $notebook->bookid])}}"
                           onclick="if (confirm('要恢复该笔记本吗？') == false) return false;">恢复</a>
                        <a href="{{url('recycle/book/completely', ['id' => $notebook->bookid])}}"
                           onclick="if (confirm('一旦彻底删除该笔记本，该笔记本所属的所有笔记都将被永久删除。') == false) return false;">彻底删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop