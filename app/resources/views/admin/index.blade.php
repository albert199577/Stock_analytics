@extends('layouts.app')

@section('title', '管理員後台')

@section('content')

<div class="container m-auto">
    <div class="flex flex-col justify-center border text-center">
        <ul class="flex flex-row text-green-700 m-2 my-3">
            <li class="w-1/4">會員名稱</li>
            <li class="w-1/3">會員信箱</li>
            <li class="w-1/4">會員等級</li>
            <li class="w-1/4">管理員</li>
        </ul>
    </div>
    @foreach ($users as $user)
    <div class="flex flex-col justify-center border text-center">
        <ul class="flex flex-row text-green-700 m-2">
            <li class="hidden">{{ $user->id }}</li>
            <li class="w-1/4">{{ $user->name }}</li>
            <li class="w-1/3">{{ $user->email }}</li>
            <li class="w-1/4">{{ $user->identity }}</li>
            <li class="w-1/4">{{ $user->is_admin ? 'yes' : 'no' }}</li>
        </ul>
    </div>
    @endforeach
</div>

@endsection
