@extends('admin_layout')
@section('layout')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
        </div>
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tất Cả Tin Tức
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tiêu Đề</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Ngày Tạo</th>
                                <th scope="col">Cập Nhật</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $id => $a)
                            <tr>
                                <td>{{$a->id}}</td>
                                <td style="max-width: 300px;">{{$a->title}}</td>
                                <td><img src="{{$a->image}}" width="50" height="50" alt=""></td>
                                <td>{{$a->created_at}}</td>
                                <td>{{$a->updated_at}}</td>
                                <td>
                                    <form method="post" action="{{route('news.destroy',$a->id)}}">
                                        @method('delete')
                                        @csrf
                                        <a  href="{{ route('news.edit', ['news' => $a->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>|
                                        <button type="submit" onclick="return confirm('Bạn Có Chắc Muốn Xóa Chứ Hành Động Không Thể Phục Hồi')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        {{$news->links()}}
                    </div>
                </footer>
            </div>
        </div>
    </section>
    @if(Session::get('message'))
    <script>
        $(document).ready(function() {
            $('#global-modal').modal('show');
        });
    </script>
    @endif
    <div id="global-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body">
                    <p><span class="text-primary">{{Session::get('message')}}</span> </p>
                    <?php

                    use Illuminate\Support\Facades\Session;

                    Session::put("message", null); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>
    @endsection
