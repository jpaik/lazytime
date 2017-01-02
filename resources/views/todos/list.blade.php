<div class="panel panel-default todolist init" data-id="{{$list->id}}">
  <div class="panel-heading">
    <h2 class="text-center">
      <span data-toggle="tooltip" title="{{$list->description}}" class="title">{{$list->name}}</span>
    </h2>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-12">
        {{ Form::open(['route'=> 'createTask', 'data-id'=>$list->id, 'class'=>'todolist_form'])}}
        <span class="input">
          {{ Form::text('description', null, ['class'=>'input__field', 'id'=>'new_task--'.$list->id, 'data-list-id'=> $list->id, 'placeholder'=>"Add task...", 'autocomplete'=>'off']) }}
          <label class="input__label" for="new_task--{{$list->id}}">
            <span class="input__label-content">Add a new task</span>
          </label>
        </span>
        {{ Form::close() }}
      </div>
    </div>
    <div class="row tasks_row">
      @foreach ($tasks[$list->id] as $task)
        @include('todos.task', ['tasks' => $task])
      @endforeach
    </div>
  </div>
</div>
