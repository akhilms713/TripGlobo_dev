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

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

<!-- Navigation -->

<?php
 $currency_info =   $this->general_model->get_currency_info();
 ?>
<!--  Cart Starts  -->
<div class="check_out_wrap" id="check_out_wrap">
  <div class="checkout">
    <?php      
		echo $this->load->view(PROJECT_THEME.'/common/cart_checkout');
	   ?>
  </div>
</div>
<!--  Cart Ends  -->

<nav class="navbar header_background navme">
  <div class="container tophedsectn">
    <div class="col-lg-2 col-md-3 col-xs-4 smaldevice nopad">
      <div class="navbar-header myheder"> <a class="mylogo" href="<?php echo WEB_URL; ?>"><img src="<?php echo ASSETS; ?>images/logo.png" alt="" /></a> </div>
    </div>
    <div class="col-lg-10 col-md-9 col-xs-8 smaldevice nopad">
      <div class="ritsidelinks">
        <div class="ritnone">
          <div class="wrapofa">
            <div class="clikandown"> <a href="#" class="topa color_text_light">
              <div class="notipopupp"> <span class="fa fa-bell"></span> <span class="notcnty">2</span> </div>
              </a> </div>
          </div>
          <div class="wrapofa">
            <div class="clikandown"> <a href="#" class="topa color_text_light"> <span class="badgeloks">Balance <strong> $2305.00 </strong></span> </a> </div>
          </div>
          <div class="wrapofa">
            <div class="clikandown"> <a href="#" class="topa color_text_light"> <span class="badgeloks">Agent ID <strong> #AL1001 </strong></span> </a> </div>
          </div>
        </div>
        <div class="wrapofa">
          <div class="clikandown"> <a href="#" class="topa color_text_light"> <span class="dowlink"><?php echo $this->display_currency;?><b class="caret"></b></span> </a>
            <div class="custom_dropdown">
              <ul class="boot_custom_down">
                <?php foreach($currency_info as $valcurr) {	?>
                <li <?php if($this->display_currency == $valcurr->currency_code){?>class="selected"<?php }?>><a href="javascript:void(0)" onClick="ChangeCurrency(this)" data-code="<?php echo $valcurr->currency_code; ?>" data-icon="<?php echo $valcurr->currency_symbol; ?>"><strong><?php echo $valcurr->currency_code; ?></strong> - <?php echo $valcurr->currency_name; ?></a></li>
                <?php	} ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="wrapofa">
          <div class="clikandown"> <a href="#" class="topa  color_text_light"> <span class="image_country"><img src="<?php echo ASSETS; ?>images/eng.png" alt="" /></span> <span class="dowlink">English<b class="caret"></b></span> </a>
            <div class="custom_dropdown">
              <ul class="boot_custom_down">
                <li> <a href="index.html">1 Column Portfolio</a> </li>
                <li> <a href="portfolio-2-col.html">2 Column Portfolio</a> </li>
                <li> <a href="portfolio-3-col.html">3 Column Portfolio</a> </li>
                <li> <a href="portfolio-4-col.html">4 Column Portfolio</a> </li>
                <li> <a href="portfolio-item.html">Single Portfolio Item</a> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="wrapofa">
          <div class="clikandown"> <a class="topa color_text_light logindown"> <span class="usrsideimg"><img src="<?php echo ASSETS; ?>images/user_1.png" alt="" /></span>
            <div class="acontname"> My Account </div>
            </a>
            <div class="custom_dropdown">
              <?php      
					echo $this->load->view(PROJECT_THEME.'/common/login');
			   ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
<?php $error_data = $this->session->flashdata('error'); 
  if(isset($error_data) && $error_data!='')
  {
	  $error_data_v1 = json_decode($error_data);
  ?>
<div class="error_warning" style="height:90px; background:#FFFFFF">
  <div class="error_caption" ><?php echo $error_data_v1->error_caption; ?></div>
  <div class="error_message"><?php echo $error_data_v1->error_message; ?></div>
</div>
<?php
  }
  ?>
