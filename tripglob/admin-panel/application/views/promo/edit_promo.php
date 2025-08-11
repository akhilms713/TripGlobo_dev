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


    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
 
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      
    <!--   <script type="text/javascript">
        function enableText(checkBox) {
    if (checkBox.nextSibling.tagName != 'INPUT') {
        var input = document.createElement('input');
        input.type = "file";
        checkBox.parentNode.insertBefore(input, checkBox.nextSibling);
    }
}

      </script>> -->

<script type="text/javascript">
    $(function () {
        $(".same_airport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#b2b_airport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvb2b").show();
            } else {
                $("#dvb2b").hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#same1_airport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassports").show();
            } else {
                $("#dvPassports").hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#amount_b2b").click(function () {
            if ($(this).is(":checked")) {
                $("#b2b_div").show();
            } else {
                $("#b2b_div").hide();
            }
        });
    });
</script>
</head>

<?php
    $module_arr  = array(
        'flight'=>'Flight',
        'bus'=>'Bus',
        'hotel'=>'Hotel',
        // 'car'=>'Car',
      /*  'activities'=>'Activities',
        'transfers'=>'Transfers',
        'flight_hotel'=>'Flight+Hotel',
        'flight_car'=>'Flight+Car',
        'hotel_car'=>'Hotel+Car',
        'flight_hotel_car'=>'Flight+Hotel+Car'*/

        );

