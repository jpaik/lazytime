<div class="panel panel-default todolist" data-id="{{$list_num}}">
  <div class="panel-heading">
    <h2 class="text-center">
      {{--$list->name--}} <span class="title">Todo List {{$list_num}}</span>
    </h2>
  </div>
  <div class="panel-body">
    <div class="row">
      @for ($i = 1; $i < rand(6,10); $i++)
        @include('todos.task', ['task_num' => $i])
      @endfor
    </div>
  </div>
</div>
