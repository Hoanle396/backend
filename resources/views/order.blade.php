<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Checkout example · Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

    <!-- Bootstrap core CSS -->
{{--    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <style>
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Thông Tin Đơn Hàng</h2>
            <p class="lead">Dưới đây là chi tiết đơn hàng của bạn cảm ơn bạn đã tin tưởng chúng tôi</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="d-flex justify-content-center align-items-center mb-3">
                    <span class="text-muted">Trạng thái đơn hàng</span>
                </h4>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h5 class="my-0">Code đơn hàng: {{$code}}</h5>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Chi tiết đơn hàng</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($order as $id => $details)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$details->product_name}}</h6>
                        </div>
                        <span class="ml-3 text-muted">sl: {{$details->product_quantity}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 order-mb-2">
                <div class="mt-3">
                    <h5 class="my-0 mb-3">Trạng thái: <span class="text-danger bg-info">{{$status}}</span> </h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 text-muted">Ghi chú: <?= $reson?> </div>
        </div>
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2021</p>
        </footer>
    </div>
    <script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
</body>

</html>
