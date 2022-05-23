@extends('layouts.layout')

@section('content')
<div class="container p-5" style="height:700px;">
    <div class="row justify-content-center py-5">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header text-center">{{ __('Σύνδεση') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Κωδικός πόσβασης') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Να με θυμάσαι') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                       
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Σύνδεση') }}
                                </button>
                            </div>
                        
                            <div class="text-center">
                            
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Ξέχασες τον Κωδικό σου;') }}
                                    </a>
                                @endif
                            </div>
                        

                        <div>
                            <p  class="text-center">
                                Εάν δεν έχετε λογαριασμό κάν'τε <a class="btn btn-link" href="{{ route('register') }}">Εγγραφή</a>
                            </p>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
