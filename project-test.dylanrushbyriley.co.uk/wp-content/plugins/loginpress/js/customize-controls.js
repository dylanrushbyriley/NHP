/**
 * This file handling some LIVE to the LoginPress Customizer live preview.
 */
jQuery(document).ready(function() {

  /* === Checkbox Multiple Control === */

  jQuery( '.customize-control-checkbox-multiple input[type="radio"]' ).on( 'change', function() {

    checkbox_values = jQuery(this)
    .parents( '.customize-control' )
    .find( 'input[type="radio"]:checked' )
    .val();

    style_values = jQuery(this)
    .parents( '.customize-control' )
    .find( 'input[type="radio"]:checked' )
    .data('style');

    var val = [];
    val.push(checkbox_values);
    val.push(style_values);
    // console.log(val);
    jQuery(this)
    .parents( '.customize-control' )
    .find( 'input[type="hidden"]' )
    .val(checkbox_values)
    .delay(500)
    .trigger( 'change' );

  } );
} ); // jQuery( document ).ready


(function($) {

  // function for change LoginPress background-image in real time...
  function loginpress_background_img( setting, target ) {
    wp.customize( setting, function( value ) {
      value.bind( function( loginPressVal ) {
        if ( loginPressVal == '' ) {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .css( 'background-image', 'none' );
        } else {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .css( 'background-image', 'url(' + loginPressVal + ')' );
        }
      } );
    } );
  } // ! loginpress_background_img();

  // function for change LoginPress CSS in real time...
  function loginpress_css_property( setting, target, property ) {
    // Update the login logo width in real time...
    wp.customize( setting, function( value ) {
      value.bind( function( loginPressVal ) {

        if ( loginPressVal == '' ) {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .css( property, '' );
        } else {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .css( property, loginPressVal );
        }
      } );
    } );
  } // finish loginpress_css_property();

  // function for change LoginPress attribute in real time...
  function loginpress_attr_property( setting, target, property ) {
    wp.customize( setting, function( value ) {
      value.bind( function( loginPressVal ) {

        if ( loginPressVal == '' ) {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .attr( property, '' );
        } else {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .attr( property, loginPressVal );
        }
      } );
    } );
  } // finish loginpress_attr_property();

  // function for change LoginPress input fields in real time...
  function loginpress_input_property( setting, property ) {
    wp.customize( setting, function( value ) {
      value.bind( function( loginPressVal ) {

        if ( loginPressVal == '' ) {
          $( '#customize-preview iframe' )
          .contents()
          .find( '.login input[type="text"]' )
          .css( property, '' );
          $( '#customize-preview iframe' )
          .contents()
          .find( '.login input[type="password"]' )
          .css( property, '' );
        } else {
          $( '#customize-preview iframe' )
          .contents()
          .find( '.login input[type="text"]' )
          .css( property, loginPressVal );
          $( '#customize-preview iframe' )
          .contents()
          .find( '.login input[type="password"]' )
          .css( property, loginPressVal );
        }
      } );
    } );
  } // finish loginpress_input_property();

  // function for change LoginPress error and welcome messages in real time...
  function loginpress_text_message( errorlog, target ) {
    wp.customize( errorlog, function( value ) {
      value.bind( function( loginPressVal ) {

        if ( loginPressVal == '' ) {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .text('');
        } else {
          $( '#customize-preview iframe' )
          .contents()
          .find( target )
          .text( loginPressVal );
        }
      } );
    } );
  }

  var change_theme;
  // function for change LoginPress error and welcome messages in real time...
  wp.customize('customize_presets_settings', function(value) {
    value.bind(function(loginPressVal) {

      change_theme = loginPressVal;


    });
  });


  // function for change LoginPress CSS in real time...
  function loginpress_display_control(setting) {
    // Update the login logo width in real time...
    wp.customize(setting, function(value) {
      value.bind(function(loginPressVal) {

        // Control on footer text.
        if ('loginpress_customization[footer_display_text]' ==
          setting && 'none' == loginPressVal) {

          $('#customize-control-login_footer_text_decoration').css(
            'display', 'none');
          $('#customize-control-login_footer_color').css('display',
            'none');
          $('#customize-control-login_footer_color_hover').css(
            'display', 'none');
          $('#customize-control-login_footer_font_size').css(
            'display', 'none');
          $('#customize-control-login_footer_bg_color').css('display',
            'none');

        } else if ('loginpress_customization[footer_display_text]' ==
          setting && 'block' == loginPressVal) {

          $('#customize-control-login_footer_text_decoration').css(
            'display', 'list-item');
          $('#customize-control-login_footer_color').css('display',
            'list-item');
          $('#customize-control-login_footer_color_hover').css(
            'display', 'list-item');
          $('#customize-control-login_footer_font_size').css(
            'display', 'list-item');
          $('#customize-control-login_footer_bg_color').css('display',
            'list-item');

        }

        // Control on footer back link text.
        if ('loginpress_customization[back_display_text]' == setting &&
          'none' == loginPressVal) {

          $('#customize-control-login_back_text_decoration').css(
            'display', 'none');
          $('#customize-control-login_back_color').css('display',
            'none');
          $('#customize-control-login_back_color_hover').css(
            'display', 'none');
          $('#customize-control-login_back_font_size').css('display',
            'none');
          $('#customize-control-login_back_bg_color').css('display',
            'none');

        } else if ('loginpress_customization[back_display_text]' ==
          setting && 'block' == loginPressVal) {

          $('#customize-control-login_back_text_decoration').css(
            'display', 'list-item');
          $('#customize-control-login_back_color').css('display',
            'list-item');
          $('#customize-control-login_back_color_hover').css(
            'display', 'list-item');
          $('#customize-control-login_back_font_size').css('display',
            'list-item');
          $('#customize-control-login_back_bg_color').css('display',
            'list-item');

        }
      });
    });
  }

  // function for change LoginPress error and welcome messages in real time...
  function loginpress_footer_text_message(errorlog, target) {
    wp.customize(errorlog, function(value) {
      value.bind(function(loginPressVal) {

        if (loginPressVal == '') {
          $('#customize-preview iframe').contents().find(target).text(
            '');
          if (errorlog ==
            'loginpress_customization[login_footer_copy_right]') {
            $('#customize-preview iframe').contents().find(target).css(
              'display', 'none');
          }
        } else {
          $('#customize-preview iframe').contents().find(target).text(
            loginPressVal);
          if (errorlog ==
            'loginpress_customization[login_footer_copy_right]') {
            $('#customize-preview iframe').contents().find(target).css(
              'display', 'block');
          }
        }
      });
    });
  }

  // LoginPress Customizer Background Image Control.
  function loginpress_customizer_bg(customizer_bg) {

    if ('default1' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress/img/bg.jpg)';
    } else if ('default2' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress/img/bg2.jpg)';
    } else if ('default3' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg3.jpg)';
    } else if ('default4' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg4.jpg)';
    } else if ('default5' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg5.jpg)';
    } else if ('default6' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg6.jpg)';
    } else if ('default7' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg7.jpg)';
    } else if ('default8' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg8.jpg)';
    } else if ('default9' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg9.jpg)';
    } else if ('default10' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg10.jpg)';
    } else if ('default11' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg11.png)';
    } else if ('default12' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg12.jpg)';
    } else if ('default13' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg13.jpg)';
    } else if ('default14' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg14.jpg)';
    } else if ('default15' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg15.jpg)';
    } else if ('default16' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg16.jpg)';
    } else if ('default17' == customizer_bg) {
      loginpress_bg = 'url(' + loginpress_script.plugin_url +
        '/loginpress-pro/img/bg17.jpg)';
    }
  }

  wp.customize('loginpress_customization[loginpress_display_bg]', function(
    value) {
    value.bind(function(loginPressVal) {

      // Check the theme id.
      customizer_bg = change_theme ? change_theme : loginpress_script
        .login_theme;

      // Set custom style on customizer.
      if ($('#customize-preview iframe').contents().find(
          '#loginpress-customize').length == 0) {
        $("<style type='text/css' id='loginpress-customize'></style>")
          .appendTo($('#customize-preview iframe').contents().find(
            'head'));
      }

      // Set conditions on behalf on themes.
      if (loginPressVal == false) {

        if ('default6' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login::after{background-image: none}");

        } else if ('default8' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "body.login::after{background: none}");

        } else if ('default10' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login::after{background-image: none}");

        } else if ('default17' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login{background: none}");

        } else {
          $('#customize-preview iframe').contents().find('body.login')
            .css('background-image', 'none');
        }

        $('#customize-control-setting_background').hide();
        $('#customize-control-background_image_size').hide();
        $('#customize-control-background_repeat_radio').hide();

      } else {

        if (localStorage.loginpress_bg) {

          loginpress_bg_ = 'url(' + localStorage.loginpress_bg + ')';

          if ('default6' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "#login::after{background-image: " + loginpress_bg_ +
              "}");

          } else if ('default8' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "body.login::after{background: " + loginpress_bg_ +
              " no-repeat 0 0; background-size: cover}");

          } else if ('default10' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "#login::after{background-image: " + loginpress_bg_ +
              "}");

          } else if ('default17' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html("#login{background: " +
              loginpress_bg_ + " no-repeat 0 0;}");

          } else {

            $('#customize-preview iframe').contents().find(
              'body.login').css('background-image', loginpress_bg_)
          }

        } else if (loginpress_script.loginpress_bg_url == true) {

          if ('default6' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "#login::after{background-image: " +
              loginpress_script.loginpress_bg_url + "}");

          } else if ('default8' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "body.login::after{background: " + loginpress_script.loginpress_bg_url +
              " no-repeat 0 0; background-size: cover}");

          } else if ('default10' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "#login::after{background-image: " +
              loginpress_script.loginpress_bg_url + "}");

          } else if ('default17' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html("#login{background: " +
              loginpress_script.loginpress_bg_url +
              " no-repeat 0 0;}");

          } else {
            $('#customize-preview iframe').contents().find(
              'body.login').css('background-image', 'url(' +
              loginpress_script.loginpress_bg_url + ')');
          }
        } else {

          loginpress_customizer_bg(customizer_bg);
          if ('default6' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "#login::after{background-image: " + loginpress_bg +
              "}");

          } else if ('default8' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "body.login::after{background: " + loginpress_bg +
              " no-repeat 0 0; background-size: cover}");

          } else if ('default10' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html(
              "#login::after{background-image: " + loginpress_bg +
              "}");

          } else if ('default17' == customizer_bg) {

            $('#customize-preview iframe').contents().find(
              '#loginpress-customize').html("#login{background: " +
              loginpress_bg + " no-repeat 0 0;}");

          } else {
            $('#customize-preview iframe').contents().find(
              'body.login').css('background-image', loginpress_bg);
          }
        }

        $('#customize-control-setting_background').show();
        $('#customize-control-background_image_size').show();
        $('#customize-control-background_repeat_radio').show();

      } // endif; conditions on behalf on themes.
    });
  });
  // LoginPress Background Image Control.
  //   wp.customize( 'loginpress_customization[loginpress_display_bg]', function( value ) {
  //     value.bind( function( loginPressVal ) {
  //       customizer_bg = change_theme ? change_theme : loginpress_script.login_theme;
  //
  //       var bg = $('#customize-preview iframe').contents().find( 'body.login' ).css( 'background-image' );
  // console.log(bg);
  //       if( loginPressVal == false ) {
  //
  //         if ( ! localStorage.loginpress_bg_check ) {
  //
  //           localStorage.setItem( "loginpress_bg_check", bg );
  //         }
  //
  //         if ( 'default6' == customizer_bg ) {
  //           //Q ki hoya ?
  //           console.log('bg of default6 is gone off');
  //           // $('#customize-preview iframe').contents().find( '#login::after' ).appendTo( 'background-image', 'none' );
  //           $("<style type='text/css'>#login::after{background-image: none}</style>").appendTo($('#customize-preview iframe').contents().find('head'));
  //         } else {
  //           console.log('bg gone off');
  //           $('#customize-preview iframe').contents().find( 'body.login' ).css( 'background-image', 'none' );
  //         }
  //         $('#customize-control-setting_background').hide();
  //         $('#customize-control-background_repeat_radio').hide();
  //         $('#customize-control-background_image_size').hide();
  //       } else {
  //
  //         if ( localStorage.getItem("loginpress_bg") === null && localStorage.loginpress_bg_check ) {
  //
  //           loginpress_bg = localStorage.loginpress_bg_check;
  //           console.log('bg1');
  //
  //         } else if ( localStorage.getItem("loginpress_bg") === null ) {
  //
  //           loginpress_customizer_bg( customizer_bg );
  //           console.log('bg2');
  //         } else if ( localStorage.loginpress_bg ) {
  //
  //           loginpress_bg = 'url(' + localStorage.loginpress_bg + ')';
  //           console.log('bg3');
  //         } else {
  //
  //           loginpress_bg = localStorage.loginpress_bg_check;
  //           console.log('bg4');
  //         }
  //
  //         if ( 'default6' == customizer_bg ) {
  //           console.log('true default6 bg');
  //           console.log(loginpress_bg);
  //           // $('#customize-preview iframe').contents().find( '#login::after' ).appendTo( 'background-image', loginpress_bg );
  //           $("<style type='text/css'>#login::after{background-image: "+loginpress_bg+"}</style>").appendTo($('#customize-preview iframe').contents().find('head'));
  //         } else {
  //           console.log('true bg');
  //           console.log(loginpress_bg);
  //           $('#customize-preview iframe').contents().find( 'body.login' ).css( 'background-image', loginpress_bg );
  //         }
  //         // $('#customize-preview iframe').contents().find( 'body.login' ).css( 'background-image', loginpress_bg );
  //         $('#customize-control-setting_background').show();
  //         $('#customize-control-background_repeat_radio').show();
  //         $('#customize-control-background_image_size').show();
  //       }
  //     } );
  //   } );

  // LoginPress Background instant change.
  wp.customize('loginpress_customization[setting_background]', function(value) {
    value.bind(function(loginPressVal) {

      customizer_bg = change_theme ? change_theme : loginpress_script
        .login_theme;

      if ($('#customize-preview iframe').contents().find(
          '#loginpress-customize').length == 0) {
        $("<style type='text/css' id='loginpress-customize'></style>")
          .appendTo($('#customize-preview iframe').contents().find(
            'head'));
      }

      if (loginPressVal == '') {
        if (localStorage.loginpress_bg) {
          localStorage.removeItem("loginpress_bg");
        }

        loginpress_customizer_bg(customizer_bg);
        if ('default6' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login::after{background-image: " + loginpress_bg +
            "}");
        } else if ('default8' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "body.login::after{background: " + loginpress_bg +
            " no-repeat 0 0; background-size: cover}");
        } else if ('default10' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login::after{background-image: " + loginpress_bg +
            "}");
        } else if ('default17' == customizer_bg) {

          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html("#login{background: " +
            loginpress_bg + " no-repeat 0 0;}");
        } else {
          $('#customize-preview iframe').contents().find('body.login')
            .css('background-image', loginpress_bg);
        }
      } else {

        // if (!localStorage.loginpress_bg) {
          localStorage.setItem("loginpress_bg", loginPressVal);
        // }

        if ('default6' == customizer_bg) {

          // console.log(loginPressVal);
          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login::after{background-image: url(" + loginPressVal +
            ")}");
        } else if ('default8' == customizer_bg) {

          // console.log(loginPressVal);
          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "body.login::after{background: url(" + loginPressVal +
            ") no-repeat 0 0; background-size: cover}");
        } else if ('default10' == customizer_bg) {

          // console.log(loginPressVal);
          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html(
            "#login::after{background-image: url(" + loginPressVal +
            ")}");
        } else if ('default17' == customizer_bg) {

          // console.log(loginPressVal);
          $('#customize-preview iframe').contents().find(
            '#loginpress-customize').html("#login{background: url(" +
            loginPressVal + ") no-repeat 0 0;}");
        } else {
          $('#customize-preview iframe').contents().find('body.login')
            .css('background-image', 'url(' + loginPressVal + ')');
        }

      }

    });
  });
  // loginpress_background_img( 'loginpress_customization[]', 'body.login' );
  $('.customize-controls-close').on('click', function() {
    // localStorage.removeItem("loginpress_bg_check");
    // localStorage.removeItem("loginpress_bg");
  });
  // localStorage.removeItem("loginpress_bg");
  // localStorage.removeItem("loginpress_bg_check");
  // loginpress_display_control( 'loginpress_customization[footer_display_text]' );
  // loginpress_display_control( 'loginpress_customization[back_display_text]' );

  // Update the login logo in real time...
  wp.customize('loginpress_customization[setting_logo]', function(value) {
    value.bind(function(loginPressVal) {

      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find('#login h1 a')
          .css('background-image', 'url(' + loginpress_script.admin_url +
            '/images/wordpress-logo.svg)');
      } else {
        $('#customize-preview iframe').contents().find('#login h1 a')
          .css('background-image', 'url(' + loginPressVal + ')');
      }
    });
  });

  loginpress_css_property('loginpress_customization[customize_logo_width]',
    '#login h1 a', 'width');
  loginpress_css_property('loginpress_customization[customize_logo_height]',
    '#login h1 a', 'height');
  loginpress_css_property('loginpress_customization[customize_logo_padding]',
    '#login h1 a', 'padding-bottom');

  loginpress_attr_property('loginpress_customization[customize_logo_hover]',
    '#login h1 a', 'href');
  loginpress_attr_property(
    'loginpress_customization[customize_logo_hover_title]', '#login h1 a',
    'title');


  // loginpress_css_property(
  //   // 'loginpress_customization[setting_background_color]', 'body.login',
  //   'background-color');

    wp.customize('loginpress_customization[setting_background_color]', function(value) {
      value.bind(function(loginPressVal) {

        customizer_bg = change_theme ? change_theme : loginpress_script
          .login_theme;

        if ($('#customize-preview iframe').contents().find(
            '#loginpress-iframe-bgColor').length == 0) {
          $("<style type='text/css' id='loginpress-iframe-bgColor'></style>")
            .appendTo($('#customize-preview iframe').contents().find(
              'head'));
        }

        if (loginPressVal == '') {

          if ( 'default6' == customizer_bg || 'default10' == customizer_bg ) {
            $('#customize-preview iframe').contents().find(
              '#loginpress-iframe-bgColor').html(
              "#login::after{background-color: #f1f1f1}");
          } else if ( 'default17' == customizer_bg ) {
            $('#customize-preview iframe').contents().find('#login').css(
               "background-color" , "'#f1f1f1'");
          } else if ( 'default8' == customizer_bg ) {
            $('#customize-preview iframe').contents().find(
              '#loginpress-iframe-bgColor').html(
              "body.login::after{background-color: #f1f1f1}");
          } else {
            $('#customize-preview iframe').contents().find('body.login').css(
              "background-color", "#f1f1f1");
          }
        } else {

          if ( 'default6' == customizer_bg || 'default10' == customizer_bg ) {
            $('#customize-preview iframe').contents().find(
              '#loginpress-iframe-bgColor').html(
              "#login::after{background-color: " + loginPressVal +
              "}");
          } else if ( 'default17' == customizer_bg ) {
            $('#customize-preview iframe').contents().find('#login').css(
               "background-color" , loginPressVal);
          } else if ( 'default8' == customizer_bg ) {
            $('#customize-preview iframe').contents().find(
              '#loginpress-iframe-bgColor').html(
              "body.login::after{background-color: " + loginPressVal +
              "}");
          } else {
            $('#customize-preview iframe').contents().find('body.login').css(
              "background-color", loginPressVal);
          }
        }
      });
    });


  // loginpress_specialcase_bg_property( 'loginpress_customization[background_repeat_radio]', 'background-repeat' );

  wp.customize( 'loginpress_customization[background_repeat_radio]', function(value) {
    value.bind(function(loginPressVal) {

      customizer_bg = change_theme ? change_theme : loginpress_script
        .login_theme;

        if ($('#customize-preview iframe').contents().find(
            '#loginpress-scbg-repeat').length == 0) {
          $("<style type='text/css' id='loginpress-scbg-repeat'></style>")
            .appendTo($('#customize-preview iframe').contents().find(
              'head'));
        }

      if ( loginPressVal != '' ) {

        if ( 'default6' == customizer_bg || 'default10' == customizer_bg ) {
          $('#customize-preview iframe').contents().find(
            '#loginpress-scbg-repeat').html(
            "#login::after{background-repeat: " + loginPressVal +
            "}");
        } else if ( 'default17' == customizer_bg ) {
          $('#customize-preview iframe').contents().find('#login').css(
             "background-repeat" , loginPressVal);
        } else if ( 'default8' == customizer_bg ) {
          $('#customize-preview iframe').contents().find(
            '#loginpress-scbg-repeat').html(
            "body.login::after{background-repeat: " + loginPressVal +
            "}");
        } else {
          $('#customize-preview iframe').contents().find('body.login').css(
            "background-repeat", loginPressVal);
        }

      }
    });
  });

  // loginpress_specialcase_bg_property( 'loginpress_customization[background_image_size]', 'background-size' );

  wp.customize( 'loginpress_customization[background_image_size]', function(value) {
    value.bind(function(loginPressVal) {

      customizer_bg = change_theme ? change_theme : loginpress_script
        .login_theme;

        if ($('#customize-preview iframe').contents().find(
            '#loginpress-scbg-size').length == 0) {
          $("<style type='text/css' id='loginpress-scbg-size'></style>")
            .appendTo($('#customize-preview iframe').contents().find(
              'head'));
        }

      if ( loginPressVal != '' ) {

        if ( 'default6' == customizer_bg || 'default10' == customizer_bg ) {
          $('#customize-preview iframe').contents().find(
            '#loginpress-scbg-size').html(
            "#login::after{background-size: " + loginPressVal +
            "}");
        } else if ( 'default17' == customizer_bg ) {
          $('#customize-preview iframe').contents().find('#login').css(
             "background-size" , loginPressVal);
        } else if ( 'default8' == customizer_bg ) {
          $('#customize-preview iframe').contents().find(
            '#loginpress-scbg-size').html(
            "body.login::after{background-size: " + loginPressVal +
            "}");
        } else {
          $('#customize-preview iframe').contents().find('body.login').css(
            "background-size", loginPressVal);
        }

      }
    });
  });

  // loginpress_specialcase_bg_property( 'loginpress_customization[background_position]', 'background-position' );

  wp.customize( 'loginpress_customization[background_position]', function(value) {
    value.bind(function(loginPressVal) {

      customizer_bg = change_theme ? change_theme : loginpress_script
        .login_theme;

        if ($('#customize-preview iframe').contents().find(
            '#loginpress-scbg-position').length == 0) {
          $("<style type='text/css' id='loginpress-scbg-position'></style>")
            .appendTo($('#customize-preview iframe').contents().find(
              'head'));
        }

      if ( loginPressVal != '' ) {

        if ( 'default6' == customizer_bg || 'default10' == customizer_bg ) {
          $('#customize-preview iframe').contents().find(
            '#loginpress-scbg-position').html(
            "#login::after{background-position: " + loginPressVal +
            "}");
        } else if ( 'default17' == customizer_bg ) {
          $('#customize-preview iframe').contents().find('#login').css(
             "background-position" , loginPressVal);
        } else if ( 'default8' == customizer_bg ) {
          $('#customize-preview iframe').contents().find(
            '#loginpress-scbg-position').html(
            "body.login::after{background-position: " + loginPressVal +
            "}");
        } else {
          $('#customize-preview iframe').contents().find('body.login').css(
            "background-position", loginPressVal);
        }

      }
    });
  });


  loginpress_background_img(
    'loginpress_customization[setting_form_background]', '#loginform');

  loginpress_css_property('loginpress_customization[customize_form_width]',
    '#login', 'max-width');
  loginpress_css_property('loginpress_customization[customize_form_height]',
    '#loginform', 'min-height');
  loginpress_css_property('loginpress_customization[customize_form_padding]',
    '#loginform', 'padding');
  loginpress_css_property('loginpress_customization[customize_form_border]',
    '#loginform', 'border');

  loginpress_input_property('loginpress_customization[textfield_width]',
    'width');
  loginpress_input_property('loginpress_customization[textfield_margin]',
    'margin');
  loginpress_input_property(
    'loginpress_customization[textfield_background_color]', 'background');
  loginpress_input_property('loginpress_customization[textfield_color]',
    'color');


  loginpress_css_property('loginpress_customization[form_background_color]',
    '#loginform', 'background-color');

  loginpress_css_property('loginpress_customization[textfield_label_color]',
    '.login label', 'color');

  loginpress_background_img(
    'loginpress_customization[forget_form_background]', '#lostpasswordform'
  );
  loginpress_css_property(
    'loginpress_customization[forget_form_background_color]',
    '#lostpasswordform', 'background-color');

  //Buttons starts.
  // Update the login form button background in real time...
  var loginPressBtnClr;
  var loginPressBtnHvr;
  wp.customize('loginpress_customization[custom_button_color]', function(
    value) {
    value.bind(function(loginPressVal) {
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').css('background',
          '');
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').on('mouseover',
          function() {

            if (typeof loginPressBtnHvr !== "undefined" ||
              loginPressBtnHvr === null) {
              $(this).css('background', loginPressBtnHvr);
            } else {
              $(this).css('background', '');
            }
          }).on('mouseleave', function() {
          $(this).css('background', '');
        });
      } else {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login .button-primary').css('background',
          loginPressVal);
        loginPressBtnClr = loginPressVal;

        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').on('mouseover',
          function() {

            if (typeof loginPressBtnHvr !== "undefined" ||
              loginPressBtnHvr === null) {
              $(this).css('background', loginPressBtnHvr);
            } else {
              $(this).css('background', '');
            }
          }).on('mouseleave', function() {
          $(this).css('background', loginPressVal);
        });
      }
    });
  });

  var loginPressBtnBrdrClr;
  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[button_border_color]', function(
    value) {
    value.bind(function(loginPressVal) {
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').css('border-color',
          '');
      } else {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').css('border-color',
          loginPressVal);
        loginPressBtnBrdrClr = loginPressVal;
      }
    });
  });

  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[button_hover_color]', function(value) {
    value.bind(function(loginPressVal) {
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').css('background',
          '');
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').on('mouseover',
          function() {
            $(this).css('background', '');
          }).on('mouseleave', function() {

          if (typeof loginPressBtnClr !== "undefined" ||
            loginPressBtnClr === null) {
            $(this).css('background', loginPressBtnClr);
          } else {
            $(this).css('background', '');
          }
        });
      } else {

        loginPressBtnHvr = loginPressVal;

        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').on('mouseover',
          function() {

            $(this).css('background', loginPressVal);
          }).on('mouseleave', function() {

          if (typeof loginPressBtnClr !== "undefined" ||
            loginPressBtnClr === null) {
            $(this).css('background', loginPressBtnClr);
          } else {
            $(this).css('background', '');
          }
        });
      }
    });
  });

  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[button_hover_border]', function(
    value) {
    value.bind(function(loginPressVal) {
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').css('border-color',
          '');
      } else {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login  .button-primary').on('mouseover',
          function() {
            $(this).css('border-color', loginPressVal);
          }).on('mouseleave', function() {

          if (typeof loginPressBtnBrdrClr !== "undefined" ||
            loginPressBtnBrdrClr === null) {
            $(this).css('border-color', loginPressBtnBrdrClr);
          } else {
            $(this).css('border-color', '');
          }
        });
      }
    });
  });

  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[custom_button_shadow]', function(
    value) {
    value.bind(function(loginPressVal) {
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login .button-primary').css('box-shadow',
          '');
      } else {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login .button-primary').css('box-shadow',
          loginPressVal);
      }
    });
  });

  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[button_text_color]', function(value) {
    value.bind(function(loginPressVal) {
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login .button-primary').css('color', '');
      } else {
        $('#customize-preview iframe').contents().find(
          '.wp-core-ui #login .button-primary').css('color',
          loginPressVal);
      }
    });
  });

  loginpress_text_message('loginpress_customization[login_footer_text]',
    '.login #nav a:nth-child(2)');

  loginpress_css_property('loginpress_customization[footer_display_text]',
    '.login #nav', 'display');
  loginpress_css_property(
    'loginpress_customization[login_footer_text_decoration]',
    '.login #nav a', 'text-decoration');

  var loginPressFtrClr;
  var loginPressFtrHvr;
  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[login_footer_color]', function(value) {
    value.bind(function(loginPressVal) {

      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.login #nav a').css('color', '');
        $('#customize-preview iframe').contents().find(
          '.login #nav a').on('mouseover', function() {

          if (typeof loginPressFtrHvr !== "undefined" ||
            loginPressFtrHvr === null) {
            $(this).css('color', loginPressFtrHvr);
          } else {
            $(this).css('color', '');
          }
        }).on('mouseleave', function() {
          $(this).css('color', '');
        });
      } else {
        loginPressFtrClr = loginPressVal;
        $('#customize-preview iframe').contents().find(
          '.login #nav a').css('color', loginPressVal);
        $('#customize-preview iframe').contents().find(
          '.login #nav a').on('mouseover', function() {

          if (typeof loginPressFtrHvr !== "undefined" ||
            loginPressFtrHvr === null) {
            $(this).css('color', loginPressFtrHvr);
          } else {
            $(this).css('color', '');
          }
        }).on('mouseleave', function() {
          $(this).css('color', loginPressVal);
        });
      }
    });
  });

  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[login_footer_color_hover]', function(
    value) {
    value.bind(function(loginPressVal) {

      if (loginPressVal == '') {

        $('#customize-preview iframe').contents().find(
          '.login #nav a').css('color', '');

        $('#customize-preview iframe').contents().find(
          '.login #nav a').on('mouseover', function() {
          $(this).css('color', '');
        }).on('mouseleave', function() {

          if (typeof loginPressFtrClr !== "undefined" ||
            loginPressFtrClr === null) {
            $(this).css('color', loginPressFtrClr);
          } else {
            $(this).css('color', '');
          }
        });
      } else {
        loginPressFtrHvr = loginPressVal;
        $('#customize-preview iframe').contents().find(
          '.login #nav a').on('mouseover', function() {
          $(this).css('color', loginPressVal);
        }).on('mouseleave', function() {

          if (typeof loginPressFtrClr !== "undefined" ||
            loginPressFtrClr === null) {
            $(this).css('color', loginPressFtrClr);
          } else {
            $(this).css('color', '');
          }
        });
      }
    });
  });

  loginpress_css_property('loginpress_customization[login_footer_font_size]',
    '.login #nav a', 'font-size');
  loginpress_css_property('loginpress_customization[login_footer_bg_color]',
    '.login #nav', 'background-color');

  loginpress_css_property('loginpress_customization[back_display_text]',
    '.login #backtoblog', 'display');
  loginpress_css_property(
    'loginpress_customization[login_back_text_decoration]',
    '.login #backtoblog a', 'text-decoration');

  var loginPressFtrBackClr;
  var loginPressFtrBackHvr;
  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[login_back_color]', function(value) {
    value.bind(function(loginPressVal) {

      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').css('color', '');
        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').on('mouseover', function() {

          if (typeof loginPressFtrBackHvr !== "undefined" ||
            loginPressFtrBackHvr === null) {
            $(this).css('color', loginPressFtrBackHvr);
          } else {
            $(this).css('color', '');
          }
        }).on('mouseleave', function() {
          $(this).css('color', '');
        });
      } else {
        loginPressFtrBackClr = loginPressVal;
        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').css('color', loginPressVal);
        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').on('mouseover', function() {

          if (typeof loginPressFtrBackHvr !== "undefined" ||
            loginPressFtrBackHvr === null) {
            $(this).css('color', loginPressFtrBackHvr);
          } else {
            $(this).css('color', '');
          }
        }).on('mouseleave', function() {
          $(this).css('color', loginPressVal);
        });
      }
    });
  });

  // Update the login form button border-color in real time...
  wp.customize('loginpress_customization[login_back_color_hover]', function(
    value) {
    value.bind(function(loginPressVal) {

      if (loginPressVal == '') {

        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').css('color', '');

        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').on('mouseover', function() {
          $(this).css('color', '');
        }).on('mouseleave', function() {

          if (typeof loginPressFtrBackClr !== "undefined" ||
            loginPressFtrBackClr === null) {
            $(this).css('color', loginPressFtrBackClr);
          } else {
            $(this).css('color', '');
          }
        });
      } else {
        loginPressFtrBackHvr = loginPressVal;
        $('#customize-preview iframe').contents().find(
          '.login #backtoblog a').on('mouseover', function() {
          $(this).css('color', loginPressVal);
        }).on('mouseleave', function() {

          if (typeof loginPressFtrBackClr !== "undefined" ||
            loginPressFtrBackClr === null) {
            $(this).css('color', loginPressFtrBackClr);
          } else {
            $(this).css('color', '');
          }
        });
      }
    });
  });

  loginpress_css_property('loginpress_customization[login_back_font_size]',
    '.login #backtoblog a', 'font-size');
  loginpress_css_property('loginpress_customization[login_back_bg_color]',
    '.login #backtoblog', 'background-color');
  loginpress_footer_text_message(
    'loginpress_customization[login_footer_copy_right]', '.copyRight');

  loginpress_text_message('loginpress_customization[incorrect_username]',
    '#login_error');
  loginpress_text_message('loginpress_customization[incorrect_password]',
    '#login_error');
  loginpress_text_message('loginpress_customization[empty_username]',
    '#login_error');
  loginpress_text_message('loginpress_customization[empty_password]',
    '#login_error');
  loginpress_text_message('loginpress_customization[invalid_email]',
    '#login_error');
  loginpress_text_message('loginpress_customization[empty_email]',
    '#login_error');
  loginpress_text_message('loginpress_customization[invalidcombo_message]',
    '#login_error');

  loginpress_text_message('loginpress_customization[lostpwd_welcome_message]',
    '.login .custom-message');
  loginpress_text_message('loginpress_customization[welcome_message]',
    '.login .custom-message');
  loginpress_text_message(
    'loginpress_customization[register_welcome_message]',
    '.login .custom-message');
  loginpress_text_message('loginpress_customization[logout_message]',
    '.login .custom-message');

  loginpress_css_property(
    'loginpress_customization[message_background_border]',
    '.login .custom-message', 'border');
  loginpress_css_property(
    'loginpress_customization[message_background_color]',
    '.login .custom-message', 'background-color');

  wp.customize( 'loginpress_customization[loginpress_show_love]', function( value ) {
    value.bind( function( loginPressVal ) {

      if ( loginPressVal == '' ) {
        $( '#customize-preview iframe' ).contents().find( '.loginpress-show-love' ).hide();
      } else {
        $( '#customize-preview iframe' ).contents().find( '.loginpress-show-love' ).show();
      }
    } );
  } );
  // loginpress_css_property( 'loginpress_customization[google_font]', '#login', 'font-family' );

  // wp.customize( 'loginpress_customization[google_font]', function( value ) {
  //   value.bind( function( loginPressVal ) {
  //
  //     if( loginPressVal == '' ) {
  //       $('#customize-preview iframe').contents().find( '#login' ).css( 'font-family', '' );
  //     } else {
  //       $('#customize-preview iframe').contents().find( '#login' ).css( 'font-family',  loginPressVal );
  //       console.log(loginPressVal);
  //     }
  //   } );
  // } );
  // console.log($('#customize-control-loginpress_display_bg').val());

  // function for change LoginPress background-image in real time...

  wp.customize('loginpress_customization[recaptcha_size]', function(value) {
    value.bind(function(loginPressVal) {
      console.log(loginPressVal);
      if (loginPressVal == '') {
        $('#customize-preview iframe').contents().find(
          '.loginpress_recaptcha_wrapper .g-recaptcha').css(
          'transform', '');
      } else {
        $('#customize-preview iframe').contents().find(
          '.loginpress_recaptcha_wrapper .g-recaptcha').css(
          'transform', 'scale(' + loginPressVal + ')');
      }
    });
  });


  $(window).on('load', function() {

    // console.log($('#customize-control-loginpress_display_bg input[type="checkbox"]').length);
    if ($(
        '#customize-control-loginpress_display_bg input[type="checkbox"]'
      ).is(":checked")) {
      $('#customize-control-setting_background').show();
      $('#customize-control-background_repeat_radio').show();
      $('#customize-control-background_image_size').show();
    } else {
      $('#customize-control-setting_background').hide();
      $('#customize-control-background_repeat_radio').hide();
      $('#customize-control-background_image_size').hide();
    }

    $("<style type='text/css' id='loginpress-customize'></style>").appendTo(
      $('#customize-preview iframe').contents().find('head'));
    $("<style type='text/css' id='loginpress-iframe-bgColor'></style>").appendTo(
      $('#customize-preview iframe').contents().find('head'));
    $("<style type='text/css' id='loginpress-scbg-position'></style>").appendTo(
      $('#customize-preview iframe').contents().find('head'));
    $("<style type='text/css' id='loginpress-scbg-size'></style>").appendTo(
      $('#customize-preview iframe').contents().find('head'));
    $("<style type='text/css' id='loginpress-scbg-repeat'></style>").appendTo(
      $('#customize-preview iframe').contents().find('head'));


  });

})(jQuery);
