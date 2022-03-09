@extends('admin_layout')
@section('layout')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Sửa Sản Phẩm
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class=" form">
                            <form class="cmxform form-horizontal " action="{{route('product.update',['product' => $product->product_id])}}" method="post" enctype="multipart/form-data" validate>
                                @method('PUT')
                                @csrf
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-3">Mã Sản Phẩm</label>
                                    <div class="col-lg-6">
                                        <input class="input-lg m-bot15 form-control" name="product_id" minlength="2" type="text" value="{{$product->product_id}}" required="" readonly>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-3">Tên Sản Phẩm</label>
                                    <div class="col-lg-6">
                                        <input class="input-lg m-bot15 form-control" name="product_name" minlength="2" type="text" value="{{$product->product_name}}" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-3">Giá</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" type="number" min="1" name="product_price" value="{{$product->product_price}}" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="curl" class="control-label col-lg-3">Xuất Xứ</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" type="text" name="product_origin" value="{{$product->product_origin}}" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-3">Hãng Sản Xuất</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" type="text" name="product_manufacturer" value="{{$product->product_manufacturer}}" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="curl" class="control-label col-lg-3">Số Lượng</label>
                                    <div class="col-lg-6">
                                        <input class="form-control input-lg m-bot15" type="number" min="1" name="product_discount" value="{{$product->product_discount}}" required="">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="ccomment" class="control-label col-lg-3">Mô Tả</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control input-lg m-bot15" id="product_description" name="product_description" style=" resize: none;" required="">{{$product->product_description}}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputFile" class="control-label col-lg-3">Hình Ảnh</label>
                                    <div class="col-lg-6">
                                        <input type="file" id="exampleInputFile" name="product_image" accept="image/*" required="">
                                    </div>
                                </div> -->
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
