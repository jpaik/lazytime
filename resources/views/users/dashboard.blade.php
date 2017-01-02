@extends('layouts.master')

@section('wrapper')
<div id="dashboard" class="content">
  <div class="container">
    <div class"row">
      <div class="col-xs-12 col-xs-offset-0 col-md-6 col-md-offset-3">
        <div class="col-xs-8">
          {{ Form::open(['route'=> 'createTask', 'id'=>'default_task_form'])}}
          <span id="quick-task" class="input">
            {{ Form::text('description', null, ['class'=>'input__field', 'id'=>'quick-task__input', 'data-list-id'=> $user->default_list_id, 'placeholder'=>"Do this task later..."]) }}
            <label class="input__label" for="quick-task__input">
              <span class="input__label-content">What needs to get done in the future?</span>
            </label>
          </span>
          {{ Form::close() }}
        </div>
        <div class="col-xs-4">
          <button id="new-todolist" class="btn btn-primary">Create Todo List</button>
        </div>
      </div>
    </div>
    <div class="row todolist-row">
      <div class="gutter-sizer"></div>
      <div class="grid-sizer"></div>
      @if(count($todolists) > 0)
        @foreach($todolists as $list)
          @include('todos.list', ['list' => $list])
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection


@section('scripts')
  <script type="text/javascript">
    $(function(){
      var $grid = $('.todolist-row').packery({
        itemSelector: '.todolist',
        gutter: '.gutter-sizer',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        shiftPercentResize:true,
        initLayout: false
      }).on('refresh', function(){
         $grid.packery('shiftLayout');
      });
      var $todolists = $grid.find('.todolist').draggable({
        handle: '.panel-heading',
        containment: '#dashboard',
        cursor: 'grabbing',
        cancel: 'input'
      });
      // get saved dragged positions
      var initPositions = localStorage.getItem('dragPositions');
      // init layout with saved positions
      $grid.packery( 'initShiftLayout', initPositions, 'todolist', 'data-id' );

      $grid.packery('bindUIDraggableEvents', $todolists);
      $grid.on('dragItemPositioned',
        function( event, draggedItem ) {
          //console.log('Packery drag item positioned', draggedItem.element );
          var positions = $grid.packery( 'getShiftPositions', 'data-id' );
          localStorage.setItem( 'dragPositions', JSON.stringify( positions ) );
        }
      );

      $('.todolist').removeClass('init');

    });

    function getHTMLTodoList(){
      return `{{ Form::open(['route'=> 'createList', 'id'=> 'new-todolist-form'])}}
        <div class="row">
          <div class="col-xs-12">
            <span class="input input--filled">
              {{ Form::text('name', null, ['class'=>'input__field', 'id'=>'new-todolist-name']) }}
              <label class="input__label" for="new-todolist-name">
                <span class="input__label-content">Name</span>
              </label>
            </span>
          </div>
          <div class="col-xs-12">
            <span class="input input--filled">
              {{ Form::text('description', null, ['class'=>'input__field', 'id'=>'new-todolist-description']) }}
              <label class="input__label" for="new-todolist-description">
                <span class="input__label-content">Description</span>
              </label>
            </span>
          </div>
        </div>
      {{ Form::close() }}`;
    }
  </script>
@endsection
