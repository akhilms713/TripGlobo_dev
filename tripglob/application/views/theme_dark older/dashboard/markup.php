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
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .dash-inpt select {border: 1px solid #e4e4e4;}
  .dash-inpt input {border: 1px solid #e4e4e4;}
  .nav-tabs>li.active>a{color: #fff!important;}
  </style>
</head>
<body>
<!-- Navigation -->
<?php if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
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
<aside class="aside">
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
<section class="wrapper">
<h3 class="lineth">MarkUp</h3>
<div class="main-chart">

<?php if (isset($email_v)) { ?>
                <div class="msg" style="display: block;"><?php echo $email_v; ?></div>
<?php } ?>
<?php if (isset($err_v)) { ?>
                <div class="msg" style="display: block;"><?php echo $err_v; ?></div>
<?php } ?>
<?php if (isset($d_msg)) { ?>
                <div class="msg" style="display: block;"><?php echo $d_msg; ?></div>  
<?php } ?>

    <div class="msg" style="display: none;"></div>
    <div class="errstatus" style="display: none;"></div>


<div class="tab_inside_profile"> 
   <!--  <span class="profile_head">Markup </span> -->
    <div class="rowit marbotom20">
    <div id="addMarkUpLoader" class="lodrefrentrev imgLoader">
        <div class="centerload"></div>
    </div>
        <div class="inreprow">
            <div class="col-md-12 nopad">
         
         <ul class="nav nav-tabs" >
          <li class="active"><a data-toggle="tab" href="#list-markup" style="color:#000;">Markup List</a></li>
          <li><a data-toggle="tab" href="#add-markup" style="color:#000;">Add Markup</a></li>
        </ul>


            <div class="clearfix"></div>
          <div class="tab-content" id="nav-tabContent">

             <!-- ----------------------------------------------markup List------------------------------------------------------------------ -->
          <div class="tab-pane fade in active" id="list-markup" role="tabpanel" aria-labelledby="list-markup-tab">
              <div class="table-responsive">
              <table id="depostDatatable" class="data-table-column-filter table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr class="sortablehed">
                    <th>Sl No</th>
                    <th>Model</th>
                    <th>Markup Type</th>
                    <th>Markup Value</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 1; ?>
                  <?php if(!empty($get_markup)): ?>
                  <?php foreach($get_markup as $k):  ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php
                     if ($k->product_id==1) {
                           echo 'Flight';
                       }elseif ($k->product_id==2) {
                           echo 'Hotel';
                       }else{
                        echo 'Bus';
                       }  
                     ?></td>
                    <td><?php echo $k->markup_value_type; ?></td>
                    <td><?php echo $k->markup; ?></td>
                    <td><?php echo $k->created_date; ?></td>
                  </tr>
                  <?php $count++; ?>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

          </div>
           <!-- ----------------------------------------------Add Markup------------------------------------------------------------------ -->
          <div class="tab-pane fade" id="add-markup" role="tabpanel" aria-labelledby="add-markup-tab">
            <div class="fullquestionswrp5">
            <?php 
            $flight_mark='';
            $hotel_mark='';
            $car_mark='';
            foreach ($get_markup as $key => $mark) {
                if($mark->product_id=='1'){
                    $flight_mark=$mark->markup;
                }else if($mark->product_id=='2'){
                    $hotel_mark=$mark->markup;
                }else if($mark->product_id=='7'){
                    $car_mark=$mark->markup;
                }
            } ?>
              <form action="<?php echo WEB_URL.'user/addMarkup';?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal' id="add_markup" name="add_markup">
                <div class="dashprof-inpt">
                        <div class="dash-lab">
                        Product<sup class="fl-star">*</sup>
                        
                        </div>
                        <div class="dash-inpt nopad">
                        <select id="product_id" name="product_id" class="typecodeans notypmar" required="required" aria-required="true" aria-invalid="false">
                          <option value="">--Choose Product--</option>
                                  <?php foreach ($products as $product) 
                                  { 
                                  ?>
                                  <option value="<?php echo $product->product_id;?>"><?php echo $product->product_name;?></option>
                                  <?php }  ?>
                         </select>
                         </div>
                    </div>

                    <div class="dashprof-inpt">
                        <div class="dash-lab">Markup Value Type <sup class="fl-star">*</sup>
                        </div>
                        <div class="dash-inpt nopad">
                        <select  id="markup_value_type" name="markup_value_type" class="typecodeans notypmar" required="required" aria-required="true" aria-invalid="false">
                                  <option value="percentage">Percentage</option>
                                  <option value="fixed" selected="">Fixed</option>
                            </select>
                            </div>
                    </div>
               
                    <div class="dashprof-inpt">
                        <div class="dash-lab">Markup<sup class="fl-star">*</sup></div>
                        <div class="dash-inpt nopad">
                        <input type="number" placeholder="0" id='mark_val'  min="0" max="100" required="" name="markup" class="typecodeans notypmar" required="required">
                            </div>
                    </div>
              
                <div class="mrg_btm">
                  <div class="col-md-3 ">
                  </div>
                  <div class="col-md-5">
                    <button type="submit"   class="dashbuttons extr_profile">Add Markup</button>
                    </div>
                </div>
            </form>
            </div>
          </div>
         
        </div>
        </div>
    </div>
</div>
</div>

</section>
</section>
</div>
</div>
</div>
<div class="clearfix"></div>


<!-- Page Content -->
<div class="clearfix"></div>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 


</body>
</html>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/settings.js"></script>
<script>
$(document).ready(function(){
    

        $('#addMarkUp').click(function() {
            $('.fullquestionswrp5').slideToggle(500);
        })
      $("#add_markup").validate({
          rules: {
              field: {
                  required: true,
                  number: true
              }
           },   
          submitHandler: function() { 
            $('#addMarkUpLoader').show();
            var action = $("#add_markup").attr('action');
            $.ajax({
              type: "POST",
              url: action,
              data: $("#add_markup").serialize(),
              dataType: "json",
              success: function(data){
                alert('test');
                $('#addMarkUpLoader').hide();
                $('.msg').show();
                $('.msg').text('Mark up updated successfully.');
                $('.fullquestionswrp5').slideToggle(500);
              }
            });
            return false; 
          }
        });

          $("#product_id").change(function()
            {
                 var id = $(this).find(":selected").val();
                 var flight_mark="<?php echo $flight_mark; ?>";
                 var hotel_mark="<?php echo $hotel_mark; ?>";

                 var car_mark="<?php echo $car_mark; ?>";
                 
                 if(id=='1'){
                    if(flight_mark!=''){
                        $('#mark_val').val(flight_mark);
                    }
                 
                 }else if(id=='2'){
                   if(hotel_mark!=''){
                        $('#mark_val').val(hotel_mark);
                    }
                 }else if(id=='7'){
                    if(car_mark!=''){
                        $('#mark_val').val(car_mark);
                    }
                 }
          });
               

    });

  </script>
