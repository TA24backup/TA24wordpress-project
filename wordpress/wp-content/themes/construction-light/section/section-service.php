<?php
/**
 * Template part for displaying front page section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Construction Light
 */
/**
 * Hook -  construction_light_action_service
 *
 * @hooked construction_light_service - 45
 */
/**
 * Our Main Service Section.
*/
if (! function_exists( 'construction_light_service' ) ):
    function construction_light_service(){
        $title          = get_theme_mod('construction_light_service_title');
        $sub_title      = get_theme_mod('construction_light_service_sub_title');
        $service_layout = get_theme_mod('construction_light_service_layout', 'layout_one');
        $services_options = get_theme_mod('construction_light_service_service_section','enable');
        $construction_light_service_bg_align = 'right';
        if( !empty( $services_options ) && $services_options == 'enable' ){
            $service_class = array(
                'cl-bg-' . $construction_light_service_bg_align,
                'cl-section',
                'cl-service-section',
                'cons_light_feature',
                'service',
                $service_layout
            );
            $type = get_theme_mod('construction_light_service_bg_type');
            $bg_video           = get_theme_mod("construction_light_service_bg_video", '1IaZy0sDLu0');
            if( $type == "video-bg" &&  $bg_video):
              $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
            else: 
              $video_data = '';
            endif;
            ?>
            <section id="cl-service-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>" <?php echo $video_data; ?>>
                <div class="cl-section-wrap">
                    <div class="container">
                        <?php construction_light_section_title( $title, $sub_title ); ?>
                        <div class="row">
                            <?php 
                                if( get_theme_mod('construction_light_service_type', 'normal') == 'normal'):
                                    get_construction_light_service_default_content($service_layout);
                                else: 
                                    get_construction_light_service_advance_content($service_layout);
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
    <?php } }
