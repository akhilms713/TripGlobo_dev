<?php
 // debug($GetBookingDetail);  die;
 // debug($Itinerary['PaxInfo'][0]['Country']);  die;

// die;
 ?>


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
          .custom-button {
            background: #e4e9ef;
            font-weight: 600;
            color: #203f7c;
            font-size: 15px;
            padding: 7px 30px;
            border-radius: 100px;
        }

        .details-table th {
            background-color: #fdb813; /* Header background color */
            color: rgb(22, 4, 4); /* Dark text in header */
        }

        .table-hover tbody tr:hover {
            background-color: #f9f9f9; /* Light grey on row hover */
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: #fff;
            padding: 10px;
            box-shadow: 0px 0px 6px 0px #ccc;
            border-radius: 5px;
        }

        .details-table {
            border: 1px solid #dee2e6;
            box-shadow: 0px 0px 6px 0px #ccc;
            border-radius: 5px;
            overflow: hidden; /* Ensures border-radius is applied to the table */
        }

        .top_table_bg {
            border-top: none !important;
        }

        .lead_content {
            font-weight: 600;
            font-size: 15px;
            line-height: 28px;
            color: #203f7c;
            margin-bottom: 0px;
        }

        .booked_on_dt {
            font-size: 17px;
            font-weight: 500;
        }

        .insuranceConfirmation {
            font-size: 20px;
            padding: 10px 0px;
            font-weight: 500;
        }

        .details_insurance th, .details_insurance td {
            border-right: 2px solid #dee2e6;
        }

        .top_table_color {
            color: #99a3a4;
        }
        .insurance_voucher_page{
            background: #fff;
            padding: 10px 20px;
            border-radius: 10px;
        }
        .insurance_voucher_page{
        	margin-top: 90px;
            width: 70%;
            margin: 90px auto 30px;
            box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.3);
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
  <div class="container">
        <div class="insurance_voucher_page">
            <h1 class="display-4 insuranceConfirmation">Insurance Confirmation</h1>
            
            <div class="flex-container">
                <div>
                    <p class="lead_content"><?php echo $Itinerary['PlanName']; ?></p>
                    <p class="mt-2 booked_on_dt">Booked on: <?php echo date("d-m-Y",strtotime($Itinerary['CreatedOn'])); ?></p>
                </div>
                <div>
                    <span class=" custom-button">Confirmed</span>
                </div>
            </div>

            <table class="table details-table">
                <thead>
                    <tr>
                        <th colspan="4">Insurance Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="top_table_bg top_table_color">Inception Date</td>
                        <td class="top_table_bg top_table_color">Expiry Date</td>
                        <td class="top_table_bg top_table_color">Duration</td>
                        <td class="top_table_bg top_table_color">Traveling to</td>
                    </tr>
                    <tr>
                        <td class="top_table_bg"> <?php echo date("d-m-Y",strtotime($Itinerary['PolicyStartDate'])); ?></td>
                        <td class="top_table_bg"> <?php echo date("d-m-Y",strtotime($Itinerary['PolicyEndDate'])); ?></td>
                        <td class="top_table_bg"><?php echo $duration; ?> days</td>
                        <td class="top_table_bg"><?php echo $Itinerary['PaxInfo'][0]['Country']; ?></td>
                    </tr>
                </tbody>
            </table>

            <h2 class="mt-4" style="    font-size: 20px; padding: 10px 0px;  font-weight: 500;">Coverage Details</h2>
            <table class="table details-table details_insurance">
                <thead>
                    <tr>
                        <th>Coverage Name</th>
                        <th>Sum Insured</th>
                        <th>Excess</th>
                    </tr>
                </thead>
                <tbody>

                	<?php foreach ($Itinerary['CoverageDetails'] as $key => $value) { ?>
                	
                    <tr>
                        <td><?php echo $value['Coverage']; ?></td>
                        <td><?php echo $value['SumInsured']; ?></td>
                        <td><?php echo $value['Excess']; ?></td>
                    </tr>
              <?php } ?>
                </tbody>
            </table>

            <h2 class="mt-4" style="    font-size: 20px; padding: 10px 0px;  font-weight: 500;">Passenger Details</h2>
            <table class="table details-table details_insurance">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Excess</th>
                    </tr>
                </thead>
                <tbody>

                	<?php foreach ($Itinerary['PaxInfo'] as $key => $valuee) { ?>
                	
                    <tr>
                        <td><?php 
                        	$name = $valuee['Title']." ".$valuee['FirstName']." ".$valuee['LastName'];
                        echo $name; ?></td>
                        <td><?php echo $valuee['EmailId']; ?></td>
                        <td><?php
                        echo date("d-m-Y",strtotime($valuee['DOB']));
                         // echo $valuee['DOB']; ?></td>
                        <td><?php
                        	$polcy_num="Policy couldn't be generated";
                          if($valuee['PolicyNo']!=""){echo $valuee['PolicyNo']; }else{
                          	echo $polcy_num;
                          } ?></td>
                    </tr>
                <?php } ?>
                <!--     <tr>
                        <td>Mr Dinakar</td>
                        <td>dinakar@gmail.com</td>
                        <td>06-Jun-1995</td>
                        <td>Policy couldn't be generated</td>
                    </tr> -->
                </tbody>
            </table>
        </div>    
    </div>
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