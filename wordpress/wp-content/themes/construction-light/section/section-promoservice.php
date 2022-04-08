<?php
/**
 * Template part for displaying front page section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Construction Light
 * Hook -  construction_light_action_promo_service
 * @hooked construction_light_promo_service - 30
 */

if (! function_exists( 'construction_light_promo_service' ) ):
    function construction_light_promo_service(){
        $features_options = get_theme_mod('construction_light_promoservice_section','enable');
        $style = get_theme_mod('construction_light_promoservice_style', 'style1');
        if( !empty( $features_options ) && $features_options == 'enable' ){
            $service_class = array(
                'cl-section',
                'cl-promoservice-section',
                'cons_light_feature',
                'team-list',
                $style
            );
            $type = get_theme_mod('construction_light_promoservice_bg_type');
            $bg_video           = get_theme_mod("construction_light_promoservice_bg_video", '1IaZy0sDLu0');
            if( $type == "video-bg" &&  $bg_video):
              $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
            else: 
              $video_data = '';
            endif;
            ?>
            <section id="cl-promoservice-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>" <?php echo $video_data; ?>>
                <div class="cl-section-wrap">
                    <div class="container">
                        <div class="row">
                            <?php
                                if( get_theme_mod('construction_light_promoservice_type', 'normal') == 'normal'):
                                    construction_light_promo_default_sections();
                                else:
                                    construction_light_promo_advance_sections();
                                endif; 
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } }
endif;
add_action('construction_light_action_promo_service', 'construction_light_promo_service', 30);

if(!function_exists('construction_light_promo_default_sections')):
    function construction_light_promo_default_sections(){
        $promo_service = get_theme_mod('construction_light_promo_service');
        if (!empty($promo_service)):
        $pages = json_decode($promo_service);
        foreach ($pages as $page):
        $page_id = $page->promoservice_page;
        if (!empty($page_id)):
            $service_query = new WP_Query('page_id=' . $page_id);
            if ( $service_query->have_posts() ): while ( $service_query->have_posts() ): $service_query->the_post();
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list">
            <div class="box">
                <?php if(has_post_thumbnail(  )): ?>
                <figure>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('construction-light-medium'); ?>
                    </a>
                </figure>
                <?php endif; ?>
                <div class="bottom-content">
                    <div class="icon-box">
                        <i class="<?php echo esc_html( $page->promoservice_icon ); ?>"></i>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
        <?php   endwhile;  endif; endif; endforeach; endif;
    }
endif;

if(!function_exists('construction_light_promo_advance_sections')):
    function construction_light_promo_advance_sections(){
        $promo_service = get_theme_mod('construction_light_promoservice_advance');
        if (!empty($promo_service)):
        $pages = json_decode($promo_service);
        foreach ($pages as $page):
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 feature-list">
            <div class="box">
                <?php if($page->image): ?>
                <figure>
                    <a href="<?php echo esc_url($page->link); ?>">
                        <img src="<?php echo esc_url($page->image); ?>" />
                    </a>
                </figure>
                <?php endif; ?>
                <div class="bottom-content">
                    <div class="icon-box">
                        <i class="<?php echo esc_html( $page->icon ); ?>"></i>
                    </div>
                    <h3><a href="<?php echo esc_url($page->link); ?>"><?php echo esc_html( $page->title); ?></a></h3>
                    <div> <?php echo esc_html( $page->content); ?></div>
                </div>
            </div>
        </div>
        <?php  endforeach; endif;
    }
endif;
do_action('construction_light_action_promo_service');