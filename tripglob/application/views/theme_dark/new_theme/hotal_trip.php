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
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
      <style>
      	.cont_pad{ padding: 30px 0px;}
      	.sub_btn{width: 100%;background: #fdb813;height: 40px;font-size: 15px;}
      	.input_ss{height: 40px;}
      	.bg_clr{background: #f2f2f2;}
      	.fgt_secss{    
		    padding: 20px 20px;
		    border-radius: 5px;
		    margin-top:70px;
		    
		}
		.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
        padding: 0px!important;
    border-top: none!important;
    }
     h2.bus_trip_specil {
    text-align: center;
    font-size: 30px;
    color: #fdb813;
    font-weight: 500;
    margin-bottom: 35px;
}
.scpl_trip_anchor{
    margin-bottom:15px;
    border-radius:5px;
    text-decoration: none !important;
    position: relative;
}
.scpl_trip_anchor img{
    width:95%;
    height:200px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}
.star_hotel_fa{
    color: #f5933b;
}
.star_hotel{
    position: absolute;
    top:10px;
    left:10px;
}
.star_on_img{
    position:absolute;
    top:10px;
    left:20px;
}
.spcl_trip_fromto{
    width:95%;
    background-color: #fff;
    padding: 10px;
    height: 75px;
    max-height:150px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    box-shadow: 0px 3px 9px 0px #ccc;
}
.spcl_trip_fromto span{
    color:#333;
}
.prnt_fromto{
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
    color:#333;
}
.spcl_trip_imgs{
    padding:0 10%;
}
.inr_price{
    color: #2471A3  !important;
    font-weight: 600;
    margin-right:5px;
}
.trip_dtls{
    font-weight: 600;
}
.star_on_img .fa-star{
    color:  #F1C40F;
}
      </style>
      </head>
   <body class="bg_clr">
   	  <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>

		<div class="container cont_pad">
         <form method="post" action="voucher">
			<div class="col-md-12 fgt_secss">
		    	 <h2 class="bus_trip_specil"><span>Hotel Trip</span></h2>
                 <div class="spcl_trip_imgs row">                        
                    <?php foreach ($hotal_trip_details as $key => $value) { 
                     $checkin_date=new DateTime(date('Y-m-d',strtotime($value->checkin_date)));
                     $checkout_date=new DateTime(date('Y-m-d',strtotime($value->checkout_date)));
                     $diff=$checkin_date->diff($checkout_date);
                     if ($diff->days==1) {
                         $night=1;
                     }else{
                         $night=$diff->days-1;                       
                     }
                      ?>
                     <a href="<?=base_url()?>general/allhotelTrip_details/<?=base64_encode(json_encode($value->hotel_trip_id)) ?>" class="scpl_trip_anchor-1 col-md-3 col-xs-4">
                        <img src="https://tripglobo.com/admin-panel/uploads/special_trip/<?=$value->hotel_image?>" alt="">
                            <div class="star_hotel" data-star="<?=$value->rating?>">
                            <span class="fa fa-star star_hotel_fa"></span>
                            <span class="fa fa-star star_hotel_fa"></span>
                            <span class="fa fa-star star_hotel_fa"></span>
                            <span class="fa fa-star star_hotel_fa"></span>
                            <span class="far fa-star star_hotel_fa"></span>
                           
                            </div>
                        <div class="spcl_trip_fromto">
                            <p class="prnt_fromto"> <?=$value->city_name?> </p> 
                            <h6><span class="inr_price">INR <?=number_format($value->price,2)?></span> <span class="trip_dtls">(<?=$diff->days?> Days <?=$night?> night )</span></h6>
                        </div>
                     </a>
                    <?php } ?>
              </div>			     
		     </div>
         </form> 
		</div>
   

       <div class="clearfix"></div>
 		<?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
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

 	</body>
 	</html>
