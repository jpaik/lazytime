$(function(){

  //Input effect
  $('.input .input__field').on('change blur', function(){
    if($(this).val() == ""){
      $(this).parent().removeClass('input--filled');
    }else{
        $(this).parent().addClass('input--filled');
    }
  });
  $('.input .input__field').trigger('change');

});
