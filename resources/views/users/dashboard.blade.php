@extends('layouts.master')

@section('wrapper')
<div id="dashboard" class="content">
  <div class="container">
    <div class="row todolist-row">
      <div class="gutter-sizer"></div>
      <div class="grid-sizer"></div>
      @for ($i = 1; $i <= 9; $i++)
        @include('todos.list', ['list_num' => $i])
      @endfor
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
        percentPosition: true
      });
      var $todolists = $grid.find('.todolist').draggable({
        handle: '.panel-heading',
        containment: '#dashboard',
        cursor: 'grabbing',
        cancel: 'input'
      });
      $grid.packery('bindUIDraggableEvents', $todolists);
      $grid.on( 'dragItemPositioned',
        function( event, draggedItem ) {
          console.log('Packery drag item positioned', draggedItem.element );
        }
      );
    });
  </script>
@endsection
