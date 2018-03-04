$(function(){
  //seletor(classe), evento(click), callback(function), ação{comandos}
  //$('.j_edit').click(function(){});
  $('.j_formsubmit').submit(function(){
    var form = $(this);
    var data = $(this).serialize();
    
    $.ajax({
      url:'ajax/ajax.php',
      data: data,
      type: 'POST',
      dataType: 'json',
      beforeSend: function(){
        form.find('.form_load').fadeIn(500);
        form.find('.trigger').fadeOut(500, function(){
          $(this).remove;
        });
      },
      success: function(resposta){
        console.clear();
        console.log(resposta);
        
        if(resposta.error){
          form.find('.trigger-box').html('<div class="trigger trigger-error">'+resposta.error+'</div>');
          form.find('.trigger-error').fadeIn();
        }else{
          form.find('.trigger-box').html('<div class="trigger trigger-success">'+resposta.success+'</div>');
          form.find('.trigger-success').fadeIn();
        }
        
        form.find('.form_load').fadeOut(500);
      }
    });
    
    return false;
    
  });
});