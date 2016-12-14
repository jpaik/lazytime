function postData(route, data){
  $.ajax({
    url: route,
    data: {data},
    success: function(data){
      console.log(data);
    }
  });
}

function updatePosition(route, id, position){
  $.ajax({
    url: route,
    data: {id: id, position: position},
    success: function(data){
      console.log(data);
    }
  });
}
