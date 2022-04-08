<?php
$pricing = get_theme_mod('construction_light_pricing_section_disable','disable');
if( $pricing != 'enable') return;

$title      = get_theme_mod('construction_light_pricing_title');
$sub_title  = get_theme_mod('construction_light_pricing_sub_title');
$pricing    = get_theme_mod('construction_light_pricing');

?>
<section id="price-section" class="price-section st-py-default bg-primary-light home-pricing">
   <div class="container">
      <div class="row">
         <div class="col-lg-7 col-12 mx-lg-auto mb-5 text-center">
            <div class="heading-default wow fadeInUp">
               <span class="badge cl-bg-primary ttl"><?php esc_html_e('Explore', 'construction-light'); ?></span>
               <h2 class="seprate-with-span"><?php echo force_balance_tags($title); ?></h2>
               <p><?php echo esc_html($sub_title); ?></p>
            </div>
         </div>
      </div>

    <?php if( $pricing ):

        $pricing = json_decode($pricing);
    ?>
    

      <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 g-4 wow fadeInUp align-items-center">
        <?php foreach($pricing as $price):

            $pp         = get_post( $price->page );
            $title      = $pp->post_title;
            $content    = $pp->post_content;
            $icon       = $price->icon;
            $link       = get_permalink( $pp->id );
            $is_popular = $price->popular;
        ?>
         <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="pricing-item <?php if($is_popular == 1): echo 'cl-recommended';  endif;?>">
                <?php if($is_popular == 1): ?>
                <span class="cl-recommended-badge"><?php esc_html_e('Popular', 'construction-light'); ?></span>
                <?php endif; ?>
                <h3><?php echo esc_html($title); ?></h3>
                <span class="pricing-icon">
                   <i class="<?php echo esc_attr($icon); ?>"></i>
                </span>
               <div class="pricing-inner">
                  <div class="pricing-rate">
                     <span class="pricing seprate-with-sup"><?php echo esc_html( $price->price ); ?></span>
                     <p><?php echo esc_html($price->type); ?></p>
                  </div>
                  <div class="price-content">
                    <?php echo apply_filters( 'the_content', $content ); ?>
                  </div>
                  <a href="<?php echo esc_url($link); ?>" class="btn btn-primary"><?php esc_html_e('Choose Plan', 'construction-light'); ?></a>
               </div>
            </div>
         </div>
        <?php 
        if(!empty($pp)){
            //invoke post data reset here
            wp_reset_postdata();
        }
        endforeach; ?>

      </div>
    <?php endif; ?>
   </div>
</section>