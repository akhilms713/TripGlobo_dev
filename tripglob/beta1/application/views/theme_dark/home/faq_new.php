   <body>
      <!-- Navigation -->
      <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>
      <!-- /Navigation --> 
     
        <div class="body_bg">
            <section class="main_newd_leftrdf data_forms">
                <div class="container wrapper_before_content">
                    <div class="col-md-12 faq_desgin">
                        <h3>Faq</h3>
                        
                        <div class="faq_desgin_outer">

                    
                        
                        <?php 
                        $i=1;
                             foreach ($faq_details as $vals) {
                                // echo $vals['subject'];
                              ?>

                          <div class="faq_qustion">
                            <h4>Q <?=$i++;?></h4>
                            <h5><?= $vals['subject'];?></h5>
                          </div>
                          <div class="faq_answer">
                             <h6>ans</h6>
                              <span><?= $vals['details']?></span>

                          </div>

                              
                             
                              <?php
                             }
                        ?>
                        </div>
                       
                        <div class="success" style="color: green;"></div>
                        
                    </div>
    </div>
            </section>
        </div>


      <!-- customers are growing -->
      <div class="clearfix"></div>
     