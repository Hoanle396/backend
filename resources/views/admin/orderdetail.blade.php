@extends('admin_layout')
@section('layout')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Đơn Hàng</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php $total = 0; ?>
                    @foreach($order as $id => $details)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$details->product_name}}</h6>
                            <small class="text-muted">số lượng: {{$details->product_quantity}}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-5 order-md-1">
                <form class="needs-validation" action="{{route('order.update',['order' => $user->order_code])}}" method="post">
                    {{csrf_field()}}
                    @method('put')
                    <div class="mb-3">
                        <label for="username">Code</label>
                        <input type="text" class="form-control" name="code" value="{{$user->order_code}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="username">Họ Và Tên</label>
                        <input type="text" class="form-control" name="fullname" value="{{$user->user_fullname}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->user_email}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="address">Địa Chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$user->user_address}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="address2">Hình Thức Thanh Toán </label>
                        <input type="text" class="form-control" id="address2" name="address2" value="{{$user->order_pay}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="address"> Số Điện Thoại</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{$user->user_phonenumber}}" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for=""> Trạng Thái</label>
                        <select name="status" class="form-control" id="">
                            <option value="{{$user->order_status}}" selected>{{$user->order_status}}</option>
                            <option value="Chờ Xử Lý">Chờ Xử Lý</option>
                            <option value="Đã Xác Nhận/ Đang Giao">Xác Nhận/ Đang Giao</option>
                            <option value="Hoàn Thành">Hoàn Thành</option>
                        </select>
                    </div>
                    <hr class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="save" value="save">Lưu Trạng Thái</button>
                        </div>
                        <div class="col-md-6">
                            <button id="click" type="button" class="btn btn-primary btn-lg btn-block">Hủy Đơn Hàng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="modal fade" id="huydon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lý do hủy đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('order.update',['order' => $user->order_code])}}" method="post">
                    {{csrf_field()}}
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group ">
                            <input type="hidden" name="email" value="{{$user->user_email}}" readonly required>
                            <input type="hidden" name="code" value="{{$user->order_code}}" readonly required>
                            <div class="col-12">
                                <textarea class="form-control input-lg m-bot15" id="description" name="description" style=" resize: none;" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer single-input-item">
                        <a class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                        <button class="check-btn sqr-btn" type="submit" name="huy" value="save">Xác Nhận Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        CKEDITOR.replace('description');
    </script>
    <script>
        $('#click').click(function() {
            $('#huydon').modal('show')
        })
    </script>
    @endsection
