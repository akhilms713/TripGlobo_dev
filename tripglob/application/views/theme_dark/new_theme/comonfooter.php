<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
<!--signupsec-->
<style>
   hr {
   margin-top: 20px;
   margin-bottom: 0px;
   border-top: 1px solid #fff;
   }
   .link{
   margin-left: 18px;
   color: white;
   text-decoration: underline;
   margin-bottom: 10px;
   }

   .footer_cities ul {padding-left: 0px}
   .footer_cities li {
    list-style: none;
    color: #fff!important;
    padding: 1px 0;
 /*  list-style: none;*/
}
.footer_cities ul li a {
    color: #000!important;  
    font-size: 15px;
    line-height: 28px;
}

.footer_cities ul li a:hover{text-decoration: none;}
.foot_phone{width: 100%;float: left;margin-top: 10px; font-size: 13px;}
.foot_phone i {
    color: #193960;
    font-size: 16px;
    width: 19px;
    padding-right: 5px;
    height: auto;
}
.list_css{
    float: left;
    list-style: none;
    padding: 0px 10px 0px 10px;
    margin-top: 13px;
}
.list_brdr{
    border-left: 1px solid;
    height: 1.4em;
}
.ftr_sec{
  background: #fff; text-align: center;height:45px; border-radius:50px;
}
.ftr_mailbtn{
    color: #fff; 
    background-color: #db271d;
    border-color: #ccc;
    margin-left: -4px;
    border: 1px solid #db271d;
    border-radius: 0px 50px 50px 0px;
}
.ftr_input{
    background: #fff0;
    border: 1px solid #db271d;
    border-radius: 50px 0px 0px 50px;
}

</style>
<!--/signupsec-->
<!-- <div class="comonfooter">
   <div class="container">
     <div class="footout">
   <div class="col-md-3 nopad">
         <div class="inerlets">
            <a class="logo" style="float: none;" href="<?php echo WEB_URL; ?>" > <img src="<?php echo base_url(); ?>assets/theme_dark/images/logo.png" alt="" /> </a>
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


      <div class="col-sm-3 col-xs-6 ft_custom margin-top-xs">
         <!--  <div class="foot_logo">
            <img src="<?php echo base_url();?>assets/theme_dark/images/logo.png">
            </div>  --> 
         <h4>Contact</h4> 
         <!-- <span class="foot_phone"><i class="fa fa-map-marker"></i>
          <span class="new_footer_aligmnt">1400 Pennsylvania Ave, 2002 DC</span>
         </span>  -->
        <!-- <span class="foot_phone"><i class="fa fa-phone"></i> <span class="new_footer_aligmnt"></span></span>-->
         <a href="mailto:contact@tripglobo.com"><span class="foot_phone"><i class="fa fa-envelope-o"></i><span class="new_footer_aligmnt">contact@tripglobo.com</span></span></a>
         
         
         
         <div class="clearfix"></div>
      </div>

      <?php foreach ($footer as $valueFooter){ ?>
        
      <div class="col-sm-3 col-xs-6 ft_custom margin-top-xs">
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
      
     //$cc= $visitor->visitor_count1+1; 
        
      //debug($cc);exit();
       //$sql11 = "UPDATE `visitor` SET `visitor_count1` = '$cc' WHERE `visitor`.`visitor_id` = '1'";
       //$this->db->query($sql11);
      
      ?>
      
      <div id="CounterVisitor" style="padding-left:77px;color: #193860;font-size: large;">
        <!-- Total Visitor:  <?php echo $visitor->visitor_count;  ?>-->
</div>
      
   
   <span><img class="foot_foot_dootre" src="<?php echo base_url();?>assets/theme_dark/images/footer_logo-new.png" alt=""></span>
 </div>
 
 
 
<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126204130-2"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

 

  gtag('config', 'UA-126204130-2');

</script>
 <div class="last_copyright" style="position: absolute;width: 100%;margin-bottom: 0;">
      <div class="">
         <div class="col-md-12 text-center" style="background:#fdb813;">
          <br>
          <div class="lst_foot" style="padding:0px 10px 10px 10px; color: #000;"> Ⓒ <?=date('Y')?> Copyright. All rights reserved</div>
         </div>
      </div>
   </div>
  


       </div>

</div>