endif;
add_action('construction_light_action_service', 'construction_light_service', 45);
function get_construction_light_service_default_content($service_layout){
    $service_page   = get_theme_mod('construction_light_service');
    if (!empty($service_page)):
    $pages = json_decode($service_page);
    foreach ($pages as $page):
        $page_id = $page->service_page;
        if (!empty($page_id)):
        $service_query = new WP_Query('page_id=' . $page_id);
        if ( $service_query->have_posts() ): while ( $service_query->have_posts() ): $service_query->the_post();
            if( function_exists( 'pll_register_string' ) ){ 
                $service_button = pll__( get_theme_mod( 'construction_light_service_button','Read More' ) ); 
            }else{ 
                $service_button = get_theme_mod( 'construction_light_service_button','Read More' );
            }
    ?>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list">
        <div class="box">
            <?php if( !empty( $service_layout ) && $service_layout == 'layout_one' ){ ?>
                <figure>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('construction-light-medium'); ?>
                    </a>
                </figure>
            <?php } ?>
            <div class="bottom-content">
                <?php if( !empty( $service_layout ) && $service_layout == 'layout_two' ){ ?>
                    <div class="icon-box">
                        <i class="<?php echo esc_attr($page->service_icon); ?>"></i>
                    </div>
                <?php } ?>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                    <?php
                    ?>
                    <?php echo esc_html( $service_button ); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endwhile; endif; endif; endforeach; endif;
}
function get_construction_light_service_advance_content($service_layout){
    $service_page   = get_theme_mod('construction_light_service_advance');
    if (!empty($service_page)):
    $pages = json_decode($service_page);
    foreach ($pages as $page):
    ?>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list">
        <div class="box">

            <?php if( !empty( $service_layout ) && $service_layout == 'layout_one' ){ ?>
                <figure>
                    <a href="<?php echo esc_url($page->link); ?>">
                        <img src="<?php echo esc_url($page->image); ?>" class="attachment-construction-light-medium size-construction-light-medium wp-post-image" alt="" loading="lazy" width="350" height="280">
                    </a>
                </figure>
            <?php } ?>

            <div class="bottom-content">
                <?php if( !empty( $service_layout ) && $service_layout == 'layout_two' ){ ?>
                    <div class="icon-box">
                        <i class="<?php echo esc_attr($page->icon); ?>"></i>
                    </div>
                <?php } ?>
                <h3><a href="<?php  echo esc_url($page->link); ?>"><?php echo esc_html($page->title); ?></a></h3>
                <p>
                    <?php echo esc_html($page->content); ?>
                </p>
                <a href="<?php  echo esc_url($page->link); ?>" class="btn btn-primary">
                    <?php
                    ?>
                    <?php echo esc_html( $page->link_text ); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; endif;
}
function construction_light_service_advance_content() {
    echo '<div class="cl-service-post-wrap">';
    $construction_light_services = json_decode(get_theme_mod('construction_light_service_advance'));
    if (!empty($construction_light_services)) {
        foreach ($construction_light_services as $construction_light_service) {
            $icon = $construction_light_service->icon;
            $title = !empty($construction_light_service->title) ? apply_filters('construction_light_translate_string', $construction_light_service->title, 'Service Block') : '';
            $content = !empty($construction_light_service->content) ? apply_filters('construction_light_translate_string', $construction_light_service->content, 'Service Block') : '';
            $link_text = !empty($construction_light_service->link_text) ? apply_filters('construction_light_translate_string', $construction_light_service->link_text, 'Service Block') : esc_html__('Read More', 'construction-light');
            $link = !empty($construction_light_service->link) ? apply_filters('construction_light_translate_string', $construction_light_service->link, 'Service Block') : '';
            $enable = 'on';
            if ($enable == 'on') {
                ?>
                <div class="cl-service-post clearfix">
                    <div class="cl-service-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                    <div class="cl-service-excerpt clearfix">
                        <h5><?php echo esc_html($title); ?></h5>
                        <div class="cl-service-text">
                            <div class="cl-service-text-inner">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                            <?php if (!empty($link)) { ?>
                                <a class="cl-service-more" href="<?php echo esc_url($link); ?>"><?php echo esc_html($link_text); ?><i class="mdi mdi-chevron-right"></i></a>
                                <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    echo '</div>';
}
function construction_light_service_default_content() {
    echo '<div class="cl-service-post-wrap">';
    $construction_light_services = json_decode(get_theme_mod('construction_light_service'));
    if (!empty($construction_light_services)) {
        foreach ($construction_light_services as $construction_light_service) {
            if (!empty($construction_light_service->service_page)):
                $service_query = new WP_Query('page_id=' . $construction_light_service->service_page);
                if ( $service_query->have_posts() ): while ( $service_query->have_posts() ): $service_query->the_post();
                    $icon = $construction_light_service->service_icon;
                    $link_text = !empty($construction_light_service->link_text) ? apply_filters('construction_light_translate_string', $construction_light_service->link_text, 'Service Block') : esc_html__('Read More', 'construction-light');
                    $enable = 'on';
                    if ($enable == 'on') {
                        ?>
                        <div class="cl-service-post clearfix">
                            <div class="cl-service-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                            <div class="cl-service-excerpt clearfix">
                                <h5><?php the_title(); ?></h5>
                                <div class="cl-service-text">
                                    <div class="cl-service-text-inner">
                                        <?php the_excerpt(  ); ?>
                                    </div>
                                    <a class="cl-service-more" href="<?php the_permalink( )?>"><?php echo esc_html($link_text); ?><i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                endwhile; endif; 
            endif;
        }
    }
    echo '</div>';
}
function construction_light_service_section() {
    if (get_theme_mod('construction_light_service_service_section') != 'on') {
        $construction_light_service_style = 'layout_three';
        $construction_light_service_bg_align = get_theme_mod('construction_light_service_bg_align', 'right');
        $service_class = array(
            $construction_light_service_style,
            'cl-bg-' . $construction_light_service_bg_align,
            'cl-section',
            'cons_light_feature',
            'cl-service-section'
        );
   
        ?>
        <section id="cl-service-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
            <div class="cl-section-wrap">
                <?php 
                    $title          = get_theme_mod('construction_light_service_title');
                    $sub_title      = get_theme_mod('construction_light_service_sub_title');
                    $bg_image = get_theme_mod('construction_light_service_img');
                    $bg_css = "";
                    if($bg_image){
                        $bg_css = "style=background-image:url(". $bg_image .")";
                    }

                    construction_light_section_title( $title, $sub_title ); 
                ?>
                <div class="cl-service-content-wrap">
                    <div class="container clearfix">
                        <div class="cl-service-posts clearfix">
                            <div class="cl-service-post-holder cl-section-content">
                                <?php
                                if ($construction_light_service_style == 'layout_three') {
                                    ?>
                                    <div class="cl-service-bg" <?php echo esc_attr($bg_css); ?>></div>
                                    <?php
                                }
                                ?>
                                <?php 
                                    if( get_theme_mod('construction_light_service_type', 'normal') == 'normal'):
                                        construction_light_service_default_content();
                                    else: 
                                        construction_light_service_advance_content();
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
add_action('construction_light_action_service_advance', 'construction_light_service_section', 45);
$layout = get_theme_mod('construction_light_service_layout', 'layout_one');
if( $layout == 'layout_one' || $layout == 'layout_two') do_action('construction_light_action_service');
else do_action('construction_light_action_service_advance'); 