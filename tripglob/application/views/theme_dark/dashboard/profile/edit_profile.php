<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
</head>
<style>
    .deal-imgss{
    margin-top: 17px;
    width: 53%;
    margin-left: 20px;
    }
</style>
<body>
<!-- Navigation --> 
<?php if($this->session->userdata('user_type')=='1'){
  echo $this->load->view(PROJECT_THEME.'/common/header');
}else{
  echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
} ?>
<div class="clearfix"></div>
<div class="dash-img"> 
</div>
<div class="container">
<div class="dashboard_section">
<div class="col-md-12 nopad">
<!--sidebar start-->
<aside class="aside col-md-3"> <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?> </aside>
<!--sidebar end--> 

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad edit-prof">
  <section class="wrapper">
   
   <h3 class="lineth">Edit Profile</h3>
  <div class="col-md-2 custom-nav side-nav">
  <ul>
  <li id="all"><a href="<?php echo WEB_URL; ?>dashboard/profile" class="<?php echo $status_profile; ?>"> 
  <i class="fal fa-user "></i> Contact Details</a></li>
  <!--  <li id="Flight">
    <a href="<?php echo WEB_URL; ?>dashboard/profile/Contact"><i class="fal fa-ticket"></i> Passport Information</a>
  </li>

   <li id="Hotel">
    <a href="<?php echo WEB_URL; ?>dashboard/profile/Preferences"><i class="fal fa-building"></i> Preferences</a>
  </li> -->
  </ul>
