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
      <?php if($this->session->userdata('user_type')=='1' || $this->session->userdata('user_type')=='4'){
         echo $this->load->view(PROJECT_THEME.'/common/header');
         }else{
         echo $this->load->view(PROJECT_THEME.'/new_theme/header'); 
         } 
      ?>
      <div class="clearfix"></div>
      <div class="dash-img"> </div>
      <div class="container">
         <div class="dashboard_section">
            <div class="col-md-12 nopad">
              <!--sidebar start-->
               <aside class="aside col-md-3">
                  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
               </aside>
               <!--main content start-->
               <section id="main-content" class="col-md-12 tab_sty nopad viewproff">
                  <section class="wrapper">
                     <h3 class="lineth">Knowledge base</h3>
                     <div class="main-chart" id="viewpro">
                        <div class="panel-group" id="accordion">
                        <?php
                          $i = 1; 
                          foreach($kb as $row) { ?>
                          <div class="panel panel-default">
                            <div class="panel-heading" style="cursor: pointer;" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                              <h4>
                                  <?php echo $row->subject; ?>
                              </h4>
                            </div>
                            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo $i==1 ? 'in' : '' ?>">
                              <div class="panel-body">
                                <?php echo $row->details; ?>
                              </div>
                            </div>
                          </div>
                          <?php $i++; } ?>
                        </div>
                     </div>
            </div>
            
            <div class="clearfix"></div>
            <!-- End of Admin top -->
            <div class="clearfix"></div>
            <div class="row margtop15 addings hide">
              <div class="col-md-4 offset-0"> 
                <div class="inrowit">
                  <span class="size16 bold dark newprof">Recent Bookings</span>
                  <div class="outsprof">
                 
                  </div>
                </div>
              </div>
            </div>
         </div>
         <?php //$this->load->view(PROJECT_THEME.'/dashboard/profile/edit_profile');?>
         <?php //$this->load->view(PROJECT_THEME.'/dashboard/profile/verifications');?>        
         </section>
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