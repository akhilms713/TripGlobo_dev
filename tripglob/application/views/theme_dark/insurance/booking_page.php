<?php
ini_set('memory_limit', '-1');
ignore_user_abort(true);
set_time_limit(0);  
?> 
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
 
<input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url();?>">
<link rel="icon" href="<?php echo base_url(); ?>assets/theme_dark/images/favicon.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome5.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/theme_dark/css/jquery_ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/animation.css" rel="stylesheet" />
<!-- Custom Fonts -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme_dark/css/backslider.css" type="text/css" media="screen" />
<!-- <link href="<?php //echo base_url(); ?>assets/theme_dark/css/custom.css" rel="stylesheet" /> -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/custom_style.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery-1.11.0.js"></script>
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery.jsort.0.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery_ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/theme_dark/js/bootstrap.min.js"></script>
<link href="<?= ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?= ASSETS; ?>css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
<link href="<?= ASSETS; ?>css/animation.css" rel="stylesheet" />
<link href="<?= ASSETS; ?>css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="<?= ASSETS; ?>css/backslider.css" type="text/css" media="screen" />
<link href="<?= ASSETS; ?>css/custom_style.css" rel="stylesheet" />

<!-- <script src="<?= ASSETS; ?>js/jquery-1.11.0.js"></script>
   <script src="<?= ASSETS; ?>js/jquery_ui.js"></script> -->
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_search.js"></script>
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_search_result.js"></script>
 <style>
           .product-details {
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .product-name {
            font-size: 16px;
            color: #203f7c;
            margin: 0;
            font-weight: 600;
        }

        .additional-info {
            font-size: 14px;
        }

        .product-context {
            font-size: 14px;
            color: #f7b500; /* Orange color for context */
            margin: 5px 0; /* Space between the elements */
        }

        .product-info {
            font-size: 13px;
            color: #333; /* Dark gray color for additional info */
            margin: 5px 0;
        }


                /* Body Styles */
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        /* Form Title */
        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        /* Form Container */
        .form-container {
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        /* Form Header */
        .form-header {
            background-color: #f7b500;
            color: #fff;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 3px 3px 0 0;
        }

        /* Section Styles */
        .form-section {
            border-top: 1px solid #ddd;
            padding-top: 15px;
            margin-top: 15px;
        }

        .insured-name-section,
        .beneficiary-name-section,
        .additional-details-section,
        .other-details-section,
        .address-section {
            margin-bottom: 20px;
        }

        /* Label Styles */
        .insured-label,
        .beneficiary-label,
        .additional-label,
        .other-details-label,
        .address-label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Input and Select Styles */
        .insured-title,
        .insured-first-name,
        .insured-last-name,
        .beneficiary-title,
        .beneficiary-first-name,
        .beneficiary-last-name,
        .relation-insured,
        .birth-day,
        .birth-month,
        .birth-year,
        .insured-gender,
        .passport-number,
        .major-destination,
        .country,
        .address,
        .city,
        .pin-code,
        .mobile-number,
        .email-id {
            border-radius: 3px;
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        /* Focus Styles */
        .insured-title:focus,
        .insured-first-name:focus,
        .insured-last-name:focus,
        .beneficiary-title:focus,
        .beneficiary-first-name:focus,
        .beneficiary-last-name:focus,
        .relation-insured:focus,
        .birth-day:focus,
        .birth-month:focus,
        .birth-year:focus,
        .insured-gender:focus,
        .passport-number:focus,
        .major-destination:focus,
        .country:focus,
        .address:focus,
        .city:focus,
        .pin-code:focus,
        .mobile-number:focus,
        .email-id:focus {
            border-color: #f7b500;
            box-shadow: 0 0 5px rgba(247, 181, 0, 0.3);
        }

        /* Row Styles */
        .row > [class*='col-'] {
            padding-left: 5px;
            padding-right: 5px;
        }
        .PassengerDetailsInsurance{
            margin-bottom: 30px;
        }
        .PassengerDetailsInsurance .row{
            margin-left: 0px !important;
            margin-right: 0px !important;
        }


        /* -------------purchase summary css start --------------*/
        /* Purchase Summary Section */
.purchase-summary {
  border: 1px solid #ddd;
  margin-top: 15px;
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
}

.purchase-header {
  background-color: #fdb813;
  padding: 10px;
  font-weight: bold;
  color: #ffffff;
  text-align: left;
  margin-bottom: 10px;
}

.purchase-details {
  font-size: 14px;
  padding: 5px 15px;
}

.purchase-item {
  margin: 0;
  font-size: 16px;
}

.purchase-age-group,
.purchase-quantity {
  margin: 5px 0;
}

.purchase-price {
  float: right;
}

.purchase-total,
.purchase-grand-total {
  font-weight: bold;
  margin-top: 10px;
}

.purchase-amount {
  float: right;
  color: #007bff;
}

.promo-section {
    border: 1px dashed #ddd;
    padding: 10px 15px;
    margin: 6px;
}

.input-group .form-control {
  border-radius: 0;
}

.input-group-btn .btn {
  background-color: #fdb813;
  color: #ffffff;
  border-radius: 0;
}

.input-group-btn .btn:hover {
  background-color: #eaa600;
}
.InsuranceBookingPage .col-md-9{
    width: 71%;
}
.InsuranceBookingPage .col-md-3{
    width: 29%;
}
.InsuranceBookingPage{
   margin-top: 80px;
}
button.proceed-to-booking-review {
    background-color: #f7b500;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
}
.button_container_div{
    text-align: end;
}
 </style>

 <?php // debug(json_decode($get_search_data_transfer,true)); die; 
 // debug($PremiumList['MinAge']); die;
 $serch_det = json_decode($get_search_data_transfer,true);

 $pas_count =count($serch_det['pax']);

$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);

          // $keyArr = range(date("Y"), 1920);
          //                                   $valArr = array_map(function($a){return $a.'-01-01-T00:00:00';},$keyArr);
          //                                   $years = array_combine($keyArr,$valArr);
          //                                   // print_r($years); die;

          //                                   foreach ($years as $key => $value) {
          //                                       echo $value;
          //                                   } die;

 ?>
<section class="InsuranceBookingPage">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="product-details">
                    <h3 class="product-name">
                        <?php echo $PlanName; ?>
                 <!--        Sankash 250W Multi 30days 
                        <span class="additional-info">(additional 10% cashback)</span> -->
                    </h3>
                    <p class="product-context">Worldwide</p>
                    <p class="product-info">No.of Paxes: <?php echo $serch_det['pax']; ?></p>
                </div>
                <div class="PassengerDetailsInsurance">
                    <h2 class="form-title">Enter Passenger Details</h2>

               
                    <div class="form-container">
                        <?php   for ($j=0;$j<$serch_det['pax'];$j++) {    ?>
                        <div class="form-header">Passenger <?php echo $j+1; ?></div>
                          <form  autocomplete="off" action="<?php echo WEB_URL ?>insurance/Booking/<?php echo $search_id ?>" name="insurance" id="insurance" >
                            <!-- Insured Name Section -->
                            <div class="form-section insured-name-section">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label insured-label">Insured Name</label>
                                    <div class="col-sm-2">
                                        <select class="form-control insured-title" name="insured_name_title[]">
                                            <!-- <option>Title*</option> -->
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control insured-first-name" placeholder="First name*" name="Ins_f_name[]" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control insured-last-name" name="Ins_l_name[]" placeholder="Last Name*" required>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Beneficiary Name Section -->
                            <div class="form-section beneficiary-name-section">
                                <div class="form-group row">
                                    <label class="col-sm-12 control-label beneficiary-label">Beneficiary Name</label>
                                    <div class="col-sm-2">
                                        <select class="form-control beneficiary-title"  name="Beneficiary_title[]" > 
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control beneficiary-first-name" name="Benef_f_name[]" placeholder="First name*" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control beneficiary-last-name" name="Benef_l_name[]" placeholder="Last Name*" required>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Additional Details Section -->
                            <div class="form-section additional-details-section">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="additional-label">Relation to Insured*</label>
                                        <select class="form-control relation-insured" name="rel_insured[]" required>
                                            <option value="Brother">Brother</option>
                                            <option value="Child">Child</option>
                                            <option value="Employer" >Employer</option>
                                            <option value="Father" >Father</option>
                                            <option value="Legal Gardian" >Legal Gardian</option>
                                            <option value="Mother" >Mother</option>
                                            <option value="Sister" >Sister</option>
                                            <option value="Spouse" >Spouse</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="additional-label">Date of Birth*</label>
                                        <div class="row">
                                         <!--    <div class="col-xs-4">
                                                <select class="form-control birth-day" name="day[]">
                                                    <?for($i=1;$i<=31;$i++) { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control birth-month">
                                                    <?php foreach ($months as $key => $value) { ?>
                                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div> -->

 
                                           
                                                   <input type="text" name="dob[]" class="form-control  adt" value="" placeholder="Date of Birth"  required readonly/>
                                       <!--          <select class="form-control birth-year">
                                                    <option>1966</option>
                                                </select> -->
                                            </div>
                                      
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="additional-label">Insured Gender*</label>
                                        <select class="form-control insured-gender" name="sex[]" required>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Other Details Section -->
                            <div class="form-section other-details-section">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label class="other-details-label">Passport No</label>
                                        <input type="text" class="form-control passport-number" name="passport_num[]" placeholder="Enter passport number" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="other-details-label">Major Destination</label>
                                        <select class="form-control country" name="major_destination[]" required>

                                            <?php foreach ($get_country as $key => $value) {  ?>
                                            <option value="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option> 
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="other-details-label">Country</label>
                                        <select class="form-control country" name="country[]" required>

                                            <?php foreach ($get_country as $key => $value) {  ?>
                                            <option value="<?php echo $value['iso3']; ?>"><?php echo $value['name']; ?></option> 
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Address Section -->
                            <div class="form-section address-section">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label class="address-label">Address</label>
                                        <input type="text" class="form-control address" placeholder="Enter address" name="address[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label class="address-label">City*</label>
                                        <input type="text" class="form-control city" placeholder="Enter City"  name="city[]">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="address-label">Pin Code*</label>
                                        <input type="text" class="form-control pin-code"   name="pincode[]" placeholder="Enter pin code">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="address-label">Mobile No</label>
                                        <input type="text" class="form-control mobile-number"  name="mobile[]" placeholder="Enter mobile number">
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="address-label">Email ID</label>
                                        <input type="email" class="form-control email-id"  name="email[]" placeholder="Enter email address">
                                        <input type="hidden" name="plan_name" value="<?php echo $PlanName; ?>">
                                        <input type="hidden" name="prices" value="<?php echo $PremiumList[0]['Price']['PublishedPriceRoundedOff']; ?>">
                                    </div>
                                </div>
                            </div> 
                        <?php } ?> 
                        <div class="button-container button_container_div">
                        <!-- <a class="choose-another-transfer">Choose Another Transfer</a> -->
                        <input type="hidden" name="TraceId" value="<?php echo $TraceId;?>">
                        <input type="hidden" name="ResultIndex" value="<?php echo $ResultIndex;?>">
                        <button class="proceed-to-booking-review">Proceed to Booking</button>
                    </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="purchase-summary">
                    <div class="purchase-header">
                      Purchase Summary
                    </div>
                    <div class="purchase-details">
                      <!-- <p class="purchase-item"><strong>Private Standard Car</strong></p> -->
                      <p class="purchase-age-group">Age Group: <span><?php
                      // debug($PremiumList); die;
                       echo $PremiumList[0]['MinAge']; ?> - <?php echo $PremiumList[0]['MaxAge']; ?> Yrs</span></p>
                      <p class="purchase-quantity">(0.3 to 40 Yrs x 1 ) <span class="purchase-price"><?php echo $PremiumList[0]['Price']['Currency']; ?> <?php echo $PremiumList[0]['Price']['PublishedPriceRoundedOff']; ?></span></p>
                      <hr>
                      <p class="purchase-total">Total: <span class="purchase-amount"><?php echo $PremiumList[0]['Price']['Currency']; ?> <?php echo $PremiumList[0]['Price']['PublishedPriceRoundedOff']; ?></span></p>
                      <p class="purchase-grand-total">Grand Total: <span class="purchase-amount"><?php echo $PremiumList[0]['Price']['Currency']; ?> <?php echo $PremiumList[0]['Price']['PublishedPriceRoundedOff']; ?></span></p>
                    </div>
                    <!-- <div class="promo-section">
                      <div class="form-group">
                        <label for="promo-code">Promo code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="promo-code" placeholder="Enter Promo">
                          <span class="input-group-btn">
                            <button class="btn btn-warning" type="button">Apply</button>
                          </span>
                        </div>
                      </div>
                    </div> -->
                  </div>
            </div>
        </div>
    </div>
   </section>
 <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>


 <script type="text/javascript">
     

          jQuery( ".adt" ).datepicker({
         
               changeMonth: true,
         
               changeYear: true,
         
               // dateFormat: 'yy/mm/dd',
                  dateFormat : 'yy-m-d',
                yearRange: "1924:-1" 
         
               // yearRange: "-80:-12",
         
               // maxDate: "-1y",
         
           });
 </script>