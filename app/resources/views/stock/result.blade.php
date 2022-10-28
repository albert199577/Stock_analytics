@extends('layouts.app')

@section('title', '搜尋結果')

@section('content')
<div class="container mx-auto">
	<h3 class="text-center text-xl">搜尋結果</h3>

	<div class="flex flex-row justify-center">
		<ul class="flex flex-col w-4/6">
		@foreach ($stocks as $stock)
			<li class="border-blue-300 border text-blue-400 text-lg rounded p-4 m-2 border-solid">
				<a href="{{ route('stock.show', ['stock' => $stock['stock_id']]) }}" class="grid grid-cols-3 gap-4 text-center">
					<span>
						{{ $stock['stock_id'] }}
					</span>
					<span>
						{{ $stock['stock_name'] }}
					</span>
					<span>
						{{ $stock['industry_category'] }}
					</span>
				</a>
			</li>
		@endforeach
		</ul>
	</div>
</div>

@endsection