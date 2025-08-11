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
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<script src="<?php echo ASSETS; ?>js/jquery.dataTables.js"></script>
<script src="<?php echo ASSETS; ?>js/dataTables.tableTools.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
         .box_main .box-icon{
      width: 80px;
    height: 80px;
    display: inline-block;
    float: left;
 } 
  .box_main .box-icon span{
        line-height: 80px;
    padding: 0px;
    color: #fff;
    font-size: 50px;
  }
  .box_main .box-text{
  width: calc(100% - 80px);
  display: inline-block;
  float: left;
  padding-left: 15px;
 } 
 .box_main .box-text h3, .box_main .box-text span{
  color:#fff;
 }

 .box_main .box-text h3{
      margin: 12px 0px 6px 0px;
    padding: 0px;
    text-align: left;
    font-size: 30px;

 }
  .box_main .box-text span{
        text-align: left !important;
    font-size: 17px !important;
    line-height: 25px !important;
  }
  .violet .box_in{
    background: #fdb813;
  }
  .violet .box-icon{
  background: #203f7c; 
  }
  .pink .box_in{
    background: #444444;
  }
  .pink .box-icon{
  background: #bb1c65;
  }
  .orange .box_in{
    background: #444444;
  }
  .orange .box-icon{
  background: #e0790c;
  }
  #BookingList.rowit{
    margin-bottom: 20px;
  }
    </style>
</head>
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
        <aside class="aside col-md-3">
          <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
        </aside>
        <!--sidebar end-->



<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad dash-allbok">
<section class="wrapper">
<h3 class="lineth">My Group Bookings</h3>

<div class="main-chart">


    <div class="msg" style="display: none;"></div>
    <div class="errstatus" style="display: none;"></div>
<div class="cancel_loader"><div id="mainDiv"><div class="carttoloadr"><strong>Please Wait...Cancellation process is going on!!..</strong></div></div>

<div class="col-md-12">


<div class="col-md-12 nopad">
<div class="rowit" id="BookingList">

  <div class="bookings_only booking-intab">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Enquiry List</a></li>
    </ul>
  <div class="tab-content  booking-inertab">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="table-responsive" style="width: 100%;overflow-x: scroll;">
                <table class="table table-bordered" id="flight_report_pre">
                 <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Trip Type</th>
                      <th>Origin</th>
                      <th>Destination</th>
                      <th>Departure Date</th>
                      <th>Return Date</th>
                      <th>Total Pax</th>
                      <th>Adult Count</th>
                      <th>Child Count</th>
                      <th>Infant Count</th>
                      <th>Cabin Class</th>
                      <th>Airline</th>
                      <th>Enquiry Date</th>
                    </tr>
                 </thead>
                  <tbody>
                    <?php if($group_report){ $num = 1; for($k=0;$k<count($group_report);$k++){ 
                      $data_request_decode=json_decode($group_report[$k]->request,true);
                    ?>
                      <tr class="">
                        <td><?php echo $num; ?></td>
                        <td><?php if(strtoupper($data_request_decode['trip_type'])=='ROUND'){echo 'ROUNDWAY';}else{echo 'ONEWAY';} ?></td>
                        <td><?php echo $data_request_decode['from']; ?></td>
                        <td><?php echo $data_request_decode['to']; ?></td>
                        <td><?php echo date('d M Y',strtotime($data_request_decode['depature'])); ?></td>
                        <td><?php if(strtoupper($data_request_decode['trip_type'])=='ROUND'){ echo date('d M Y',strtotime($data_request_decode['return']));}else{echo ' -- ';} ?></td>
                        <td><?php echo $data_request_decode['adult']+$data_request_decode['child']+$data_request_decode['infant']; ?></td>
                        <td><?php echo $data_request_decode['adult']; ?></td>
                        <td><?php echo $data_request_decode['child']; ?></td>
                        <td><?php echo $data_request_decode['infant']; ?></td>
                        <td><?php echo $data_request_decode['class2']; ?></td>
                        <td><?php if($data_request_decode['airlines']!='0'){  $airline_name=$this->Flight_Model->get_airline_name($data_request_decode['airlines']);
                        echo $airline_name .'('.$data_request_decode['airlines'].')';}else{echo ' -- ';} ?></td>
                        <td><?php echo date('d M Y, h:i A',strtotime($group_report[$k]->insertion_time)); ?></td>
                      </tr>
                    <?php $num++; } } ?>
                  </tbody>
                </table>
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
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</body>
</html>
<script>
  $(document).ready(function () {
  var oTable = $('#flight_report_pre').dataTable({
          "oLanguage": {
              "sSearch": "Search all columns:"
          },
          'iDisplayLength': 10,
          "sPaginationType": "full_numbers",
          "dom": 'T<"clear">lfrtip',
          "tableTools": {
              "sSwfPath": "<?php echo base_url('assets2/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
          }
      });
  });
</script>