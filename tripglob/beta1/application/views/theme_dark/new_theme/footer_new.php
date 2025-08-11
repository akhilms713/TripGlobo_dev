
<!--signupsec-->

<!--/signupsec-->
<!-- <div class="comonfooter">
   <div class="container">
     <div class="footout">
   <div class="col-md-3 nopad">
         <div class="inerlets">
            <a class="logo"  style="float: none;" href="<?php echo WEB_URL; ?>" > <img src="<?php echo base_url(); ?>assets/theme_dark/images/logo.png" alt="" /> </a>
         </div>
       </div>
   
   
     <div class="col-md-3 nopad">
         
          <?php 
      $CI = get_instance();
      $CI->load->model('home_model');  
      $social_links_details = $CI->home_model->social_links(); 
      foreach($social_links_details as $links) {
      $icon_img = $links->icon;
      $link = $links->link;
      ?>
            <?php } ?> 
          
   <?php 
      $footer_details = $CI->home_model->footer_details(); 
      // debug($footer_details);
      // exit;
        foreach($footer_details as $footers) {
          $footer_name = $footers->footer_name;
          $footer_desc = $footers->description;
          ?>
          <div class="col-md-12 mefotr"> 
              <h2>About Us</h2>
           <ul class="footerlistblack">
            <?php echo $footer_desc; ?>
           </ul>
         </div>      
         <?php  } ?>
     </div>
   
      <div class="col-md-3 nopad">
         
          <div class="col-md-12 mefotr"> 
          <h2>Quick Links</h2>
           <ul class="footerlistblack">
             <li><a href="<?=base_url()?>">Home</a></li>
             <li><a href="<?=base_url()?>Flights">Flights</a></li>
             <li><a href="<?=base_url()?>Hotels">Hotels</a></li>
             <li><a href="<?=base_url()?>Cars">Cars</a></li>
             <li><a href="<?=base_url()?>Packages">Bundle Deals</a></li>
             <li><a href="<?=base_url()?>Activities">Activites</a></li>
             <li><a href="<?=base_url()?>Transfers">Transfers</a></li>
           </ul>
         </div>      
        
     </div>
   
   
     <div class="col-md-3 nopad">
         
          <?php 
      $CI = get_instance();
      $CI->load->model('home_model');  
      $social_links_details = $CI->home_model->social_links(); 
      foreach($social_links_details as $links) {
      $icon_img = $links->icon;
      $link = $links->link;
      ?>
            <?php } ?> 
          
   <?php 
      $footer_details = $CI->home_model->footer_details(); 
        foreach($footer_details as $footers) {
          $footer_name = $footers->footer_name;
          $footer_desc = $footers->description;
          ?>
          <div class="col-md-12 mefotr"> 
              <h2>Site Links</h2>
           <ul class="footerlistblack">
            <?php //echo $footer_desc; ?>
           </ul>
         </div>      
         <?php  } ?>
     </div>
   
   
   
     </div>
   </div>
   <div class="container"> 
   <div class="col-md-6 nopad text-left">   
   <span class="copurit">&copy; 2018 &nbsp;&nbsp;<a href="#"> <?php  echo PROJECT_URL; ?></a> &nbsp;&nbsp;          All Rights Reserved </span> 
   </div>
   
   <div class="col-md-6 nopad text-right"> 
      <span class="copurit">Powered by <a href="https://www.provab.com" target="_blank">Provab</a></span>
   </div>
   
   </div>
   </div>
   -->
<?php $ci =& get_instance();
   $ci->load->model('General_Model');
   $spcialdata= $ci->General_Model->socialiconfunction(); 
   // $imp_link= $ci->General_Model->get_important_links(); 
   $imp_link= $ci->General_Model->footer_details_db(); 
   //$data['spcialdata'] = $this->General_Model;
   // echo "<pre>";print_r($imp_link); exit('pankaj');

    $ci->load->model('flight_model');
    $data['destinations']= $ci->flight_model->get_top_destinations(5);
    $data['airline_pages']= $ci->flight_model->get_airline_page_link(5);
    //print_r($data['destinations']); exit;
   ?>


<div class="col-md-12 hidden-xs" style="background:#fff;padding:0px;">
 <!--  <img src="http://tauliaconnect.com/img/buildings.png" width="100%" height="300px"> -->
 <!-- <img src="<?php echo base_url(); ?>assets/theme_dark/images/buildings.jpg" alt="Vietnet" width="100%" height="300px"/>  -->
