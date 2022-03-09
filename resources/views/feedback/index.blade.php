@extends('admin_layout')
@section('layout')
    <section id="main-content">
        <section class="wrapper">
            <div class="table-agile-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Tất Cả Phản Hồi
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Khách Hàng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số Điện Thoại</th>
                                <th scope="col">Nội Dung</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedback as $id => $a)
                                <tr>
                                    <td>{{$a->id}}</td>
                                    <td>{{$a->firstname.' '.$a->lastname}}</td>
                                    <td>{{$a->email}}</td>
                                    <td>{{$a->phonenumber}}</td>
                                    <td>{{$a->message}}</td>
                                    <td>
                                        <form method="post" action="{{route('feedback.destroy',$a->id)}}">
                                            @method('delete')
                                            @csrf
                                            <a type="button"  href="mailto:{{$a->email}}?subject=Phản Hồi Đánh Giá Của Bạn " class="btn btn-primary"><i class="fa fa-send"></i></a>|
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
                            {{$feedback->links()}}
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
