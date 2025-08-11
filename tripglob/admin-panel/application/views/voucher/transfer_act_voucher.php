<?php #print_r($ProductDetails);die;?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo PROJECT_TITLE; ?></title>
   <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet"><!-- Custom styling plus plugins -->
<link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/voucher.css" rel="stylesheet">
<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">
<script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo ASSETS; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS; ?>js/custom.js"></script>
    </head>

   <body class="nav-md">

       <div class="container body">
          <div class="main_container">
    <?php 

        if(!isset($mail_voucher)){ ?>
        
        <?php   echo $this->load->view('common/sidebar_menu');
          echo $this->load->view('common/top_menu'); 
       }
    ?>
    <div class="clearfix"></div>

            <div class="cancel_loader"><div id="mainDiv"><div class="carttoloadr"><strong>Please Wait...Cancellation process is going on!!..</strong></div></div>

      <!-- Navigation -->
      
<div class="right_col" role="main">
<div class="allpagewrp top80">

<div class="table-responsive" style="width:100%; position:relative" id="tickect_hotel">   
<table class="table" cellpadding="0" cellspacing="0" width="100%" style="font-size:13px; font-family: 'Open Sans', sans-serif; max-width:900px; margin:30px auto;background-color:#f5f5f5; padding:50px 45px;">      
<tbody>         
<tr>            
<td style="border-collapse: collapse; padding:20px;">               
<table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0" border="0">                  
<tbody>                     
<tr>                        
<td style="padding: 0px;">                           
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">                              
<tbody>                                 
<tr>                                    
<td style="font-size:22px; line-height:30px; width:100%; display:block; font-weight:600; text-align:center">E-Ticket</td>                                 
</tr>                                 

<tr>                                    
<td> 
<table width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0" border="0">                                          
<tbody>   
<?php 
  // debug($Booking);
  // exit;
