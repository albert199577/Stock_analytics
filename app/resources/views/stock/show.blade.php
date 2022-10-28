@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/techan.css') }}">
@section('title', '個股資訊')

@section('content')

<div class="container mx-auto p-o text-center flex flex-col justify-center">
	<div class="flex flex-row justify-around">
		<div class="text-lg m-4 text-sky-600">{{ $stockInfo['stock_name'] }}</div>
		<div class="text-lg m-4">{{ $stockInfo['date'] }}</div>
		<div class="text-lg m-4">{{ $stockInfo['stock_id'] }}</div>
		<div class="text-lg m-4">{{ $stockInfo['industry_category'] }}</div>
	</div>
	<div class="chart mx-auto">
	</div>
</div>
<x-techan>

</x-techan>
@endsection