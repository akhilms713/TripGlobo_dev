<Style>

.align_r{text-align: left !important;}

</Style>

<?php

// $template_images = $GLOBALS['CI']->template->template_images();

// debug($BoardingDetails); exit();

?>

	<div class="col-md-6 nopad"style="padding:18px!important">

      <h3>BOARDING POINT</h3>

      <?php 

      	foreach ($BoardingDetails['BoardingPointsDetails'] as $key => $value) {

      		$filt_dept_time = str_replace('T', ' ', $__bv['CityPointTime']);

    		// debug(explode('T',$value['CityPointTime'])[1] );exit();

      ?>

      <div class="col-md-12 nopad my_tr">

         <div class="col-md-2 nopad">

            <h5><?= explode('T',$value['CityPointTime'])[1] ?></h5>

         </div>

         <div class="col-md-5 nopad">

            <h5><?=$value['CityPointName']?></h5>

             <h5><?=$value['CityPointAddress']?></h5>

         </div>

      

         <div class="col-md-3 nopad">

           

         </div>

      </div>

   



  <?php  } ?>

   </div>

   <div class="col-md-6 droping_end" style="padding:15px!important">

      <!--<hr> -->

      <h3 class="align_r">DROPPING POINT</h3>

      <?php 

      

      	foreach ($BoardingDetails['DroppingPointsDetails'] as $key => $value) {

      	  //  print_r($value);

      		$filt_arrv_time = str_replace('T', ' ', $value['CityPointTime']);

      ?>

      <div class="col-md-12 nopad my_tr">

         <div class="col-md-2 nopad">

            <h5 class="align_r"><?= explode('T',$value['CityPointTime'])[1] ?></h5>

         </div>

         <div class="col-md-10">

            <div class="col-md-12 nopad">

               <h5 class="align_r"><?=$value['CityPointName']?>    <?=$value['CityPointLocation']?></h5>

            </div>

         </div>

      </div>



  <?php  } ?>

   </div>



 <?php

/*if (@$details['result']['Pickups'] == true) {

	$CUR_Pickup = force_multple_data_format(@$details['result']['Pickups']);

} else {

	$CUR_Pickup = '';

}

if (@$details['result']['Dropoffs'] == true) {

	$CUR_Dropoff = force_multple_data_format(@$details['result']['Dropoffs']);

} else {

	$CUR_Dropoff = '';

}

// debug($details);exit;

$CUR_CancellationCharges = force_multple_data_format($details['result']['Canc']);

?>

<div class="pick-up-wrapper">

<table class="table table-condensed table-striped">

	<caption><img class="media-object pull-left" src="" alt="Bus Boarding Dropping Point Icon"><h4>Boarding Point Details</h4></caption>

	<tr>

		<th>Sno</th>

		<th>Pick Up</th>

		<th>Time</th>

		<th>Details</th>

	</tr>

	<?php

	if (valid_array($CUR_Pickup) == true) {

		foreach ($CUR_Pickup as $pk => $pv) {

			?>

	<tr>

		<td><?=($pk+1)?></td>

		<td><?=$pv['PickupName']?></td>

		<td><?=get_time($pv['PickupTime'])?></td>

		<td><?=($pv['Address'])?> <?=($pv['Landmark'])?> <?=($pv['Contact'])?></td>

	</tr>

	<?php

		}

	} else {

		echo '<tr><td colspan="4">NA</td></tr>';

	}

	?>

</table>

</div>

<hr>

<div class="drop-wrapper">

<table class="table table-condensed table-striped">

	<caption><img class="media-object pull-left" src="" alt="Bus Boarding Dropping Point Icon"><h4>Drop Point Details</h4></caption>

	<tr>

		<th>Sno</th>

		<th>Drop</th>

		<th>Time</th>

		<!-- <th>Details</th> -->

	</tr>

	<?php

	if (valid_array($CUR_Dropoff) == true) {

		foreach ($CUR_Dropoff as $dk => $dv) {

			?>

	<tr>

		<td><?=($dk+1)?></td>

		<td><?=$dv['DropoffName']?></td>

		<td><?=get_time($dv['DropoffTime'])?></td>

		<!-- <td><?=($dv['Address'])?> <?=($dv['Landmark'])?> <?=($dv['Phone'])?></td> -->

	</tr>

	<?php

		}

	} else {

		echo '<tr><td colspan="4">NA</td></tr>';

	}

	?>

</table>

</div>

<?php

// include_once 'travelyaari_cancellation_policy.php';*/

?>