error_reporting(E_ALL);
?>

  <tr>                                                
	<td style="padding: 0px;">
  <?php if($Booking->user_type_id ==B2B_USER ){
      $user_data =   $this->general_model->get_user_details($Booking->user_id,$Booking->user_type_id );
    ?>
    <img src="<?php echo UPLOAD_PATH.$user_data->profile_picture;?>" width="100" alt="" />
  <?php }else{?>
	<img style="width:200px;" src="<?php echo base_url(); ?>assets/images/logo.png">
  <?php }?>
	</td>                                                

      <td style="padding: 0px;">                                                   
        <table width="100%" style="font-size:13px; font-family: 'Open Sans', sans-serif;border-collapse: collapse;text-align: right; line-height:15px;" cellpadding="0" cellspacing="0" border="0">                                                    
        <tbody>                                                         
	     <tr>                                                            
	      <td style="padding-bottom:10px;line-height:20px" align="right"> 
	      <span>Travel Date: <?=date('M d,Y', strtotime($Booking->travel_date))?></span><br>
	      <span>Booking Reference: <?=$Booking->parent_pnr_no?></span><br>
        <?php $activity_code=json_decode($Booking->specific_rec_details,true);?>
	      <span>Activity Code: <?=$Booking->pnr_no?></span>
	      </td>                                                        
	       </tr>                                                      
       </tbody>                                                   
       </table>                                                
       </td>   

       </tr> 

       </tbody>                                       
       </table>                                    
       </td>                                 
       </tr>                                 
       
       <tr>                                    
       <td align="right" style="line-height:24px;font-size:13px;border-top:1px solid #00a9d6;border-bottom:1px solid #00a9d6;padding: 5px;">Status: 
       <strong class="<?php echo booking_status_label($Booking->booking_status) ?>" style=" font-size:14px;"><?=$Booking->booking_status?></strong>                              
       </td>                                 
       </tr>                                 

       <tr>                                    
       <td style="line-height:12px;">&nbsp;</td>                                 
       </tr>                                 

       <tr>                                    
       <td>                                       
       <table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;padding:5px;">                                          
       <tbody>                                             
       <tr>                                                
        <?php $det_res=json_decode(base64_decode($cart->detail_response),true);
          #debug($det_res);exit;
          $res= json_decode(base64_decode($cart->response),true);
         
        ?>
        
       <td style="padding:10px 0">
       <?php if($det_res['ProductImage']):?>
          <img style="width:160px;height:107px;" src="<?=$det_res['ProductImage']?>">
        <?php else:?>
             <img style="width:160px;height:107px;" src="<?=base_url().'assets/theme_dark/images/no_image_available.jpg'?>">
        <?php endif;?>
       </td>                                                

       <td valign="top" style="padding:10px;">
       <span style="line-height:30px;font-size:16px;color:#00a9d6;vertical-align:middle;font-weight: 600;"><?=$det_res['ProductName'];?></span>
       <br>
       <span style="display: block;line-height:22px;font-size: 13px;"><?=$res['BlockTrip']['BlockTripResult']['Destination']?> </span>
       <br>
      
       <span style="display: block;line-height:22px;font-size: 13px;">
       <div class="star_detail">
              <div data-star="5" class="stra_hotel">
              <?php for($i=0;$i<$det_res['StarRating'];$i++):?>
                <span class="fa fa-star"></span>
              <?php endfor;?>
                
            <!--     <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span> -->
              </div>
            </div>
          </span>
       </td>                                                

       <td width="32%" style="padding:10px 0;text-align: center;">
       <span style="font-size:14px; border:2px solid #808080; display:block">
       <span style="color:#00a9d6;padding:5px; display:block;text-transform:uppercase">Booking ID</span>
       <span style="font-size:14px;line-height:35px;padding-bottom: 5px;display:block;font-weight: 600;"><?=$Booking->pnr_no?></span>
      </span>
       </td> 

       </tr>                                          
       </tbody>                                       
       </table>                                    
       </td>                                 
       </tr>                                 

       <tr>                                    
       <td style="line-height:12px;">&nbsp;</td>                                 
       </tr>                                 

       <tr>                                    
       <td style="background-color:#00a9d6;border: 1px solid #00a9d6; color:#fff; font-size:14px; padding:5px;">
       <img style="vertical-align:middle" src=""> 
       <span style="font-size:14px;color:#fff;vertical-align:middle;"> &nbsp;Activity Details</span>
       </td>                                 
       </tr>                                 

       <tr>                                    
       <td width="100%" style="border: 1px solid #00a9d6; padding:0px;">                                       
         <table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;padding:5px;">                                          
           <tbody>                                             
            <tr>                                                                               
              <td style="background-color:#d9d9d9;padding:5px;color: #333333;">Supplier</td>                                                
              <td style="background-color:#d9d9d9;padding:5px;color: #333333;">Supplier Phone No</td>                                                
              <td style="background-color:#d9d9d9;padding:5px;color: #333333;">Duration</td>                                                
              <td style="background-color:#d9d9d9;padding:5px;color: #333333;text-align:center">Total Traveler(s)</td>                                             
             </tr>                                             
             
             <tr>                                                
             <td style="padding:5px"><span style="width:100%; float:left"> <?=$cart->SupplierName?></span></td>                                                
             <td style="padding:5px"><span style="width:100%; float:left">   <?=$cart->SupplierPhoneNumber?></span></td>
             <td style="padding:5px"><?=$det_res['Duration']?></td>                                                
             <td style="padding:5px" align="center"><?php echo count($Passenger)?></td>                                             
             </tr>                                          
             </tbody>                                       
             </table>                                    
             </td>                                 
             </tr>                                 

             <tr>                                    
             <td style="line-height:12px;">&nbsp;</td>                                 
             </tr>                                 

             <tr>                                    
             <td style="background-color:#666666;border: 1px solid #666666; color:#fff; font-size:14px; padding:5px;">
             <img style="vertical-align:middle" src=""> 
             <span style="font-size:14px;color:#fff;vertical-align:middle;"> &nbsp;Traveller(s) Details</span>
             </td>                                 
             </tr>                                 

             <tr>                                    
             <td width="100%" style="border: 1px solid #666666; padding:0px;">                                       
             <table width="100%" cellpadding="5" style="padding: 10px;font-size: 13px;">                                          
             <tbody>                                             
             <tr>                                                
             <td style="background-color:#d9d9d9;padding:5px;color: #333333;">Sr No.</td>                                                
             <td style="background-color:#d9d9d9;padding:5px;color: #333333;">Passenger(s) Name</td>                                                
             <td style="background-color:#d9d9d9;padding:5px;color: #333333;">Type</td>                                             
             </tr>                                               
                                                                            
             <?php foreach($Passenger as $k=>$val){
              $age_band_details_arr = array('1'=>'Adult','2'=>'Child','3'=>'Infant','4'=>'Youth','5'=>'Senior');
              ?>                                
             <tr>                                                
             <td style="padding:5px;"><?=($k+1)?></td>                                         
             <td style="padding:5px"><?=$val['saluation'].'.'.$val['first_name'].' '.$val['middle_name'].' '.$val['last_name'] ;?></td>                 
             <td style="padding:5px;"><?=$age_band_details_arr[$val['passenger_type']]?></td>                            
             </tr>                                                                        <?php } ?>                                                             
             </tbody>                                      
             </table>                                    
             </td>                                    
                                     
             </tr>                                 
             <tr>                                    
             <td style="line-height:12px;">&nbsp;</td>                                
              </tr>                                 

              <tr>                                    
              <td colspan="4" style="padding:0;">                                       
              <table cellspacing="0" cellpadding="5" width="100%" style="font-size:12px; padding:0;">                                          
              <tbody>                                             
              <tr>                                                
              <td width="50%" style="padding:0;padding-right:14px; vertical-align: top;">                                                   
              <table cellspacing="0" cellpadding="5" width="100%" style="font-size:12px; padding:0;border:1px solid #9a9a9a;">                                                      
              <tbody>                                                         
              <tr>                                                            
              <td style="border-bottom:1px solid #ccc;padding:5px;"><span style="font-size:13px">Payment Details</span></td>                                                            
              <td style="border-bottom:1px solid #ccc;padding:5px;"><span style="font-size:11px">Amount (<?=BASE_CURRENCY_ICON?>)</span></td>
              </tr>                                                                                                                  

              <tr>                                                     
              
              <td style="padding:5px"><span>Base Fare</span></td>                                                            
              <td style="padding:5px"><span><?=($Booking->total_amount+$Booking->discount)?></span></td>                                                        
              </tr>                                                         

            <!--   <tr>                                                            
              <td style="padding:5px"><span>Taxes</span></td>                                                            
              <td style="padding:5px"><span><?=0?></span></td>                                                         
              </tr>                                                         

              <tr> -->                                                            
              <td style="padding:5px"><span>Discount</span></td>                                                            
              <td style="padding:5px"><span><?=$Booking->discount?></span></td>                                                         
              </tr>                                                         

              <tr>                                                            
              <td style="border-top:1px solid #ccc;padding:5px"><span style="font-size:13px">Total Fare</span></td>
              <td style="border-top:1px solid #ccc;padding:5px"><span style="font-size:13px"><?=$Booking->total_amount?></span></td>                                                         
              </tr>                                                                                                               

              </tbody>                                                   

              </table>                                                
              </td>                                                

              <td width="50%" style="padding:0;padding-left:14px; vertical-align:top">        

              <?php 
                
                $inclustion = json_decode(base64_decode($res['search_params']['inclusions']),true);
                $additional_info = json_decode(base64_decode($res['search_params']['additional_info']),true);
                $exclusions = json_decode(base64_decode($res['search_params']['exclusions']),true);
                $short_desc = base64_decode($res['search_params']['short_desc']);
                $TM_cancellation_charge = $res['BlockTrip']['BlockTripResult']['TM_Cancellation_Charge'];

                $total_amount =($Booking->api_rate+$Booking->admin_markup+$Booking->discount);
                $policy_string ='';
                if($TM_cancellation_charge){
                    foreach ($TM_cancellation_charge  as $key => $value) {

                      if($value['Charge']==0){
                           $policy_string .='No cancellation charges, if cancelled before '.date('d M Y',strtotime($value['ToDate'])).'<br/>';
                          
                      }else{
                          if($value['ChargeType']!=2){
                              $amount =  BASE_CURRENCY_ICON." ".$value['Charge'];
                          }else{
                            $amount =  BASE_CURRENCY_ICON." ".$total_amount ;
                          }
                          $current_date = date('Y-m-d');
                          $cancell_date = date('Y-m-d',strtotime($value['FromDate']));
                          if($cancell_date >$current_date){
                            $value['FromDate'] = $value['FromDate'];

                            $policy_string .=' Cancellations made after '.date('d M Y',strtotime($value['FromDate'])).', or no-show, would be charged '.$amount;
                          }else{
                            $value['FromDate'] = date('Y-m-d');
                            $policy_string  .='This rate is non-refundable. If you cancel this booking you will not be refunded any of the payment.';
                          }
                      }

                    }
                  }
              ?>                                           
              <table cellspacing="0" cellpadding="5" width="100%" style="border:1px solid #9a9a9a;font-size:12px; padding:0;">  
              <tbody>                                                         
              <tr>                                                            
              <td style="background-color:#d9d9d9;border-bottom:1px solid #ccc;padding:5px; color:#333"><span style="font-size:13px">Activity Inclusions</span></td> 
              </tr>                                                       <?php foreach($inclustion as $incl):?>     
              <tr>     
                 <td style="padding:5px"><span><?=$incl?></span></td>    
              </tr> 
              <?php endforeach;?>
               </tbody>
              </table>

              </td>                                             
              </tr> 

              </tbody>                                       
              </table>                                    
              </td>                                 
              </tr>   

              <tr>                                    

              <td style="line-height:12px;">&nbsp;</td>                                 
              </tr>

              <tr>                                 
              <td align="center" colspan="4" style="border-bottom:1px solid #999999;padding-bottom:15px">
              <span style="font-size:13px; color:#555;">Customer Contact Details | E-mail : <?=$Booking->billing_email?> | Contact No : <?=$Booking->billing_contact_number?></span>
              </td>                                 
              </tr>                                 

              <tr>                                    
              <td style="line-height:12px;">&nbsp;</td>                                 
              </tr>                                 

              <tr>                                    
              <td colspan="4"><span style="line-height:26px;font-size: 15px;font-weight: 500;">Cancellation Policy</span></td>                                 
              </tr>                                 

              <tr>                                    
              <td colspan="4" style="line-height:20px; font-size:12px; color:#555"><?=$policy_string?></td>                                 
              </tr>                                 

              <tr>                                    
              <td style="line-height:12px;">&nbsp;</td>                                 
              </tr>                                 

              <tr>                                    
              <td colspan="4"><span style="line-height:26px;font-size: 15px;font-weight: 500;">Tour Information</span></td>                                 
              </tr>                                 

              <tr>                                    
              <td colspan="4" style="line-height:20px; padding-bottom:15px; font-size:12px; color:#555">                                      
              <span style="line-height: 23px;font-size: 13px;font-weight: 500;color: #333;">Tour Description</span><br><?=$short_desc?><br>                                      
              <span style="line-height: 23px;font-size: 13px;font-weight: 500;color: #333;">Information</span>    

             <ul>        
                <?php foreach($additional_info as $ad):?>                               
                 <li><?=$ad?></li>
                <?php endforeach;?>
             </ul>                                      

             <span style="line-height: 23px;font-size: 13px;font-weight: 500;color: #333;">Exclusions</span>                                      

             <ul>
                <?php foreach($exclusions as $excl):?>
                <li><?=$excl?></li>
                <?php endforeach;?>
             </ul>                                    
             </td>                                 
             </tr>                                 
                                 
              <tr>                                    
              <td colspan="4">
              <span style="line-height:26px;font-size: 15px;font-weight: 500;">Terms and Conditions</span>
              </td>                                
               </tr>                                 

              <tr>                                    
                <td colspan="4" style="line-height:20px; border-bottom:1px solid #999999; padding-bottom:15px; font-size:12px; color:#555">1.Please ensure that operator BookingID is filled, otherwise the ticket is not valid.</td>                 
              </tr>                                 
              <tr>
              <?php 
                $current_date = date('Y-m-d');
                $travel_date = date('Y-m-d',strtotime($res['BlockTrip']['BlockTripResult']['BookingDate']));
               
              ?>
              <?php if( ($travel_date > $current_date ) &&($res['BlockTrip']['BlockTripResult']['Cancellation_available'])):?>
                  <?php if($Booking->booking_status=='CONFIRMED' || $Booking->booking_status =='CANCEL_HOLD'):?>
                    <td><button data-pnr="<?php echo base64_encode($Booking->pnr_no);?>" class="btn btn-danger" id="cancelPnrbooking">Ticket-cancel</button></td>
                <?php endif;?>
              <?php endif; ?>
              </tr>
              <tr style="">                                    
             <td colspan="4" align="right" style="padding-top:10px;font-size:13px;line-height:20px;"><?=PROJECT_TITLE?> <br>

              <?php  echo @$admin_details->address;?><br/>
              <?php  echo @$admin_details->city_name.', '.$admin_details->state_name.' '.$admin_details->zip_code.'. '.$admin_details->country_code_3;?><br/>
              
                <div class="iconmania"><span class="fa fa-phone"></span> Tel :<?=@$admin_details->admin_cell_phone?></div>
              <div class="iconmania"><span class="fa fa-phone"></span> Toll free :<?=@$admin_details->admin_home_phone?></div>

              <div class="iconmania"><span class="fa fa-envelope"></span><a> Email:<?=@$admin_details->admin_email?></a></div>
              </td>                                   
              </tr> 

              </tbody>                           
              </table>                        
              </td>                     
              </tr>                  
              </tbody>               
              </table>   
              </td>
              </tr>
              </tbody>
              </table>
                     
              

              <table id="printOption" onclick="w=window.open();w.document.write(document.getElementById('tickect_hotel').innerHTML);w.print();w.close(); return true;" style="border-collapse: collapse;font-size: 14px; margin: 10px auto; font-family: arial;" width="70%" cellpadding="0" cellspacing="0" border="0">      
              <tbody>         
              <tr>            
              <td align="center">
              <?php  if(!isset($mail_voucher)){ ?>
                 <input style="background:#418bca; height:34px; padding:10px; border-radius:4px; border:none; color:#fff; margin:0 2px;" type="button" value="Print">   
              <?php } ?>      
              </td>         
              </tr>      
              </tbody>   
              </table>
              </div>
      <div class="clearfix"></div>
       
       </div>
       <?php 
        if(!isset($mail_voucher)){
           echo $this->load->view('common/footer');
        }
       ?>
<div class="clearfix"></div>
     </div>
     </div>
   </div>
      <!--  <?php //echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?> -->
      <script src="<?php echo ASSETS; ?>js/bootstrap.min.js"></script> 
    <script type="text/javascript">
      $(function(){
         $("#cancelPnrbooking").click(function(){
          var pnr_no = $(this).data('pnr');
          $('.cancel_loader .carttoloadr').show();
          $.ajax({
              type:"post",
              url:"<?php echo base_url()?>"+"reports/transfer_activity_cancel",
              data:{PNR_NO:pnr_no},
              success:function(res){
                var obj = JSON.parse(res);
                $('.cancel_loader .carttoloadr').hide();
              //  console.log(obj);
                if(obj.status=='1'){
                    alert('Cancellation success');              
                }else{
                  alert('Cancellation not success');
                  
                }
                location.reload();

              },
              error:function(obj){
                
              }
          });

        });
      });
    </script>
     </body>
</html>       