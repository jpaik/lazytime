<div class="col-xs-12 task {{$task->state == 1 ? 'checked' : ''}}" data-id="{{$task->id}}" data-list-id="{{$list->id}}">
  <input id="task_{{$list->id}}_{{$task->id}}" {{$task->state == 1 ? 'checked' : ''}} type="checkbox" /> <span> <label for="task_{{$list->id}}_{{$task->id}}">{{$task->description}}</label></span>
  {{Form::token()}}
</div>