</div>
    <div class="col-lg-8 col-xs-8 main-chart">

      
      <div class="editmsg" style="display:none;"></div>
      <div  id="editpro">
        <ul class="nav nav-tabs profile_tab hide">
          <li class="active"> <a href="#edit_profile" data-toggle="tab"><span class="fa fa-pencil"></span>Edit Profile</a> </li>
          <li > <a href="#billing_address" data-toggle="tab"><span class="fa fa-file"></span>Billing Address</a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="edit_profile">
            <div class="tab_inside_profile">
            <!-- <span class="profile_head">Edit Profile</span>-->
              <form id="editprofile" method="post" name="editprofile" action="<?php echo WEB_URL;?>dashboard/updateProfile">
                 <div class="tab-content">
          <div class="tab-pane active" id="edit_profile">
            <div class="tab_inside_profile"> <span class="profile_head">Edit Profile</span>
              <form id="editprofile" name="editprofile" action="<?php echo WEB_URL;?>dashboard/updateProfile">
                <div class="rowit">
                  <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                    <div class="prolabel">Name : </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="4" type="text" class="form-control" name="fname" placeholder="" value="<?php if($userInfo->user_type_name == 'B2B2B') echo $userInfo->c_p_name; else echo $userInfo->user_name; ?>" required/>
                    <label class="pronote">This is only shared once you have a confirmed booking with another <?php echo PROJECT_TITLE; ?> user.</label>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                    <div class="prolabel">Address :</div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <textarea class="form-control" name="address" placeholder="" required/><?php echo $address_details->address; ?></textarea>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                    <div class="prolabel">City : </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="4" type="text" class="form-control" name="city_name" placeholder="" value="<?php echo $address_details->city_name; ?>" required/>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                    <div class="prolabel">State : </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="2" type="text" class="form-control" name="state_name" placeholder="" value="<?php echo $address_details->state_name; ?>" required/>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                    <div class="prolabel">Zip Code : </div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                    <input minlength="4" type="text" class="form-control" name="zip_code" placeholder="" value="<?php echo $address_details->zip_code; ?>" required/>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                    <div class="prolabel">E-mail Address :</div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles"> <?php echo ($userInfo->user_email); ?> </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="prolabel">Phone Number</div>
                  </div>

                
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   
                   <input type="number" class="form-control"  data-rule-number="true" name="phone" value="<?php echo @
                    $userInfo->mobile_phone ?>" maxlength="15">
                    
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="prolabel">Country</div>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                    <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                      <?php foreach($getCountry as $country){?>
                      <?php 
                        $selected='';
                        if($address_details->country_code!=''){
                           if($country->country_code == $address_details->country_code){
                            $selected ="selected=selected";

                          }
                        }elseif($country->country_code==$admin_country_code){
                            $selected ="selected=selected";
                          }
                       

                      ?>
                      <option value="<?php echo $country->country_code;?>" <?php echo $selected; ?> ><?php echo $country->country_name;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-12">
                
                    <button type="submit" class="center_btn">Save</button>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-12 margbotm15"> </div>
                </div>
              </form>
            </div>
          </div>
          
          <div class="tab-pane hide" id="billing_address">
            <div class="tab_inside_profile"> 
              <span class="profile_head"> Billing Address</span>
              <div class="rowit">
              <div class="table-responsive overwidth">
                <table id="depostDatatable" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                  <thead>
                    <tr class="sortablehed">
                      <th>No</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>city</th>
                      <th>State</th>
                      <th>Zip</th>
                      <th>Country</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 1; ?>
                    <?php if(!empty($baddress_details)): ?>
                    <?php foreach($baddress_details as $k):
               
               ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $k->billing_first_name; ?></td>
                      <td><?php echo $k->billing_last_name; ?></td>
                      <td><?php echo $k->billing_email; ?></td>
                      <td><?php echo $k->billing_contact_number; ?></td>
                      <td><?php echo $k->billing_address; ?></td>
                      <td><?php echo $k->billing_city; ?></td>
                      <td><?php echo $k->billing_state; ?></td>
                      <td><?php echo $k->billing_zip; ?></td>
                      <td><?php echo $k->billing_country_id; ?></td>
                    </tr>
                    <?php $count++; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>  
              </div>
            </div>
          </div>
        </div>
              </form>
            </div>
          </div>
          
          <div class="tab-pane hide" id="billing_address">
            <div class="tab_inside_profile"> 
              <span class="profile_head"> Billing Address</span>
              <div class="rowit">
              <div class="table-responsive overwidth">
                <table id="depostDatatable" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                  <thead>
                    <tr class="sortablehed">
                      <th>No</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>city</th>
                      <th>State</th>
                      <th>Zip</th>
                      <th>Country</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 1; ?>
                    <?php if(!empty($baddress_details)): ?>
                    <?php foreach($baddress_details as $k):
							 
							 ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $k->billing_first_name; ?></td>
                      <td><?php echo $k->billing_last_name; ?></td>
                      <td><?php echo $k->billing_email; ?></td>
                      <td><?php echo $k->billing_contact_number; ?></td>
                      <td><?php echo $k->billing_address; ?></td>
                      <td><?php echo $k->billing_city; ?></td>
                      <td><?php echo $k->billing_state; ?></td>
                      <td><?php echo $k->billing_zip; ?></td>
                      <td><?php echo $k->billing_country_id; ?></td>
                    </tr>
                    <?php $count++; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-xs-4 right_side_dash">
      <div class="dash_inside">
        <div class="cntbl"> <a class="profiledash" href="<?php echo WEB_URL.'dashboard/edit_profile'; ?>"> <img src="<?php echo UPLOAD_PATH.'users/'.$userInfo->profile_picture; ?>" alt="" class="profile_photo"/>
          <div class="overlaychange"> <span class="chngers">Change Photo</span>
            <form id="myForm" action="<?php echo WEB_URL; ?>dashboard/update_user_profile_image" method="post" enctype="multipart/form-data" >
              <input class="rschange" type="file" name="profilePhoto" id="profilePhoto" value="Upload Photo">
            </form>
          </div>
          </a> </div>
      </div>
    </div>
    
  </section>
</section>
</div>
</div></div>
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<!-- Page Content --> 

<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?> 
<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?> 

<!-- Script to Activate the Carousel -->


<script src="<?php echo ASSETS; ?>js/jquery.ajaxform.js"></script>
    
<script type="text/javascript">
    $(document).ready(function() { 
        $('#profilePhoto').on('change', function() {
            $('.imgLoader').fadeIn();
            $("#myForm").ajaxForm({
                dataType: 'json',
                success: function(r) {
                  if(r.img=='failed'){
                    alert('Invalid file type, Only JPEG, JPG, GIF and PNG types are accepted.');
                  }else{

                    //$('.fstusrp').html('<img src="'+r.img+'">');
                    //$('.profileusrs').html('<img src="'+r.img+'">');
                    $('.profile_photo').attr("src", r.img);
                    $('.imgLoader').fadeOut();
                  }
                }
            }).submit();
        })

        $( "#dob" ).datepicker({
                            changeMonth: true, 
                            changeYear: true, 
                           
                     });
    }); 
</script>

<script>
$(document).ready(function() {
	
	//$('#example').DataTable();
	$('#depostDatatable').DataTable( {
		"order": [[ 1, "desc" ]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
	
  //BookingPagination();
});
		
	</script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>
</body>
</html>