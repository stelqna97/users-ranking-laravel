@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
                
            </div>
            <div class="card">
                <div class="card-header">{{ __('Invite a friend to register by entering his e-mail address') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('store.invite') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email_invite" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Invite') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="cart">
                    <div class="card-header">{{ __('User Ranking') }}</div>
                <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Score</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($scoreusers as $scoreuser)
                      <tr>
                        <th scope="row">{{$scoreuser->id}}</th>
                        <td>{{$scoreuser->users->email}}</td>
                        <td>{{$scoreuser->score}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
