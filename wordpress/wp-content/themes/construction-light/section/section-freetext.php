<?php
if( 'enable' != get_theme_mod('construction_light_freetext_section','disable') ) return;


$content = get_theme_mod('construction_light_free_text');
$img = get_theme_mod('construction_light_pro_freetext_image');
$css = "";
if($img){
   $css = "style=background:url('". $img ."')";
}
?>
<section id="free-hand-text-section" class="free-hand-text-section st-py-default bg-primary-light" <?php echo esc_attr( $css ); ?>>
   <div class="container">
      <?php echo ( do_shortcode( $content ) ); ?>
   </div>
</section>
