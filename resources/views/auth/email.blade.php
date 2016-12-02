@extends('auth.auth')
@section('title', 'Confirm Email | ')
@section('content')
  @include('common.status')
  <h2>Welcome to Lazytime</h2>
  <p>
    Please confirm your email first!
  </p>
  <p>
    Your email address is: {{$user->email}}
    <br />
    <br />
    <a href="{{route('send_verification_code')}}" class="btn btn-primary">Resend Verification Code</a>
  </p>
@endsection
