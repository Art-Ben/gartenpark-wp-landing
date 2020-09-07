let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);

window.addEventListener('resize', () => {
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
});

jQuery(document).ready(function () {

  if( Cookies.get('cookieBanner') == 'yes') {
    $('.cookieBanner').hide();
  }

  $('.acceptCookie').click(function(){
    Cookies.set('cookieBanner', 'yes', { expires: 7 });
    $('.cookieBanner').hide(600);
  })

  let flickitySLiderOptions = {
    prevNextButtons: false,
    pageDots: false,
    wrapAround: false,
    cellAlign: 'right',
    contain: true,
    adaptiveHeight: true,
  };

  var page_slider;

  if ($(window).innerWidth() > 1024) {
    flickitySLiderOptions.draggable = false;
    page_slider = $('.page__intro--slider').flickity(flickitySLiderOptions);
  } else {
    flickitySLiderOptions.draggable = true;
    page_slider = $('.page__intro--slider').flickity(flickitySLiderOptions);
  }

  $('.page__intro--slider_nav .arrow').click(function () {
    if ($(this).hasClass('prev')) {
      page_slider.flickity('previous');
    };
    if ($(this).hasClass('next')) {
      page_slider.flickity('next');
    };
  });

  const media = $('.page__intro_poster').get(0);
  var mediaElementInstance = new MediaElementPlayer('.my-player');

  $('.my-select').select2({
    minimumResultsForSearch: -1,
    dropdownCssClass: 'my-select-drop',
    containerCssClass: 'my-select-cont',
    dropdownParent: $('.selectgrp')
  });

  function checkEmpty(val) {
    return (!val || 0 === val.length);
  }

  $('.customCtaForm__form').find('#type').on('change', function(e){
    if( $(this).val() ) {
      $(this).removeClass('error');
    }
    console.log($(this).val());
  })

  $('.customCtaForm__form').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    var name, lastname_elem, newsletter_elem, lastname, tel, email, type, message, button, name_elem, tel_elem, email_elem, type_elem, message_elem;
    button = _this.find('.my-sbm');

    name_elem = _this.find('#name');
    lastname_elem = _this.find('#lastname');
    tel_elem = _this.find('#tel');
    email_elem = _this.find('#email');
    type_elem = _this.find('#type');
    message_elem = _this.find('#message');
    newsletter_elem = _this.find('#newsletter_chck');

    name = name_elem.val();
    lastname = lastname_elem.val();
    tel = tel_elem.val();
    email = email_elem.val();
    type = type_elem.val();
    message = message_elem.val();
    newsletter_checked = newsletter_elem.prop('checked');
    
    if( newsletter_checked == true ) {
      newsletter_checked = 'checked';
    }

    console.log(newsletter_checked);

    var emailRegExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    var error = false;
    var errors = '';
    var errors_obj = _this.data('messages');

    var infoCont = _this.find('.afterSubmitBlock');

    var data = new FormData();
    data.append('action', 'sendcontactform');
    data.append('name', name);
    data.append('lastname', lastname);
    data.append('tel', tel);
    data.append('email', email);
    data.append('type', type);
    data.append('message', message);
    data.append('newsletter', newsletter_checked);

    function addErrorClass(elem, errorClass) {
      $(elem).addClass(errorClass);
    }

    function removeErrorClass(elem, errorClass) {
      $(elem).removeClass(errorClass);
    }

    if (checkEmpty(name)) {
      error = true;
      addErrorClass(name_elem, 'error');
    } else {
      removeErrorClass(name_elem, 'error');
    }

    if (checkEmpty(lastname)) {
      error = true;
      addErrorClass(lastname_elem, 'error');
    } else {
      removeErrorClass(lastname_elem, 'error');
    }

    if (checkEmpty(tel)) {
      error = true;
      addErrorClass(tel_elem, 'error');
    } else {
      removeErrorClass(tel_elem, 'error');
    }

    if (checkEmpty(type)) {
      error = true;
      addErrorClass(type_elem, 'error');
    } else {
      removeErrorClass(type_elem, 'error');
    }

    if (checkEmpty(message)) {
      error = true;
      addErrorClass(message_elem, 'error');
    } else {
      removeErrorClass(message_elem, 'error');
    }

    if (!email.match(emailRegExp)) {
      error = true;
      addErrorClass(email_elem, 'error');
    } else {
      removeErrorClass(email_elem, 'error');
    }

    if (!error) {
      $.ajax({
        url: ajax_object.ajaxurl,
        data: data,
        type: 'POST',
        processData: false,
        contentType: false,
        dataType: "json",

        beforeSend: function (xhr) {
          button.addClass('loading');
        },

        success: function (data) {
          if (data.response == "SUCCESS") {
            button.removeClass('loading');
            _this.find('.formGroup:not(.special)').fadeOut(600);

            infoCont.fadeIn(600).addClass('success').html(errors_obj.success);
          } else {
            console.log(data.error);
          }
        },
      })
    } else {
      //infoCont.fadeIn(600).removeClass('success').addClass('errors').html(errors);
    }
  });



  $('.header__socials--btn').click(function () {
    $(this).siblings('.header__socials--hidden').toggleClass('show');
  });

  $('.header__burger, .mobileMenu__close').click(function () {
    $('.mobileMenu').toggleClass('open');
  });

  $(".navigation_to_anchor").click(function (e) {

    if ($('.mobileMenu').hasClass('open')) {
      setTimeout(() => {
        $('.mobileMenu').removeClass('open');
      }, 1200);
    }

    if (this.hash !== "") {

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function () {
        window.location.hash = hash;
      });
      return false;
    }
  });

  var target = $(location).attr("hash");
  var offset = ($(this).attr('data-offset') ? $(this).attr('data-offset') : 0);
  if(target) {
      $('body,html').animate({
        scrollTop: $(target).offset().top
      }, 1000);
  }

  $('.mySpecialPostBlock .postMore').click(function () {
    $(this).parents('.mySpecialPostBlock').find('.postContent__short').fadeToggle(500);
    $(this).parents('.mySpecialPostBlock').find('.postContent__full').delay(500).fadeToggle(500);

    if( $(this).hasClass('open') ) {
      $(this).removeClass('open');
    } else {
      $(this).addClass('open');
    }
  });

})