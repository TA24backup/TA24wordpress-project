<?php
/**
 * Template part for displaying front page section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Construction Light
 */

 /**
 * Hook -  construction_light_action_recentwork
 *
 * @hooked construction_light_recentwork - 55
 */
/**
 *  Our Work Portfolio Section.
*/
if (! function_exists( 'construction_light_recentwork_default' ) ):

    function construction_light_recentwork_default() {

        $title = get_theme_mod('construction_light_recentwork_title');
        $sub_title = get_theme_mod('construction_light_recentwork_sub_title');

        $cons_light_portfolio_cat = get_theme_mod('construction_light_recent_work');

        $portfolio_options = get_theme_mod('construction_light_portfolio_section','enable');

        if( !empty( $portfolio_options ) && $portfolio_options == 'enable' ){
        ?>
        <section id="cl_portfolio" class="cons_ligcons_light_portfolio-section clearfix">
            <div class="container">

                <?php construction_light_section_title( $title, $sub_title ); ?>

                <?php
                    if($cons_light_portfolio_cat){
                    $cons_light_portfolio_cat_array = explode(',', $cons_light_portfolio_cat) ;
                ?>  
                    <div class="cons_light_portfolio-cat-name-list">
                        <div class="cons_light_portfolio-cat-name active" data-filter="*"><?php echo esc_html_e('All Works','construction-light'); ?></div>
                        <?php 
                            foreach ($cons_light_portfolio_cat_array as $cons_light_portfolio_cat_single) {

                                $category_slug = "";
                                $category_slug = get_category($cons_light_portfolio_cat_single);

                                if( is_object($category_slug)){

                                $category_slug = 'portfolio-'.$category_slug->term_id;
                        ?>
                                <div class="cons_light_portfolio-cat-name" data-filter=".<?php echo esc_attr($category_slug); ?>">
                                    <?php echo esc_html(get_cat_name($cons_light_portfolio_cat_single)); ?>
                                </div>

                        <?php } } ?>
                    </div>
                <?php } ?>

                <div class="cons_light_portfolio-post-wrap clearfix">
                    <div class="cons_light_portfolio-posts clearfix">
                        <?php 
                            if($cons_light_portfolio_cat){
                            $count = 1;
                            $args = array( 'cat' => $cons_light_portfolio_cat, 'posts_per_page' => -1 );
                            $query = new WP_Query($args);

                            if($query->have_posts()): while($query->have_posts()) : $query->the_post(); 

                                $categories = get_the_category();
                                $category_slug = "";
                                $cat_slug = array();

                            foreach ($categories as $category) {
                                $cat_slug[] = 'portfolio-'.$category->term_id;
                            }

                            $category_slug = implode(" ", $cat_slug);

                            if(has_post_thumbnail()){
                                $image_url = get_template_directory_uri().'/assets/images/portfolio-small-blank.png';
                                $cons_light_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'construction-light-portfolio');    
                                $cons_light_image_large = wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
                            }else{
                                $image_url = get_template_directory_uri().'/assets/images/portfolio-small.png';
                                $cons_light_image = "";
                            }

                        ?>
                            <div class="cons_light_portfolio <?php echo esc_attr($category_slug); ?>">
                                <div class="cons_light_portfolio-outer-wrap">
                                    <div class="cons_light_portfolio-wrap" style="background-image: url(<?php echo esc_url( $cons_light_image[0] ) ?>);">
                                    
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php esc_attr(get_the_title()); ?>">

                                        <div class="cons_light_portfolio-caption">

                                            <h3><?php the_title(); ?></h3>

                                            <a class="cons_light_portfolio-link" href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-link"></i></a>
                                            
                                            <?php if(has_post_thumbnail()){ ?>
                                                <a class="cons_light_portfolio-image"  href="<?php echo esc_url( $cons_light_image_large[0] ) ?>"><i class="fa fa-search"></i></a>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endwhile; endif; wp_reset_postdata(); } ?>
                    </div>
                </div>

            </div>
        </section>
    <?php } }
endif;

if( !function_exists('construction_light_recentwork_advance')){
    function construction_light_recentwork_advance(){
        $title = get_theme_mod('construction_light_recentwork_title');
        $sub_title = get_theme_mod('construction_light_recentwork_sub_title');

        $cons_light_portfolio_cat = get_theme_mod('construction_light_advance_portfolio');

        $portfolio_options = get_theme_mod('construction_light_portfolio_section','enable');

        if( !empty( $portfolio_options ) && $portfolio_options == 'enable' ){
        ?>
        <section id="cl_portfolio" class="cons_ligcons_light_portfolio-section clearfix">
            <div class="container">

                <?php construction_light_section_title( $title, $sub_title ); ?>

                <?php
                    if($cons_light_portfolio_cat){
                        $cons_light_portfolio_cat = json_decode($cons_light_portfolio_cat); ?>  
                        <div class="cons_light_portfolio-cat-name-list">
                            <div class="cons_light_portfolio-cat-name active" data-filter="*"><?php echo esc_html_e('All Works','construction-light'); ?></div>
                            <?php 
                            foreach ($cons_light_portfolio_cat as $cons_light_portfolio_cat_single) {
                                $category_slug = sanitize_title_with_dashes($cons_light_portfolio_cat_single->title); 
                                ?>

                                <div class="cons_light_portfolio-cat-name" data-filter=".<?php echo esc_attr($category_slug); ?>">
                                    <?php echo esc_html(($cons_light_portfolio_cat_single->title)); ?>
                                </div>

                            <?php } } ?>
                        </div>
                

                    <div class="cons_light_portfolio-post-wrap clearfix">
                        <div class="cons_light_portfolio-posts clearfix">
                            <?php 
                                if($cons_light_portfolio_cat){
                                    foreach ($cons_light_portfolio_cat as $cons_light_portfolio_cat_single) {
                                        $category_slug = sanitize_title_with_dashes($cons_light_portfolio_cat_single->title); 
                                        $image_url = get_template_directory_uri().'/assets/images/portfolio-small-blank.png';
                                        
                                        $gallerys = explode(',', $cons_light_portfolio_cat_single->gallery) ;
                                        foreach($gallerys as $id){
                                            $cons_light_image = wp_get_attachment_image_src($id,'construction-light-portfolio');    
                                            $cons_light_image_large = wp_get_attachment_image_src($id,'full');

                                            if($cons_light_image_large) {
                                                $url = esc_url_raw( $cons_light_image_large[0]);
                                            ?>
                                            <div class="cons_light_portfolio <?php echo esc_attr($category_slug); ?>">
                                                <div class="cons_light_portfolio-outer-wrap">
                                                    <div class="cons_light_portfolio-wrap">
                                                        <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr( wp_get_attachment_caption($id) ) ?>" class="portfolio-image">
                                                        <div class="cons_light_portfolio-caption">
                                                            <h3><?php echo esc_html( wp_get_attachment_caption($id) ) ?></h3>
                                                            <a class="cons_light_portfolio-link" href="<?php echo esc_url( $cons_light_image_large[0] ) ?>" rel="cons-portfolio[work]"><i class="fa fa-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } } 
                                    }
                                } ?>
                        </div>
                    </div>

            </div>
        </section>
    <?php } }
    
}

if( !function_exists('construction_light_recentwork')){
    function construction_light_recentwork(){
        $type = get_theme_mod('construction_light_recentwork_type', 'default');
        if( $type == 'advance'){
            construction_light_recentwork_advance();
        }else{
            construction_light_recentwork_default();
        }
    }
}


add_action('construction_light_action_recentwork', 'construction_light_recentwork', 55);

do_action('construction_light_action_recentwork');