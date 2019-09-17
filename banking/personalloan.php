<?php /* Template Name: personal-loan */ ?>

<?php get_header();?>


 <section class="section section-bredcrumbs">
        <div class="container context-dark breadcrumb-wrapper">
          <h3><?php the_title(); ?></h3>
          <ul class="breadcrumbs-custom">
            <li><a href="index.html">Home</a></li>           
            <li class="active">Personal Loan</li>
          </ul>
        </div>
</section>

<section class="que-form" >          
    <div class="container" ng-controller="CCFormController">

      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
                <h4 class="modal-title" ng-if="pageInfo.mobileVerified == 1">Thank you</h4>
                <h4 class="modal-title" ng-if="pageInfo.mobileVerified != 1">Verify OTP</h4>
              </div>
              <div class="modal-body modal-pop"> 
                {{pageInfo.mobileVerified}}
                <div ng-if="pageInfo.mobileVerified == 1">
                  <p>Mobile Number Verified, Thank you for submitting your details. Our executive will get in touch with you shortly!</p>
                </div>
                <div ng-if="pageInfo.mobileVerified == 2 || pageInfo.mobileVerified == 4">
                  <div class="form-wrap">
                  <input ng-change="verify_otp();" ng-model="pageInfo.verifyotp" class="form-control" id="otp" placeholder="Verify OTP" type="text" name="otp" required>
                  <p ng-if="pageInfo.mobileVerified == 4"><i class="fa fa-close"></i> Invalid OtP</p>            
                  </div>
                </div>
            </div>
          </div>

       </div>
      </div> 
        <div class="modal-body"> 
          <form ng-if="!pageInfo.enquirydone" name="pageInfo.enquiryform" ng-class="{formSubmitted: pageInfo.formSubmitted}" autocomplete="off" ng-init="newEnquiry.etype='<?php the_title(); ?>'">
            <h5><b>Get the best Loan that suits your requirement by filling the below Details.</b></h5>
              <div class="row">
                     <div class="col-sm-6">
                              <div class="form-wrap">
                                <label >Full Name (as per PAN Card)</label>
                                <input ng-model="newEnquiry.name" class="form-control" placeholder="Name as per PAN Card" id="name" type="text" name="name" required>                
                              </div>
                    </div>
                    <div class="col-sm-6">
                              <div class="form-wrap">
                                <label>Gender</label>
                                  <p><label class="rediobtn">Male
                                    <input ng-model="newEnquiry.gender" value="Male" type="radio" name="gender">
                                    <span class="checkmark"></span>
                                  </label>
                                  <label class="rediobtn">Female
                                    <input value="Female" type="radio"  name="gender">
                                    <span class="checkmark"></span>
                                  </label></p>
                              </div>
                      </div>
              </div>
                  <div class="row">
                        <div class="col-sm-6">
                              <div class="form-wrap">
                                <label>Mobile Number</label>
                                <input ng-model="newEnquiry.mobile" class="form-control" placeholder="Mobile No" id="mobile" type="number" name="mobile" required>
                                <p ng-if="pageInfo.mobileVerified == 2">OTP Sent to your mobile number. Please verify</p>
                                <p ng-if="pageInfo.mobileVerified == 3"><i class="fa fa-close"></i> Invalid Mobile Number</p>
                              </div>
                        </div>
                        <div class="col-sm-6">
                              <div class="form-wrap">
                                <label >Email</label>
                                <input ng-model="newEnquiry.email" class="form-control" placeholder="Enter Your email" id="email" type="text" name="email" required>                
                              </div>
                        </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                              <div class="form-wrap">
                                <label>Date of Birth</label>
                                <div ng-model="newEnquiry.dob">
                                  <select class="form-control date-select" name="date" ng-model="newEnquiry.dob[2]" required>
                                    <option value="">dd</option>
                                    <?php for($i=1;$i<=31;$i++){?>
                                    <option value="<?= $i?>"><?= $i?></option>
                                    <?php }?>
                                  </select>
                                  <select class="form-control date-select" name="month" ng-model="newEnquiry.dob[1]" required>
                                    <option value="">mm</option>
                                    <?php for($i=1;$i<=12;$i++){?>
                                    <option value="<?= $i?>"><?= $i?></option>
                                    <?php }?>
                                  </select>
                                  <select class="form-control date-select" name="year" ng-model="newEnquiry.dob[0]" required>
                                    <option value="">yyyy</option>
                                    <?php for($i=1950;$i<=date('Y');$i++){?>
                                    <option value="<?= $i?>"><?= $i?></option>
                                    <?php }?>
                                  </select>
                                </div>
                                
                                <!-- <input ng-model="newEnquiry.dob" class="form-control" placeholder="Date of Birth" type="text" onfocus="(this.type='date')" id="dob"  name="dob" ng-model="newEnquiry.gender" required>  -->               
                              </div>
                    </div>
                    <div class="col-sm-6">
                          <div class="form-wrap">
                            <label>Current Location</label>
                            <input autocomplete="off" ng-click="$event.stopPropagation();pageInfo.showcity = true" ng-model="newEnquiry.zip" class="form-control" placeholder="Where do you stay in Chennai(Pincode)" id="pin" type="text" name="pin" required> 
                            <div class="citylist" ng-show="pageInfo.showcity">
                              <span ng-repeat="city in citylist | filter: newEnquiry.zip" ng-click="setCity(city);pageInfo.showcity = false;">{{city}}</span>
                            </div>               
                          </div>
                    </div>
                  </div>
                  <div class="row">       
                      <div class="col-sm-6">
                          <div class="form-wrap">
                            <label>Occupation</label>
                            <select class="form-control" required  ng-model="newEnquiry.occupation">
                              <option value="" disabled selected>Occupation Type</option>
                              <option>Salaried</option>
                              <option>Self Employed</option>
                              <option>Unemployed</option>
                              <option>Retired</option>
                              <option>Student</option>
                              <option>Home Maker</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-sm-6" ng-if="newEnquiry.occupation == 'Salaried'">
                          <div class="form-wrap">
                            <label>Company Name</label>
                            <input ng-model="newEnquiry.company" class="form-control" placeholder="Company I Work for" id="Company" type="text" name="Company" required>                
                          </div>
                    </div>
                    <div class="col-sm-6" ng-if="newEnquiry.occupation == 'Self Employed'">
                          <div class="form-wrap">
                            <label>Latest Year Income after Tax</label>
                            <input ng-model="newEnquiry.income" class="form-control" placeholder="Latest Year Income after Tax" id="income" type="number" name="income" required onkeyup="incometext.innerHTML=convertNumberToWords(this.value)" />
                            <div id="incometext"></div>
                          </div>
                    </div>
                  </div>
                  <div class="row" ng-if="newEnquiry.occupation == 'Salaried'">
                        
                        <div class="col-sm-6">
                          <div class="form-wrap">
                            <label>Monthly Income</label>
                            <input  ng-model="newEnquiry.monthly" class="form-control" id="mincome" placeholder="Monthly Income" type="number" name="monthly" required onkeyup="mincometext.innerHTML=convertNumberToWords(this.value)" />
                            <div id="mincometext"></div>                  
                          </div>
                        </div>
                        <div class="col-sm-6">
                              
                          <div class="form-wrap">
                            <label>I receive Salary By</label>
                            <select class="form-control" required  ng-model="newEnquiry.salary_by">
                              <option value="" disabled selected>I receive Salary By</option>
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
                              <label>Do you have any existing Credit card?</label> 
                                <p><label class="rediobtn">Yes
                                  <input type="radio" ng-model="newEnquiry.cc" value="Yes" name="cc">
                                  <span class="checkmark"></span>
                                </label>
                                <label class="rediobtn">No
                                  <input type="radio" ng-model="newEnquiry.cc" value="No" name="cc">
                                  <span class="checkmark"></span>
                                </label> </p>         
                            </div>
                     </div>                      
                    <div class="col-sm-6" ng-if="newEnquiry.cc == 'Yes'">
                          <div class="form-wrap">
                             <label>Total amount of EMIs you currently pay per month</label>
                           <input ng-model="newEnquiry.creditlimit" class="form-control" id="creditlimit" placeholder="Total amount of EMIs you currently pay per month" type="number" name="creditlimit" required onkeyup="creditlimittext.innerHTML=convertNumberToWords(this.value)" />
                          <div id="creditlimittext"></div>              
                      </div>
                    </div>
                </div>

                <div class="row">                 
                  <div class="col-sm-6">
                          <div class="form-wrap">
                            <label>Language</label>
                            <select class="form-control" required ng-model="newEnquiry.language">
                              <option value="" disabled selected>Prefered Language</option>
                              <option>Tamil</option>
                              <option>English</option>
                              <option value="Others">Others- Specify</option>
                            </select>
                          </div>
                  </div>
                  <div class="col-sm-6"  ng-if="newEnquiry.language == 'Others'">
                          <div class="form-wrap">
                            <input ng-model="newEnquiry.otherlanguage" class="form-control" id="language" placeholder="Type your language" type="text" name="language" required>             
                          </div>
                        </div>
                </div>

                <div class="row">
                <div class="col-sm-12">
                  <p><input ng-model="newEnquiry.tnc" required="" type="checkbox" name="tnc" checked> I accept the <a href="#">Terms & conditions</a> and allow Chennai Banking to call or send message.</p>
                  <button class="button button-sm button-primary" ng-click="submitForm();" type="submit">Submit</button>
                </div>
              </div>
      </form>        
     </div>
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
