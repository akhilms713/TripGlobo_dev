<?php

if($request->type == 'O'){  

if($flex_air_segment_date){
							
							$result= (array)$flex_air_segment_date;
						$max_h_p = max($result);
						$cinv = explode("-",$request->depart_date);
						$cin = $cinv[2].'-'.$cinv[1].'-'.$cinv[0];
	
	?><div class="width_46 barContainer">
                  <?php
foreach($result as $keycv => $vals) { // city_b headings
$cinsv = explode("-",$keycv);
						$cinsad = $cinsv[2].'-'.$cinsv[1].'-'.$cinsv[0];
?>
                  <div class="col_seven">
                    <a class="chart_wrap fare_matrix1 <?php if($keycv==$cin) { echo 'active'; } ?>"  data-price="<?php echo $vals; ?>" data-datval="<?php echo $cinsad; ?>">
                        <div class="price_chart">
                          <label for="" class="bar" data-height="<?php echo (($vals/$max_h_p)*100); ?>">
                          	<span class="price_popover">
                            	<?php echo date("d M Y",strtotime($keycv)); ?>
                            	<span class="priconluy"><strong>$</strong><?php echo $vals; ?></span>
                            </span>
                          </label>
                        </div>
                      <span class="barInfo"><?php echo date("d M",strtotime($keycv)); ?></span>
                    </a>
                  </div>
                  
                  
             <?php
}
?>       
                  
                  
                  
                  
                  
              </div>
                <div class="width_8 priceRange">
                  <div class="sitedivide"><label class="top_price" for=""><?php echo $max_h_p; ?></label></div>
                  <div class="sitedivide"><label class="mdl_price" for=""><?php echo ($max_h_p/2); ?></label></div>
                  <div class="sitedivide"><label class="botm_price" for="">0</label></div>
              </div>
                    
              <?php
						}
		}
		if($request->type == 'R'){if($flex_air_segment_date){
							
							$resuslts= (array)$flex_air_segment_date;
							$result_v = array_values($resuslts);
						
						for($k=0;$k<count($result_v);$k++)
						{
							$res_data = (array)$result_v[$k];
							$res_datasd = array_values($res_data);
							$result_r[$res_datasd[1]] = $res_datasd[0];
						}
						for($k=0;$k<count($result_v);$k++)
						{
							$res_data = (array)$result_v[$k];
							$res_datasd = array_values($res_data);
							$result_f[$res_datasd[2]] = $res_datasd[0];
						}

						$max_h_p = max($result_r);
						$max_h_p3 = max($result_f);
						$cinv = explode("-",$request->depart_date);
						$cin = $cinv[2].'-'.$cinv[1].'-'.$cinv[0];
						$cinvw = explode("-",$request->return_date);
						$cout = $cinvw[2].'-'.$cinvw[1].'-'.$cinvw[0];
?>
  <div class="width_46 barContainer">

    <?php
						//	echo '<pre/>';	print_r($result_r);
foreach($result_r as $keycv => $vals) { // city_b headings
$cinsv = explode("-",$keycv);
if(isset($cinsv[2]) && $vals!='')
{
	$cinsad = $cinsv[2].'-'.$cinsv[1].'-'.$cinsv[0];
?>
<div class="col_seven">
                    <a class="chart_wrap fare_matrix1 <?php if($keycv==$cin) { echo 'active'; } ?>"  data-price="<?php echo $vals; ?>" data-datval="<?php echo $cinsad; ?>">
                        <div class="price_chart">
                          <label for="" class="bar" data-height="<?php echo (($vals/$max_h_p)*100); ?>">
                          	<span class="price_popover">
                            	<?php echo date("d M Y",strtotime($keycv)); ?>
                            	<span class="priconluy"><strong>$</strong><?php echo $vals; ?></span>
                            </span>
                          </label>
                        </div>
                      <span class="barInfo"><?php echo date("d M",strtotime($keycv)); ?></span>
                    </a>
                  </div>

     <?php
}
}
?>

</div>
  <div class="width_8 priceRange">
                  <div class="sitedivide"><label class="top_price" for="">1200</label></div>
                  <div class="sitedivide"><label class="mdl_price" for="">600</label></div>
                  <div class="sitedivide"><label class="botm_price" for="">0</label></div>
              </div>
                    
              <div class="width_46 barContainer">


    <?php
	
foreach($result_f as $keycv3 => $vals3) { // city_b headings
$cinsv = explode("-",$keycv3);
if(isset($cinsv[2]) && $vals3!='')
{
						$cinsad = $cinsv[2].'-'.$cinsv[1].'-'.$cinsv[0];
?>
<div class="col_seven ">
                    <a class="chart_wrap fare_matrix2 <?php if($keycv3==$cout) { echo 'active'; } ?>"  data-price="<?php echo $vals3; ?>" data-datval="<?php echo $cinsad; ?>">
                        <div class="price_chart">
                          <label for="" class="bar" data-height="<?php echo (($vals3/$max_h_p3)*100); ?>">
                          	<span class="price_popover">
                            	<?php echo date("d M Y",strtotime($keycv3)); ?>
                            	<span class="priconluy"><strong>$</strong><?php echo $vals3; ?></span>
                            </span>
                          </label>
                        </div>
                      <span class="barInfo"><?php echo date("d M",strtotime($keycv3)); ?></span>
                    </a>
                  </div>

     <?php
}
}
?>
</div>
<?php
						}}
		?><script>
		
		 $('.fare_matrix1').click(function(){
		$('.fare_matrix1').removeClass('active');
		$(this).toggleClass('active');
	});
	$('.fare_matrix2').click(function(){
		$('.fare_matrix2').removeClass('active');
		$(this).toggleClass('active');
	});  
	
	$(".fare_matrix1").click(function(){
	$dataval = 	$(this).data('datval');
$priceval = 	$(this).data('price');
$('#Departure').val($dataval);
	}); 
	$(".fare_matrix2").click(function(){
	$dataval = 	$(this).data('datval');
$priceval = 	$(this).data('price');

$('#Arrival').val($dataval);
	}); 
	
	
		 $('.barContainer a label').each(function(){
		var price = $(this).data('height')+'%';
		$(this).css({'height': price});    
	  });
	  </script>