<?php /* Template Name: creaditcard */ ?>

<?php get_header();?>


 <section class="section section-bredcrumbs">
        <div class="container context-dark breadcrumb-wrapper">
          <h1>CREDIT CARD</h1>
          <ul class="breadcrumbs-custom">
            <li><a href="index.html">Home</a></li>           
            <li class="active">Cridit Card</li>
          </ul>
        </div>
      </section>
    <section>
         <div class="container">
     <div class="row">
     <div class="col-sm-12">
    <div class="content">
<h3>What is Lorem Ipsum?</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised 
in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
          <h4 class="modal-title">CREDIT CARD</h4>
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
                        <p><b>Do you have any existing Credit card?</b></p>	
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
                        <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " class="selectpicker w-100">
			                <option>United Kingdom</option>
			                <option>United States</option>
			                <option>France</option>
			                <option>Germany</option>
			                <option>Italy</option>
			            </select>               
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
            <button class="button button-sm button-primary" data-dismiss="modal" type="submit">Send</button>
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
      });
$(function () {
$('.selectpicker').selectpicker();
});
</script>

