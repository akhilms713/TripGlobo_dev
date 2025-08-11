    <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header_new'); ?>

<style>
    
.form-control {
    width: 97%;
}
textarea.form-control {
   width: 550px !important;
}
.choose_file {
    margin-bottom: 8px;
    margin-top: 8px;
}
</style>

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
                             <label class="col-md-2 col-sm-2 choose_file">Upload Resume (PDF)</label>
                            <div class="col-md-4 col-sm-4 choose_file">
                               <input type="file" name="resume" id="resume"  required  accept="application/pdf">
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

<script type="text/javascript">
    $('#feedback_btn').on('click',function(){
       var value = $('#resume').val();
       var ext = value.split('.').pop();
       if (ext=='pdf') {
       return true;
       }else{
       $('#resume').val('')        
       alert('please upload valid pdf file'); 
       return false;        
       }
       // console.log(ext);
    });
</script>
    