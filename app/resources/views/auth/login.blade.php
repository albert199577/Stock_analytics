@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex flex-row justify-center rounded-xl border-2 border-blue-900 w-2/5 m-auto">
        <div class="h-1/2">
            <div class="text-center m-8">{{ __('登入') }}</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="">
                    <label for="email" class="">{{ __('電子信箱') }}</label>

                    <div class="">
                        <input id="email" type="email" class="border form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('密碼') }}</label>

                    <div class="">
                        <input id="password" type="password" class="border form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="">
                    <div class="offset-md-4">
                        <div class="form-check flex justify-between">
                            <div>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('記住我') }}
                                </label>
                            </div>
                                
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('忘記密碼') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center m-6">
                    <button type="submit" class="btn btn-primary border p-5 rounded-xl">
                        {{ __('登入') }}
                    </button>
                    <button type="button" class="btn btn-primary border p-5 rounded-xl">
                        <a class="btn btn-link" href="{{ route('line.login') }}">
                            {{ __('Line 登入') }}
                        </a>
                    </button>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <a class="btn btn-link" href="{{ route('register') }}">
                            {{ __('沒有帳號嗎？ 註冊一個吧') }}
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
