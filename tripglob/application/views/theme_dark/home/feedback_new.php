   <body>
      <!-- Navigation -->
        <div class="clearfix"></div>
      <!-- /Navigation --> 
     
        <div class="body_bg">
            <section class="main_newd_leftrdf data_forms">
                <div class="container wrapper_before_content">
                    <div class="col-md-12 ">
                        <h3>Feedback</h3>
                        <p style="color:green;padding-left:20px;"><?= $this->session->flashdata('success');?></p>
                        <form action="<?php echo base_url();?>general/send_feedback_request" id="feedback_form" method="post">
            
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
                                    <textarea class="form-control" id="feedback" name="feedback" placeholder="Feedback" maxlength="100" required></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group ft">
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" id="suggestion" name="suggestion" placeholder="Suggestion" maxlength="100" required></textarea>
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

