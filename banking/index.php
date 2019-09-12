<?php get_header();?>
      <!-- Swiper-->
       <marquee class="marquee">Best banking services. Attractive offers. Free service &  quick response. Digital & doorstep services. Only  for Chennai Customers. Quality financial suggestion</marquee>
      <section class="block-preview slider">
        <?php 
echo do_shortcode('[smartslider3 slider=2]');
?>
      </section>

      <!-- Advantages-->
      <section class="section section-sm section-sm-1 bg-gray-100">
        <div class="container service-container text-center">
          <div class="row row-40">
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('credit-card');?>">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/credit_card.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Credit Card</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                    </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('personal-loan');?>">
                <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/Instant_Personal_Loan.svg" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Personal Loan</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                    </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('home-loan');?>">
               <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/home_loan.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Home Loan</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                    </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('mortgage-loan');?>">
                <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/Mortgage_Loan.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Mortgage loan</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                </div>
              </a>
            </div>
          </div>
          <div class="row row-40">
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('home-loan');?>">
                <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/Loan-Against-Property-icon.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Home loan for Cash salary/Without ITR</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('home-loan');?>">
                <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/home-loan-construction-icon.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Construction loan(without plan approval)</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
             <a href="<?= site_url('home-loan');?>">
                <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/house-symbol.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">Home Loan for patta property</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Apply Now</h3> 
                        </div>
                      </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <a href="<?= site_url('emi-calculator');?>">
                <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="<?php bloginfo('template_url');?>/images/emi_calculator.png" alt="" style="width:100px;height:90px;">
                          <div class="subtitle">EMI Calculator</div> 
                        </div>
                        <div class="flip-card-back">
                          <h3>Check EMI</h3> 
                        </div>
                      </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div>
          <div>
            <div class="text-center review-btns">
              <a class="button button-primary button-lg" id="testimonial" href="#">Write about Us</a>
              <a class="button button-primary button-lg" id="referbtn" href="#">Refer your Friends and Earn</a>
            </div>
          </div>
        </div> 
      </section>   

      <!-- Advantages-->
      <section class="section section-sm section-sm-2 bg-primary-gradient">
        <div class="container text-center">
          <div class="row row-30">
            <div class="col-md-6 col-lg-3 wow fadeInRight">
              <div class="list-icon list-icon-white">
                <div class="list-icon-title"><span class="icon-item thin-icon-map-marker"></span>
                  <div class="title">Various Locations</div>
                </div>
                <div class="list-icon-body">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.</div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInRight" data-wow-delay="0.1s">
              <div class="list-icon list-icon-white">
                <div class="list-icon-title"><span class="icon-item thin-icon-mobile"></span>
                  <div class="title">Mobile Banking Apps</div>
                </div>
                <div class="list-icon-body">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.</div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInRight" data-wow-delay="0.2s">
              <div class="list-icon list-icon-white">
                <div class="list-icon-title"><span class="icon-item mercury-icon-social"></span>
                  <div class="title">Family Programs</div>
                </div>
                <div class="list-icon-body">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.</div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInRight" data-wow-delay="0.3s">
              <div class="list-icon list-icon-white">
                <div class="list-icon-title"><span class="icon-item thin-icon-support"></span>
                  <div class="title">24/7 Support</div>
                </div>
                <div class="list-icon-body">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Call to action-->
      <section class="section parallax-container section-xs context-dark parallax-primary-gradient" data-parallax-img="images/parallax-1.jpg">
        <div class="parallax-content">
          <div class="container">
            <div class="box-cta">
              <div class="box-cta-inner">
                <h3>Choose Your <span class="font-weight-bold">Bank Card</span> Now!</h3>
              </div>
              <div class="box-cta-inner"><a class="button button-lg button-white" href="#">Order Card</a></div>
            </div>
          </div>
        </div>
      </section>

      <!-- A Few Words About Us-->
      <section class="section section-lg section-image-relative bg-gray-100">
        <div class="container text-center text-xl-left">
          <div class="row justify-content-center justify-content-xl-start">
            <div class="col-md-10 col-xl-6">
              <div class="text-block-3">
                <h2 class="wow fadeIn">A Few Words About Us</h2>
                <h6 class="wow fadeIn">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h6>
                <p class="wow fadeIn">Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum has been the industry's standard dummy text ever since the 1500s,.</p>
              </div>
              <div class="row row-xs-center row-30 text-center">
                <div class="col-6 col-sm-4">
                  <!-- Circle Progress Bar-->
                  <div class="progress-bar-circle" data-value="0.25" data-gradient="#00db8e" data-empty-fill="rgba(0,0,0,.1)" data-size="96" data-thickness="2"><span></span></div>
                  <p class="progress-bar-circle-title">Economy</p>
                </div>
                <div class="col-6 col-sm-4">
                  <!-- Circle Progress Bar-->
                  <div class="progress-bar-circle" data-value="0.5" data-gradient="#00db8e" data-empty-fill="rgba(0,0,0,.1)" data-size="96" data-thickness="2"><span></span></div>
                  <p class="progress-bar-circle-title">Cashback</p>
                </div>
                <div class="col-sm-4">
                  <!-- Circle Progress Bar-->
                  <div class="progress-bar-circle" data-value="0.75" data-gradient="#00db8e" data-empty-fill="rgba(0,0,0,.1)" data-size="96" data-thickness="2"><span></span></div>
                  <p class="progress-bar-circle-title">Stability</p>
                </div>
              </div><a class="button button-primary button-lg" href="#">Learn More</a>
            </div>
          </div>
        </div><img class="img-custom" src="<?php bloginfo('template_url');?>/images/index-3-1-959x808.png" alt="" width="959" height="808"/>
      </section>
        <!-- Latest Statistical Information-->
     <!--  <section class="section">
        <div class="container">
          <div class="row row-fix align-items-end">
            <div class="col-lg-8">
              <div class="section-lg">
                <h2>Latest Statistical Information</h2>
                <div class="row row-offset-4 row-fix">
                  <div class="col-md-6">-->
                    <!-- gradient blocks-->
                    <!-- gradient primary-->
                    <!-- <svg class="svg-hidden"> -->
                      <!-- gradient-->
                      <!-- <lineargradient id="linear-gradient-primary" x1="50%" y1="30%" x2="50%" y2="100%">
                        <stop offset="0%" stop-color="#00db8e"></stop>
                        <stop offset="100%" stop-color="#fff"></stop>
                      </lineargradient>
                    </svg> -->
                    <!-- gradient secondary-->
                   <!--  <svg class="svg-hidden"> -->
                      <!-- gradient-->
                  <!--     <lineargradient id="linear-gradient-secondary" x1="50%" y1="30%" x2="50%" y2="100%">
                        <stop offset="0%" stop-color="#00db8e"></stop>
                        <stop offset="100%" stop-color="#130c37"></stop>
                      </lineargradient>
                    </svg>
                    <div class="d3-chart" id="spline-chart" style="width:100%; margin: 0 auto"></div>
                  </div>
                  <div class="col-md-6 col-xl-5">
                    <p class="text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum is simply dummy text of the printing and typesetting industry</p><a class="button button-1 button-lg button-primary" href="#">Read more</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
              <div class="wrap"><img class="d-block" src="<?php bloginfo('template_url');?>/images/index-3-2-338x507.png" alt="" width="338" height="507"/>
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <!-- Latest Blog Posts-->
      <!-- <section class="section section-lg bg-gray-100">
        <div class="container text-center">
          <h2>Latest Blog Posts</h2>
          <div class="row row-30 row-offset-4 text-left">
            <div class="col-md-6 col-lg-4 wow fadeInRight">
              <article class="post-boxed">
                <div class="post-meta">
                  <div class="post-meta-item">
                    <div class="post-author"><span>by</span> <a href="#">Martha Ryan</a>
                    </div>
                  </div>
                  <div class="post-meta-item">
                    <div class="post-date">2 days ago</div>
                  </div>
                </div><a class="media-wrapper" href="#"><img src="<?php bloginfo('template_url');?>/images/grid-blog-1-370x272.jpg" alt="" width="370" height="272"/></a>
                <div class="post-body">
                  <ul class="list-tags">
                    <li><a class="tag-1" href="#">News</a>
                    </li>
                  </ul>
                  <h6 class="post-title"><a href="#">7 Banking Services That Can Save Retirees Money</a></h6>
                  <p class="post-exeption">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,...</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInRight" data-wow-delay="0.1s">
              <article class="post-boxed">
                <div class="post-meta">
                  <div class="post-meta-item">
                    <div class="post-author"><span>by</span> <a href="#">Martha Ryan</a>
                    </div>
                  </div>
                  <div class="post-meta-item">
                    <div class="post-date">2 days ago</div>
                  </div>
                </div><a class="media-wrapper" href="#"><img src="<?php bloginfo('template_url');?>/images/grid-blog-2-370x272.jpg" alt="" width="370" height="272"/></a>
                <div class="post-body">
                  <ul class="list-tags">
                    <li><a class="tag-1" href="#">News</a>
                    </li>
                  </ul>
                  <h6 class="post-title"><a href="#">Stocks Could Surge Another 10% Between Now And 2018</a></h6>
                  <p class="post-exeption">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,...</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInRight" data-wow-delay="0.2s">
              <article class="post-boxed">
                <div class="post-meta">
                  <div class="post-meta-item">
                    <div class="post-author"><span>by</span> <a href="#">Martha Ryan</a>
                    </div>
                  </div>
                  <div class="post-meta-item">
                    <div class="post-date">2 days ago</div>
                  </div>
                </div><a class="media-wrapper" href="#"><img src="<?php bloginfo('template_url');?>/images/grid-blog-3-370x272.jpg" alt="" width="370" height="272"/></a>
                <div class="post-body">
                  <ul class="list-tags">
                    <li><a class="tag-1" href="#">News</a>
                    </li>
                  </ul>
                  <h6 class="post-title"><a href="#">Wall Street Analysts Are Nailing It This Year</a></h6>
                  <p class="post-exeption">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,...</p>
                </div>
              </article>
            </div>
          </div>
          <div class="button-wrap-lg"><a class="button button-lg button-primary" href="#">View All Blog Posts</a></div>
        </div>
      </section>  -->
    <!-- Testimonials-->
      <section class="section section-lg">
        <div class="container text-center">
          <h2>Testimonials</h2>
          <?php  echo do_shortcode('[testimonial_view id="1"]'); ?>
           
        </div>
      </section>

      <!-- Subscribe to Our Newsletter-->
      <section class="section section-sm bg-primary-gradient context-dark text-center">
        <div class="container">
          <div class="row row-20 justify-content-md-center">
            <div class="col-md-9 col-lg-6 col-xxl-7">
              <h3>Subscribe for <span class="font-weight-bold">News and Updates</span></h3>
            </div>
            <?php echo do_shortcode('[email-subscribers-form id="1"]');?>
            <!-- <div class="col-md-8 col-lg-5 col-xxl-4">             
              <form class="rd-form rd-mailform rd-form-inline-2" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="#">
                <div class="form-wrap">
                  <input class="form-input" id="subscribe-form-0-email" type="email" name="email" data-constraints="@Email @Required"/>
                  <label class="form-label" for="subscribe-form-0-email">Enter your e-mail</label>
                </div>
                <button class="form-icon-button mdi mdi-email-outline" type="submit"></button>
              </form>
            </div> -->
          </div>
        </div>
      </section>

    
     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
          <h4 class="modal-title">Write about us</h4>
        </div>
        <div class="modal-body"> 
          <?php  echo do_shortcode('[testimonial_view id="2"]'); ?>
                 
        </div>


    </div>

 </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="refer">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
          <h4 class="modal-title"><b>Refer Your Friends and Relatives</b></h4>
        </div>
        <div class="modal-body" ng-controller="ReferController">
          <div ng-if="pageInfo.enquirydone">
            <p>Thank you for your referral we will get in touch with you shortly!</p>
          </div>
          <form ng-if="!pageInfo.enquirydone" name="pageInfo.referform" method="post" ng-class="{formSubmitted: pageInfo.formSubmitted}">
            <div class="row">
              <div class="col-sm-6">
                <div>
                  <h4 class="margin-bottom">Your Details</h4>
                </div>
                 <div class="form-wrap">
                   <input type="text" ng-model="newEnquiry.name" class="form-control" name="username" placeholder="Your Name" required=" ">                 
                  </div>
                <div class="form-wrap">
                   <input type="email" ng-model="newEnquiry.email" class="form-control" name="email" placeholder="Enter your e-mail" required="">                 
                  </div>
                  <div class="form-wrap">
                   <input type="text" ng-model="newEnquiry.phone" class="form-control" name="phone number" placeholder="Enter your Phone number" required="">                 
                  </div>
              </div>
              
              <div class="col-sm-6">
                <div>
                  <h4 class="margin-bottom">Referral details</h4>
                </div>
                 <div class="form-wrap">
                    <input type="text" ng-model="newEnquiry.name2" class="form-control" name="username2" placeholder="Referral name" required=" ">                 
                  </div>
                <div class="form-wrap">
                    <input type="email" ng-model="newEnquiry.email2" class="form-control" name="email2" placeholder="Enter referral e-mail" required="">                 
                  </div>
                  <div class="form-wrap">
                   <input type="text" ng-model="newEnquiry.phone2" class="form-control" name="phone2" placeholder="Enter referral Phone number" required="">                 
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-sm-12 form-wrap">
                  <textarea ng-model="newEnquiry.more" name="more" class="form-control" required placeholder="Tell us more about your referral "></textarea>                
                  </div>
              </div>
              
            
            <div class="text-center padding">
                <button class="button button-sm button-primary" ng-click="submitForm();" type="submit">Submit</button>
              </div>
        </form> 
                     
            </div>


    </div>

 </div>
</div>



 <?php get_footer(); ?>
