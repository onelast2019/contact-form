$(document).ready(function(){

//defining custom function to show error message and give red border to field and show astrisk back if hidden
  function show_message(err_selector,input_selector){
    $(err_selector).fadeIn(200);
    $(input_selector).css("border","1px solid red");
    $(input_selector).parent().find('.astrisk').fadeIn();
  };
//defining custom function to hide error message and give green border to field and hide astrisk  if shown
  function hide_message(err_selector,input_selector){
    $(err_selector).fadeOut(200);
    $(input_selector).css("border","1px solid green");
    $(input_selector).parent().find('.astrisk').fadeOut();
  };

  //prevent form submission if there is error in form by using formError variable

  var nameError=true;
  var mailError=true;
  var messageError=true;

  $('#name').blur(function(){
    if ($(this).val().length<4) {                 //check if the value of name field is larger than 3 charachters when blur
      show_message('.name_err','#name');
      nameError=true;
    }else {
      hide_message('.name_err','#name');
      nameError=false;

    }

  });
  $('#email').blur(function(){
    if ($(this).val().length<4) {                     //check if user typed any thing in email
        show_message('.mail_err','#email');
        mailError=true;
    }else {
        hide_message('.mail_err','#email');
        mailError=false;
    }

  });
  $('#message').blur(function(){
    if ($(this).val().length<20) {                   //check if message is larger than 20 charachters
      show_message('.message_err','#message');
      messageError=true;

    }else {
      hide_message('.message_err','#message');
      messageError=false;

    }

  });

$('form').submit(function(e){                //prevent form from submission if there is any error in any field
  if (nameError===true||mailError===true||messageError===true) {
    e.preventDefault();
  }
});

});
