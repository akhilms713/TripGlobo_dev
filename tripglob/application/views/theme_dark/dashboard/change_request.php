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
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />  
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<script>
  var WEB_URL = "<?=WEB_URL?>";
</script>
<script type="text/javascript" src="<?php echo ASSETS; ?>js/custom_modified.js"></script>
   
</head>

<body>
<!-- Navigation -->
<?php
// debug($this->session->userdata);exit();
 if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
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

<!--main content start-->
<section id="main-content" class="col-md-12 tab_sty nopad viewproff">
        <h3 class="lineth">Change Requests</h3>
        <div class="row">
            <div class="col-md-2"></div>
            
         <div class="col-md-8">
             
             <form id="change_request" method="post" name="change_request" action="<?php echo base_url(); ?>dashboard/send_change_request">
                <div class="tab-content">
                  <div class="tab-pane active" id="">
                    <div class="tab_inside_profile"> 
                        <div class="rowit">
                          <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                            <div class="prolabel">Pnr No. : </div>
                          </div>
                          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                            <input minlength="4" type="text" class="form-control" name="pnr" placeholder="" value="" required="">
                          </div>
                         
                          <div class="col-lg-3 col-md-3 col-sm-12 fullprofiles">
                            <div class="prolabel">Comments :</div>
                          </div>
                          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15 fullprofiles">
                            <textarea class="form-control" name="remarks" placeholder="" required=""></textarea>
                          </div>
                         
                          <div class="col-sm-12">
                            <button type="submit" class="center_btn">Save</button>
                          </div>
                          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15"> </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
            </form>
             
             <div class="table-responsive">
              <table id="depostDatatable" class="data-table-column-filter table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>PNR</th>
                    <th>Comments</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count = 1; ?>
                  <?php if(!empty($change_request)): ?>
                  <?php foreach($change_request as $k): ?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $k->pnr_no; ?></td>
                    <td><?php echo $k->request; ?></td>
                    <td><?php echo $k->create_date; ?></td>
                  </tr>
                  <?php $count++; ?>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</section>
</div>
</div></div>
</body>

<div class="clearfix"></div>


<!-- Page Content -->
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</body>
</html>
<script src="<?php echo ASSETS; ?>js/jquery.ajaxform.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>
