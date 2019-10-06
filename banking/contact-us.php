<?php /* Template Name: contact-us */ ?>

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
     <div class="row">
     <div class="col-sm-12">
    <div class="content">
<?php

      /* Start the Loop */
      while ( have_posts() ) :
        the_post();

        the_content();

        

      endwhile; // End of the loop.
      ?>
</div>
     </div>
     </div>
     </div>
    </section> 

 <?php get_footer(); ?>
