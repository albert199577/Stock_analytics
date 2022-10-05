@extends('layouts.app')

@section('title', '個股資訊')

@section('content')

<div class="container m-4 p-0 text-center">
	<div class="row">
		<div class="col">{{ $stockInfo['stock_name'] }}</div>
		<div class="col">{{ $stockInfo['date'] }}</div>
		<div class="col">{{ $stockInfo['stock_id'] }}</div>
		<div class="col">{{ $stockInfo['industry_category'] }}</div>
	</div>
</div>

<x-techan>

</x-techan>
@endsection