</div>
<!----For mobile view------->
<div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="background:#fff;padding:0px;">
<!-- <img src="http://tauliaconnect.com/img/buildings.png" width="100%" > -->  
<!-- <img src="<?php echo base_url(); ?>assets/theme_dark/images/buildings.jpg" alt="Vietnet" width="100%"/> -->
</div>
<!------------>
<?php 
 $sql = "SELECT * FROM footer_details where status='ACTIVE' ORDER BY position asc";
 $footer = $this->db->query($sql)->result();
 
 /*$sql2 = "SELECT * FROM footer_data where status='ACTIVE'";
 $footer_data = $this->db->query($sql2)->result();*/
 
?>
<div class="last_footer">
   <div class=""></div>
   <div class="container">
     
      <?php if(empty($imp_link)){ ?>
      <!-- <div class="col-sm-3 ">
         <h4>&nbsp;</h4>
      </div> -->
      <?php }else{?>

      <?php } ?>
      <!-- <div class="col-sm-3 ft_custom margin-top-xs">
         <h4><?=$imp_link[1]->footer_name?></h4>
         <div class="footer_cities">
            <?=$imp_link[2]->description?>
            <a href="<?php echo WEB_URL.'flight/site_map'?>" class="link">View More</a>
         </div>
      </div> -->


      <div class="col-sm-3 col-xs-12 ft_custom margin-top-xs">
         <!--  <div class="foot_logo">
            <img src="<?php echo base_url();?>assets/theme_dark/images/logo.png">
            </div>  --> 
         <h4>Contact</h4> 
         <!-- <span class="foot_phone"><i class="fa fa-map-marker"></i>
          <span class="new_footer_aligmnt">1400 Pennsylvania Ave, 2002 DC</span>
         </span>  -->
        <!-- <span class="foot_phone"><i class="fa fa-phone"></i> <span class="new_footer_aligmnt"></span></span>-->
         <span class="foot_phone"><i class="fa fa-envelope-o"></i><span class="new_footer_aligmnt">contact@tripglobo.com</span></span>
         <span class="foot_phone"><i class="fa fa-users"></i><span class="new_footer_aligmnt"><a href="https://tripglobo.com/beta1/account/agent_registration">Become An Agent</a></span></span>
         
         
         <div class="clearfix"></div>
      </div>

      <?php foreach ($footer as $valueFooter){ ?>
        
      <div class="col-sm-3 col-xs-12 ft_custom margin-top-xs">
         <h4><?=$valueFooter->footer_name?></h4>
         <div class="footer_cities">
            <?=$valueFooter->description?>
            
         </div>
      </div>
      <?php } ?>

      <div class="clearfix"></div>
      <?php
      $sql1 = "SELECT * FROM visitor";
      $visitor = $this->db->query($sql1)->row();
      
    //$cc= $visitor->visitor_count +1;      
      
       //$sql11 = "UPDATE `visitor` SET `visitor_count` = '$cc' WHERE `visitor`.`visitor_id` = '1'";
       //$this->db->query($sql11);
      
      ?>
      
      <div id="CounterVisitor" style="padding-left:77px;color: #193860;font-size: large;">
         Total Visitor:  <?php echo $visitor->visitor_count;  ?>
</div>
      
   
   <span><img class="foot_foot_dootre" src="<?php echo base_url();?>assets/theme_dark/images/footer_logo-new.png" alt=""></span>
 </div>
 
 
 
<!-- Global site tag (gtag.js) - Google Analytics -->


 <div class="last_copyright">
      <div class="">
         <div class="col-md-12 text-center" style="background:#fdb813;">
          <br>
          <div class="lst_foot" style="padding:0px 10px 10px 10px; color: #000;"> Ⓒ <?=date('Y')?> Copyright. All rights reserved</div>
         </div>
      </div>
   </div>
  


       </div>

