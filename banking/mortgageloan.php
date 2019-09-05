<?php /* Template Name: mortgage-loan */ ?>

<?php get_header();?>


 <section class="section section-bredcrumbs">
        <div class="container context-dark breadcrumb-wrapper">
          <h1><?php the_title(); ?></h1>
          <ul class="breadcrumbs-custom">
            <li><a href="index.html">Home</a></li>           
            <li class="active">Mortgage Loan</li>
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

 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
          <h4 class="modal-title">Mortgage Loan</h4>
        </div>
        <div class="modal-body"> 
          <h5><b>Get the best Loan that suits your requirement</b></h5>

              <div class="row">
                 <div class="col-sm-6">
                          <div class="form-wrap">
                            <input class="form-control" placeholder="Name as per PAN Card" id="name" type="text" name="name" required>                
                          </div>
                </div>
                <div class="col-sm-6">
                          <div class="form-wrap">
                            <p><b>Gender</b>
                              <label class="rediobtn">Male
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                              </label>
                              <label class="rediobtn">Female
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                              </label></p> 
                          </div>
                  </div>
              </div>
              <div class="row">
                 <div class="col-sm-6">
                          <div class="form-wrap">
                            <input class="form-control" placeholder="Date of Birth" type="text" onfocus="(this.type='date')" id="dob"  name="dob" required>                
                          </div>
                </div>
                <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" placeholder="Where do you stay in Chennai(Pincode)" id="pin" type="text" name="pin" required>                
                      </div>
                </div>
              </div>
              <div class="row">       
                  <div class="col-sm-6">
                      <div class="form-wrap">
                        <select class="form-control" required>
                          <option disabled selected>Occupation Type</option>
                          <option>Salaried</option>
                          <option>Self Employed</option>
                          <option>Unemployed</option>
                          <option>Retired</option>
                          <option>Student</option>
                          <option>Home Maker</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" placeholder="Company I Work for" id="Company" type="text" name="Company" required>                
                      </div>
                </div>
                <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" placeholder="Latest Year Income after Tax" id="income" type="text" name="income" required>  
                      </div>
                </div>
              </div>
              <div class="row">
                    
                    <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" id="income" placeholder="Monthly Income" type="text" name="monthly" required>                  
                      </div>
                    </div>
                    <div class="col-sm-6">
                          
                      <div class="form-wrap">
                        <select class="form-control" required>
                          <option disabled selected>I receive Salary By</option>
                          <option>Cash</option>
                          <option>Cheque</option>
                          <option>Bank Transfer</option>
                        </select>
                      </div>
                    </div>
              </div>

      		    <div class="row">
          		      <div class="col-sm-6">
                          <div class="form-wrap">
                            <input class="form-control" placeholder="Mobile No" id="mobile" type="text" name="name" required>                
                          </div>
          			    </div>
      			        <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" id="email" placeholder="Personal Email" type="email" name="email" required>                  
                      </div>
      				      </div>
      			  </div>
      			<div class="row">
      		   
      			<div class="col-sm-6">
                      <div class="form-wrap">
                        <p><b>Are you paying any monthly EMI?</b></p>	
                          <label class="rediobtn">Yes
                            <input type="radio" checked="checked" name="radio">
                            <span class="checkmark"></span>
                          </label>
                          <label class="rediobtn">No
                            <input type="radio" checked="checked" name="radio">
                            <span class="checkmark"></span>
                          </label>					
                      </div>
      				</div>
              <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" id="emi" placeholder="Total amount of EMIs you currently pay per month" type="text" name="emi" required>                  
                      </div>
                    </div>
      			</div>
            <div class="row">
             
            <div class="col-sm-6">
                      <div class="form-wrap">
                        <select class="form-control" required>
                          <option disabled selected>Prefered Language</option>
                          <option>Tamil</option>
                          <option>English</option>
                          <option>Others- Specify</option>
                        </select>
                      </div>
              </div>
              <div class="col-sm-6">
                      <div class="form-wrap">
                        <input class="form-control" id="language" placeholder="Type your language" type="text" name="language" required>             
                      </div>
                    </div>
            </div>
          <div>
            <p><input type="checkbox" name=""> I accept the <a href="#">Terms & conditions</a> and allow Chennai Banking to call or send message.</p>
            <button class="button button-sm button-primary" data-dismiss="modal" type="submit">Submit</button>
          </div>
				         
        </div>
    </div>

    </div>
</div>
    </div>
    <!-- Global Mailform Output-->
	    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->			
   <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
	<script>
	 $(window).load(function(){
                $('#onload').modal('show');
            });</script>