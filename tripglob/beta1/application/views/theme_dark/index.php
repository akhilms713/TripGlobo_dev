   <?php
      $sql1 = "SELECT * FROM visitor";
      $visitor = $this->db->query($sql1)->row();
      //debug($visitor);exit;
       $cc= $visitor->visitor_count + 1;      
       $sql11 = "UPDATE `visitor` SET `visitor_count` = '$cc' WHERE `visitor`.`visitor_id` = '1'";
       $this->db->query($sql11);
      
      ?>
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
      .main_second {
    padding: 30px 0px 0;
}
.full_section_pad_n {
    width: 100%;
    background: white;     padding: 15px 0px;
}      
      .main_section_headerd_n {
    position: relative; width: 88%;
}

.main_section_headerd_n img {
    width: 100%;
    height: 178px;
    object-fit: cover;
    border-radius: 50%;
}

.main_section_headerd_n h4 {
    position: absolute;
    bottom: 20px;
    background: #ffffff9c;
    padding: 6px 11px;
    text-align: center;
    color: #000;
    text-transform: capitalize;
    left: 27%;
    border-radius: 4px;
}

.main_section_headerd_n h3 {
    font-size: 17px;
    color: #203f7c;
    text-transform: capitalize;
    padding:  12px 0px;
    text-align: center;
}

#Flight_dates_ind .owl-buttons .owl-prev:before {
    content: "\f061";
    font-family: 'Font Awesome 5 Pro';
    /* color: red; */
    background: url(https://tripglobo.com/beta1/assets/theme_dark/images/prev_newd-1.png) no-repeat center 9px !important;
    width: 45px;
    height: 65px;
    float: left;
    position: absolute;
    top: 54px;
    left: 10px;
}

#Flight_dates_ind .owl-buttons .owl-next:before {
    content: "\f061";
    font-family: 'Font Awesome 5 Pro';
    /* color: red; */
    background: url(https://tripglobo.com/beta1/assets/theme_dark/images/next_newd-1.png) no-repeat center 9px !important;
    width: 45px;
    height: 65px;
    float: left;
    position: absolute;
    top: 54px;
    left: 10px;
}



#Flight_dates_ind_offer .owl-buttons .owl-prev:before {
    content: "\f061";
    font-family: 'Font Awesome 5 Pro';
    /* color: red; */
    background: url(https://tripglobo.com/beta1/assets/theme_dark/images/prev_newd-1.png) no-repeat center 9px !important;
    width: 45px;
    height: 65px;
    float: left;
    position: absolute;
    top: 54px;
    left: 10px;
}

#Flight_dates_ind_offer .owl-buttons .owl-next:before {
    content: "\f061";
    font-family: 'Font Awesome 5 Pro';
    /* color: red; */
    background: url(https://tripglobo.com/beta1/assets/theme_dark/images/next_newd-1.png) no-repeat center 9px !important;
    width: 45px;
    height: 65px;
    float: left;
    position: absolute;
    top: 54px;
    left: 10px;
}
        
/*@media (max-width:1199px) {*/
/*    #Flight_dates_ind .owl-buttons.owl-prev {left:-20px !important;}*/
    
/*}*/


/*.main_new_imagessctions::first-child img{float:right;} */
/*.main_new_imagessctions img:first-child {float:right;} */
.customtab.Y {
    padding: 120px 0px 55px 0px!important;
}
.dyamnic_par h4 {
    font-size: 21px;
    padding: 7px 12px;
}

.dyamnic_par h5 {
    font-size: 18px;
    padding: 0px 12px;
}

.dyamnic_par h6 {
       font-size: 20px;
    padding: 7px 12px;
    font-weight: 400;
    text-transform: capitalize;
    text-shadow: none;
}

.main_section_headerd_nx {
    width: 100%;
    float: left;
}

.main_section_headerd_nx img {
    width: 93%; padding-top: 15px;
}

section.second_n_z_offfzx {
    position: relative;
    float: left;
    width: 100%;
    background: #fff;
    padding: 35px 0px;
}

.dyamnic_par {
    position: absolute;
    bottom: 20px;
    left: 50px;
    /*background: #0000009e; */
    color: #fff;
    font-family: 'Lato', sans-serif !important;
}

.main_new_imagessctions img{width:100%;}
.main_new_imagessctions {float: none;width: 80%;margin: auto;}



