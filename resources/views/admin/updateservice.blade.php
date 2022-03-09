@extends('admin_layout')
@section('layout')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12 text-center">
            </div>
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Lên Lịch Hẹn
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class=" form">
                            <form class="cmxform form-horizontal " action="{{route('service.update',$service->id)}}" method="post" enctype="multipart/form-data" validate>
                                @method('put')
                                @csrf
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-3">Tên Khách Hàng</label>
                                    <div class="col-lg-6">
                                        <input class="input-lg m-bot15 form-control" name="fullname" minlength="2" type="text" value="{{$service->fullname}}" required="" readonly>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-3">Email Khách Hàng</label>
                                    <div class="col-lg-6">
                                        <input class="input-lg m-bot15 form-control" name="email" minlength="2" type="text" value="{{$service->email}}" required="" readonly>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-3">Giờ</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" type="time" name="time"  required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="curl" class="control-label col-lg-3">Ngày</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" type="date" name="date" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="ccomment" class="control-label col-lg-3">Ghi Chú</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control input-lg m-bot15"  name="description" style=" resize: none;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit">Gửi</button>
                                        <button class="btn btn-default" type="button">Cancel</button>
                                       </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
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

    @section('js')
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="/js/config.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('product_description');
    </script>
    @endsection
