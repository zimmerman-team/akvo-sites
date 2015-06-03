<?php
if (is_page('contact')  && (function_exists( 'ninja_forms_display_form' ) ) ) {
    $test = true;
    ?><div class="col-md-9 article"><?php
}
else {
    $test = false;
    ?><div class="col-md-12 article"><?php
}
?>

	<div class="bg">
        <div class="main-image">
        <?php the_post_thumbnail( 'large' ); ?>
        <?php
            $map = get_post_meta( get_the_ID(), '_map_option_address', true );
            if(!empty($map)) {
                flexmap_show_map(array(
                    'width' => '100%',
                    'height' => '400px',
                    'address' => $map
                ));
            } 
        ?>
        </div>

        <div class="row">
            <?php if ($test == false) { ?>
            <div class="col-lg-6 col-lg-offset-3">
            <?php } else { ?>
            <div class="col-lg-8 col-lg-offset-2">
            <?php } ?>
            	<?php use Roots\Sage\Titles; ?>
        		<h1><?= Titles\title(); ?></h1>
            </div>
            <div class="col-lg-8 col-lg-offset-2">
                <div class="meta single"></div>
            </div>
            <?php if ($test == false) { ?>
            <div class="col-lg-6 col-lg-offset-3">
            <?php } else { ?>
            <div class="col-lg-8 col-lg-offset-2">
            <?php } ?>
                <div class="entry-content">
                 	<?php the_content(); ?>
                </div>
            </div>
        </div>
	</div>
</div>

<?php

if ($test == true) {
    ?>
<div class="col-md-3 article form">
    <div class="bg">
        <h4>Contact us</h4>
        <?php ninja_forms_display_form( 1 ); ?>
    </div>
</div>

    <?php
}

?>