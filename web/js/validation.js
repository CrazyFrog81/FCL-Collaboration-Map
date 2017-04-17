function validateDropdown(id,step)
{
  $('button[type=submit]').on('click',function(e){
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
        if(!($(id).val())){
          $(id).css('border-color','DarkRed');
          if($(id).next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
          {
            $(id).after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please choose one</span></div>');
          }
          $('html, body').animate({
               scrollTop: $(id).offset().top - 200
           }, 700);
          e.preventDefault();
        }
      }
    }
  });
  $(id).on('input change', function(){
    if($(id).val()){
      $(id).css('border-color','');
      if($(id).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
        $(id).next().remove();
      }
    }
  });
}

function validateMotherTongues(id,step)
{
  $('button[type=submit]').on('click',function(e){
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
        if($(id).attr('title') == null)
        {
          $('.select2-selection').css('border-color','DarkRed');
          if($('.select2').next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
          {
            $('.select2').after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please choose one</span></div>');
          }
          $('html, body').animate({
               scrollTop: $('#background_information_mother_tongues').offset().top - 200
           }, 700);
          e.preventDefault();
        }
      }
    }
  });
  $('#background_information_mother_tongues').on('input change',function(){
    if($(id).attr('title') != null)
    {
      $('.select2-selection').css('border-color','');
      if($('.select2').next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
        $('.select2').next().remove();
      }
    }
  });
}

function validateSelect2(id,step)
{
  $('button[type=submit]').on('click',function(e){
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
        if(!($.isNumeric($('#' + id).val())) && ($('#' + id).val() != 'Other'))                  {
              $('[aria-labelledby="select2-'+ id + '-container"]').css('border-color','DarkRed');
              if($('[aria-labelledby="select2-'+ id + '-container"]').next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
              {
                $('[aria-labelledby="select2-'+ id + '-container"]').after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please choose one</span></div>');
              }
              $('html, body').animate({
                   scrollTop: $('#' + id).offset().top - 200
               }, 700);
              e.preventDefault();
            }
          }
        }
      });
  $('#' + id).on('input change',function(){
    if($('#' + id).val() != null)
    {
      $('[aria-labelledby="select2-'+ id + '-container"]').css('border-color','');
      if($('[aria-labelledby="select2-'+ id + '-container"]').next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
        $('[aria-labelledby="select2-'+ id + '-container"]').next().remove();
      }
    }
  });
}

function validateRadioChoices(id,step)
{
  $('button[type=submit]').on('click',function(e){
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
            var pass = 0;
            $(id + ' input[type=radio]').each(function(){
              if($(this).is(':checked')){
                pass++;
              }
            });
            if(pass == 0)
            {
              $(id).css('color','DarkRed');
              if($(id).next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
              {
                $(id).after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please choose one</span></div>');
              }
              $('html, body').animate({
                   scrollTop: $(id).offset().top - 200
               }, 700);
              e.preventDefault();
            }
          }
        }
      });
  $(id).on('input change',function(){
    $(id).css('color','black');
    if($(id).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
      $(id).next().remove();
    }
  });
}

function validateDate(id,step){
  $('button[type=submit]').on('click',function(e){
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
            if(!($(id + '_year').val()))
            {
              $(id+'_year').css('border-color','DarkRed');
              if($(id).next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
              {
                $(id).after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please fill in the field</span></div>');
              }
              $('html, body').animate({
                   scrollTop: $(id).offset().top - 200
               }, 700);
              e.preventDefault();
            }
            if(!($(id + '_month').val()))
            {
              $(id+'_month').css('border-color', 'DarkRed');
              if($(id).next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
              {
                $(id).after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please fill in the field</span></div>');
              }
              $('html, body').animate({
                   scrollTop: $(id).offset().top - 200
               }, 700);
              e.preventDefault();
            }
          }
        }
      });
  $(id + '_year').on('input change',function(){
    $(this).css('border-color','');
    if($(id).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
      $(id).next().remove();
    }
  });

  $(id + '_month').on('input change',function(){
    $(this).css('border-color','');
    if($(id).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
      $(id).next().remove();
    }
  });
}

function validateTextbox(id, step){
  $('button[type=submit]').on('click',function(e){
    if($(id).attr('disabled') == 'disabled'){
      return null;
    }
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
            if(!($(id).val())){
              $('html, body').animate({
                   scrollTop: $(id).offset().top - 200
               }, 700);
              e.preventDefault();
              $(id).css('border-color','DarkRed');
              if($(id).next().attr('class') != 'help-block glyphicon glyphicon-exclamation-sign')
              {
                $(id).after('<div class="help-block glyphicon glyphicon-exclamation-sign" style="color:DarkRed;"><span style="font:bold italic 12px lato;">Please fill in the field</span></div>');
              }
            }
          }
        }
      });
  $(id).on('input change',function(){
    if(($(id).val())){
      if($(id).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign'){
        $(id).css('border-color','');
        $(id).next().remove();
      }
    }
  });
}

function validateCheckbox(id, step){
  $('button[type=submit]').on('click',function(e){
    if($(this).text() == 'Next Step'){
      if($('.number').text() == step){
            var pass = 0;
            $( id + ' input[type=checkbox]').each(function(){
              if($(this).is(':checked')){
                pass++;
              }
            });
            if(pass == 0){
              $(id).addClass('has-error');
              if($(id).find('.help-block').hasClass('help-block') == false)
              {
                $(id).append('<div class="help-block glyphicon glyphicon-exclamation-sign"><span style="font:bold italic 12px lato;">Choose at least one checkbox</span></div>');
              }
              $('html, body').animate({
                   scrollTop: $(id).offset().top - 200
               }, 700);
              e.preventDefault();
            }
          }
        }
  });

  $(id + ' input[type=checkbox]').on('input change',function(){
    $(id + ' input[type=checkbox]').each(function(){
      if($(this).is(':checked')){
        $(id).removeClass('has-error');
        $(id).find('.help-block').remove();
      }
  });
});

}
