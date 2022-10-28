@extends('layouts.app')

@section('title', '搜尋飆股')

@section('content')

<div class="container mx-auto">
	<h1 class="text-center m-3 text-3xl">搜尋條件</h1>
	<form class="flex flex-col" action="{{ route('stock.search') }}" method="POST">
		@csrf
		<ul>
			<li class="border m-3 px-4 py-3">
				<span>
					收盤價大於近
					<input type="text" class="w-16 border rounded-md text-center" id="close_day_price" name="close_day_price">
					日平均
				</span>
			</li>
			<li class="border m-3 px-4 py-3">
				<span>
					近
					<input type="text" class="w-16 border rounded-md text-center" id="weekend" name="gain[weekend]">
					週漲幅平均大於
					<input type="text" class="w-16 border rounded-md text-center" id="percent" name="gain[precent]">
					％
				</span>
			</li>
			<li class="border m-3 px-4 py-3">
				<span>
					收盤價大於
					<input type="text" class="w-16 border rounded-md text-center" id="price_greater" name="price_greater">
					元
				</span>
			</li>
			<li class="border m-3 px-4 py-3">
				<span>
					交易量近
					<input type="text" class="w-16 border rounded-md text-center" id="trading_day" name="trading[day]">
					日合計大於
					<input type="text" class="w-16 border rounded-md text-center" id="trading_volume" name="trading[volume]">
					張
				</span>
			</li>
			<li class="border m-3 px-4 py-3">
				<span>
					橫盤整理漲跌幅不超過
					<input type="text" class="w-16 border rounded-md text-center" id="sideway_percent" name="sideway[percent]">
					％ 合計大於
					<input type="text" class="w-16 border rounded-md text-center" id="sideway_weekend" name="sideway[weekend]]">
					週
				</span>
			</li>
			<li class="border m-3 px-4 py-3">
				均線多頭排列
				<p>
					短均線=<input type="text" class="w-16 border rounded-md text-center" id="s_ma" name="bull[s_ma]">
				</p>
				<p>
					中均線=<input type="text" class="w-16 border rounded-md text-center" id="m_ma" name="bull[m_ma]">
				</p>
				<p>
					長均線=<input type="text" class="w-16 border rounded-md text-center" id="l_ma" name="bull[l_ma]">
				</p>
			</li>
			<li class="border m-3 px-4 py-3">
				<span>
					收盤價
					<input type="text" class="w-16 border rounded-md text-center" id="close_price" name="bull[close_price]">
					日MA向上
				</span>
			</li>
		</ul>
		{{-- <input type="button" value="Search" class="btn btn-primary inline-block"> --}}
		<button class="border rounded-lg bg-blue-300 w-25 mx-auto p-3 my-3 text-white">submit</button>
	</form>
</div>

@endsection