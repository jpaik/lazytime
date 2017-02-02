$(function() {

  //Input effect
  $('.input .input__field').on('change blur', function() {
    if ($(this).val() == "") {
      $(this).parent().removeClass('input--filled');
    } else {
      $(this).parent().addClass('input--filled');
    }
  });
  $('.input .input__field').trigger('change');

  /*
  ========================================================
  Todo List functions
  ========================================================
  */
  /*Button click for new todo list*/
  $('#new-todolist').on('click', function() {
    swal({
      title: 'Create a new todo list',
      html: getHTMLTodoList(),
      showCancelButton: true,
      confirmButtonText: 'Create',
      confirmButtonColor: '#514a9d',
      showLoaderOnConfirm: true,
      customClass: 'createTodoSwal',
      preConfirm: function() {
        return new Promise(function(resolve, reject) {
          if ($('#new-todolist-name').val() == "") {
            reject('Please enter a name');
          } else {
            resolve([
              $('#new-todolist-name').val(),
              $('#new-todolist-description').val()
            ]);
          }
        })
      },
      allowOutsideClick: false
    }).then(function(result) {
      $.ajax({
        url: "/list",
        type: 'POST',
        data: {
          name: result[0],
          position: 0,
          description: result[1],
          _token: $('#default_task_form input[name="_token"]').val()
        },
        success: function(data) {
          console.log(data);
          createTodoList(data);
        }
      });
    }).catch(swal.noop);
  });

  /*Create default task*/
  $('#default_task_form').submit(function(e) {
    e.preventDefault();
    if ($("#quick-task__input").val() === "") {
      alert("Please write something");
      return;
    } else {
      var task = $("#quick-task__input").val();
      var listId = parseInt($("#quick-task__input").attr('data-list-id'));
      var token = $('#default_task_form input[name="_token"]').val();
      $.ajax({
        url: "/task",
        type: 'POST',
        data: {
          description: task,
          position: 0,
          list_id: listId,
          _token: token
        },
        success: function(data) {
          $("#quick-task__input").val('');
          $('.todolist[data-id="' + data.list_id + '"] .panel-body > .tasks_row').append(getHTMLtask(data));
          $('.todolist-row').trigger('refresh');
        }
      });
    }
  });

  /*Create List Task*/
  $('.todolist-row').on('submit', '.todolist_form', function(e) {
    e.preventDefault();
    var listId = parseInt($(this).attr('data-id'));
    if ($('#new_task--' + listId).val() === "") {
      alert("Please write something");
      return;
    } else {
      var task = $('#new_task--' + listId).val();
      var token = $('#default_task_form input[name="_token"]').val();
      $.ajax({
        url: "/task",
        type: 'POST',
        data: {
          description: task,
          position: 0,
          list_id: listId,
          _token: token
        },
        success: function(data) {
          $('#new_task--' + listId).val('');
          $('.todolist[data-id="' + data.list_id + '"] .panel-body > .tasks_row').append(getHTMLtask(data));
          $('.todolist-row').trigger('refresh');
        }
      });
    }
  });

  /*Check or Uncheck Task*/
  $('.todolist-row').on('change','.todolist .task input[type="checkbox"]', function() {
    var taskId = parseInt($(this).parent().attr('data-id'));
    var token = $('#default_task_form input[name="_token"]').val();
    var state = $(this).is(':checked') ? 1 : 0;
    $.ajax({
      url: "/task/update",
      type: 'POST',
      data: {
        id: taskId,
        state: state,
        _token: token
      },
      success: function(data) {
        if (data.state == 0) {
          var task = $('.task[data-id="' + data.id + '"]').detach();
          $('.todolist[data-id="' + data.list_id + '"] .panel-body > .tasks_row .task:not(".checked")').last().after($(task).removeClass('checked'));
        } else if (data.state == 1) {
          $('.todolist[data-id="' + data.list_id + '"] .panel-body > .tasks_row .task:not(".checked")').last().after($('.task[data-id="' + data.id + '"]').addClass('checked'));
        }
      }
    });
  });

});

function getHTMLtask(data) {
  return `
  <div class="col-xs-12 task" data-id="` + data.id + `" data-list-id="` + data.list_id + `">
    <input id="task_` + data.list_id + `_` + data.id + `" class="" type="checkbox" /> <span> <label for="task_` + data.list_id + `_` + data.id + `">` + data.description + `</label></span>
  </div>
  `;
}

function createTodoList(data) {
  var html = `
  <div class="panel panel-default todolist" data-id="${data.id}" style="position:absolute;">
    <div class="panel-heading">
      <h2 class="text-center">
        <span data-toggle="tooltip" title="${data.description}" class="title">${data.name}</span>
      </h2>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-12">
        <form method="POST" action="/task" accept-charset="UTF-8" data-id="${data.id}" class="todolist_form">
          <span class="input">
            <input class="input__field" id="new_task--${data.id}" data-list-id="${data.id}" placeholder="Add task..." autocomplete="off" name="description" type="text">
            <label class="input__label" for="new_task--${data.id}">
              <span class="input__label-content">Add a new task</span>
            </label>
          </span>
        </form>
        </div>
      </div>
      <div class="row tasks_row">
      </div>
    </div>
  </div>
  `;

  $('.todolist-row').append(html);
  $('.todolist[data-id="'+data.id+'"]').draggable({
    handle: '.panel-heading',
    containment: '#dashboard',
    cursor: 'grabbing',
    cancel: 'input'
  })
  $('.todolist-row').packery('appended', $('.todolist[data-id="'+data.id+'"]'));
  $('.todolist-row').packery('bindUIDraggableEvents', $('.todolist[data-id="'+data.id+'"]'));
  $('.todolist-row').trigger('refresh');
}

function deleteTodoList(data) {

}



// get JSON-friendly data for items positions
Packery.prototype.getShiftPositions = function(attrName) {
  attrName = attrName || 'id';
  var _this = this;
  return this.items.map(function(item) {
    return {
      attr: item.element.getAttribute(attrName),
      x: item.rect.x / _this.packer.width
    }
  });
};

Packery.prototype.initShiftLayout = function(positions, cls, attr) {
  if (!positions) {
    // if no initial positions, run packery layout
    this.layout();
    return;
  }
  // parse string to JSON
  if (typeof positions == 'string') {
    try {
      positions = JSON.parse(positions);
    } catch (error) {
      console.error('JSON parse error: ' + error);
      this.layout();
      return;
    }
  }

  attr = attr || 'id'; // default to id attribute
  this._resetLayout();
  // set item order and horizontal position from saved positions
  this.items = positions.map(function(itemPosition) {
    var selector = '.' + cls + '[' + attr + '="' + itemPosition.attr + '"]'
    var itemElem = this.element.querySelector(selector);
    var item = this.getItem(itemElem);
    if(item){
      item.rect.x = itemPosition.x * this.packer.width;
      return item;
    }
  }, this);
  // filter out any items that no longer exist
  this.items = this.items.filter(function(item) {
    return item !== undefined;
  });
  // add new items
  var newitems = [];
  var p = this;
  $(this.$element[0]).find(this.options.itemSelector).each(function(i, e) {
    if (!p.getItem(e)) {
      newitems.push(e);
    }
  });
  this.addItems(newitems);

  this.shiftLayout();
};
