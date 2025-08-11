<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?> </title>
	<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->

    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">

   <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />

    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script> 

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            

            <!-- top navigation -->
            
  <?php echo $this->load->view('common/sidebar_menu'); ?>
          <?php echo $this->load->view('common/top_menu'); ?>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Update Special Trip
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Update Special Trip<small> </small></h2>
                                    <?//php print_r($flight_details);?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal form-label-left"  method="post" action="<?php echo WEB_URL; ?>special_trip/update_flight_trip/<?php echo $flight_details->flight_trip_id; ?>" enctype="multipart/form-data" enctype="multipart/form-data">
                                       
                                          <div class="item form-group">
                                            <label for="fname" class="control-label col-md-3">Module Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control" name="moduleName">
                                                   <option value="">Select Module</option>
                                                   <option value="Flight" selected>Flight</option>
                                                   <!--<option value="Hotel">Hotel</option>-->
                                                   <!--<option value="Bus">Bus</option>-->
                                                   
                                               </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Stops</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control" name="stops" onclick="addStops(this.value)">
                                                   <option>Select Stops</option>
                                                 
                                                   <option value="0" <?php if($flight_details->stops=='0'){ echo "selected";}?>>0</option>
                                                   <option value="1" <?php if($flight_details->stops=='1'){ echo "selected";}?>>1</option>
                                                   <option value="2" <?php if($flight_details->stops=='2'){ echo "selected";}?>>2</option>
                                                   
                                               </select>
                                                     </div>
                                        </div>
                                          <?php 
                                             $from=json_decode($flight_details->from_location);
                                             $to=json_decode($flight_details->to_location);
                                             $departure_date=json_decode($flight_details->departure_date);
                                             $arrival_date=json_decode($flight_details->arrival_date);
                                             $start_time=json_decode($flight_details->start_time);
                                             $end_time=json_decode($flight_details->end_time);
                                          // print_r($airline_name);
                                         if($flight_details->stops=='0'){ 
                                         ?>
                                          <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">From</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" name="from[]" type="text" value="<?php echo $from[0]; ?>" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  value="<?php  echo $to[0]; ?>" id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                                <!--<input id="to" type="text" name="to"  class="form-control col-md-7 col-xs-12" required="required">-->
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="departure_date[]" value="<?= $departure_date[0]?>"  class="form-control col-md-7 col-xs-12" placeholder="Departure">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="arrival_date[]" value="<?= $arrival_date[0]?>" class="form-control col-md-7 col-xs-12" placeholder="Arrival">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="start_time[]" value="<?= $start_time[0]?>"  class="form-control col-md-7 col-xs-12"  placeholder="Start Time">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="end_time[]" value="<?= $end_time[0]?>" class="form-control col-md-7 col-xs-12" placeholder="End Time">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                         <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[0]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                              
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>	
                                        </div>
                                         
                                         <?php
                                         } else if($flight_details->stops=='1')
                                         {
                                             ?>
                                              <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">From</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" name="from[]" type="text" value="<?php echo $from[0];?>" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                       
                                                <!--<input id="from" type="text" name="from"  class="form-control col-md-7 col-xs-12" required="required" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  value="<?php echo $to[0]; ?>" id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                                <!--<input id="to" type="text" name="to"  class="form-control col-md-7 col-xs-12" required="required">-->
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="departure_date[]" value="<?php echo $departure_date[0]?>"  class="form-control col-md-7 col-xs-12" placeholder="Departure">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="arrival_date[]" value="<?php echo $arrival_date[0]?>" class="form-control col-md-7 col-xs-12"  placeholder="Arrival">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="start_time[]" value="<?php echo $start_time[0]?>"  class="form-control col-md-7 col-xs-12"  placeholder="Start Time">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="end_time[]" value="<?php echo $end_time[0]?>" class="form-control col-md-7 col-xs-12" placeholder="End Time">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?php //print_r($airlineName[0]->airline_name);?>
                                                 <select class="form-control" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                     
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[0]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>	
                                        </div>
                                         <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">From</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" name="from[]" type="text" value="<?php echo $from[1];?>" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                       
                                                <!--<input id="from" type="text" name="from"  class="form-control col-md-7 col-xs-12" required="required" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  value="<?php echo $to[1]; ?>" id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                                <!--<input id="to" type="text" name="to"  class="form-control col-md-7 col-xs-12" required="required">-->
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="departure_date[]" value="<?php echo $departure_date[1]?>" class="form-control col-md-7 col-xs-12"  placeholder="Departure">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="arrival_date[]"  value="<?php echo $arrival_date[1]?>" class="form-control col-md-7 col-xs-12" placeholder="Arrival">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="start_time[]" value="<?php echo $start_time[1]?>"  class="form-control col-md-7 col-xs-12"  placeholder="Start Time">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="end_time[]"  value="<?php echo $end_time[1]?>" class="form-control col-md-7 col-xs-12" placeholder="End Time">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[1]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>	
                                        </div>
                                             
                                             <?php
                                         }else
                                         {
                                             ?>
                                                       <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">From</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" name="from[]" type="text" value="<?php echo $from[0];?>" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                       
                                                <!--<input id="from" type="text" name="from"  class="form-control col-md-7 col-xs-12" required="required" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  value="<?php echo $to[0]; ?>" id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                                <!--<input id="to" type="text" name="to"  class="form-control col-md-7 col-xs-12" required="required">-->
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="departure_date[]" value="<?php echo $departure_date[0]?>"  class="form-control col-md-7 col-xs-12"  placeholder="Departure">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="arrival_date[]" value="<?php echo $arrival_date[0]?>" class="form-control col-md-7 col-xs-12"  placeholder="Arrival">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="start_time[]" value="<?php echo $start_time[0]?>"  class="form-control col-md-7 col-xs-12"  placeholder="Start Time">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="end_time[]" value="<?php echo $end_time[0]?>" class="form-control col-md-7 col-xs-12"  placeholder="End Time">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[0]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>	
                                        </div>
                                         <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">From</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" name="from[]" type="text" value="<?php echo $from[1];?>" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                       
                                                <!--<input id="from" type="text" name="from"  class="form-control col-md-7 col-xs-12" required="required" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  value="<?php echo $to[1]; ?>" id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                                <!--<input id="to" type="text" name="to"  class="form-control col-md-7 col-xs-12" required="required">-->
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="departure_date[]" value="<?php echo $departure_date[1]?>" class="form-control col-md-7 col-xs-12"  placeholder="Departure">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="arrival_date[]"  value="<?php echo $arrival_date[1]?>" class="form-control col-md-7 col-xs-12"  placeholder="Arrival">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="start_time[]" value="<?php echo $start_time[1]?>"  class="form-control col-md-7 col-xs-12"  placeholder="Start Time">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="end_time[]"  value="<?php echo $end_time[1]?>" class="form-control col-md-7 col-xs-12"  placeholder="End Time">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[1]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>	
                                        </div>
                                             
                                         <div class="item form-group">
                                            <label for="email" class="control-label col-md-3">From</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="from" name="from[]" type="text" value="<?php echo $from[2];?>" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/>
                       
                                                <!--<input id="from" type="text" name="from"  class="form-control col-md-7 col-xs-12" required="required" >-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  value="<?php echo $to[2] ;?>" id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" />
                      
                                                <!--<input id="to" type="text" name="to"  class="form-control col-md-7 col-xs-12" required="required">-->
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="departure_date[]" value="<?php echo $departure_date[2] ;?>" class="form-control col-md-7 col-xs-12" placeholder="Departure">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="arrival_date[]" value="<?php echo $arrival_date[2] ;?>" class="form-control col-md-7 col-xs-12"  placeholder="Arrival">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="departure" type="text" name="start_time[]" value="<?php echo $start_time[2] ;?>" class="form-control col-md-7 col-xs-12"  placeholder="Start Time">
                                            </div>	
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="arrival" type="text" name="end_time[]" value="<?php echo $end_time[2] ;?>" class="form-control col-md-7 col-xs-12"  placeholder="End Time">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <select class="form-control" name="airline[]">
                                                     <option value="">Select Airline</option>
                                                        <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>" <?php if($a_value['airline_name']==$airlineName[2]->airline_name){ echo "selected";}?>><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                 </select>
                                            </div>	
                                        </div>
                                             
                                             <?php
                                         }
                                         ?>
                                       
                                        <div class="" id="addModuleField"></div>
                                        <div class="item form-group">
                                            <label for="zip_code" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="amount" type="number" name="amount" value="<?php echo $flight_details->amount;?>" class="form-control col-md-7 col-xs-12"  placeholder="Amount">
                                            </div>
                                        </div>
                                       
                                        <!--<div class="item form-group">-->
                                        <!--    <label for="profile_photo" class="control-label col-md-3 col-sm-3 col-xs-12">Profile Photo</label>-->
                                        <!--    <div class="col-md-6 col-sm-6 col-xs-12">-->
                                        <!--        <input  type="file" name="profile_photo" id="profile_photo" class="form-control col-md-7 col-xs-12">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <!--<div class="ln_solid"></div>-->
                                        <div class="form-group">
                                            <div class="col-md-9 ad-btn col-md-offset-3">
                                                <input type="hidden" name="user_type_name" value="STAFF">
                                              <a href="javascript:history.back()"  class="btn btn-primary ad-cancel">Cancel</a>                                                
                                                <button id="send" type="submit" class="btn btn-success ad-save">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               <!-- footer content -->
               <?php echo $this->load->view('common/footer'); ?>  
               <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo ASSETS; ?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo ASSETS; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script>
    <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
  <script type="text/javascript" src="https://tripglobo.com/beta1/assets/theme_dark/js/custom_modified.js"></script>
   
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    <link href="<?php echo ASSETS; ?>css/common/patternLock.css"  rel="stylesheet" type="text/css" />
<script src="<?php echo ASSETS; ?>js/pattern/patternLock.js"></script>
    <script>
	var lock6=new PatternLock('#patternHolder3',{
    mapper: function(idx){
		  $(".patt-holder").css("background", "#0aa89e"); 
		  
        return (idx%9);
     },
   onDraw:function(pattern){
    $("#patern").val(pattern);
   }
});

        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>
  <script type="text/javascript">
          <?php
