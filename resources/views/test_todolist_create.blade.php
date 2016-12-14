@extends('layouts.master')

@section('title', 'Cosinic | ')

@section('wrapper')
@include('common.status')
{{ Form::open(['route'=> 'createList'])}}
  <div class="row">
    <div class="col-xs-12">
      <span class="input">
        {{ Form::text('name', null, ['class'=>'input__field', 'id'=>'name']) }}
        <label class="input__label" for="name">
          <span class="input__label-content">Name</span>
        </label>
      </span>
    </div>
    <div class="col-xs-12">
      <span class="input">
        {{ Form::text('description', null, ['class'=>'input__field', 'id'=>'description']) }}
        <label class="input__label" for="description">
          <span class="input__label-content">Description</span>
        </label>
      </span>
    </div>
  </div>
  {{ Form::hidden('position', 0, ['class' => 'todolist_position']) }}
  <div class="text-center">
    {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
  </div>
{{ Form::close() }}
@endsection
