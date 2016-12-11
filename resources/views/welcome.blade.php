@extends('layouts.master')


@section('wrapper')
<div id="home" class="content">
  <div class="container">
    <div class="center">
      <h1 class="title">Lazytime</h1>
      <div class="desc">
        When you're too lazy to do it now, but need to remember later.
      </div>
      <div class="row">
        <a href="/register" class="btn btn-primary">Register</a>
          <a href="/login" class="btn btn-info">Login</a>
      </div>
    </div>
  </div>
</div>
@endsection
