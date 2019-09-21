<?php /* Template Name: emi-calculator */ ?>

<?php get_header();?>

<section class="section section-bredcrumbs">
        <div class="container context-dark breadcrumb-wrapper">
          <h3><?php the_title(); ?></h3>
          <ul class="breadcrumbs-custom">
            <li><a href="<?= site_url();?>">Home</a></li>           
            <li class="active"><?php the_title(); ?></li>
          </ul>
        </div>
</section>
<section>
    <div class="container">
        <div class="content">
			<div id="ecww-widget-iframeinner" class="row"></div>
		</div>
	</div>
</section> 
	

 <?php get_footer(); ?>