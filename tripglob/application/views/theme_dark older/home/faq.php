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
.faq_desgin h3 {
text-align: center;
font-size: 28px;
text-transform: uppercase;
font-weight: 600;
padding: 15px;
text-decoration: underline;
}




.faq_desgin {
background: none;
float: left;
border: 1px solid yellowgreen;
padding: 0px;
}

.faq_desgin h4 {
float: left;
text-align: left;
font-size: 15px;
font-weight: 600;
padding-right: 15px;
}

.faq_desgin_outer {
padding: 25px;
float: left;
width: 100%;
}

.faq_desgin h5 {
float: left;
text-align: left;
font-size: 17px;
font-weight: 600;
}

.faq_qustion {
float: left;
width: 100%;
padding: 15px;
}

.faq_answer {
width: 100%;
float: left;
background: #e9e9e9;
padding: 6px 15px;
}

.faq_desgin h6 {
float: left;
text-align: left;
font-size: 15px;
font-weight: 600;
padding-right: 11px;
text-transform: capitalize;
}

.faq_desgin span {
float: left;
text-align: left;
font-size: 15px;
font-weight: 400;
}
</style>
   </head>
   <body>
      <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
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
                   $('#feedback_form').trigger("reset");
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