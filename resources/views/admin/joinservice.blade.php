@extends('admin_layout')
@section('layout')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
        </div>
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tất Cả Lịch Hẹn
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Khách Hàng</th>
                                <th scope="col">Email Khách Hàng</th>
                                <th scope="col">Giờ</th>
                                <th scope="col">Ngày</th>
                                <th scope="col">Ghi Chú</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($service as $id => $a)
                            <tr>
                                <td>{{$a->id}}</td>
                                <td>{{$a->service_fullname}}</td>
                                <td>{{$a->service_email}}</td>
                                <td>{{$a->time}}</td>
                                <td>{{$a->date}}</td>
                                <td><?=$a->description ?></td>
                                <td>
                                    <a type="button" onclick="return confirm('Bạn Có Chắc Chắn Là Đã Hoàn Thành lịch Hẹn Chứ')" href="{{route('meet.edit',$a->id)}}" class="btn btn-success"><i class="fa fa-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        {{$service->links()}}
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