if(isset($error['status']) && $error['status']!='')
{
	
?>
toastr.<?php echo $error['status_tag']; ?>("<?php echo $error['status_msg']; ?>", '');

<?php
}
?>
</script>

<script>
    function addStops(val)
    {
       if(val==0)
       {
          $('#addModuleField').html('');
       } else if(val==1)
       {
          $('#addModuleField').html(''); 
         $('#addModuleField').append('<div class="item form-group"><label for="email" class="control-label col-md-3">From</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="from" name="from[]" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/></div></div><div class="item form-group"><label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label><div class="col-md-6 col-sm-6 col-xs-12"><input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" /></div></div> <div class="item form-group"><label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="departure" type="text" name="departure_date[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Departure"></div></div><div class="item form-group"><label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="arrival" type="text" name="arrival_date[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="Arrival"></div></div><div class="item form-group"><label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="departure" type="text" name="start_time[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Start Time"></div></div><div class="item form-group"><label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="arrival" type="text" name="end_time[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="End Time"></div></div><div class="item form-group"><label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label><div class="col-md-6 col-sm-6 col-xs-12"><select class="form-control" name="airline[]"><option>Select Airline</option><?php foreach($airline_list as $a_value):?><option value="<?=$a_value['airline_list_id']?>"><?=$a_value['airline_name']?></option><?php endforeach;?></select></div></div>');
          
       }
       else{
             $('#addModuleField').html(''); 
             $('#addModuleField').append('<div class="item form-group"><label for="email" class="control-label col-md-3">From</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="from" name="from[]" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/></div></div><div class="item form-group"><label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label><div class="col-md-6 col-sm-6 col-xs-12"><input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" /></div></div> <div class="item form-group"><label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="departure" type="text" name="departure_date[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Departure"></div></div><div class="item form-group"><label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="arrival" type="text" name="arrival_date" class="form-control col-md-7 col-xs-12" required="required" placeholder="Arrival"></div></div><div class="item form-group"><label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="departure" type="text" name="start_time[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Start Time"></div></div><div class="item form-group"><label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="arrival" type="text" name="end_time[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="End Time"></div></div><div class="item form-group"><label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label><div class="col-md-6 col-sm-6 col-xs-12"><select class="form-control" name="airline[]"><option>Select Airline</option><?php foreach($airline_list as $a_value):?><option value="<?=$a_value['airline_list_id']?>"><?=$a_value['airline_name']?></option><?php endforeach;?></select></div></div><div class="item form-group"><label for="email" class="control-label col-md-3">From</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="from" name="from[]" type="text" class=" ft fromflight mytextbox iconLoc contr_form form-control col-md-7 col-xs-12" placeholder="From, Airport" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list"/></div></div><div class="item form-group"><label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">To</label><div class="col-md-6 col-sm-6 col-xs-12"><input class="ft departflight mytextbox iconLoc contr_form pad_twofive form-control col-md-7 col-xs-12" name="to[]"  id="to"  placeholder="To, Airport" value="<?php echo $destination;?>" autoComplete="off" aria-autocomplete="list" type="text" /></div></div> <div class="item form-group"><label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Departure Date</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="departure" type="text" name="departure_date[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Departure"></div></div><div class="item form-group"><label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Arrival Date</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="arrival" type="text" name="arrival_date[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="Arrival"></div></div><div class="item form-group"><label for="phone_number" class="control-label col-md-3 col-sm-3 col-xs-12">Start Time</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="departure" type="text" name="start_time[]"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Start Time"></div></div><div class="item form-group"><label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">End Time</label><div class="col-md-6 col-sm-6 col-xs-12"><input id="arrival" type="text" name="end_time[]" class="form-control col-md-7 col-xs-12" required="required" placeholder="End Time"></div></div><div class="item form-group"><label for="city_name" class="control-label col-md-3 col-sm-3 col-xs-12">Airline</label><div class="col-md-6 col-sm-6 col-xs-12"><select class="form-control" name="airline[]"><option>Select Airline</option><?php foreach($airline_list as $a_value):?><option value="<?=$a_value['airline_list_id']?>"><?=$a_value['airline_name']?></option><?php endforeach;?></select></div></div>');
       }
        
    }
</script>
 
</body>
</html>
