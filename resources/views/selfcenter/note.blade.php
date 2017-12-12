@extends('selfcenter/selfcenter')
@section('subtitle')
    笔记列表
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/notebook.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">
                    {{$notebook->bookname}}
                    @if(Auth::user()->id==$notebook->userid)
                        <a href="{{ url('notebook/delete', ['id' => $notebook->bookid]) }}"
                            onclick="if (confirm('确定要删除吗？') == false) return false;" style="font-size: 15px;">删除</a>
                    @endif
                </p>
            </div>
            <div class="col-md-offset-8">
                <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#newNoteModal">新的笔记</a>
                &nbsp;&nbsp;
                <a href="{{route('notebook') }}" class="btn btn-lg">返回</a>
            </div>
        </div>
        <br/>
        <div><p style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $notebook->summary }}</p></div>
        <div class="col-md-offset-6"><p style=";font-size: 15px; ">建立时间：{{ $notebook->created_at }}</p></div>
        <hr/>
        <table class="table table-hover table-striped" style="table-layout:fixed">
            @foreach($notes as $note)
                <tr>
                    <td style="white-space:nowrap; overflow:hidden; text-overflow: ellipsis; width: 60%">
                        {{ $note->content }}</td>
                    <td>{{ $note->updated_at }}</td>
                    <td>
                        <a href="{{ url('note/detail', ['id' => $note->noteid]) }}">查看</a>
                        <a href="{{ url('note/delete', ['id' => $note->noteid]) }}"
                           onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop
@section('modal-fade')
    <div class="modal fade" id="newNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">新建笔记</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-newBookModal" method="post" action="{{route('createNote')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" class="hidden" name="bookid" value="{{$notebook->bookid}}"/>
                        <div class="form-group">
                            <label for="inputBookDescription" class="control-label sr-only">笔记内容</label>
                            <textarea id="inputBookDescription" class="form-control" rows="8" placeholder="记录此刻的所思所想"
                                      required="" type="text" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">上传附件</label>
                            <input type="file" id="inputFile" name="file">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">发布</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop