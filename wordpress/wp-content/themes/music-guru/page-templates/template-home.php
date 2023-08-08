<?php
/**
 *
 * Template Name: Frontpage

 *

 */

$music_guru_options = music_guru_theme_options();


$newsletter_show            = $music_guru_options['newsletter_show'];
$newsletter_title		 	 = $music_guru_options['newsletter_title'];
$newsletter_shortcode     = $music_guru_options['newsletter_shortcode'];

get_header();


get_template_part('template-parts/homepage/banner', 'section');

get_template_part('template-parts/homepage/album', 'section');




get_template_part('template-parts/homepage/about', 'section');


get_template_part('template-parts/homepage/video', 'section');


if($newsletter_show) { 
    if (1 == $newsletter_show):?>
    <div class="newsletter-sec" id="newsletter-section">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="newsletter-content">
                        <h2 class="newsletter-title"><?php echo esc_html($newsletter_title); ?></h2>
                        

                        <?php  
                        echo do_shortcode($newsletter_shortcode);  
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

        <?php
        
    endif;
}

get_template_part('template-parts/homepage/blog', 'section');


get_footer();
