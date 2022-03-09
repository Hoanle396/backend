@extends('admin_layout')
@section('layout')
    <section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <header class="panel-heading">
                    Danh Sách Tài Khoản
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                     <table class="table table-striped b-t b-light">
                         <thead>
                             <tr>
                                 <th scope="col">
                                     Chủ Tài Khoản
                                 </th scope="col">
                                 <th scope="col">
                                     Số Tài Khoản
                                 </th>
                                 <th scope="col">
                                     Tên Ngân Hàng
                                 </th>
                                 <th scope="col">
                                     QR code
                                 </th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>
                                  {{$bank->bankauth}}
                                 </td>
                                 <td>
                                     {{$bank->banknumber}}
                                 </td>
                                 <td>
                                     {{$bank->bankname}}
                                 </td>
                                 <td>
                                     <img src="{{$bank->qrcode}}" width="50">
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Sửa Tài Khoản
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class=" form">
                            <form class="cmxform form-horizontal " action="{{URL::to('Admin/Bank')}}" method="post" enctype="multipart/form-data" validate>
                                @csrf
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-3">Tên Ngân Hàng</label>
                                    <div class="col-lg-6">
                                        <input class="input-lg m-bot15 form-control" name="name" minlength="2" type="text" value="{{$bank->bankname}}" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="ccomment" class="control-label col-lg-3">Chủ Tài Khoản</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" name="description" value="{{$bank->bankauth}}" required=""/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="ccomment" class="control-label col-lg-3">Số Tài Khoản</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" name="banknumber" value="{{$bank->banknumber}}" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile" class="control-label col-lg-3">QRcode</label>
                                    <div class="col-lg-6">
                                        <input type="file" id="exampleInputFile" name="image" accept="image/*" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-6">
                                        <button class="btn btn-primary" type="submit">Save</button>
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
                <div class="modal-body ">
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