<div class="clearfix"></div>
<div class="b2b_section">
  <div class="tabforfuly">
    <div class="container">
      <div class="luxt1">
        <ul class="nav profile-tabs">
          <li class="brdli active"> <a class="dshbrdLnk" data-toggle="tab" href="#dashbord"> <span title="Dashboard" class="glyphicon glyphicon-dashboard dshbrdLnkcv"></span> <strong>Dashboard</strong> </a> </li>
          <li class="brdli"> <a class="dshbrdLnk" data-toggle="tab" href="#profile"> <span title="Your Profile" class="glyphicon glyphicon-user dshbrdLnkcv"></span> <strong>Your Profile</strong> </a> </li>
          <li class="brdli "> <a class="dshbrdLnk" data-toggle="tab" href="#bookings"> <span title="Bookings" class="glyphicon glyphicon-pushpin dshbrdLnkcv"></span> <strong>Bookings</strong> </a> </li>
          <li class="brdli dash_down "> <a class="dshbrdLnk" data-toggle="tab" href="#settings"> <span title="Settings" class="glyphicon glyphicon-cog dshbrdLnkcv"></span> <strong>Settings</strong> </a>
            <div class="custom_dropdown1">
              <ul class="boot_custom_down">
                <li class="selected"><a >My Markup</a></li>
                <li><a> Balance Alert</a></li>
                <li><a>Change Password</a></li>
                <li><a>Newsletter</a></li>
              </ul>
            </div>
          </li>
          <li class="brdli "> <a class="dshbrdLnk" data-toggle="tab" href="#chg_password"> <span title="Deposit" class=" glyphicon glyphicon-usd dshbrdLnkcv"></span> <strong>Deposit</strong> </a> </li>
          <li class="brdli "> <a class="dshbrdLnk" data-toggle="tab" href="#acc_statement"> <span title="Account Statement" class="glyphicon glyphicon-file dshbrdLnkcv"></span> <strong>Account Ledger</strong> </a> </li>
          <li class="brdli "> <a class="dshbrdLnk" data-toggle="tab" href="#spotr_ticket"> <span title="Support Ticket" class="glyphicon glyphicon-record dshbrdLnkcv"></span> <strong>Support Ticket</strong> </a> </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="container">
    <div class="conoio">
      <div class="tab-content5">
        <div id="dashbord" class="tab-pane active">
          <div class="sercharea bebaddings">
            <div class="srchinarea">
              <div class="allformst">
                <div class="fulltab_length blue_background_dark"> 
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs tabstab">
                    <li class="active"> <a data-toggle="tab" href="#flight"> <span class="sprte iconcmn icn_flt"></span>Flights </a> </li>
                    <li> <a data-toggle="tab" href="#hotel"> <span class="sprte iconcmn icn_htl"></span>Hotels </a> </li>
                    <li> <a data-toggle="tab" href="#car"> <span class="sprte iconcmn icn_car"></span>Cars </a> </li>
                  </ul>
                </div>
                <!-- Tab panes -->
                <div class="secndblak blue_background_opc">
                  <div class="tab-content custmtab">
                    <div id="flight" class="tab-pane active" novalidate="novalidate">
                      <form autocomplete="off" method="get" action="http://192.168.0.145/t9x/flight/search" accept-charset="utf-8" id="flight" name="flight">
                        <input type="hidden" value="R" id="trip_type" name="trip_type">
                        <div class="tabspl">
                          <div class="tabrow">
                            <div class="col-md-6 nopad">
                              <div class="colfrty_wdth">
                                <div class="insidety">
                                  <div class="plcetogo deprtures sidebord"> <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                    <input type="text" placeholder="Type Departure City" id="Fromflight" required="" class="normalinput Fromflight ui-autocomplete-input" name="depature" aria-required="true" autocomplete="off">
                                  </div>
                                </div>
                              </div>
                              <div class="coltwnty"> <a onclick="swap_orgin_destination()">
                                <div class="sprte frmnto rundtrp"></div>
                                </a> 
                                <!--onwyy--> 
                              </div>
                              <div class="colfrty_wdth">
                                <div class="insidety">
                                  <div class="plcetogo destinatios sidebord"> <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                    <input type="text" placeholder="Type Destination City" id="Toflight" required="" class="normalinput Toflight   ui-autocomplete-input" name="arrival" aria-required="true" autocomplete="off">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 nopad">
                              <div class="col-xs-3 padfive hafintab">
                                <div class="insidety">
                                  <div class="plcetogo datemark sidebord">
                                    <div data-date="15-02-2016" id="filterStartDate_v1"></div>
                                    <input type="text" placeholder="Departure" required="" id="Departure" class="normalinput hasDatepicker" name="depature_date" aria-required="true">
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 padfive hafintab">
                                <div class="insidety">
                                  <div class="plcetogo datemark sidebord">
                                    <input type="text" placeholder="Arrival" id="Arrival" class="normalinput validate[required] hasDatepicker" name="arrival_date">
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-4 padfive fullintab">
                                <div class="insidety">
                                  <div class="totlall iconpasngr"> <span class="remngwd"><span class="total_pax_count">1</span> passenger</span>
                                    <div class="roomcount pax_count_div">
                                      <div class="inallsn">
                                        <div class="oneroom">
                                          <div class="roomrow">
                                            <div class="celroe col-xs-4">Adults<br>
                                              <span class="agemns">(12+)</span></div>
                                            <div class="celroe col-xs-8">
                                              <div class="input-group countmore adult_count_div"> <span class="input-group-btn">
                                                <button data-field="adult" data-type="minus" disabled="disabled" class="btn btn-default btn-number" type="button"> <span class="glyphicon glyphicon-minus"></span> </button>
                                                </span>
                                                <input type="text" data-max="10" data-min="1" value="1" class="form-control input-number centertext pax_count_value" name="adult" id="adult">
                                                <span class="input-group-btn">
                                                <button data-field="adult" data-type="plus" class="btn btn-default btn-number" type="button"> <span class="glyphicon glyphicon-plus"></span> </button>
                                                </span> </div>
                                            </div>
                                          </div>
                                          <div class="roomrow">
                                            <div class="celroe col-xs-4">Children<br>
                                              <span class="agemns">(0-11)</span></div>
                                            <div class="celroe col-xs-8">
                                              <div class="input-group countmore child_count_div"> <span class="input-group-btn">
                                                <button data-field="child" data-type="minus" disabled="disabled" class="btn btn-default btn-number" type="button"> <span class="glyphicon glyphicon-minus"></span> </button>
                                                </span>
                                                <input type="text" data-max="10" data-min="0" value="0" class="form-control input-number centertext pax_count_value" name="child" id="child">
                                                <span class="input-group-btn">
                                                <button data-field="child" data-type="plus" class="btn btn-default btn-number" type="button"> <span class="glyphicon glyphicon-plus"></span> </button>
                                                </span> </div>
                                            </div>
                                          </div>
                                          <div class="roomrow">
                                            <div class="celroe col-xs-4">Infant<br>
                                              <span class="agemns">(0-2)</span></div>
                                            <div class="celroe col-xs-8">
                                              <div class="input-group countmore infant_count_div"> <span class="input-group-btn">
                                                <button data-field="infant" data-type="minus" disabled="disabled" class="btn btn-default btn-number" type="button"> <span class="glyphicon glyphicon-minus"></span> </button>
                                                </span>
                                                <input type="text" data-max="10" data-min="0" value="0" class="form-control input-number centertext pax_count_value" name="infant" id="infant">
                                                <span class="input-group-btn">
                                                <button data-field="infant" data-type="plus" class="btn btn-default btn-number" type="button"> <span class="glyphicon glyphicon-plus"></span> </button>
                                                </span> </div>
                                            </div>
                                          </div>
                                          <div class="pull-left alert-wrapper hide">
                                            <div role="alert" class="alert alert-danger"> <span class="alert-content"></span> </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-2 padfive fullintab">
                                <div class="insidety">
                                  <div class="searchsbmtfot">
                                    <input type="submit" value="search" class="searchsbmt color_text_white button_back">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="optindown">
                              <div class="col-xs-4 nopad way_full">
                                <div class="waywy_trip">
                                  <div class="smalway_trip"> <a data-name="O" class="wament_trip">One Way</a> <a data-name="R" class="wament_trip active">Round Way</a> <a data-name="M" class="wament_trip">Multi City</a> </div>
                                </div>
                              </div>
                              <div class="col-xs-6 nopad way_full">
                                <div class="togleadvnce">
                                  <div class="advncebtn">
                                    <div class="labladvnce">More options</div>
                                  </div>
                                  <div class="advsncerdch">
                                    <div class="col-xs-5 nopad">
                                      <div class="alladvnce"> <span class="remngwd">Class</span>
                                        <div class="advncedown spladvnce">
                                          <div class="inallsnnw">
                                            <div class="scroladvc"> <a class="adscrla">Economy</a> <a class="adscrla">Premium Economy</a> <a class="adscrla">Business</a> </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-5 nopad">
                                      <div class="alladvnce"> <span class="remngwd">Preferred Aireline</span>
                                        <div class="advncedown spladvnce">
                                          <div class="inallsnnw">
                                            <div class="scroladvc"> <a class="adscrla">Jet Airways</a> <a class="adscrla">Air Asia</a> <a class="adscrla">Go Air</a> </div>
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
                      </form>
                    </div>
                    <div id="hotel" class="tab-pane">
                      <div class="cmsun">Hotels - Coming soon!</div>
                    </div>
                    <div id="car" class="tab-pane">
                      <div class="cmsun">Cars - Coming soon!</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="fullofdash">
            <div class="col-xs-12 nopad">
              <ul>
                <li class="dshcol">
                  <div class="indash">
                    <div class="rountabl">
                      <div class="dashico"> <img alt="" src="<?php echo ASSETS; ?>images/dash1.png"> </div>
                    </div>
                    <div class="marwit">
                      <h3 class="dashinhed">Edit your profile</h3>
                      <p> Update name and photo, etc</p>
                    </div>
                  </div>
                </li>
                <li class="dshcol">
                  <div class="indash">
                    <div class="rountabl">
                      <div class="dashico"> <img alt="" src="<?php echo ASSETS; ?>images/dash3.png"> </div>
                    </div>
                    <div class="marwit">
                      <h3 class="dashinhed">FAQ's</h3>
                      <p> Need any help, Check our FAQ.</p>
                    </div>
                  </div>
                </li>
                <li class="dshcol">
                  <div class="indash">
                    <div class="rountabl">
                      <div class="dashico"> <img alt="" src="<?php echo ASSETS; ?>images/dash4.png"> </div>
                    </div>
                    <div class="marwit">
                      <h3 class="dashinhed">Get help</h3>
                      <p> Need any help, Check here.</p>
                    </div>
                  </div>
                </li>
                <li class="dshcol">
                  <div class="indash">
                    <div class="rountabl">
                      <div class="dashico"> <img alt="" src="<?php echo ASSETS; ?>images/dash2.png"> </div>
                    </div>
                    <div class="marwit">
                      <h3 class="dashinhed">Help Desk</h3>
                      <p> Need any help, Create the ticket and get answer immediately.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div id="profile" class="tab-pane">
          <div class="profb2b">
            <div class="col-md-3 col-xs-12">
              <div class="full_menu">
                <div class="user_dash">
                  <div class="user_image"> <img src="<?php echo ASSETS; ?>images/user.jpg" alt="" /> </div>
                  <div class="user_name">Hi <br/>
                    Tony Park</div>
                </div>
              </div>
            </div>
            <div class="col-md-9 col-xs-12">
              <div class="dashdiv">
                <h3 class="evryhead">Edit Your Profile</h3>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">First Name</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="First name">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Last Name</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Last name">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Mobile Number</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Enter the number">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Country</div>
                    <div class="lablmain cellpas">
                      <div class="selectwrp custombord">
                        <select class="custmselct">
                          <option selected="">Select Country</option>
                          <option>Standard</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Describe Yourself</div>
                    <div class="lablmain cellpas">
                      <textarea class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                <h3 class="evryhead">Billing Address</h3>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">First Name</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="First name">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Last Name</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Last name">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Mobile Number</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Enter the number">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Country</div>
                    <div class="lablmain cellpas">
                      <div class="selectwrp custombord">
                        <select class="custmselct">
                          <option selected="">Select Country</option>
                          <option>Standard</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">City</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Enter the city">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">State</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Enter the state">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 margpas">
                  <div class="tnlepasport">
                    <div class="paspolbl cellpas">Postel Code</div>
                    <div class="lablmain cellpas">
                      <input class="clainput" type="text" placeholder="Enter the postel code">
                    </div>
                  </div>
                </div>
                <a class="savepspot">Save Profile</a> </div>
            </div>
          </div>
        </div>
        <div id="bookings" class="tab-pane">
          <div class="fullofdash">
            <div class="booktble">
              <div class="col-xs-3 nopad fullbook">
                <div class="cmnsets clrcm1"> <span class="bkcount">5</span> <span class="bkcname">Overall Bookings</span> </div>
              </div>
              <div class="col-xs-3 nopad fullbook">
                <div class="cmnsets clrcm2"> <span class="bkcount">5</span> <span class="bkcname">Confirmed Bookings</span> </div>
              </div>
              <div class="col-xs-3 nopad fullbook">
                <div class="cmnsets clrcm3"> <span class="bkcount">5</span> <span class="bkcname">Cancelled Bookings</span> </div>
              </div>
              <div class="col-xs-3 nopad fullbook">
                <div class="cmnsets clrcm4"> <span class="bkcount">5</span> <span class="bkcname">Faild/Pending Bookings</span> </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 nopad">
              <div class="travemore mrgbtm">
                <div class="othinformtn">
                  <ul role="tablist" class="nav nav-tabs tabssyb">
                    <li class="active" data-role="presentation"> <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#b2bflight" aria-expanded="true"> <span class="fa fa-plane"></span>Flights </a> </li>
                    <li class="" data-role="presentation"> <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#b2bhotel" aria-expanded="false"> <span class="fa fa-bed"></span>Hotels </a> </li>
                  </ul>
                  <div class="tab-content">
                    <div id="b2bflight" class="tab-pane active" role="tabpanel">
                      <div class="infowone">
                        <h3 class="cnthead">Flight Bookings</h3>
                        <div class="fulltable">
                          <div class="trow tblhd">
                            <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                            <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                            <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                            <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                            <div class="tblpad"> <span class="lavltr">Status</span> </div>
                            <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                            <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                            <div class="tblpad"> <span class="lavltr">Action</span> </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="b2bhotel" class="tab-pane" role="tabpanel">
                      <div class="infowone">
                        <h3 class="cnthead">Hotel Bookings</h3>
                        <div class="fulltable">
                          <div class="trow tblhd">
                            <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                            <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                            <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                            <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                            <div class="tblpad"> <span class="lavltr">Status</span> </div>
                            <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                            <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                            <div class="tblpad"> <span class="lavltr">Action</span> </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
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
        <div id="settings" class="tab-pane">
          <div class="setingfull">
            <div class="col-xs-12 nopad">
              <div class="col-xs-9 nopad setrefull"> <span class="datahd">My Markup</span> <span class="dahdsec">Add Markup to your account</span> <span class="dapara">Add or update your markup for your account</span> </div>
              <div class="col-xs-3 nopad setrenone">
                <div class="setingimg"> <img alt="" src="<?php echo ASSETS; ?>images/add_markup.png"> </div>
              </div>
              <a class="btnscmn" aria-expanded="true" data-target="#addmark" data-toggle="collapse">Add Markup</a>
              <div class="clearfix"></div>
              <div id="addmark" class="collapse" aria-expanded="false" data-toggle="collapse">
                <div class="col-xs-6 nopad fsetfull"> <span class="markhds">Hotel Markup</span>
                  <div class="col-xs-8 nopad">
                    <input class="form-control" type="number">
                  </div>
                  <div class="col-xs-4"><a class="upbtn">Update</a></div>
                </div>
                <div class="col-xs-6 nopad fsetfull"> <span class="markhds">Flight Markup</span>
                  <div class="col-xs-8 nopad">
                    <input class="form-control" type="number">
                  </div>
                  <div class="col-xs-4"><a class="upbtn">Update</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="setingfull">
            <div class="col-xs-12 nopad">
              <div class="col-xs-9 nopad setrefull"> <span class="datahd">Balance Alert</span> <span class="dahdsec">Set Balance Alert to your provab account</span> <span class="dapara">You would be alerted via popup, when the credit balance</span> </div>
              <div class="col-xs-3 nopad setrenone">
                <div class="setingimg"> <img alt="" src="<?php echo ASSETS; ?>images/balance_alert.png"> </div>
              </div>
              <a class="btnscmn" aria-expanded="true" data-target="#addbalance" data-toggle="collapse">Add Balance</a>
              <div class="clearfix"></div>
              <div id="addbalance" class="collapse" aria-expanded="false" data-toggle="collapse">
                <div class="col-xs-6 nopad fsetfull"> <span class="markhds">Balance Alert</span>
                  <div class="col-xs-8 nopad">
                    <div class="selectwrp custombord">
                      <select class="custmselct">
                        <option selected="">000</option>
                        <option>0120</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4"><a class="upbtn">Update</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="setingfull">
            <div class="col-xs-12 nopad">
              <div class="col-xs-9 nopad setrefull"> <span class="datahd">Change Password</span> <span class="dahdsec">You can change your password</span> <span class="dapara">Update your current provab Password</span> </div>
              <div class="col-xs-3 nopad setrenone">
                <div class="setingimg"> <img alt="" src="<?php echo ASSETS; ?>images/change_password.png"> </div>
              </div>
              <a class="btnscmn" aria-expanded="true" data-target="#changepass" data-toggle="collapse">Change password</a>
              <div class="clearfix"></div>
              <div id="changepass" class="collapse" aria-expanded="false" data-toggle="collapse">
                <div class="col-xs-6 nopad fsetfull"> <span class="markhds">Change your password</span>
                  <div class="col-xs-12 margpas">
                    <div class="tnlepasport">
                      <div class="paspolbl cellpas">Current Password</div>
                      <div class="lablmain cellpas">
                        <input type="text" class="clainput">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 margpas">
                    <div class="tnlepasport">
                      <div class="paspolbl cellpas">New Password</div>
                      <div class="lablmain cellpas">
                        <input type="text" class="clainput">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 margpas">
                    <div class="tnlepasport">
                      <div class="paspolbl cellpas">Confirm Password</div>
                      <div class="lablmain cellpas">
                        <input type="text" class="clainput">
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12"><a class="upbtn">Update Password</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="setingfull">
            <div class="col-xs-12 nopad">
              <div class="col-xs-9 nopad setrefull"> <span class="datahd">Newsletter</span>
                <div class="squaredThree">
                  <input id="squaredThree" type="checkbox" value="None" name="check">
                  <label for="squaredThree"></label>
                </div>
                <label class="lbllbl" for="squaredThree">Check this box to receive </label>
              </div>
              <div class="col-xs-3 nopad setrenone">
                <div class="setingimg"> <img alt="" src="<?php echo ASSETS; ?>images/newsletter.png"> </div>
              </div>
            </div>
          </div>
        </div>
        <div id="chg_password" class="tab-pane">
          <div class="fullofdash">
            <div class="topbokshd">
              <h3 class="dashhed">Deposit Management</h3>
              <a class="addbutton">Add New Deposit</a> </div>
            <span class="balance">Balance Amount<strong> $2305.00 </strong></span>
            <div class="fulltable">
              <div class="trow tblhd">
                <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                <div class="tblpad"> <span class="lavltr">Status</span> </div>
                <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                <div class="tblpad"> <span class="lavltr">Action</span> </div>
              </div>
              <div class="clearfix"></div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
            </div>
          </div>
        </div>
        <div id="acc_statement" class="tab-pane">
          <div class="fullofdash">
            <div class="topbokshd">
              <h3 class="dashhed">Account Management</h3>
            </div>
            <span class="balance">Balance Amount<strong> $2305.00 </strong></span>
            <div class="fulltable">
              <div class="trow tblhd">
                <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                <div class="tblpad"> <span class="lavltr">Status</span> </div>
                <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                <div class="tblpad"> <span class="lavltr">Action</span> </div>
              </div>
              <div class="clearfix"></div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
              <div class="trow"> <span class="lavltrs">S.No</span>
                <div class="tblpad"> <span class="lavltr">1</span> </div>
                <span class="lavltrs">PNR No</span>
                <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                <span class="lavltrs">Lead Pax</span>
                <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                <span class="lavltrs">Voucher Date</span>
                <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                <span class="lavltrs">Status</span>
                <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                <span class="lavltrs">Profit</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Net Rate</span>
                <div class="tblpad"> <span class="lavltr">$230</span> </div>
                <span class="lavltrs">Action</span>
                <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
              </div>
            </div>
          </div>
        </div>
        <div id="spotr_ticket" class="tab-pane">
          <div class="fullofdash">
            <div class="topbokshd">
              <h3 class="dashhed">Support Tickets</h3>
            </div>
            <div class="col-xs-12 nopad">
              <div class="travemore mrgbtm">
                <div class="othinformtn">
                  <ul role="tablist" class="nav nav-tabs tabssyb">
                    <li class="active" data-role="presentation"> <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#b2binbox" aria-expanded="true"> Inbox </a> </li>
                    <li class="" data-role="presentation"> <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#b2bsent" aria-expanded="false"> Sent <span class="srnone">Tickets</span> </a> </li>
                    <li class="" data-role="presentation"> <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#b2bclose" aria-expanded="false"> Closed <span class="srnone">Tickets</span> </a> </li>
                    <li class="" data-role="presentation"> <a data-toggle="tab" data-role="tab" data-aria-controls="home" href="#b2badd" aria-expanded="false"> Add New <span class="srnone">Tickets</span> </a> </li>
                  </ul>
                  <div class="tab-content">
                    <div id="b2binbox" class="tab-pane active" role="tabpanel">
                      <div class="infowone">
                        <h3 class="cnthead">Inbox</h3>
                        <div class="fulltable">
                          <div class="trow tblhd">
                            <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                            <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                            <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                            <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                            <div class="tblpad"> <span class="lavltr">Status</span> </div>
                            <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                            <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                            <div class="tblpad"> <span class="lavltr">Action</span> </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="b2bsent" class="tab-pane" role="tabpanel">
                      <div class="infowone">
                        <h3 class="cnthead">Sent Tickets</h3>
                        <div class="fulltable">
                          <div class="trow tblhd">
                            <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                            <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                            <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                            <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                            <div class="tblpad"> <span class="lavltr">Status</span> </div>
                            <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                            <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                            <div class="tblpad"> <span class="lavltr">Action</span> </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="b2bclose" class="tab-pane" role="tabpanel">
                      <div class="infowone">
                        <h3 class="cnthead">Closed Tickets</h3>
                        <div class="fulltable">
                          <div class="trow tblhd">
                            <div class="tblpad"> <span class="lavltr">S.No</span> </div>
                            <div class="tblpad"> <span class="lavltr">PNR No</span> </div>
                            <div class="tblpad"> <span class="lavltr">Lead Pax</span> </div>
                            <div class="tblpad"> <span class="lavltr">Voucher Date</span> </div>
                            <div class="tblpad"> <span class="lavltr">Status</span> </div>
                            <div class="tblpad"> <span class="lavltr">Profit</span> </div>
                            <div class="tblpad"> <span class="lavltr">Net Rate</span> </div>
                            <div class="tblpad"> <span class="lavltr">Action</span> </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                          <div class="trow"> <span class="lavltrs">S.No</span>
                            <div class="tblpad"> <span class="lavltr">1</span> </div>
                            <span class="lavltrs">PNR No</span>
                            <div class="tblpad"> <span class="lavltr">BNT02F08160942</span> </div>
                            <span class="lavltrs">Lead Pax</span>
                            <div class="tblpad"> <span class="lavltr">Ruby</span> </div>
                            <span class="lavltrs">Voucher Date</span>
                            <div class="tblpad"> <span class="lavltr">Mon, 08 Feb 2016</span> </div>
                            <span class="lavltrs">Status</span>
                            <div class="tblpad"> <span class="lavltr">CONFIRMED</span> </div>
                            <span class="lavltrs">Profit</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Net Rate</span>
                            <div class="tblpad"> <span class="lavltr">$230</span> </div>
                            <span class="lavltrs">Action</span>
                            <div class="tblpad"> <span class="lavltr"> <a class="detilac">Cancel</a> </span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="b2badd" class="tab-pane" role="tabpanel">
                      <div class="infowone">
                        <h3 class="cnthead">Add New Tickets</h3>
                        <div class="col-xs-12 margpas">
                          <div class="tnlepasport">
                            <div class="paspolbl cellpas">Subject</div>
                            <div class="lablmain cellpas">
                              <div class="selectwrp custombord">
                                <select class="custmselct">
                                  <option selected="">Select Country</option>
                                  <option>Standard</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 margpas">
                          <div class="tnlepasport">
                            <div class="paspolbl cellpas">Attachment</div>
                            <div class="lablmain cellpas">
                              <input type="file" class="clainput">
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 margpas">
                          <div class="tnlepasport">
                            <div class="paspolbl cellpas">Message</div>
                            <div class="lablmain cellpas">
                              <textarea class="form-control"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 margpas">
                          <div class="tnlepasport">
                            <div class="paspolbl cellpas">&nbsp;</div>
                            <div class="lablmain cellpas"> <a class="savepspot">Add Ticket</a> </div>
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
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?> <?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?> 
<script>




</script>
</body>
</html>
