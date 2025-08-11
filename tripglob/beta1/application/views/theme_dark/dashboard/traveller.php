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

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

  <!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/header'); ?>
  
<div class="clearfix"></div>


<div class="full onlycontent">
<div class="container martopbtm">
        	<div class="padding20me">
            
                <div class="col-md-3">
          
              <div class="profileusrs">
                <div class="lodrefrentrev imgLoader">
                  <div class="centerload"></div>
                </div>
                
                <div class="cntbl">
                    <a href="http://192.168.0.145/transion//dashboard/profile" class="profiledash">
                      <img class="profile_photo" alt="" src="http://192.168.0.145/transion/assets/theme_dark/images/user-avatar.jpg"> 
                    
                    <div class="overlaychange">
                        <span class="chngers">Change Photo</span>
                      <form enctype="multipart/form-data" method="POST" action="http://192.168.0.145/transion/dashboard/update_user_profile_image" id="myForm">
                        <input type="file" value="Upload Photo" id="profilePhoto" name="profilePhoto" class="rschange">  
                      </form>
                    </div>
                    </a>
                </div>
                
                
              </div>
              <div class="userprowrp">
              	<h3 class="proname">asdadas</h3>
          	  </div>
          
          <div class="clear"></div>
          <ul class="sideul">
            <li class="sidepro">
              <a class="dshbrdLnk">Dashboard</a>
            </li>
            <li class="sidepro">
              <a class="dshbrdLnk">Profile</a>
            </li>
            <li class="sidepro">
              <a class="dshbrdLnk">Traveller Info</a>
            </li>
      
          </ul>
        </div>
                
                <div class="col-md-9 col-xs-12 nopad">
                	<div class="trvlwrap">
                    	<span class="size16 padtabne bold">Travellers Details</span>
                        <div class="rowit">
                            <div class="topbokshd">
                                <a class="addbutton">Add Traveller</a>
                            </div>
                            <div class="travemore mrgbtm">
                                <div class="othinformtn">
                            <ul class="nav nav-tabs tabssyb" role="tablist">
                                <li data-role="presentation" class="active">
                                    <a href="#useinform" data-aria-controls="home" data-role="tab" data-toggle="tab">User  <span class="notin">Information</span></a>
                                </li>
                                <li data-role="presentation" class="">
                                    <a href="#passportinfo1" data-aria-controls="home" data-role="tab" data-toggle="tab">Passport  <span class="notin">Information</span></a>
                                </li>
                                <li data-role="presentation" class="">
                                    <a href="#visainfo1" data-aria-controls="home" data-role="tab" data-toggle="tab">Visa  <span class="notin">Information</span></a>
                                </li>
                               
                             </ul>
                             
                             
                             <div class="tab-content tab-content1">
                             
                             <div role="tabpanel" class="tab-pane active" id="useinform">
                                    <div class="infowone">
                                        <div class="paspertorgnl paspertedit">
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Name</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Type</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">DOB</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Email</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            <a class="savepspot">Save</a>
                                            <a class="cancelll">Cancel</a>
    
                                        </div>
                                    </div>                                    
                                 </div>
                             
                                <div role="tabpanel" class="tab-pane" id="passportinfo1">
                                    <div class="infowone">
                                        <div class="paspertorgnl paspertedit">
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Name</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Nationality</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Expiry Date</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Passport Number</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Issuing Country</div>
                                                    <div class="lablmain cellpas">
                                                        <div class="selectwrp custombord">
                                                          <select class="custmselct">
                                                            <option selected>Select Country</option>
                                                            <option>Standard</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <a class="savepspot">Save</a>
                                            <a class="cancelll">Cancel</a>
    
                                        </div>
                                    </div>                                    
                                 </div>
                                 
                                 
                                 <div role="tabpanel" class="tab-pane" id="visainfo1">
                                    <div class="infowone">
                                        <div class="paspertorgnl paspertedit">
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Name</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Expiry Date</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Visa Number</div>
                                                    <div class="lablmain cellpas">
                                                        <input type="text" class="clainput" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 margpas">
                                                <div class="tnlepasport">
                                                    <div class="paspolbl cellpas">Issuing Country</div>
                                                    <div class="lablmain cellpas">
                                                        <div class="selectwrp custombord">
                                                          <select class="custmselct">
                                                            <option selected>Select Country</option>
                                                            <option>Standard</option>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <a class="savepspot">Save</a>
                                            <a class="cancelll">Cancel</a>
    
                                        </div>
                                    </div>                                    
                                 </div>
                                 
                              </div>
                             
                        </div>
                            </div>
                            <div class="fulltable">
                            
                                <div class="trow tblhd">
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Name</span>
                                    </div>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">Type</span>
                                    </div>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">DOB</span>
                                    </div>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Email</span>
                                    </div>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">Action</span>
                                    </div>
                                </div>
                                
                                <div class="trow">
                                    <span class="lavltrs">Name</span>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Ruby</span>
                                    </div>
                                    <span class="lavltrs">Type</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">ADT</span>
                                    </div>
                                    <span class="lavltrs">DOB</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">1991-11-04</span>
                                    </div>
                                    <span class="lavltrs">Email</span>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Ruby@provab.com</span>
                                    </div>
                                    <span class="lavltrs">Action</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">
                                            <a class="detilac" data-toggle="collapse" data-target="#collapse101" aria-expanded="true">Detail</a>
                                            <a class="fa fa-trash-o"></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                
                                
                                <div id="collapse101" class="collapse">
                                    <div class="travemore">
                                        <div class="othinformtn">
                                    <ul class="nav nav-tabs tabssyb" role="tablist">
                                        <li data-role="presentation" class="active">
                                            <a href="#useinform" data-aria-controls="home" data-role="tab" data-toggle="tab">User  <span class="notin">Information</span></a>
                                        </li>
                                        <li data-role="presentation" class="">
                                            <a href="#passportinfo1" data-aria-controls="home" data-role="tab" data-toggle="tab">Passport  <span class="notin">Information</span></a>
                                        </li>
                                        <li data-role="presentation" class="">
                                            <a href="#visainfo1" data-aria-controls="home" data-role="tab" data-toggle="tab">Visa  <span class="notin">Information</span></a>
                                        </li>
                                       
                                     </ul>
                                     
                                     
                                     <div class="tab-content">
                                     
                                     <div role="tabpanel" class="tab-pane active" id="useinform">
                                            <div class="infowone">
                                                <div class="paspertorgnl">
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Name</div>
                                                            <div class="lablmain cellpas">Ruby</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Type</div>
                                                            <div class="lablmain cellpas">ADT</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">DOB</div>
                                                            <div class="lablmain cellpas">2022-11-09</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">PEmail</div>
                                                            <div class="lablmain cellpas">Ruby@gmail.com</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="clearfix"></div>
                                                    <a class="editpasport">Edit</a>
    
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="paspertorgnl paspertedit">
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Name</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Type</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">DOB</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Email</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="clearfix"></div>
                                                    <a class="savepspot">Save</a>
                                                    <a class="cancelll">Cancel</a>
    
                                                </div>
    
                                                
                                                
                                            </div>                                    
                                         </div>
                                     
                                        <div role="tabpanel" class="tab-pane" id="passportinfo1">
                                            <div class="infowone">
                                                <div class="paspertorgnl">
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Name</div>
                                                            <div class="lablmain cellpas">Ruby</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Nationality</div>
                                                            <div class="lablmain cellpas">India</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Expiry Date</div>
                                                            <div class="lablmain cellpas">2022-11-09</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Passport Number</div>
                                                            <div class="lablmain cellpas">KO99966</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Issuing Country</div>
                                                            <div class="lablmain cellpas">India</div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <a class="editpasport">Edit</a>
    
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="paspertorgnl paspertedit">
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Name</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Nationality</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Expiry Date</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Passport Number</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Issuing Country</div>
                                                            <div class="lablmain cellpas">
                                                                <div class="selectwrp custombord">
                                                                  <select class="custmselct">
                                                                    <option selected>Select Country</option>
                                                                    <option>Standard</option>
                                                                  </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <a class="savepspot">Save</a>
                                                    <a class="cancelll">Cancel</a>
    
                                                </div>
    
                                                
                                                
                                            </div>                                    
                                         </div>
                                         
                                         
                                         <div role="tabpanel" class="tab-pane" id="visainfo1">
                                            <div class="infowone">
                                                <div class="paspertorgnl">
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Nmae</div>
                                                            <div class="lablmain cellpas">Ruby</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Expiry Date</div>
                                                            <div class="lablmain cellpas">2022-11-09</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Visa Number</div>
                                                            <div class="lablmain cellpas">KO99966</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Issuing Country</div>
                                                            <div class="lablmain cellpas">India</div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <a class="editpasport">Edit</a>
    
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="paspertorgnl paspertedit">
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Name</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Expiry Date</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Visa Number</div>
                                                            <div class="lablmain cellpas">
                                                                <input type="text" class="clainput" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 margpas">
                                                        <div class="tnlepasport">
                                                            <div class="paspolbl cellpas">Issuing Country</div>
                                                            <div class="lablmain cellpas">
                                                                <div class="selectwrp custombord">
                                                                  <select class="custmselct">
                                                                    <option selected>Select Country</option>
                                                                    <option>Standard</option>
                                                                  </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <a class="savepspot">Save</a>
                                                    <a class="cancelll">Cancel</a>
    
                                                </div>
    
                                                
                                                
                                            </div>                                    
                                         </div>
                                         
                                      </div>
                                     
                                </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                <div class="trow">
                                    <span class="lavltrs">Name</span>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Ruby</span>
                                    </div>
                                    <span class="lavltrs">Type</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">ADT</span>
                                    </div>
                                    <span class="lavltrs">DOB</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">1991-11-04</span>
                                    </div>
                                    <span class="lavltrs">Email</span>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Ruby@provab.com</span>
                                    </div>
                                    <span class="lavltrs">Action</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">
                                            <a class="detilac" data-toggle="collapse" data-target="#collapse101" aria-expanded="true">Detail</a>
                                            <a class="fa fa-trash-o"></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="trow">
                                    <span class="lavltrs">Name</span>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Ruby</span>
                                    </div>
                                    <span class="lavltrs">Type</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">ADT</span>
                                    </div>
                                    <span class="lavltrs">DOB</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">1991-11-04</span>
                                    </div>
                                    <span class="lavltrs">Email</span>
                                    <div class="col-xs-3 tblpad">
                                        <span class="lavltr">Ruby@provab.com</span>
                                    </div>
                                    <span class="lavltrs">Action</span>
                                    <div class="col-xs-2 tblpad">
                                        <span class="lavltr">
                                            <a class="detilac" data-toggle="collapse" data-target="#collapse101" aria-expanded="true">Detail</a>
                                            <a class="fa fa-trash-o"></a>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        	
        </div>
    </div>
</div>

<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>



<script>




</script>
</body>
</html>
