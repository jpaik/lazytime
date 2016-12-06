@extends('layouts.master')

@section('wrapper')
<div id="dashboard" class="content">
  <div class="container">
    <div class="center">
      <h1 class="title">Welcome to Lazytime, {{$user->first_name}}</h1>
      <div class="desc">
        @include('common.status')
        Get ready to be productive, when you feel ready.
      </div>
    </div>
  </div>
</div>
@endsection
