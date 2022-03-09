@extends('admin_layout')
@section('layout')
<section id="main-content">
	<section class="wrapper">
		<div class="container-fluid">
			<div class="market-updates">
				<div class="col-md-3 market-update-gd">
					<div class="market-update-block clr-block-3">
						<div class="col-md-4 market-update-right">
							<i class="fa fa-eye"> </i>
						</div>
						<div class="col-md-8 market-update-left">
							<h4>Services</h4>
							<h3>{{$total['totalservice']}}</h3>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-3 market-update-gd">
					<div class="market-update-block clr-block-3">
						<div class="col-md-4 market-update-right">
							<i class="fa fa-users"></i>
						</div>
						<div class="col-md-8 market-update-left">
							<h4>Users</h4>
							<h3>{{$total['totaluser']}}</h3>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-3 market-update-gd">
					<div class="market-update-block clr-block-3">
						<div class="col-md-4 market-update-right">
							<i class="fa fa-usd"></i>
						</div>
						<div class="col-md-8 market-update-left">
							<h4>Products</h4>
							<h3>{{$total['totalproduct']}}</h3>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-3 market-update-gd">
					<div class="market-update-block clr-block-3">
						<div class="col-md-4 market-update-right">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</div>
						<div class="col-md-8 market-update-left">
							<h4>Orders</h4>
							<h3>{{$total['totalorder']}}</h3>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="row">
				<style type="text/css">
					table.table.table-bordered.table-light {
						background: #feffff;
					}

					table.table.table-bordered.table-light tr th {
						color: #111111;
					}

					table.table-light tr td {
						color: #111 ;
					}
				</style>
				<p class="title_thongke">Thống kê</p>
				<div class="col-md-12">
					<table class="table table-bordered table-light">
						<thead>
							<tr>
								<th scope="col">Tổng Số Khách Hàng</th>
								<th scope="col">Tổng Số Đơn Hàng</th>
								<th scope="col">Tổng Số Sản Phẩm</th>
								<th scope="col">Tổng Lượt Đăng Kí Dịch Vụ</th>
								<th scope="col">Tổng Lượt Phản Hồi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$total['totaluser']}}</td>
								<td>{{$total['totalorder']}}</td>
								<td>{{$total['totalproduct']}}</td>
								<td>{{$total['totalservice']}}</td>
								<td>{{$total['totalfeedback']}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<style type="text/css">
				p.title_thongke {
					text-align: center;
					font-size: 20px;
					font-weight: bold;
				}
			</style>
			<div class="table-agile-info">
				<div class="panel panel-default">
					<div class="panel-heading">
						Đơn Hàng Mới
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light">
							<thead>
								<tr>
									<th scope="col">Mã đơn hàng</th>
									<th scope="col">Code thanh toán</th>
									<th scope="col">Tên sản phẩm</th>
									<th scope="col">Số lượng</th>
									<th scope="col">Tên Khách Hàng</th>
									<th scope="col">Thanh toán</th>
									<th scope="col">Trạng Thái</th>
								</tr>
							</thead>
							<tbody>
								@foreach($order as $id => $o)
								<tr>
									<td>{{$o->id}}</td>
									<td>{{$o->order_code}}</td>
									<td>{{$o->product_name}}</td>
									<td>{{$o->product_quantity}}</td>
									<td>{{$o->user_fullname}}</td>
									<td>{{$o->order_pay}}</td>
									<td>{{$o->order_status}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<footer class="panel-footer">
						<div class="row">
							{{$order->links()}}
						</div>
					</footer>
				</div>
			</div>
			<div class="table-agile-info">
				<div class="panel panel-default">
					<div class="panel-heading">
					Phản Hồi Từ Khách Hàng
					</div>
					<div class="table-responsive">
						<table class="table table-striped b-t b-light">
							<thead>
								<tr>
								<th scope="col">Họ</th>
								<th scope="col">Tên</th>
								<th scope="col">Email</th>
								<th scope="col">Số Điện Thoại</th>
								<th scope="col" colspan="2">Nội Dung</th>
								</tr>
							</thead>
							<tbody>
							@foreach($feedback as $id => $a)
							<tr>
								<td>{{$a->firstname}}</td>
								<td>{{$a->lastname}}</td>
								<td>{{$a->email}}</td>
								<td>{{$a->phonenumber}}</td>
								<td>{{$a->message}}</td>
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
		</div>
	</section>
	@endsection
