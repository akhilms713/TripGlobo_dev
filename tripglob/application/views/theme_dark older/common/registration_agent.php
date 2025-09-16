<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
  .fa_anv{position: absolute;padding: 10px;}
  label.error{color: #cd1818 !important;}
</style>
</head>
<body class="noside">
<!-- Navigation --> 
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
<div class="clearfix"></div>
<div class="agent_login_wrap top80">
  <div class="container">
    <div class="inside_agent">
      <div class="col-xs-12">
        <div class="agent_registration" >
          <div id="signupfix">
            <div class="popuperror agetn_page" style="display:none;"></div>
            <div id="AgntloginLdrReg" class="lodrefrentrev imgLoader">
              <div class="centerloadangen"></div>
            </div>
              <form  id="Agentregistration" name="Agentregistration" action="<?php echo WEB_URL;?>account/agent_create" enctype="multipart/form-data">
              
              <div class="boxr">
                <div class="col-sm-2 nopad">
                  <div class="iconft"><img alt="" src="<?php echo ASSETS ?>/images/co_1.png"></div>
                </div>
                <div class="col-sm-10 nopad">
                  <div class="allflds">
                    <h3 class="fldhd ">Company Details</h3>
                    <div class="allfields">
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="text"  required name="company" id="company" class="form-control valid_company_name" placeholder="Company Name" />
                          <label style="display:none;" id="company_name_error" class="error">Please Enter Company Name</label>
                          <span class="mandatory">*</span> </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input type="text" name="iata" id="iata" class="form-control" placeholder="IATA Code" />
                        </div>
                      </div>
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="number" name="no_branch" id="no_branch" class="form-control" placeholder="No of Branches" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="boxr">
                <div class="col-sm-2 nopad">
                  <div class="iconft"><img alt="" src="<?php echo ASSETS ?>/images/co_2.png"></div>
                </div>
                <div class="col-sm-10 nopad">
                  <div class="allflds">
                    <h3 class="fldhd ">Contact Details</h3>
                    <div class="allfields">
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="text" required name="c_person" id="c_person" class="form-control valid_contact_person" placeholder="Contact Person" />
                          <label style="display:none;" id="contact_person_error" class="error">Please Enter Contact Person</label>
                          <span class="mandatory">*</span> </div>
                      </div>
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="text" required name="c_designation" id="c_designation" class="form-control valid_designation" placeholder="Designation" />
                          <label style="display:none;" id="designation_error" class="error">Please Enter Designation</label>
                          <span class="mandatory">*</span> </div>
                      </div>
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="text" required name="c_email" id="c_email" class="form-control valid_email" placeholder="Email" />
                          <label style="display:none;" id="email_error" class="error">Please Enter Email</label>
                          <span class="mandatory">*</span> </div>
                      </div>
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="text"  required name="c_phone"  class="form-control valid_phone" placeholder="Phone">
                          <label style="display:none;" id="phone_error" class="error">Please Enter Phone</label>
                          <span class="mandatory">*</span> </div>
                        <input type="hidden" value="MjAxNjAzMTcwMDA5MjQ=" name="temp_id">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="boxr">
                <div class="col-sm-2 nopad">
                  <div class="iconft"><img alt="" src="<?php echo ASSETS ?>/images/co_3.png"></div>
                </div>
                <div class="col-sm-10 nopad">
                  <div class="allflds">
                    <h3 class="fldhd ">Office Address Details</h3>
                    <div class="allfields">
                      <div class="col-sm-3 nopad">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-12  text-center ">
                              <div class="logo_uploader"> <img class="default_upload" src="<?php echo ASSETS ?>/images/upload.jpg" alt="" />
                                <input type="file"  accept=".jpg, .jpeg, .png, .gif" name="profile_picture" id="profile_picture" class="hideid_upload" />
                              </div>
                              <span class="text_file">Upload logo</span> </div>
                            <!--end .col --> 
                          </div>
                        </div>
                        <!--end .form-group --> 
                      </div>
                      <div class="col-sm-9">
                        <div class="col-xs-12 ">
                          <div class="form-group">
                            <input type="text" required="" name="o_address" id="o_address" class="form-control valid_address" placeholder="Address" />
                            <label style="display:none;" id="address_error" class="error">Please Enter Address</label>
                            <span class="mandatory">*</span> </div>
                        </div>
                        <div class="col-sm-6 ">
                          <div class="form-group">
                            <input type="text" required="" name="o_city" id="o_city" class="form-control valid_city" placeholder="City" />
                            <label style="display:none;" id="city_error" class="error">Please Enter City</label>
                            <span class="mandatory">*</span> </div>
                        </div>
                        <div class="col-sm-6 ">
                          <div class="form-group">
                            <div class="selectedwrap">
                              <select required name="country_code" id="countryCode"  class="form-control static">
                                <option value="">Select Country</option>
                                <?php foreach($country_code as $k): ?>
                                <option value="<?php echo $k->country_code; ?>"><?php echo $k->country_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <span class="mandatory">*</span> </div>
                          </div>
                        </div>
                        <div class="col-sm-6 ">
                          <div class="form-group">
                            <input type="text" required name="o_pin" id="o_pin" class="form-control valid_pin_code " placeholder="Pin Code" />
                            <label style="display:none;" id="pin_code_error" class="error">Please Enter Pin Code</label>
                            <span class="mandatory">*</span> </div>
                        </div>
                        <div class="col-sm-6 ">
                          <div class="form-group">
                            <input type="text"  required  name="contact_no"  class="form-control valid_phone_number" placeholder="Phone Number" />
                            <label style="display:none;" id="phone_number_error" class="error">Please Enter Phone Number</label>
                            <span class="mandatory">*</span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="boxr">
                <div class="col-sm-2 nopad">
                  <div class="iconft"> <img alt=""  src="<?php echo ASSETS ?>/images/co_4.png" /> </div>
                </div>
                <div class="col-sm-10 nopad">
                  <div class="allflds">
                    <h3 class="fldhd ">Access Details</h3>
                    <div class="allfields">
                      <div class="col-sm-8 ">
                        <div class="form-group">
                          <input type="email" required name="email" id="email" class="form-control valid_user_email" placeholder="User Email" />
                           <label style="display:none;" id="user_email_error" class="error">Please Enter User Email</label>
                          <span class="mandatory">*</span> </div>
                      </div>
                      <div class="col-sm-4 ">
                        <div class="form-group">
                          <input type="password"  name="pswd" required  id="password" class="form-control valid_pass" placeholder="Password" />
                          <label style="display:none;" id="regex_err_pass" class="error">Password between 5 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character</label>
                          <span class="mandatory">*</span> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2 nopad col-sm-offset-6">
                <div class="inputbtnpce">
                  <input type="submit" id="b2b_register_clk" class="btn btn_comnbtns submitlogin" value="SignUp" name="Sign up"/>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="agent_re">Already Have Account ? <a class="signinfixed" href="<?php echo WEB_URL;?>account/agent_login">SignIn</a> </div>
            <input type="hidden" name="user_type_name" value="B2B">
            </form>
          </div> 
          
          <div id="messageSentPopup" class="thankudiv_pob">
            <span class="fa fa-check-square-o"></span>
                <div class="messgae_thank">
                    <h3>Thank You</h3>
                    <p>Will Back Soonly</p>
                </div>
          </div>
          
          <div class="wrapdivs stepss" id="agentVerification">
          <div class="twostep withpadd">
        	<div class="cenerstepbox">
            <div class="popuperror" style="display:none;"></div>
            <div  class="pophed">Verify Your Account</div>
            <div class="signdiv" style="position: relative">
              <div id="AgntVeriContact" class="lodrefrentrev imgLoader">
                <div class="centerload"></div>
              </div>
              <div class="insigndiv">
                <form id="AgentVerify" name="AgentVerify" action="<?php echo WEB_URL;?>account/verifyContactDetails" method="post">
                  <input type="hidden" name="verify_id" id="verify_id" value=""  required>
                  <div class="ritpul"> <span class="veri_msg"> Enter the verification codes sent to your email </span>
                    <div class="rowput"> <span class="fa fa-envelope fa_anv"></span>
                      <input class="form-control logpadding" type="text" name="veri_email" id="veri_email" placeholder="Email OTP" required>
                    </div><br>
                    <div class="clearfix"></div>
                    <button class="btn btn_comnbtns submitlogin">Submit</button>
                    <div class="clearfix"></div>
                    <div class="dntacnt"> <a  data-toggle="modal" data-target="#facing_problem"  class="problemReceCode problemReceCode_open">If You Have Facing Any Problem?</a> </div>
                  </div>
                </form>
              </div>
            </div>
            </div>
          </div>
          </div>
          
          
          
          <div id="facing_problem" class="modal fade" role="dialog">
            <div class="modal-dialog"> 
              
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Contact Admin</h4>
                </div>
                <div class="clearfix"></div>
                <div class="modal-body">
                  <form method="POST" action="<?php echo WEB_URL.'auth/contactAdmin'; ?>" id="cntctAdmin">
                    <input type="hidden" name="vid_c" id="verify_id_c" value=""  required>
                    <div class="poprow">
                      <div class="col-md-12"> <span class="poplabel_msg">Enter your message:</span>
                        <textarea name="agentMsg" class="simtextre" id="msgId" placeholder="Enter the problem faced while receiving the verification code..." required></textarea>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                      <button class="popbutton blubutton help_btn" type="submit">Send Message</button>
                    </div>
                  </form>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Content --> 

<script type="text/javascript">

$(document).ready(function(){
    $('#b2b_register_clk').click(function() {
        var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{5,15}$/;
        var inputtxt=$('.valid_pass').val();
        var companyname = $('.valid_company_name').val();
        var contactperson = $('.valid_contact_person').val();
        var designation = $('.valid_designation').val();
        var email = $('.valid_email').val();
        var phone = $('.valid_phone').val();
        var address = $('.valid_address').val();
        var city = $('.valid_city').val();
        var pincode = $('.valid_pin_code').val();
        var phonenumber = $('.valid_phone_number').val();
        var useremail = $('.valid_user_email').val();
        var showmsg = true;
         if (inputtxt.match(decimal)) 
        { 
            $('#regex_err_pass').hide();
            
        }else{ 
            $('#regex_err_pass').show();
            showmsg = false;
        }
       
        if (companyname == '' || companyname == null) 
        { 
            $('#company_name_error').show();
            showmsg = false;
            
        }else{ 
            $('#company_name_error').hide();
          
        }
        if (contactperson == '' || contactperson == null) 
        { 
            $('#contact_person_error').show();
             showmsg = false;
        }else{ 
            $('#contact_person_error').hide();
           
        }
        
        if (designation == '' || designation == null) 
        { 
            $('#designation_error').show();
            showmsg = false;
        }else{ 
            $('#designation_error').hide();
           
        }
        
        if (email == '' || email == null) 
        { 
            $('#email_error').show();
            showmsg = false;
        }else{ 
            $('#email_error').hide();
            
        }
        
        if (phone == '' || phone == null) 
        { 
            $('#phone_error').show();
           showmsg = false;
        }else{ 
            $('#phone_error').hide();
          
        }
       
        if (address == '' || address == null) 
        { 
            $('#address_error').show();
           showmsg = false;
        }else{ 
            $('#address_error').hide();
           
        }
        
        if (city == '' || city == null) 
        { 
            $('#city_error').show();
           showmsg = false;
        }else{ 
            $('#city_error').hide();
           
        }
        
        if (pincode == '' || pincode == null) 
        { 
            $('#pin_code_error').show();
            showmsg = false;
        }else{ 
            $('#pin_code_error').hide();
           
        }
        
        if (phonenumber == '' || phonenumber == null) 
        { 
            $('#phone_number_error').show();
            showmsg = false;
        }else{ 
            $('#phone_number_error').hide();
            
        }
        
        if (useremail == '' || useremail == null) 
        { 
            $('#user_email_error').show();
             showmsg = false;
        }else{ 
            $('#user_email_error').hide();
             
        }  
        
        return showmsg;
    });
});
</script>
<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?> <?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?> 

</body>
</html>
