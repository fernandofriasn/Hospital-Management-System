<?php
add_action( 'wp_enqueue_scripts', 'music_guru_enqueue_child_theme_styles', PHP_INT_MAX);

function music_guru_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'music-guru-font', music_guru_font_url(), array(), null);
    wp_enqueue_style( 'music-guru-child-css', get_template_directory_uri() . '/assets/css/music-artist.css', array(), '1.0' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', array('parent-style') );
    wp_enqueue_style( 'music-guru-media-css', get_template_directory_uri() . '/assets/css/media-queries.css', array(), '1.0' );
    
}

if (!function_exists('music_guru_font_url')) :
    function music_guru_font_url()
    {
        $fonts_url = '';
        $fonts = array();


        if ('off' !== _x('on', 'Oswald font: on or off', 'music-guru')) {
            $fonts[] = 'Oswald:600';
        }
        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
            ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }
endif;

function music_guru_enqueue_scripts() {
    wp_enqueue_script(
        'music-guru-custom-script',
        get_stylesheet_directory_uri() . '/custom_script.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'music_guru_enqueue_scripts' );

function music_guru_sanitize_checkbox( $input ) {
    if ( true === $input ) {
        return 1;
     } else {
        return 0;
     }
}


function music_guru_customize_register( $wp_customize ) {

	$music_guru_options = music_guru_theme_options();
	
    $wp_customize->add_section(
        'newsletter_section',
        array(
            'title' => esc_html__( 'Newsletter Section','music-guru' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('music_guru_theme_options[newsletter_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $music_guru_options['newsletter_show'],
            'sanitize_callback' => 'music_guru_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('music_guru_theme_options[newsletter_show]',
        array(
            'label' => esc_html__('Show Newsletter Section', 'music-guru'),
            'type' => 'Checkbox',

            'section' => 'newsletter_section',

        )
    );
	$wp_customize->add_setting('music_guru_theme_options[newsletter_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('newsletter_title',
	    array(
	        'label' => esc_html__('Title', 'music-guru'),
	        'type' => 'text',
	        'section' => 'newsletter_section',
	        'settings' => 'music_guru_theme_options[newsletter_title]',
	    )
	);

	$wp_customize->add_setting('music_guru_theme_options[newsletter_shortcode]',
	    array(
	        'type' => 'option',
	        'default' => $music_guru_options['newsletter_shortcode'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('music_guru_theme_options[newsletter_shortcode]',
	    array(
	        'label' => esc_html__('newsletter Shortcode (Mailchimp Preferred)', 'music-guru'),
	        'type' => 'text',
	        'section' => 'newsletter_section',
	        'settings' => 'music_guru_theme_options[newsletter_shortcode]',
	    )
	);

  }
  add_action( 'customize_register', 'music_guru_customize_register' );


  if (!function_exists('music_guru_theme_options')) :
      function music_guru_theme_options()
      {
          $defaults = array(
  

  
              'newsletter_show' => 0,
              'newsletter_title' => '',
   
              'newsletter_shortcode' => '',
              
  
          );
  
          $options = get_option('music_guru_theme_options', $defaults);
  
          //Parse defaults again - see comments
          $options = wp_parse_args($options, $defaults);
  
          return $options;
      }
  endif;