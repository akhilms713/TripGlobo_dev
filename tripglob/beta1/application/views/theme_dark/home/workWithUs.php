    <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header_new'); ?>
   <body>
      <!-- Navigation -->
     
      <div class="clearfix"></div>
      <!-- /Navigation --> 
     
 
        <div class="body_bg">
        
        <section class="main_newd_leftrdf data_forms">
            
            <div class="container">
                
                <div class="col-md-12 fgt_secss">
                    <h3>Work with us</h3>
                    
                    <form action="<?php echo base_url();?>general/work_with_us" method="post" id="work_form" enctype="multipart/form-data">
        
                        <div class="form-group ft">
                             <div class="col-md-6 col-sm-6">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required="required">
                            </div>
                        </div>
                        <div class="form-group ft">
                            <div class="col-md-6 col-sm-6">
                                <input type="email" id="sub_mail" name="email" class="form-control" placeholder="Email" required="required" onclick="ValidateEmail(document.form1.text1)">
                            </div>
                        </div>
                        <div class="form-group ft">
                            <div class="col-md-6 col-sm-6">
                            <input type="number" id="contant" name="contact_number" class="form-control" placeholder="Contact Number" required="required">
                            </div>
                        </div>
                        
                        <div class="form-group ft">
                            <div class="col-md-6 col-sm-6">
                            <input type="number" id="experience" name="experience" class="form-control" placeholder="Work experience" required="required">
                            </div>
                        </div>
                        
                        <div class="form-group ft">
                            <div class="col-md-6 col-sm-6">
                            <input type="text" id="qualification" name="qualification" class="form-control" placeholder="Qualification" required="required">
                            </div>
                        </div>
                        
                         <div class="form-group ft">
                             <label class="col-md-2 col-sm-2">Upload Resume</label>
                            <div class="col-md-4 col-sm-4">
                               <input type="file" name="resume" id="resume"  required>
                            </div>
                        </div>
                        
                        <div class="form-group ft">
                            <div class="col-md-6 col-sm-6">
                                <textarea class="form-control" id="about_yourself" name="about_yourself" placeholder="About Yourself" maxlength="100" required></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                        <button type="submit" id="feedback_btn" class="btn btn-primary button_newd_mamkp_q">Send</button>
                        </div>
                    
                    </form>
                    <div class="success" style="color: green;"></div>
                    
                </div>
            </div>
            
        </section>
            
        </div>


    