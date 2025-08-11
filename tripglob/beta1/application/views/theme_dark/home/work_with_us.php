<style>
    
    .wrapper_before_content{
        margin-top: 75px;
    }
</style>
   
<!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?php echo PROJECT_TITLE; ?></title>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <!-- Custom CSS -->
<!--       <link href="<?php //echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
      <link href="<?php //echo base_url(); ?>assets/theme_dark/css/main_ff.css" rel="stylesheet" />  -->

<style type="text/css">
.data_forms .ft .col-md-6{padding-bottom:5px;}
.data_forms h3{text-align:center;}
.fgt_secss{
    	    margin-top:70px;
		 
}
</style>
   </head>
   <body>
      <!-- Navigation -->
     
      <div class="clearfix"></div>
      <!-- /Navigation --> 
     
  <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
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


      <!-- customers are growing -->
      <div class="clearfix"></div>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <!-- /.container --> 
      <link href="<?php //echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/datepicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/wow.min.js"></script>
      
    <script>
    
        $(function() {  
        $("textarea[maxlength]").bind('input propertychange', function() {  
            var maxLength = $(this).attr('maxlength');  
            if ($(this).val().length > maxLength) {  
                $(this).val($(this).val().substring(0, maxLength));  
            }  
        })  
    });
    
     $('#suggestion, #feedback, #about_yourself').on('keypress', function (event) {
        var regex = new RegExp("^[0-9a-zA-Z \b]+$");
        var key = String.fromCharCode(!event.charCode ? event.which: event.charCode);
        if (!regex.test(key)) 
        {
            event.preventDefault();
            return false;
        } 
    });

     
    $("#advertise_form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(),
               success: function(data)
               {
                   alert('Request sent Successfully. Our Team will contant you shortly.');
               }
             });
    });
    
    
    $("#feedback_form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(),
               success: function(data)
               {
                   alert('Your Feedback sent Successfully.');
               }
         });
    });
    
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
      <?php if($this->session->flashdata('success')){ ?>
          toastr.success("<?php echo $this->session->flashdata('success'); ?>");
      <?php }else if($this->session->flashdata('error')){  ?>
          toastr.error("<?php echo $this->session->flashdata('error'); ?>");
      <?php }else if($this->session->flashdata('warning')){  ?>
          toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
      <?php }else if($this->session->flashdata('info')){  ?>
          toastr.info("<?php echo $this->session->flashdata('info'); ?>");
      <?php } ?>
    </script>
    
    
      <script>   
        AOS.init(); 
      </script>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer_js'); 
         ?>
   </body>
</html>