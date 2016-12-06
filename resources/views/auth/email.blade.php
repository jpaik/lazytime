@extends('auth.auth')

@section('title', 'Confirm Email | ')

@section('content')

  <div class="panel panel-default">
    <div class="panel-heading text-center">
      <h2>Welcome to Lazytime</h2>
    </div>
    <div class="panel-body">
      @include('common.status')
      <div class="row">
        <div class="col-xs-12">
          <p>
            Please confirm your email first!
          </p>
          <p>
            Your email address is: {{$user->email}}
            <br />
            <br />
            <a href="{{route('send_verification_code')}}" class="btn btn-primary">Resend Verification Code</a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
