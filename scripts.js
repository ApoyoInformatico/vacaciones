/*$(document).ready(function(){
  $('.panel').click(function(){
      var clickBtnValue = $(this).val();
      var ajaxurl = 'ajax.php',
      data =  {'action': clickBtnValue};
      $.post(ajaxurl, data, function (response) {
          // Response div goes here.
          window.location.href="logout.php";
      });
  });
  $('.login').click(function(){
    var clickBtnValue = $(this).val();
    var ajaxurl = 'ajax.php',
    data =  {'action': clickBtnValue};
    $.post(ajaxurl, data, function (response) {
        // Response div goes here.
        window.location.href="login.php";
    });
});
});*/


// variables
$(document).ready(function(){
    var logo = $('.logo'),
        logoName = $('.header p'),
        form = $('form'),
        fields = $('fieldset'),
        submit = $('.form__submit'),
        connect = $('.connect'),
        account = $('.account'),
        circle = $('.circle'),
        red = $('.red'),
        tl = new TimelineMax();
    
    //animations
  /*  tl.from(logoName, .4,{y:-70, autoAlpha:0, ease:Sine.easeOut})
      .from(form, .3,{y:-50, autoAlpha:0, ease:Sine.easeOut})
      .staggerFrom(fields, .3, {y:-10, autoAlpha:0, ease:Sine.easeOut})
      .from(submit, .3,{y:-50, autoAlpha:0, ease:Sine.easeOut})
      .from(connect, .3,{y:-50, autoAlpha:0, ease:Sine.easeOut})
      .from(account, .3,{y:-50, autoAlpha:0, ease:Sine.easeOut})
      .fromTo(circle, 3, {drawSVG:0 }, {stroke:'white', drawSVG:"100%", ease:Sine.easeOut}, "-=1")
      .fromTo(circle, .9,{drawSVG:0 }, {fill:'white', drawSVG:"102%", delay:0.5 })
      .to(red, 1, {autoAlpha:1, ease:Linear.easeNone})*/
    })


    