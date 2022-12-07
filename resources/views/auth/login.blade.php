@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">

        <div class="col-md-6">
            <img width="100%" src="{{ asset('login.jpeg') }}" alt="">

        </div>

        <div class="col-md-6">



                    <form method="POST" action="{{ route('login.perform') }}">
                        @csrf


                        <div class="login-box">
                            <label>{{ __('messages.email') }} : </label>
                            <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="email" autofocus>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <label>{{ __('messages.Password') }} : </label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('messages.Remember') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('messages.Forgot') }}
                            </a> --}}
                        @endif
                        <button type="submit">{{ __('messages.login') }}</button>

                        </div>


                    </form>
                </div>




                <div class="col-md-12 mt-5">
                    <p>

                        {{ __('messages.desc') }}

                    </p>
                </div>




    </div>
</div>
@endsection