</div>


      
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
<script type="text/javascript">
function doLogin(data){
  $('#simnavrit #login_signup').remove();
  //$('#simnavrit #agent_signup').remove();
  //$('.wrapofa.login').remove();
  var login = '<li role="presentation" id="login_signup1" class="dropdown login_after"><a href="#" class="topa dropdown-toggle nomargin" data-toggle="dropdown"> <div class="reglog"><div class="userimage user_profimag"><img src="'+data.profile_photo+'" alt=""/></div><div class="userorlogin">'+data.fname+'</div></div></a><ul class="dropdown-menu mysign1"><li><a href="<?php echo WEB_URL;?>dashboard"><i class="fa fa-dashboard"></i> <span class="name_currency">Dashboard</span></a></li><li><a href="<?php echo WEB_URL;?>dashboard/bookings"><i class="fa fa-book"></i><span class="name_currency">Bookings</span></a></li><li><a href="<?php echo WEB_URL;?>dashboard/settings"><i class="fa fa-cog"></i><span class="name_currency">Settings</span></a></li><li><a href="<?php echo WEB_URL;?>dashboard/support_conversation"><i class="fa fa-life-ring"></i><span class="name_currency">Support</span></a></li><li><a href="<?php echo WEB_URL;?>auth/logout/<?php echo PROJECT_NAME; ?>/'+data.rid+'">Logout</a></li></ul></li>';
  $(login).appendTo('#simnavrit');
  /* dropdown animation*/
var dropdownSelectors = $('.dropdown, .dropup');
dropdownSelectors.on({
  "show.bs.dropdown": function () {
    // On show, start in effect
    var dropdown = dropdownEffectData(this);
    dropdownEffectStart(dropdown, dropdown.effectIn);
  },
  "shown.bs.dropdown": function () {
    // On shown, remove in effect once complete
    var dropdown = dropdownEffectData(this);
    if (dropdown.effectIn && dropdown.effectOut) {
      dropdownEffectEnd(dropdown, function() {}); 
    }
  },  
  "hide.bs.dropdown":  function(e) {
    // On hide, start out effect
    var dropdown = dropdownEffectData(this);
    if (dropdown.effectOut) {
      e.preventDefault();   
      dropdownEffectStart(dropdown, dropdown.effectOut);   
      dropdownEffectEnd(dropdown, function() {
        dropdown.dropdown.removeClass('open');
      }); 
    }    
  }, 
});

}

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<script type="text/javascript">
  $(function(){
      if (localStorage.chkbx && localStorage.chkbx != '') {
          $('#remember_me').attr('checked', 'checked');
          $('#login_email_id').val(localStorage.usrname);
          $('#pswd').val(localStorage.pass);
      } else {
          $('#remember_me').removeAttr('checked');
          $('#login_email_id').val('');
          $('#pswd').val('');
      }

      $('#remember_me').click(function() { 
       
          if ($('#remember_me').is(':checked')) {
              // save username and password
              
              localStorage.usrname = $('#login_email_id').val();
              localStorage.pass = $('#pswd').val();
              localStorage.chkbx = $('#remember_me').val();
             

          } else {
            
              localStorage.usrname = '';
              localStorage.pass = '';
              localStorage.chkbx = '';
          }
      });

  });
  function ChangeCurrency(that){
    var code = $(that).data('code');
    var icon = $(that).data('icon');
    // alert(code);
    // alert(icon);
    //$('.currencychange').hide();
    var data = {};
    data['code'] = code;
    data['icon'] = icon;
    $.ajax({
      type: 'POST',
      url: '<?php echo WEB_URL;?>general/change_currency',
      async: true,
      dataType: 'json',
      data: data,
      success: function(data) {
        // alert('fff');
      location.reload();
      }   
    });
    } 
</script>
        <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
  }
</script>


<!-- Flag click handler -->
<script type="text/javascript">
    $('.translation-links a').click(function() {
      var lang = $(this).data('lang');
      var $frame = $('.goog-te-menu-frame:first');
      if (!$frame.size()) {
        alert("Error: Could not find Google translate frame.");
        return false;
      }
      $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
      return false;
    });
    
    
    // b2c_register_clk
    $('#b2c_register_clk').click(function() {
        var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{5,15}$/;
        var inputtxt=$('.valid_pass').val();
        if(inputtxt.match(decimal)) 
        { 
            $('#regex_err_pass').hide();
            return true;
        }else{ 
            $('#regex_err_pass').show();
            return false;
        }
    });
    
   
</script>
 <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer_js');  ?>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/datepicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/wow.min.js"></script>
       <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126204130-2"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

 

  gtag('config', 'UA-126204130-2');

</script>
 </body>
</html>