@media (max-width:991px){.main_new_imagessctions {width: 100%;}}

        #Flight_dates_ind .owl-buttons .owl-prev { 
     left: -80px;
    position: absolute;
    top: 44px;
    height: 178px;
    opacity: 1;
    text-indent: -9999;
    font-size: 0 !important;
    opacity: 1 !important;
    width: 68px;
    border-radius: 0px !important;
    background: #f5f5f5  !important;

}
  #Flight_dates_ind .owl-buttons .owl-next { 
    right: -80px;
    position: absolute;
    top: 44px;
    height: 178px;
    opacity: 1;
    text-indent: -9999;
    font-size: 0 !important;
    opacity: 1 !important;
    width: 68px;
    border-radius: 0px !important;
    background: #f5f5f5  !important;

}
img.main_abosule_n {
    width: 25px;
    position: absolute;
    right: 6px;
    top: -16px;
}

   #Flight_dates_ind_offer .owl-buttons .owl-prev { 
     left: -80px;
    position: absolute;
    top: 22px;
    height: 178px;
    opacity: 1;
    text-indent: -9999;
    font-size: 0 !important;
    opacity: 1 !important;
    width: 68px;
    border-radius: 0px !important;
    background: #f5f5f5  !important;

}
  #Flight_dates_ind_offer .owl-buttons .owl-next { 
    right: -80px;
    position: absolute;
    top: 22px;
    height: 178px;
    opacity: 1;
    text-indent: -9999;
    font-size: 0 !important;
    opacity: 1 !important;
    width: 68px;
    border-radius: 0px !important;
    background: #f5f5f5  !important;

}
#best_tour_plan .owl-buttons .owl-prev {
    background: #fff url(<?= base_url(); ?>assets/theme_dark/images/next_buttons_newd1.png) no-repeat center 9px !important;
    left: 0;
    position: absolute;
    bottom: -60px;
    height: 50px;
    opacity: 1;
    text-indent: -9999;
    font-size: 0 !important;
    opacity: 1 !important;
    width: 78px;
    border-radius: 0px !important;
}

  #best_tour_plan .owl-buttons .owl-next { 
     background: #fff url(<?= base_url(); ?>assets/theme_dark/images/next_buttons_newd.png) no-repeat center 9px !important;
    left: 70px;
    position: absolute;
    bottom: -60px;
    height: 50px;
    opacity: 1;
    text-indent: -9999;
    font-size: 0 !important;
    opacity: 1 !important;
    width: 78px;
    border-radius: 0px !important;

}
 
         .topdstnatn {
         width: 100%;
         float: left;
         background: #fff;
         padding: 15px 0px;
         }
         .top_d {
         width: 100%;
         float: left;
         padding: 0px 0px 0px 0px;
         }
         .top_d ul li {
         margin: 0px 0px;
         list-style: disc;
         padding: 4px 0px;
         }
         .top_d ul li a {  
         margin: 0px 0px;
         padding: 0px 0px;
         text-decoration: none;
         font-size: 14px;
         color:#182a3c; 
         }
         .tab_ss{
         width: 20%;
         /*   margin-right: 26px;*/
         margin-left: 48px;
         text-align: center;
         margin-bottom: -2px!important;
         font-size: 20px;
         }
         .tab_brdr{
         border-bottom:1px solid #00235f;
         }
         .tcon{
         padding: 20px;
         }
         .cont{
         margin-top: 20px; margin-bottom: 20px;
         }
         .btn_ss{
         color: #060606;
         background-color: #f2f2f2;
         border-radius: 0px;
         }
         .para{
         padding: 0px 10px 10px 10px;
         text-align: justify;
         line-height: 22px;
         }
         .text_head{
         text-align: center;
         color: #00235f;
         margin-bottom: 10px;
         }
         #addclose img {
          width: 25px;
          background: #19191896;
        }
        * {box-sizing: border-box;}

      .imgtxt {
        position: relative;
        /* width: 50%;
        max-width: 300px; */
      }

      .image {
        display: block;
        width: 100%;
        height: 140px;
      }

      .overlay {
        position: absolute; 
        bottom: 0; 
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.5); /* Black see-through */
        color: #f1f1f1; 
        width: 92%;
        transition: .5s ease;
        opacity:0;
        color: white;
        font-size: 15px;
        padding: 10px 15px;
        /* text-align: center; */
      }

      .imgtxt .overlay {
        opacity: 1;
      }
      .ls ul {
          list-style: none;
          padding: 0px;
          font-size:11px;
      }

      .ls ul li:before
      {
          content: '\2713';
          /* margin: 0 1em;    any design */
      }
      .btnn {
          display: inline-block;
          /* background-image: none; */
          border: 1px solid transparent;
          padding: 6px 25px;
          background: #db271d;
          margin-left: -68px;
          font-size: 14px;
          color:#fff;
          border-radius: 0px;
      }
      .btnn:hover{
          color: #fff;
          background-color: #db271d;
          border-color: #db271d;
       }
      .fm{
          border-radius: 0px;
          /* width: 244px!important; */
      }
      .box{
        background: #3e3e3e;    
        margin: 0px 0px;
        padding: 10px 10px; color:#fff;
        height: 140px;
      }
      .lftxt{
        width:50%; float:left;
      }
      rttxt{
        width:40%; float:right;
      }
      .imgss{
        padding-top: 16px;
        left: -10px;
      }
      .mr4{
        margin-bottom:10px;
      }

      /*------------*/
