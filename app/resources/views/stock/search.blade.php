@extends('layouts.app')

@section('title', '搜尋飆股')

@section('content')

<div class="container">
	<form class="d-flex flex-column" action="{{ route('stock.search') }}" method="POST">
		@csrf
		<div class="form-group">
			<span>
				收盤價大於近
				<input type="text" class="w-25" id="close_day_price" name="close_day_price">
				日平均
			</span>
		</div>
		<div class="form-group">
			<span>
				近
				<input type="text" class="w-25" id="weekend" name="weekend">
				週漲幅平均大於
				<input type="text" class="w-25" id="percent" name="percent">
				％
			</span>
		</div>
		<div class="form-group">
			<span>
				收盤價大於
				<input type="text" class="w-25" id="price_greater" name="price_greater">
				元
			</span>
		</div>
		<div class="form-group">
			<span>
				交易量近
				<input type="text" class="w-25" id="trading_day" name="trading_day">
				日合計大於
				<input type="text" class="w-25" id="trading_volume" name="trading_volume">
				張
			</span>
		</div>
		<div class="form-group">
			均線多頭排列
			<p>
				短均線=<input type="text" class="w-25" id="s_ma" name="s_ma">
			</p>
			<p>
				中均線=<input type="text" class="w-25" id="m_ma" name="m_ma">
			</p>
			<p>
				長均線=<input type="text" class="w-25" id="l_ma" name="l_ma">
			</p>
		</div>
		<div class="form-group">
			<span>
				收盤價
				<input type="text" class="w-25" id="close_price" name="close_price">
				日MA向上
			</span>
		</div>
		{{-- <input type="button" value="Search" class="btn btn-primary inline-block"> --}}
		<button>submit</button>
	</form>
</div>

@endsection