@extends('auth.auth')
@section('title', 'Login | ')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h2>Login</h2>
  </div>

  <div class="panel-body">
    @include('common.status')
    {{ Form::open(['route'=> 'handleLogin'])}}
      <div class="row">
        <div class="col-xs-12">
          <span class="input">
            {{ Form::text('email', null, ['class'=>'input__field', 'id'=>'email']) }}
            <label class="input__label" for="email">
              <span class="input__label-content">Email Address</span>
            </label>
          </span>
        </div>
        <div class="col-xs-12">
          <span class="input">
            {{ Form::password('password', ['class'=>'input__field', 'id'=>'password']) }}
            <label class="input__label" for="password">
              <span class="input__label-content">Password</span>
            </label>
          </span>
        </div>
        <div class="col-xs-12">
          {{ Form::checkbox('remember_me', 'true', false, ['id' => 'remember_me']) }}
          {{ Form::label('remember_me', 'Remember Me', ['style'=>'font-weight:300;margin-top:20px;']) }}
        </div>
      </div>
      <div class="text-center">
        {{ Form::submit('Log In', ['class' => 'btn btn-primary']) }}
      </div>
    {{ Form::close() }}
  </div>
</div>
<div class="text-center">
  <a class="inverse" href="/register">Don't have an account? Click here to register!</a>
</div>
@endsection