.carousel-caption {
    position: absolute;
    left: 70%;
    right: 0%;
    top: 65px;
    height: 150px;
    /* bottom: 20px; */
    width: 300px;
    font-family: sans-serif;
    z-index: 1;
    background: #00000061;
    color: #fff;
    line-height: 35px;
    padding: 15px;
    font-size: 30px;
    font-weight: 600;
    text-align: right;
    text-shadow: 0 1px 2px rgba(0,0,0,.6);
}
.carousel-caption1 {
    position: absolute;
    left: 45%;
    right: 0%;
    top: 0;
    height: 100%;
    width: 55%;
    font-family: sans-serif;
    z-index: 1;
    background-image:linear-gradient(to right, #4f4f4f00, #060606e3, #000000, #000000, #000000);
    color: #fff;
    line-height: 35px;
    padding: 15px;
    font-size: 25px;
    /*font-weight: 600;*/
    text-align: left;
    text-shadow: 0 1px 2px rgba(0,0,0,.6);
}
.mybtn_cap{
  background: #db271d;
  color: #fff;
  border: 1px solid #db271d;
  margin-top: 15px;
}
.flight_frm{padding:10px; background-color: #000544; height:;}
.cont_fld_nopad{
  padding:0px;
}
.p_cls{
  margin-top: 10px;
    text-align: justify;
}
.mr_top{
  margin-top:10px;
}
.thd_bg img {
    display: block;
    width: 100%;
    height: 200px !important;
}
.thd_bg {
    color: #000;
    margin-bottom: 20px;
    box-shadow: 2px 2px 2px 2px #cccccc87;
}

.thd_bg1 img {
    display: block;
    width: 100%;
    height: 200px !important;
}
.thd_bg1 {
    color: #000;
    margin-bottom: 20px;
    box-shadow: 2px 2px 2px 2px #cccccc87;
    border:1px solid #ccc;
}

.cap_img {
    padding: 5px 10px 10px;
    text-align: center;
}
.cap_img1{
  padding: 10px;
  font-size: 15px;
  font-weight: 600;
}
.h2_ss{
  text-align: center;
  margin:30px 0px 45px;
  color:#000;
}
.img_p_cap1{
    font-size: 18px;
    letter-spacing: 10px;
    margin:5px;
}
.img_p_cap2{
  margin:5px;
}
.img_p_cap3{
  font-size:17px;
}
.P_cap3_span{
  font-size:22px;
}
.plane_icn{
    float: right;
    font-size: 30px;
    color: #ccc;

}
.promo_btn{
      background: #828282;
    color: #fff;
    border: 1px solid #828282;
    margin-top: 25px;
    padding: 7px;
    font-size: 18px;
    border-radius: 0px;
}
/* Zoom In #1 */
.hover01 figure img {
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}
.hover01 figure:hover img {
  -webkit-transform: scale(1.3);
  transform: scale(1.3);
}

/*********************** Demo - 19 *******************/
.box19{text-align:center;position:relative}
.box19 .box-content{width:100%;height:100%;background:0 0;padding-top:25%;position:absolute;top:0;left:0;transition:all .3s ease 0s}
.box19 .icon,.box19 .title{transition:all .2s ease 0s}
.box19:hover .box-content{background:rgba(0,0,0,.5)}
.box19 .title{font-size:24px;color:#fff;transform:scale(0)}
.box19:hover .title{transform:scale(1)}
.box19 .icon{list-style:none;padding:0;margin:0;opacity:0}
.box19:hover .icon{opacity:1}
.box19 .icon li{display:inline-block}
.box19 .icon li:first-child a,.box19 .icon li:last-child a{    display: block;width: auto;height: 40px;line-height: 38px;font-size: 15px;color: #fff;padding: 0px 10px;border: 1px solid #fff;position: relative;}
.box19 .icon li a{top:-150px}
.box19:hover .icon li a{top:0}
.box19:hover .icon li a:hover{background:#203f7cb3;border-color:#fff;}
.box19 .icon li:first-child a{transition:all .6s cubic-bezier(.175,.885,.32,1.275) 0s}
.box19 .icon li:last-child a{transition:all .6s cubic-bezier(.175,.885,.32,1.275) .1s}
@media only screen and (max-width:990px){.box19{margin-bottom:30px}
}
@media only screen and (max-width:360px){.box19 .box-content{padding-top:20%}
}

/*********************** Demo - 14 *******************/
.box14{position:relative}
.box15,.box17,.box18{box-shadow:0 0 5px #7e7d7d;text-align:center}
.box14:before{content:"";width:100%;height:100%;background:rgba(0,0,0,.5);position:absolute;top:0;left:0;opacity:0;transition:all .35s ease 0s}
.box14:hover:before{opacity:1}
.box14 img{width:100%;height:auto}
.box14 .box-content{width:90%;height:90%;position:absolute;top:5%;left:5%}
.box14 .box-content:after,.box14 .box-content:before{content:"";position:absolute;top:0;left:0;bottom:0;right:0;opacity:0;transition:all .7s ease 0s}
.box14 .box-content:before{border-bottom:1px solid rgba(255,255,255,.5);border-top:1px solid rgba(255,255,255,.5);transform:scale(0,1);transform-origin:0 0 0}
.box14 .box-content:after{border-left:1px solid rgba(255,255,255,.5);border-right:1px solid rgba(255,255,255,.5);transform:scale(1,0);transform-origin:100% 0 0}
.box14:hover .box-content:after,.box14:hover .box-content:before{opacity:1;transform:scale(1);transition-delay:.15s}
.box14 .title{font-size:21px;font-weight:700;color:#fff;margin:15px 0;opacity:0;transform:translate3d(0,-50px,0);transition:transform .5s ease 0s}
.box14:hover .title{opacity:1;transform:translate3d(0,0,0)}
.box14 .post{font-size:14px;color:#fff;padding:10px;background:#d79719;opacity:0;border-radius:0 19px;transform:translate3d(0,-50px,0);transition:all .7s ease 0s}
.box14 .icon,.box15 .icon{padding:0;list-style:none}
.box14:hover .post{opacity:1;transform:translate3d(0,0,0);transition-delay:.15s}
.box14 .icon{width:100%;margin:0;position:absolute;bottom:-10px;left:0;opacity:0;z-index:1;transition:all .7s ease 0s}
.box14:hover .icon{bottom:70px;left:95px;opacity:1;transition-delay:.15s}
.box14 .icon li a{    display: block;width: 110px;height: 40px;padding: 0px 10px;line-height: 38px;border: 1px solid #fff;border-radius: 0 16px;font-size: 14px;color: #fff;vertical-align: middle;margin-right: 5px;transition: all .4s ease 0s;
}
.box14 .icon li a:hover{background:#203f7cb3;border-color:#fff;}
@media only screen and (max-width:990px){.box14{margin-bottom:30px}
}

ul {
    list-style-type: none;
}
.all_list{text-align: center;}
.Info__list .info__item a{text-decoration:none;}
.Info__list .info__item
{
    color: #193960;
    margin-bottom: 5px;
    font-size: 15px;
}
.data_forms .ft .col-md-6{padding-bottom:5px;}


</style>
   </head>
   <body><?php
   //debug($cc);
   ?>

      <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>
      <!-- /Navigation --> 
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tab'); ?>
      <?php //echo $this->load->view(PROJECT_THEME.'/home/search_tab'); ?>
      <div class="clearfix"></div>
 
      <div class="body_bg">

<!------------------------------------>

<?php 
    if (in_array("This month low fare", $active_home_module_list)){ 
?>
<section class="main_second">
<div class="container">
  <div class="main_header_iconsaq">
    <div class="poppoular-icons hidden-xs hidden-sm">
          <img class="img-responsive" src="<?php echo base_url(); ?>assets/theme_dark/images/poppoular-icons.png" alt="logo">
    </div>
  <h3>This month low fare</h3>   
 <h4>Find your low fare</h4> 
 <!-- <p>Showing 30 deals from $39</p>  -->
  </div>
</div>
<div class="full_section_pad_n">
<div class="container">
    <div class="owl-carousel owl-theme" id="Flight_dates_ind">
       <?php foreach ($flightdeals as $deal): ?>
        <div class="item">
              <div class="main_section_headerd_n">
                  <h3><?php echo $deal->deal_from_place . ' to ' . $deal->deal_to_place; ?></h3>  
                  
                  <img src="<?php echo base_url('/admin-panel/uploads/flightdeal/' . $deal->deal_image); ?>" alt="Deal Image"><br>
                  <h4><?php echo $deal->deal_offered_price ?></h4>  
                  
             </div>
        </div>
        <?php endforeach; ?>
    
 


 
</div></div>

</div>
</section>
<?php
    }
?>

<?php 
    if (in_array("Best flight destinations", $active_home_module_list)){ 
?>
        <section class="main_second main-images_wq hide">
<div class="container">  
 <div class="main_header_iconsaq new_right_secondcon">
  <div class="poppoular-icons hidden-xs hidden-sm">
          <img class="img-responsive" src="<?php echo base_url(); ?>assets/theme_dark/images/poppoular-icons.png" alt="logo">
    </div> 
  <h3 class="m11_w" >Best Flight Destin</h3> 
  
 <!-- <h4>Find your low fare</h4>  -->
 <p>Compare & Book the best airlines deals available online in just on search</p> 
  </div> 
  
    <?php
    list($first_list, $second_list) = array_chunk($top_flightdeals, ceil(count($top_flightdeals) / 2));
    ?>
    <div class="row all_list">
        
    <ul class="col-md-6 Info__list">
       <?php  
       foreach($first_list as $keys => $values) { 
           $from_city=$to_city='';
            $CI =& get_instance();
            $CI->load->model('Flight_Model');
            $from_aircode=substr(chop(substr($values->deal_from_place, -5), ')'), -3);
            $from_city = $CI->Flight_Model->get_airport_cityname($from_aircode);
            
            $to_aircode=substr(chop(substr($values->deal_to_place, -5), ')'), -3);
            $to_city=$CI->Flight_Model->get_airport_cityname($to_aircode);
       ?>
      <li class="info__item"><a class="" href="<?php echo base_url(); ?>flight/custom_search?from=<?php echo $values->deal_from_place; ?>&to=<?php echo $values->deal_to_place; ?>"><?php echo $from_city; ?> To <?php echo $to_city; ?></a></li>
    <?php } ?>
    </ul>
    
     <ul class="col-md-6 Info__list">
       <?php  
       foreach($second_list as $keys => $values) { 
            $from_city=$to_city='';
            $CI =& get_instance();
            $CI->load->model('Flight_Model');
            $from_aircode=substr(chop(substr($values->deal_from_place, -5), ')'), -3);
            $from_city = $CI->Flight_Model->get_airport_cityname($from_aircode);
            
            $to_aircode=substr(chop(substr($values->deal_to_place, -5), ')'), -3);
            $to_city=$CI->Flight_Model->get_airport_cityname($to_aircode);
       ?>
      <li class="info__item"><a class="" href="<?php echo base_url(); ?>flight/custom_search?from=<?php echo $values->deal_from_place; ?>&to=<?php echo $values->deal_to_place; ?>"><?php echo $from_city; ?> To <?php echo $to_city; ?></a></li>
    <?php } ?>
    </ul>
    
    </div>
  
  <!--<img class="newd_bannerew_pl" src="<?php echo base_url(); ?>assets/theme_dark/images/fly_section.png"> -->
  </div>
</section>
<?php
    }
?>


<?php 
    if (in_array("Exclusive flight offers", $active_home_module_list)){ 
?>
<section class="main_second ">
<div class="container">    
 <div class=" new_right_secondcon_new">
  <h3 class="m11_w">Exclusive Flight Offers</h3>   
   <!-- <h4>Find your low fare</h4>  -->
   <p>Compare & Book the best airlines deals available online in just on search</p> 
  </div> 
 
<div class="main_new_imagessctions hide">
    
     <?php foreach($promo_deals as $promodeal): ?>
       
            <div class="col-md-6 col-sm-6 col-xs-6 pad8">
            <?php
                  if(isset($promodeal->pic_name) && $promodeal->pic_name!='')
                  {
                    ?>
                      <img class="" src="<?php echo base_url(); ?>admin-panel/uploads/promo_img/<?= $promodeal->pic_name;?>">
             
                    <?php
                  }
                  else
                  {
                   ?>
                   <img class="" src="<?php echo base_url(); ?>assets/theme_dark/images/banner_main_secion_1.png" >
                   <?php
                  }
            ?>
                    
             
                 <div class="dyamnic_par">
                     <h6><strong><?php echo $promodeal->description;?></strong></h6>
                      <h5> <strong><?php echo $promodeal->discount;?>% Offer</strong></h5>
                 <h4><strong>Promo Code : <?php echo $promodeal->promo_code;?></strong></h4>
                </div>
               </div>
             <?php
            if(($key+1) % 2==0){
            ?>
             <div class="col-md-12 col-sm-12 pad12_edit"><img class="nmw_plokwqsx" src="<?php echo base_url(); ?>assets/theme_dark/images/main_flight_symble.png" ></div>
    
            <?php
            }
           ?>
          
           
    <?php endforeach; ?>
    
    
            
 <!--  <div class="col-md-12 col-sm-12 pad12_edit"><img class="nmw_plokwqsx" src="<?php echo base_url(); ?>assets/theme_dark/images/main_flight_symble.png" ></div>

  <div class="col-md-6 col-sm-6 col-xs-6 pad8"><img class="" src="<?php echo base_url(); ?>assets/theme_dark/images/banner_main_secion_3.png" > </div>
  <div class="col-md-6 col-sm-6 col-xs-6 pad8"><img src="<?php echo base_url(); ?>assets/theme_dark/images/banner_main_secion_4.png" > </div> -->
  <!--<div class="col-md-12"><p class="view_more_deatils_lolk">View More Deals</p></div>-->
</div>
  
  </div> 
</section>


<section class="second_n_z_offfzx">
    <div class="container">
    <div class="owl-carousel owl-theme" id="Flight_dates_ind_offer">
    <?php foreach ($promo_deals as $promodeal): ?>
        <div class="item">
          <div class="main_section_headerd_nx">
               <img src="<?php echo base_url('/admin-panel/uploads/promo_img/' . $promodeal->pic_name); ?>" alt="Deal Image">
               <!--<img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png">-->
              <!--<img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">-->
          </div>
        </div>
    <?php endforeach ?>
    
     <div class="item">
      <div class="main_section_headerd_nx">
     <img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png"> 
     
      <img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">
      
      </div>
    </div>
     <div class="item">
      <div class="main_section_headerd_nx">
          <img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png">
          
      <img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">
      
      </div>
    </div>
     <div class="item">
      <div class="main_section_headerd_nx">
          <img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png">
          
      <img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">
      
      </div>
    </div>
     <div class="item">
      <div class="main_section_headerd_nx" 
          <img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png">
          
         <img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">
      
      </div>
    </div>
     <div class="item">
      <div class="main_section_headerd_nx">
          <img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png">
          
      <img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">
      
      </div>
    </div>
     <div class="item">
      <div class="main_section_headerd_nx">
          <img class="" src="https://tripglobo.com/beta1/assets/theme_dark/images/banner_main_secion_1.png">
          
      <img class="main_abosule_n" src="https://tripglobo.com/beta1/assets/theme_dark/images/main_flight_symble.png">
      
      </div>
    </div>


 
</div>

</div>
</section>


<?php
    }
?>

<?php 
    if (in_array("Best tour plans", $active_home_module_list)){ 
?>
        <section class="slider_banners_imagesa">
<div class="container">   
 <div class="main_header_iconsaq new_right_secondcon"> 
  <h3 class="main_header_iconsaq_plk new_ok">Best <br clear="new_br">Tour Plans</h3> 
 
 <div class="col-md-3"><img class="new_indicarote" src="<?php echo base_url(); ?>assets/theme_dark/images/aroow_indicator.jpg" alt="">  </div>
 <div class="col-md-9">
 
  <div class="owl-carousel owl-theme" id="best_tour_plan">
    <div class="item">
      <img src="<?php echo base_url(); ?>assets/theme_dark/images/slider_1.png" class="img-responsive">
      <div class="main_tage_new"> 
        <h5>Beijing</h5>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo base_url(); ?>assets/theme_dark/images/slider_2.png" class="img-responsive">
      <div class="main_tage_new"> 
        <h5>Mexico</h5>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo base_url(); ?>assets/theme_dark/images/slider_3.png" class="img-responsive">
      <div class="main_tage_new"> 
        <h5>London</h5>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo base_url(); ?>assets/theme_dark/images/slider_1.png" class="img-responsive">
      <div class="main_tage_new"> 
        <h5>Beijing</h5>
      </div>
    </div>

</div>
<!--<p class="view_more_bestplnz">View More Deals</p>-->

</div>


 </div> 
  </div> 
</section> 
<?php
    }
?>

<?php 
    if (in_array("Welcome aboard", $active_home_module_list)){ 
?>
        <section class="main_last_slider"> 
  <div class="owl-carousel owl-theme" id="aborde_new">
    <div class="item"><img src="<?php echo base_url(); ?>assets/theme_dark/images/banner_slider_last_slider.png" class="img-responsive"></div>
    <div class="item"><img src="<?php echo base_url(); ?>assets/theme_dark/images/banner_slider_last_slider.png" class="img-responsive"></div>
    <div class="item"><img src="<?php echo base_url(); ?>assets/theme_dark/images/banner_slider_last_slider.png" class="img-responsive"></div>
    
</div>
   

</section> 
<?php
    }
?>



<section class="main_newd_leftrdf">
  <div class="container">
  <div class="col-md-12 ">
       <div class="col-md-1"></div>
    <div class="col-md-5">
      <h3>Subscribe our Newsletter and offers</h3>
      <p>By subscribing to our mailing list you will always be 
update with the latest news from us.</p>
     <input type="email" id="sub_mail" class="email" placeholder="Your Email" required="required" onclick="ValidateEmail(document.form1.text1)">
      <button type="button" id="subscribe" class="btn btn-primary button_newd_mamkp_q">Subscribe </button>
       <div class="success" style="color: green;"></div>
      </div>
      
      <div class="col-md-1"></div>
      
      <div class="col-md-5">
      <h3>Follow us</h3>
      <p>By connecting our social media
        follow us </p>
        <div class="social-icon">
      <ul>
      <?php
      $CI = get_instance();
      $CI->load->model('home_model');  
      $social_links_details = $CI->home_model->social_links(); 
      foreach($social_links_details as $links) {
      $icon_img = $links->icon;
      $link = $links->link;
      ?>
      
        <li><a href="<?php echo $link;  ?>" target="_blank"><i class="<?php echo $icon_img; ?>"></i></a></li>
        <?php
        }
        ?>
      
      
      </ul>
    </div>
      </div>
      
      <div class="col-md-1"></div>

      <!--<div class="col-md-2 footer_cities">
          <ul>
        	<li><a href="<?php echo base_url(); ?>general/work_with_uss" target="_blank">Work with us</a></li>
        	<li><a href="<?php echo base_url(); ?>general/advertise" target="_blank">Advertise with Us</a></li>
        	<li><a href="<?php echo base_url(); ?>general/feedback" target="_blank">FeedBack</a></li>
        </ul>
      </div>-->

  </div>
  </div>
</section>



                                  
                             </div>
                           
                                </div>
                          </div>
                </div> 
              </div>

<br>

<br>


      </div>
      <!-- customers are growing -->
      <div class="clearfix"></div>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
      <!-- /.container --> 
      <link href="<?php //echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/datepicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme_dark/js/wow.min.js"></script>
      <!-- <script type="text/javascript">
         // Wow Animations
           wow = new WOW(
             {
             boxClass:     'wow',      // default
             animateClass: 'animated', // default
             offset:       0,          // default
             mobile:       true,       // default
             live:         true        // default
           }
           )
           wow.init();
         </script> -->
      <script type="text/javascript"> 
         $(document).ready(function () {
          $(document).ready(function($) {
             
          $("#aborde_new").owlCarousel({
            items : 1, 
            itemsDesktop : [1000,1],
            itemsDesktopSmall : [991,1], 
            itemsTablet: [767,1], 
            itemsMobile : [480,1], 
            dots:true,
             
            
               }); 
                 $("#best_tour_plan").owlCarousel({
            items : 3, 
            itemsDesktop : [1000,3],
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,3], 
            itemsTablet: [600,2], 
            itemsMobile : [480,2], 
            itemsMobile : [360,1], 
            navigation : true,
            pagination : false
               });

          $("#Flight_dates_ind_offer").owlCarousel({
            items : 5, 
            itemsDesktop : [1000,4],
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,2], 
            itemsMobile : [480,1], 
                 navigation : true,
            pagination : false
               });
               $("#Flight_dates_ind").owlCarousel({
            items : 6, 
            itemsDesktop : [1000,4],
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,2], 
            itemsMobile : [480,1], 
                 navigation : true,
            pagination : false
               });
                 $("#owl_demo_dest").owlCarousel({
            items : 4, 
            itemsDesktop : [1000,4],
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,2], 
            itemsMobile : [480,1], 
                 navigation : true,
            pagination : false
               });
         
            $("#flight_demo1").owlCarousel({
            items : 5, 
            itemsDesktop : [1000,3],
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,2], 
            itemsMobile : [480,1], 
                 navigation : true,
            pagination : false
               });
         
           });
         
         
         
           $(document).ready(function($) {
                 $("#owl-demohotel").owlCarousel({
                   items : 4, 
                   itemsDesktop : [1000,3],
                   itemsDesktopSmall : [900,3], 
                   itemsTablet: [768,2], 
                   itemsMobile : [479,1], 
                   navigation : false,
                   pagination : true,
                   autoPlay : true
               });
           });
         
         
         
          $("#TopAirLine").owlCarousel({
            items : 5, 
            itemsDesktop : [1000,3],
            itemsDesktopSmall : [991,3], 
            itemsTablet: [767,2], 
            itemsMobile : [480,1], 
                 navigation : true,
            pagination : false
               });
             var owl3 = $("#owl-demo3");
         
             owl3.owlCarousel({      
                 itemsCustom : [
                     [0, 1],
                     [450, 2],
                     [551, 3],
                     [700, 4],
                     [1000, 5],
                     [1200, 6],
                     [1400, 6],
                     [1600, 6]
                 ],
                 navigation : false
         
             });
         
               var check_in = db_date(7);
               var check_out = db_date(10);
               $(".htl-wrap").on("click",function(){
                
                  var city_name =$(".city_name",this).val();
                  var city_id = $('.city_id',this).val();
                  $("#check-in").val(check_in);
                  $("#check-out").val(check_out);
                  $("#city").val(city_name);
                  $("#hotelSearchForm").submit();
               });
               $(".top_flight,.top_flight_book").on("click",function(e){
                 e.preventDefault();
                 var from_place = $(".from_place",this).val();
                 var to_place = $(".to_place",this).val();
                 $("#from").val(from_place);
                 $("#to").val(to_place);
                 $("#depature").val(check_in);
                 $("#return").val(check_out);
                 $("#trip_type").val('round');
                 $("#flight").submit();
               });
               
         });

        //  $("#subscribe").submit(function(e) {
        //     e.preventDefault(); // avoid to execute the actual submit of the form.
        //     var form = $(this);
        //     var url = form.attr('action');

        //     $.ajax({
        //        type: "POST",
        //        url: url,
        //        data: form.serialize(), // serializes the form's elements. 
        //        success: function(data)
        //        {
        //            $(".success").html('<b>Congratulations!!!</b> You are subscribed for our secret deals.') // show response from the php script.
        //        }
        //     });
        // });
        
      

         $("#subscribe").click(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
             var sub_mail = $('#sub_mail').val();
             
             var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
             
             var a=0;

                if(!pattern.test(sub_mail)){
                  alert('Please provide a valid e-mail address');
                   a=a+1;
                }
            
             if(a!=1){
                 
            var url = "<?php echo base_url(); ?>";

            $.ajax({
               type: "POST",
               url: url+"general/subscribe_save",
               data: {sub_mail:sub_mail}, // serializes the form's elements. 
               success: function(data)
               {
                // alert(data);
                  if(data == "true"){
                    $('#sub_mail').val('');
                   $(".success").html('<b>Congratulations!!!</b> You are subscribed for our secret deals.') // show response from the php script.
                  }else{

                    $('#sub_mail').val('');
                   $(".success").html('This mail is already Subscribe ') // show response from the php script.
                  }
               }
            });
             }
             
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
        $(function(){

  $('#hotelLoad').click(function(e){
    e.preventDefault();
   
    // var next_tab = $('.blank_select_hotel > .active');
     if($('.page_flight').hasClass('active')){
        $('.page_flight').removeClass('active');
        }
        $('.page_hotel').addClass('active');
       var getHotel= searchPanel('hotelSearchPanel','flightSearchPanel','busSearchPanel');
         $('#blank_select_hotel').addClass('active');
         $('#blank_select_fly').removeClass('active');
         $('#blank_select_bus').removeClass('active');
       
  });
});

     var hash = window.location.hash;
          if(hash=='#hotels')
          {
             $('#blank_select_hotel').addClass('active');
             $('#blank_select_fly').removeClass('active');
             $('#blank_select_bus').removeClass('active');
             var getHotel= searchPanel('hotelSearchPanel','flightSearchPanel','busSearchPanel');
          }
          else if(hash=='#buses')
          {
              $('#blank_select_bus').addClass('active');
             $('#blank_select_fly').removeClass('active');
             $('#blank_select_hotel').removeClass('active');
             var getHotel= searchPanel('busSearchPanel','flightSearchPanel','hotelSearchPanel');
          }

  

    </script>
      <script>   
        AOS.init(); 
      </script>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer_js'); 
         ?>
   </body>
</html>