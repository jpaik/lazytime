@extends('auth.auth')

@section('title', 'Register | ')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading text-center">
    <h2>Create an account</h2>
  </div>

  <div class="panel-body">
    @include('common.status')
    {{ Form::open(['route' => 'users.store'])}}
    <div class="row">
      <div class="col-xs-6">
        <span class="input">
          {{ Form::text('first_name', null, ['class'=>'input__field', 'id'=>'first_name']) }}
					<label class="input__label" for="first_name">
						<span class="input__label-content">First Name</span>
					</label>
				</span>
      </div>
      <div class="col-xs-6">
        <span class="input">
          {{ Form::text('last_name', null, ['class'=>'input__field', 'id'=>'last_name']) }}
					<label class="input__label" for="last_name">
						<span class="input__label-content">Last Name</span>
					</label>
				</span>
      </div>
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
        <span class="input">
          {{ Form::password('password_confirmation', ['class'=>'input__field', 'id'=>'password_confirmation']) }}
          <label class="input__label" for="password_confirmation">
            <span class="input__label-content">Confirm Password</span>
          </label>
        </span>
      </div>
      <div class="text-center">
        {{ Form::submit('Register', ['class'=>'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
<div class="text-center">
  <a class="inverse" href="/login">Already have an account? Click here to log in.</a>
</div>

@endsection
