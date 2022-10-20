@extends('layouts.app')

@section('title', '搜尋結果')

@section('content')
<div class="container m-4">
	<div class="row justify-content-center">
		<div class="col-6">
			<ul class="list-group">
			@foreach ($stocks as $stock)
				<a href="{{ route('stock.show', ['stock' => $stock]) }}"><li class="list-group-item text-center m-1">{{ $stock }}</li></a>
			@endforeach
			</ul>
		</div>
	</div>
</div>

@endsection