?>
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
                  Update New Promo 
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Update New Promo</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
 <?php if($status=='1'){?>
                    <div class="alert alert-block alert-success alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Success!</h4>
                    Your Password Successfully Updated.
                  </div>
              <?php }elseif($status=='0'){?>
                   <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                     Your Password Not Updated Due To Some Error. Please Try Again After Some Time.
                  </div>
               <?php }elseif($status=='11'){?>
               <div class="alert alert-block alert-danger alert-dismissable">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h4 class="alert-heading">Failure!</h4>
                     Current Password Worng, Please Enter Correct Password.
                  </div>
               <?php } ?>
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="<?php if ($promo->promo_type=='PERCENTAGE') {echo 'active';} ?>"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Promo code by %</a>
                                            </li>
                                            <li role="presentation" class="<?php if ($promo->promo_type=='AMOUNT') {echo 'active';} ?>"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Promo code by amount</a>
                                            </li>
                                            
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade <?php if ($promo->promo_type=='PERCENTAGE') {echo 'active in';} ?>" id="tab_content1" aria-labelledby="home-tab">
                                                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>promo/update_promo_new/<?=$promo->promo_id?>" enctype="multipart/form-data">
                                                   <?php 
                                               if($promo->module=='bus')
                                               {
                                                   ?>
                                                    <div class="item form-group">
                                            <label for="user_type" class="control-label col-md-3">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="user_type" class="form-control col-md-7 col-xs-12 user_type" id="user_type">
                                                 
                                                        <option data-id="<?=$udata->user_type_name?>" value="<?=$promo->user_type?>"><?php 
                                                        if($promo->user_type==2)
                                                        {
                                                            echo "B2C";
                                                        }
                                                        else
                                                        {
                                                            echo "B2B";
                                                        }
                                                        ?></option>
                                                    
                                                </select>
                                            </div>
                                         </div>
                                         
                                        
                                          <?php
                                          if($promo->user_type==1)
                                                {
                                                          ?>
                                                          
                                          <div class="item form-group" id="agent_user">
                                            <label for="user_id" class="control-label col-md-3">User List</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">
                                                    <option value="">All</option>
                                                    <?php foreach($agent_user as $udata):?>
                                                          <option value="<?=$udata->user_id?>" <?php if($udata->user_id==$promo->user_id){echo 'selected';}?>><?=$udata->user_name?> - <?=$udata->user_email?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                         </div>
                                                          <?php
                                                 }
                                                       
                                         ?>
                                         
                                          <div class="item form-group">
                                            <label for="promo_code" class="control-label col-md-3">Promo Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="promo_code" type="text" name="promo_code"  class="form-control col-md-7 col-xs-12" value="<?=$promo->promo_code?>" required="required">
                                            </div>
                                          </div>
                                        <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="description" type="text" name="description"  class="form-control col-md-7 col-xs-12" value="<?=$promo->description?>" required="required">
                                            </div>
                                         </div>
                                          <!-- <div class="item form-group">
                                            <label for="minimum_amount" class="control-label col-md-3">Minimun Amount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="minimum_amount" type="number" name="minimum_amount"  class="form-control col-md-7 col-xs-12" value="<?=$promo->minimum_amount?>" required="required">
                                            </div>
                                         </div> -->
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Module</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="module_type" class="form-control col-md-7 col-xs-12 module_type" onchange="removeAirline(this.value)">
                                                   
                                                        <option value="<?=$promo->module?>"><?php if($promo->module=='flight'){ echo 'Flight';}else if($promo->module=='bus'){ echo 'Bus';}else{ echo 'Hotel'; }?></option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                        <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Limit Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="promo_code_type" class="form-control col-md-7 col-xs-12 promo_code_type" onchange="promocodetype(this.value)">
                                                        <option value="single" <?php if ($promo->limit=='single') {echo'selected';} ?> data-iconurl="">Single</option>
                                                        <option value="multiple" <?php if ($promo->limit=='multiple') {echo'selected';} ?> data-iconurl="">Multiple</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group limit_promo" >
                                            <label for="discount" class="control-label col-md-3">Limit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="limit" type="number" name="limit"  class="form-control col-md-7 col-xs-12" value="<?=$promo->limit_count?>">
                                            </div>
                                          </div>
                                          <div class="item form-group">
                                            <label for="discount" class="control-label col-md-3">Discount in %</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="discount" type="number" name="discount"  class="form-control col-md-7 col-xs-12" value="<?=$promo->discount?>" required="required" maxlength="3" pattern="[0-9.]">
                                            </div>
                                          </div>
                                          <div class="item form-group">
                                            <label for="exp_date" class="control-label col-md-3">Expiry Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?php 
                                                        $date1=explode("-",$promo->expiry_date);
                                                        $dateOnly=explode("00:00:00",$date1[2]);
                                                ?>
                                                <input id="single_cal4" type="text" name="exp_date"  class="form-control col-md-7 col-xs-12" value="<?php echo trim($date1[1])."/".trim($dateOnly[0]).'/'.trim($date1[0]); ?>" required="required" readonly>
                                            </div>
                                          </div>

                                          

                                        <!--<div class="item form-group">-->

                                        <!--<div class="col-md-3"></div>-->

                                        <!--  <label for="same_airport">-->
                                        <!--      <input class="form-control chckbox same_airport" value="2" type="checkbox" id="same_airport" name="b2c_airport" />-->
                                        <!--     Show b2c Dashboard-->
                                        <!--  </label>-->

                                        <!--  <label for="same_airport">-->
                                        <!--    <input class="form-control chckbox same_airport" value="1" type="checkbox" id="same_airport" name="b2b_airport" />-->
                                        <!--     Show b2b Dashboard-->
                                        <!--  </label>-->
                                          
                                        <!--  <div id="dvPassport" style="display: none">-->
                                        <!--     <div class="col-md-3"></div>-->
                                        <!--    <div class="col-md-3">-->
                                        <!--      <h4>Browse file:</h4>-->
                                        <!--      <input type="file" id="pic_name" name="pic_name"  />-->
                                        <!--    </div>-->
                                        <!--  </div>-->

                                        <!--</div>-->
                                        
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                                   
                                                   <?php
                                               }else if($promo->module=='flight'){
                                                   ?>
                                                    <div class="item form-group">
                                            <label for="user_type" class="control-label col-md-3">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="user_type" class="form-control col-md-7 col-xs-12 user_type" id="user_type">
                                                 
                                                        <option data-id="<?=$udata->user_type_name?>" value="<?=$promo->user_type?>"><?php 
                                                        if($promo->user_type==2)
                                                        {
                                                            echo "B2C";
                                                        }
                                                        else
                                                        {
                                                            echo "B2B";
                                                        }
                                                        ?></option>
                                                    
                                                </select>
                                            </div>
                                         </div>
                                         <?php
                                          if($promo->user_type==1)
                                                {
                                                          ?>
                                                          
                                          <div class="item form-group" id="agent_user">
                                            <label for="user_id" class="control-label col-md-3">User List</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">
                                                     <option value="">All</option>
                                                    <?php foreach($agent_user as $udata):?>
                                                       <option value="<?=$udata->user_id?>" <?php if($udata->user_id==$promo->user_id){echo 'selected';}?>><?=$udata->user_name?> - <?=$udata->user_email?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                         </div>
                                                          <?php
                                                 }
                                                       
                                         ?>
                                         <!--<div class="item form-group" id="staff_user">-->
                                         <!--   <label for="staff_user_id" class="control-label col-md-3">User List</label>-->
                                         <!--   <div class="col-md-6 col-sm-6 col-xs-12">-->
                                         <!--       <select  name="user_id" class="form-control col-md-7 col-xs-12 user">-->
                                         <!--           <?php foreach($staff_user as $udata):?>-->
                                         <!--               <option value="<?=$udata->user_id?>"><?=$udata->user_name?> - <?=$udata->user_email?></option>-->
                                         <!--           <?php endforeach;?>-->
                                         <!--       </select>-->
                                         <!--   </div>-->
                                         <!--</div>-->
                                         
                                          <div class="item form-group">
                                            <label for="promo_code" class="control-label col-md-3">Promo Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="promo_code" type="text" name="promo_code"  class="form-control col-md-7 col-xs-12" value="<?=$promo->promo_code?>" required="required">
                                            </div>
                                          </div>
                                        <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="description" type="text" name="description"  class="form-control col-md-7 col-xs-12" value="<?=$promo->description?>" required="required">
                                            </div>
                                         </div>
                                          <!-- <div class="item form-group">
                                            <label for="minimum_amount" class="control-label col-md-3">Minimun Amount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="minimum_amount" type="number" name="minimum_amount"  class="form-control col-md-7 col-xs-12" value="<?=$promo->minimum_amount?>" required="required">
                                            </div>
                                         </div> -->
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Module</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="module_type" class="form-control col-md-7 col-xs-12 module_type" onchange="removeAirline(this.value)">
                                                   
                                                        <option value="<?=$promo->module?>"><?php if($promo->module=='flight'){ echo 'Flight';}else if($promo->module=='bus'){ echo 'Bus';}else{ echo 'Hotel'; }?></option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Limit Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="promo_code_type" class="form-control col-md-7 col-xs-12 promo_code_type" onchange="promocodetype(this.value)" >
                                                        <option value="single" <?php if ($promo->limit=='single') {echo'selected';} ?> data-iconurl="">Single</option>
                                                        <option value="multiple" <?php if ($promo->limit=='multiple') {echo'selected';} ?> data-iconurl="">Multiple</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group limit_promo" >
                                            <label for="discount" class="control-label col-md-3">Limit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="limit" type="number" name="limit"  class="form-control col-md-7 col-xs-12" value="<?=$promo->limit_count?>">
                                            </div>
                                          </div>
                                         
                                         <div class="item form-group airline_codes" id="airlinwise">
                                            <label for="airline_code" class="control-label col-md-3">Airline Wise</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-12">
                                                <select name="airline_code" class="form-control col-md-7 col-xs-12 select2" style="width:100%;">
                                                    <option value="all">All</option>
                                                    <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>"<?php if($a_value['airline_name']==$promo->airline_code){ echo 'selected';}?>><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group">
                                            <label for="discount" class="control-label col-md-3">Discount in %</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="discount" type="number" name="discount"  class="form-control col-md-7 col-xs-12" value="<?=$promo->discount?>" required="required" maxlength="3" pattern="[0-9.]">
                                            </div>
                                          </div>
                                          <div class="item form-group">
                                            <label for="exp_date" class="control-label col-md-3">Expiry Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <?php 
                                                        $date1=explode("-",$promo->expiry_date);
                                                        $dateOnly=explode("00:00:00",$date1[2]);
                                                ?>
                                                <input id="single_cal5" type="text" name="exp_date"  class="form-control col-md-7 col-xs-12" value="<?php echo trim($date1[1])."/".trim($dateOnly[0]).'/'.trim($date1[0]); ?>" required="required" readonly>
                                         </div>
                                          </div>

                                          

                                        <!--<div class="item form-group">-->

                                        <!--<div class="col-md-3"></div>-->

                                        <!--  <label for="same_airport">-->
                                        <!--      <input class="form-control chckbox same_airport" value="2" type="checkbox" id="same_airport" name="b2c_airport" />-->
                                        <!--     Show b2c Dashboard-->
                                        <!--  </label>-->

                                        <!--  <label for="same_airport">-->
                                        <!--    <input class="form-control chckbox same_airport" value="1" type="checkbox" id="same_airport" name="b2b_airport" />-->
                                        <!--     Show b2b Dashboard-->
                                        <!--  </label>-->
                                          
                                        <!--  <div id="dvPassport" style="display: none">-->
                                        <!--     <div class="col-md-3"></div>-->
                                        <!--    <div class="col-md-3">-->
                                        <!--      <h4>Browse file:</h4>-->
                                        <!--      <input type="file" id="pic_name" name="pic_name"  />-->
                                        <!--    </div>-->
                                        <!--  </div>-->

                                        
                                        <!--</div>-->
                                        
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                                   <?php
                                                   
                                               }else
                                               {
                                                   ?>
                                                   
                                                         <div class="item form-group">
                                            <label for="user_type" class="control-label col-md-3">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="user_type" class="form-control col-md-7 col-xs-12 user_type" id="user_type">
                                                 
                                                        <option data-id="<?=$udata->user_type_name?>" value="<?=$promo->user_type?>"><?php 
                                                        if($promo->user_type==2)
                                                        {
                                                            echo "B2C";
                                                        }
                                                        else
                                                        {
                                                            echo "B2B";
                                                        }
                                                        ?></option>
                                                    
                                                </select>
                                            </div>
                                         </div>
                                         <?php 
                                                if($promo->user_type==1)
                                                {
                                                          ?>
                                                          
                                          <div class="item form-group" id="agent_user">
                                            <label for="user_id" class="control-label col-md-3">User List</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">
                                                     <option value="">All</option>
                                                    <?php foreach($agent_user as $udata):?>
                                                        <option value="<?=$udata->user_id?>" <?php if($udata->user_id==$promo->user_id){echo 'selected';}?>><?=$udata->user_name?> - <?=$udata->user_email?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                         </div>
                                                          <?php
                                                 }
                                                       
                                         ?>
                                          
                                         <!--<div class="item form-group" id="agent_user">-->
                                         <!--   <label for="user_id" class="control-label col-md-3">User List</label>-->
                                         <!--   <div class="col-md-6 col-sm-6 col-xs-12">-->
                                         <!--       <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">-->
                                         <!--           <?php foreach($agent_user as $udata):?>-->
                                         <!--               <option value="<?=$udata->user_id?>"><?=$udata->user_name?> - <?=$udata->user_email?></option>-->
                                         <!--           <?php endforeach;?>-->
                                         <!--       </select>-->
                                         <!--   </div>-->
                                         <!--</div>-->
                                         
                                         <!--<div class="item form-group" id="staff_user">-->
                                         <!--   <label for="staff_user_id" class="control-label col-md-3">User List</label>-->
                                         <!--   <div class="col-md-6 col-sm-6 col-xs-12">-->
                                         <!--       <select  name="user_id" class="form-control col-md-7 col-xs-12 user">-->
                                         <!--           <?php foreach($staff_user as $udata):?>-->
                                         <!--               <option value="<?=$udata->user_id?>"><?=$udata->user_name?> - <?=$udata->user_email?></option>-->
                                         <!--           <?php endforeach;?>-->
                                         <!--       </select>-->
                                         <!--   </div>-->
                                         <!--</div>-->
                                         
                                          <div class="item form-group">
                                            <label for="promo_code" class="control-label col-md-3">Promo Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="promo_code" type="text" name="promo_code"  class="form-control col-md-7 col-xs-12" value="<?=$promo->promo_code?>" required="required">
                                            </div>
                                          </div>
                                        <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="description" type="text" name="description"  class="form-control col-md-7 col-xs-12" value="<?=$promo->description?>" required="required">
                                            </div>
                                         </div>
                                         <!--  <div class="item form-group">
                                            <label for="minimum_amount" class="control-label col-md-3">Minimun Amount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="minimum_amount" type="number" name="minimum_amount"  class="form-control col-md-7 col-xs-12" value="<?=$promo->minimum_amount?>" required="required">
                                            </div>
                                         </div> -->
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Module</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="module_type" class="form-control col-md-7 col-xs-12 module_type" onchange="removeAirline(this.value)">
                                                   
                                                        <option value="<?=$promo->module?>"><?php if($promo->module=='flight'){ echo 'Flight';}else if($promo->module=='bus'){ echo 'Bus';}else{ echo 'Hotel'; }?></option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Limit Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="promo_code_type" class="form-control col-md-7 col-xs-12 promo_code_type" onchange="promocodetype(this.value)">
                                                        <option value="single"<?php if ($promo->limit=='single') {echo'selected';} ?> data-iconurl="">Single</option>
                                                        <option value="multiple"<?php if ($promo->limit=='multiple') {echo'selected';} ?> data-iconurl="">Multiple</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group limit_promo" >
                                            <label for="discount" class="control-label col-md-3">Limit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="limit" type="number" name="limit"  class="form-control col-md-7 col-xs-12" value="<?=$promo->limit_count?>">
                                            </div>
                                          </div>
                                       
                                          <div class="item form-group">
                                            <label for="discount" class="control-label col-md-3">Discount in %</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="discount" type="number" name="discount"  class="form-control col-md-7 col-xs-12" value="<?=$promo->discount?>" required="required" maxlength="3" pattern="[0-9.]">
                                            </div>
                                          </div>
                                          <div class="item form-group">
                                            <label for="exp_date" class="control-label col-md-3">Expiry Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?php 
                                                        $date1=explode("-",$promo->expiry_date);
                                                        $dateOnly=explode("00:00:00",$date1[2]);
                                                ?>
                                                <input id="single_cal5" type="text" name="exp_date"  class="form-control col-md-7 col-xs-12" value="<?php echo trim($date1[1])."/".trim($dateOnly[0]).'/'.trim($date1[0]); ?>" required="required" readonly>
                                       </div>
                                          </div>

                                          

                                        <!--<div class="item form-group">-->

                                        <!--<div class="col-md-3"></div>-->

                                        <!--  <label for="same_airport">-->
                                        <!--      <input class="form-control chckbox same_airport" value="2" type="checkbox" id="same_airport" name="b2c_airport" />-->
                                        <!--     Show b2c Dashboard-->
                                        <!--  </label>-->

                                        <!--  <label for="same_airport">-->
                                        <!--    <input class="form-control chckbox same_airport" value="1" type="checkbox" id="same_airport" name="b2b_airport" />-->
                                        <!--     Show b2b Dashboard-->
                                        <!--  </label>-->
                                          
                                        <!--  <div id="dvPassport" style="display: none">-->
                                        <!--     <div class="col-md-3"></div>-->
                                        <!--    <div class="col-md-3">-->
                                        <!--      <h4>Browse file:</h4>-->
                                        <!--      <input type="file" id="pic_name" name="pic_name"  />-->
                                        <!--    </div>-->
                                        <!--  </div>-->

                                        <!--</div>-->
                                        
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                               
                                                   <?php
                                               }
                                            ?>
                                           
                                    </form>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade <?php if ($promo->promo_type=='AMOUNT') {echo 'active in';} ?>" id="tab_content2" aria-labelledby="profile-tab">
                                               <form id="update_new_promo" class="form-horizontal form-label-left" novalidate method="post" action="<?php echo WEB_URL; ?>promo/update_promo_new_amount/<?= $promo->promo_id;?>" enctype="multipart/form-data" >
                                            <?php 
                                               if($promo->module=='bus')
                                               {
                                                   ?>
                                                         <div class="item form-group">
                                            <label for="user_type" class="control-label col-md-3">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="user_type" class="form-control col-md-7 col-xs-12 user_type" id="user_type2">
                                                   
                                                        <option data-id="<?=$udata->user_type_name?>" value="<?=$udata->user_type_id?>">
                                                        <?php
                                                           if($promo->user_type==2)
                                                           {
                                                               echo 'B2C';
                                                           }
                                                           else
                                                           {
                                                               echo 'B2B';
                                                           }
                                                        ?>
                                                        </option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                           <?php
                                          if($promo->user_type==1)
                                                {
                                                          ?>
                                                          
                                          <div class="item form-group" id="agent_user">
                                            <label for="user_id" class="control-label col-md-3">User List</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">
                                                     <option value="">All</option>
                                                    <?php foreach($agent_user as $udata):?>
                                                         <option value="<?=$udata->user_id?>" <?php if($udata->user_id==$promo->user_id){echo 'selected';}?>><?=$udata->user_name?> - <?=$udata->user_email?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                         </div>
                                                          <?php
                                                 }
                                                       
                                         ?>
                                        
                                         <div class="item form-group">
                                            <label for="promo_code" class="control-label col-md-3">Promo Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="promo_code" type="text" name="promo_code"  class="form-control col-md-7 col-xs-12" value="<?php echo $promo->promo_code; ?>" required="required">
                                            </div>
                                        </div>
                                                                                <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="description" type="text" name="description"  class="form-control col-md-7 col-xs-12" value="<?php echo $promo->description; ?>" required="required">
                                            </div>
                                         </div>
                                         
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Module</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="module_type" class="form-control col-md-7 col-xs-12 module_type"  onchange="removeairlineWise(this.val)">
                                                   <option value="<?=$promo->module?>"><?php if($promo->module=='bus'){ echo 'BUS';}else if($promo->module=='flight'){ echo 'Flight';}else{ echo 'Hotel'; }?></option>
                                                     
                                                </select>
                                            </div>
                                         </div>
                                         <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Limit Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="promo_code_type" class="form-control col-md-7 col-xs-12 promo_code_type" onchange="promocodetype(this.value)">
                                                        <option value="single" <?php if ($promo->limit=='single') {echo'selected';} ?>data-iconurl="">Single</option>
                                                        <option value="multiple"<?php if ($promo->limit=='multiple') {echo'selected';} ?> data-iconurl="">Multiple</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group limit_promo" >
                                            <label for="discount" class="control-label col-md-3">Limit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="limit" type="number" name="limit"  class="form-control col-md-7 col-xs-12" value="<?=$promo->limit_count?>">
                                            </div>
                                          </div>
                                         
                                        <div class="item form-group">
                                            <label for="discount" class="control-label col-md-3">Discount in <?php echo BASE_CURRENCY_ICON; ?></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="discount" type="text" name="discount"  class="form-control col-md-7 col-xs-12" value="<?= $promo->promo_amount;?>" required="required" pattern="[0-9.]">
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="exp_date" class="control-label col-md-3">Expiry Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?php 
                                                        $date1=explode("-",$promo->expiry_date);
                                                        $dateOnly=explode("00:00:00",$date1[2]);
                                                ?>
                                                <input id="single_cal6" type="text" name="exp_date"  class="form-control col-md-7 col-xs-12" value="<?php echo trim($date1[1])."/".trim($dateOnly[0]).'/'.trim($date1[0]); ?>" required="required" readonly>
                                        </div>
                                          </div>
                                        
                                          

                                        <!--<div class="item form-group">-->

                                        <!--<div class="col-md-3"></div>-->

                                        <!--    <label for="same1_airport">-->
                                        <!--      <input class="form-control chckbox" type="checkbox" id="same1_airport" name="same1_airport" />-->
                                        <!--     Show b2c Dashboard-->
                                        <!--    </label>-->

                                          
                                        <!--  <div id="dvPassports" style="display: none">-->
                                        <!--    <div class="col-md-3"></div>-->
                                        <!--    <div class="col-md-3">-->
                                        <!--      <h2>Browse file:</h2>-->
                                        <!--      <input type="file" id="pic_name1" name="pic_name1" />-->
                                        <!--    </div>-->
                                        <!--  </div>-->

                                        <!--</div>-->
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                                   <?php
                                               }
                                               else if($promo->module=='flight')
                                               {
                                                   ?>
                                                         <div class="item form-group">
                                            <label for="user_type" class="control-label col-md-3">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="user_type" class="form-control col-md-7 col-xs-12 user_type" id="user_type2">
                                                   
                                                        <option data-id="<?=$udata->user_type_name?>" value="<?=$udata->user_type_id?>">
                                                        <?php
                                                           if($promo->user_type==2)
                                                           {
                                                               echo 'B2C';
                                                           }
                                                           else
                                                           {
                                                               echo 'B2B';
                                                           }
                                                        ?>
                                                        </option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                         <?php
                                          if($promo->user_type==1)
                                                {
                                                          ?>
                                                          
                                          <div class="item form-group" id="agent_user">
                                            <label for="user_id" class="control-label col-md-3">User List</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">
                                                     <option value="">All</option>
                                                    <?php foreach($agent_user as $udata):?>
                                                        <option value="<?=$udata->user_id?>" <?php if($udata->user_id==$promo->user_id){echo 'selected';}?>><?=$udata->user_name?> - <?=$udata->user_email?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                         </div>
                                                          <?php
                                                 }
                                                       
                                         ?>
                                         <div class="item form-group">
                                            <label for="promo_code" class="control-label col-md-3">Promo Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="promo_code" type="text" name="promo_code"  class="form-control col-md-7 col-xs-12" value="<?php echo $promo->promo_code; ?>" required="required">
                                            </div>
                                        </div>
                                                                                <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="description" type="text" name="description"  class="form-control col-md-7 col-xs-12" value="<?php echo $promo->description; ?>" required="required">
                                            </div>
                                         </div>
                                         
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Module</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="module_type" class="form-control col-md-7 col-xs-12 module_type"  onchange="removeairlineWise(this.val)">
                                                   <option value="<?=$promo->module?>"><?php if($promo->module=='bus'){ echo 'BUS';}else if($promo->module=='flight'){ echo 'Flight';}else{ echo 'Hotel'; }?></option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                         <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Limit Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="promo_code_type" class="form-control col-md-7 col-xs-12 promo_code_type" onchange="promocodetype(this.value)">
                                                        <option value="single"<?php if ($promo->limit=='single') {echo'selected';} ?> data-iconurl="">Single</option>
                                                        <option value="multiple"<?php if ($promo->limit=='multiple') {echo'selected';} ?> data-iconurl="">Multiple</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group limit_promo" >
                                            <label for="discount" class="control-label col-md-3">Limit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="limit" type="number" name="limit"  class="form-control col-md-7 col-xs-12" value="<?=$promo->limit_count?>">
                                            </div>
                                          </div>
                                         <div class="item form-group airline_codes" id="airlines1">
                                            <label for="airline_code" class="control-label col-md-3">Airline Wise</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-12">
                                                <select name="airline_code" class="form-control col-md-7 col-md-12 col-xs-12 select2" style="width:100%">
                                                    <option value="all">All</option>
                                                    <?php foreach($airline_list as $a_value):?>
                                                        <option value="<?=$a_value['airline_list_id']?>"><?=$a_value['airline_name']?></option>
                                                    <?php endforeach;?>
                                                    
                                                </select>
                                            </div>
                                         </div>
                                        
                                        <div class="item form-group">
                                            <label for="discount" class="control-label col-md-3">Discount in <?php echo BASE_CURRENCY_ICON; ?></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="discount" type="text" name="discount"  class="form-control col-md-7 col-xs-12" value="<?= $promo->promo_amount;?>" required="required" pattern="[0-9.]">
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="exp_date" class="control-label col-md-3">Expiry Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <?php 
                                                        $date1=explode("-",$promo->expiry_date);
                                                        $dateOnly=explode("00:00:00",$date1[2]);
                                                ?>
                                                <input id="single_cal7" type="text" name="exp_date"  class="form-control col-md-7 col-xs-12" value="<?php echo trim($date1[1])."/".trim($dateOnly[0]).'/'.trim($date1[0]); ?>" required="required" readonly>
                                        </div>
                                          </div>
                                        
                                          

                                        <!--<div class="item form-group">-->

                                        <!--<div class="col-md-3"></div>-->

                                        <!--    <label for="same1_airport">-->
                                        <!--      <input class="form-control chckbox" type="checkbox" id="same1_airport" name="same1_airport" />-->
                                        <!--     Show b2c Dashboard-->
                                        <!--    </label>-->
                                        <!--  <div id="dvPassports" style="display: none">-->
                                        <!--    <div class="col-md-3"></div>-->
                                        <!--    <div class="col-md-3">-->
                                        <!--      <h2>Browse file:</h2>-->
                                        <!--      <input type="file" id="pic_name1" name="pic_name1" />-->
                                        <!--    </div>-->
                                        <!--  </div>-->

                                        <!--</div>-->
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                                   <?php
                                               }else
                                               {
                                                   ?>
                                                         <div class="item form-group">
                                            <label for="user_type" class="control-label col-md-3">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="user_type" class="form-control col-md-7 col-xs-12 user_type" id="user_type2">
                                                   
                                                        <option data-id="<?=$udata->user_type_name?>" value="<?=$udata->user_type_id?>">
                                                        <?php
                                                           if($promo->user_type==2)
                                                           {
                                                               echo 'B2C';
                                                           }
                                                           else
                                                           {
                                                               echo 'B2B';
                                                           }
                                                        ?>
                                                        </option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                              <?php
                                          if($promo->user_type==1)
                                                {
                                                          ?>
                                                          
                                          <div class="item form-group" id="agent_user">
                                            <label for="user_id" class="control-label col-md-3">User List</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="agent_user_id" class="form-control col-md-7 col-xs-12 user">
                                                     <option value="">All</option>
                                                    <?php foreach($agent_user as $udata):?>
                                                         <option value="<?=$udata->user_id?>" <?php if($udata->user_id==$promo->user_id){echo 'selected';}?>><?=$udata->user_name?> - <?=$udata->user_email?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                         </div>
                                                          <?php
                                                 }
                                                       
                                         ?>
                                         <div class="item form-group">
                                            <label for="promo_code" class="control-label col-md-3">Promo Code</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="promo_code" type="text" name="promo_code"  class="form-control col-md-7 col-xs-12" value="<?php echo $promo->promo_code; ?>" required="required">
                                            </div>
                                        </div>
                                                                                <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="description" type="text" name="description"  class="form-control col-md-7 col-xs-12" value="<?php echo $promo->description; ?>" required="required">
                                            </div>
                                         </div>
                                         
                                          <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Module</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="module_type" class="form-control col-md-7 col-xs-12 module_type"  onchange="removeairlineWise(this.val)">
                                                   <option value="<?=$promo->module?>"><?php if($promo->module=='bus'){ echo 'BUS';}else if($promo->module=='flight'){ echo 'Flight';}else{ echo 'Hotel'; }?></option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                         <div class="item form-group">
                                            <label for="module_type" class="control-label col-md-3">Limit Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select  name="promo_code_type" class="form-control col-md-7 col-xs-12 promo_code_type" onchange="promocodetype(this.value)">
                                                        <option value="single" <?php if ($promo->limit=='single') {echo'selected';} ?>data-iconurl="">Single</option>
                                                        <option value="multiple" <?php if ($promo->limit=='multiple') {echo'selected';} ?>data-iconurl="">Multiple</option>
                                                   
                                                    
                                                </select>
                                            </div>
                                         </div>
                                          <div class="item form-group limit_promo" >
                                            <label for="discount" class="control-label col-md-3">Limit</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="limit" type="number" name="limit"  class="form-control col-md-7 col-xs-12" value="<?=$promo->limit_count?>">
                                            </div>
                                          </div>
                                       
                                         
                                        <div class="item form-group">
                                            <label for="discount" class="control-label col-md-3">Discount in <?php echo BASE_CURRENCY_ICON; ?></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="discount" type="text" name="discount"  class="form-control col-md-7 col-xs-12" value="<?= $promo->promo_amount;?>" required="required" pattern="[0-9.]">
                                            </div>
                                        </div>
                                          <div class="item form-group">
                                            <label for="exp_date" class="control-label col-md-3">Expiry Date</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?php 
                                                        $date1=explode("-",$promo->expiry_date);
                                                        $dateOnly=explode("00:00:00",$date1[2]);
                                                ?>
                                                <input id="single_cal8" type="text" name="exp_date"  class="form-control col-md-7 col-xs-12" value="<?php echo trim($date1[1])."/".trim($dateOnly[0]).'/'.trim($date1[0]); ?>" required="required" readonly>
                                          </div>
                                          </div>
                                        
                                          

                                        <!--<div class="item form-group">-->

                                        <!--<div class="col-md-3"></div>-->

                                        <!--    <label for="same1_airport">-->
                                        <!--      <input class="form-control chckbox" type="checkbox" id="same1_airport" name="same1_airport" />-->
                                        <!--     Show b2c Dashboard-->
                                        <!--    </label>-->

                                           
                                        <!--  <div id="dvPassports" style="display: none">-->
                                        <!--    <div class="col-md-3"></div>-->
                                        <!--    <div class="col-md-3">-->
                                        <!--      <h2>Browse file:</h2>-->
                                        <!--      <input type="file" id="pic_name1" name="pic_name1" />-->
                                        <!--    </div>-->
                                        <!--  </div>-->

                                        <!--</div>-->
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3"> 
                                                <button id="send" type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                                   <?php
                                               }
                                            ?>
                                   
                                    </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    

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
    
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS; ?>js/datepicker/daterangepicker.js"></script>
      <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />
    <!-- icheck -->
    <script src="<?php echo ASSETS; ?>js/icheck/icheck.min.js"></script> 
    <script src="<?php echo ASSETS; ?>js/tags/jquery.tagsinput.min.js"></script>
    <script src="<?php echo ASSETS; ?>js/custom.js"></script>
    <!-- form validation -->
    <script src="<?php echo ASSETS; ?>js/validator/validator.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
	<script>
	     $(document).ready(function(){
	         $(".select2").select2();
	     });
	</script>
    
    <script>
    $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
            });
             var today = new Date(); 
             // console.log(today);
   $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
      $('#single_cal5').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
         $('#single_cal6').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
      $('#single_cal7').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
         $('#single_cal8').daterangepicker({
                singleDatePicker: true,
                 minDate:today,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
      // $('#single_cal9').daterangepicker({
      //           singleDatePicker: true,
      //            minDate:today,
      //           calender_style: "picker_4"
      //       }, function (start, end, label) {
      //           console.log(start.toISOString(), end.toISOString(), label);
      //       });
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
           //if(($('input[type="checkbox"]').prop("checked") == true)){
             if(($('.same_airport').prop("checked") == true)){
                   if($('#pic_name')[0].files.length === 0){
                      alert("Attachment Required");
                      $('#pic_name').focus();

                      return false;
                  }   
              }

              // if(($('#b2b_airport').prop("checked") == true)){
              //      if($('#pic_b2b')[0].files.length === 0){
              //         alert("Attachment B2B Required");
              //         $('#pic_b2b').focus();

              //         return false;
              //     }   
              // }


              if(($('#same1_airport').prop("checked") == true)){
                   if($('#pic_name1')[0].files.length === 0){
                      alert("Attachment Requiredssss");
                      $('#pic_name1').focus();

                      return false;
                  }   
              }

              if(($('#amount_b2b').prop("checked") == true)){
                   if($('#img_b2b')[0].files.length === 0){
                      alert("Attachment B2B Required");
                      $('#img_b2b').focus();

                      return false;
                  }   
              }
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }
             if(parseInt($("#discount").val())>100){
               submit = false;
               alert('More than 100% you have added');
               $("#discount").css('border','1px solid #CE5454');
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

        $(".module_type").change(function(){
           var module_type = $(this).val();

           if(module_type=='hotel' ||module_type =='car' || module_type== 'activities' || module_type=='transfers'){
            $(".airline_codes").addClass('hide');
           }else{
            $(".airline_codes").removeClass('hide');
           }
        });
    </script>
    
<script type="text/javascript">
$('#staff_user, #staff_user2').hide();
$('#agent_user, #agent_user2').show();
    $('#user_type').on('change', function() {
      var val = $(this).find(':selected').attr('data-id')
      //alert(val);
      if(val == 'STAFF')
      {
          $('#staff_user').show();
          $('#agent_user').hide();
      }else if(val == 'B2B'){
          $('#staff_user').hide();
          $('#agent_user').show();
      }else{
          $('#staff_user').hide();
          $('#agent_user').hide();
      }
    });
    
    $('#user_type2').on('change', function() {
      var val = $(this).find(':selected').attr('data-id')
      if(val == 'STAFF')
      {
          $('#staff_user2').show();
          $('#agent_user2').hide();
      }else if(val == 'B2B'){
          $('#staff_user2').hide();
          $('#agent_user2').show();
      }else{
          $('#staff_user2').hide();
          $('#agent_user2').hide();
      }
    });
    
</script>
<script>
     function removeAirline(val)
     {
        if(val=='bus')
        {
            $("#airlinwise").hide();
           //  $('#airlinwise').find(':input').prop('required',false);
        }
        else
        {
            $("#airlinwise").show();
           // $('#airlinwise').find(':input').prop('required',true);
        }
     }
     
     function removeairlineWise(vals)
     {
        if(val=='bus')
        {
            $("#airlines1").hide();
            
        }
        else
        {
            $("#airlines1").show();
           
        }
     }
       $(document).ready(function(){
        var vals=$('.promo_code_type').val();
        // console.log(vals);
       if (vals=='single') {
            $('.limit_promo').hide();
         }else{
           $('.limit_promo').show();
         } 
        });
        function promocodetype(vals){
            
         if (vals=='single') {
            $('.limit_promo').hide();
         }else{
           $('.limit_promo').show();
         } 
        }
     
  </script>
  
  <script type="text/javascript">

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } ?>

</script>
</body>

</html>
