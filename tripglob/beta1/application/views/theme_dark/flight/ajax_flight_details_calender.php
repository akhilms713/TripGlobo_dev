<?php 
// echo "<pre/>";print_r($flight_details);die;
  if (!empty($flight_details)) {
    $pax = $flight_details['FlightDetails'][0]['PCode'];
    $pax_quantity = $flight_details['FlightDetails'][0]['PQuantity'];
    $pax_eq_fare = $flight_details['FlightDetails'][0]['PEquivFare_org'];
    $pax_tax = $flight_details['FlightDetails'][0]['PTaxFare'];
    $pax_total = $flight_details['FlightDetails'][0]['PTotalFare_org'];
    $total_pax_qnt = 0;
    if (!empty($pax)) {
      $data = array();
      $total = array();
      for ($i=0; $i < (count($pax)); $i++) { 
        $adt = array();
        $adt['pax'] = $pax_quantity[$i] .' x '. $pax[$i];
        $adt['base'] = $pax_quantity[$i]*$pax_eq_fare[$i];
        $adt['tax'] = $pax_quantity[$i]*$pax_tax[$i];
        $adt['total'] = $pax_quantity[$i]*$pax_total[$i];
        $total_pax_qnt++;
        array_push($data, $adt);
      }
    }

    function exact_class($class) {
      $classCode = '';
      if ($class == 'Y') {
        $classCode = 'Economy';
      }
      if ($class == 'S') {
        $classCode = 'PremiumEconomy';
      }
      if ($class == 'C') {
        $classCode = 'Business';
      }
      if ($class == 'J') {
        $classCode = 'PremiumBusiness';
      }
      if ($class == 'F') {
        $classCode = 'First';
      }
      if ($class == 'P') {
        $classCode = 'PremiumFirst';
      }
      return $classCode;
    }
    //print_r($data);exit;
?>
<thead>
  <tr class="bg-j">
    <th class="ftclr"><i class="fa fa-plane" aria-hidden="true"></i></th>
    <th class="ftclr">Flight</th>
    <th class="ftclr">C</th>
    <th class="ftclr">From</th>
    <th class="ftclr">To</th>
    <th class="ftclr">Departure</th>
    <th class="ftclr">Arrival</th>
    <th class="ftclr"><i class="fa fa-clock-o" aria-hidden="true"></i></th>
    <th class="ftclr">No Of Pax</th>
    <th class="ftclr">Total price</th>
    <th class="ftclr">Action</th>
  </tr>
</thead>
<tbody>
  <?php 
    for ($i=0; $i < count($flight_details['FlightDetails']); $i++) {
      $s_cnt            = count($flight_details['FlightDetails'][$i]['Destination']);
      $start_place      = explode('(',$flight_details['FlightDetails'][$i]['Origin'][0]);
      $end_place        = explode('(',$flight_details['FlightDetails'][$i]['Destination'][$s_cnt-1]);
      $start_place_code = $flight_details['FlightDetails'][$i]['OriginLocation'][0];
      $end_place_code   = $flight_details['FlightDetails'][$i]['DestinationLocation'][$s_cnt-1];
      $count            = count($flight_details['FlightDetails'][$i]['MarketingAirline']) - 1;
      //echo $count;
      if($t_count == 1){
        $s = 12;
      }else{
        $s = 6;
      }
  ?>
  <?php
    for ($j=0; $j <= $count; $j++) { 
    
  ?>
  <tr>
    <td><img src="https://c.fareportal.com/n/common/air/ai/<?php echo $flight_details['FlightDetails'][$i]['MarketingAirline'][$j]; ?>.gif" alt=""></td>
    <td>
      <div class="tooltip1">
        <?php echo $flight_details['FlightDetails'][$i]['Airline_name'][$j]; ?> <br>(<?php echo $flight_details['FlightDetails'][$i]['MarketingAirline'][$j].'-'.$flight_details['FlightDetails'][$i]['FlighvgtNumber_no'][$j] ?>)
        <span class="tooltiptext55">
          <table class="table table-bordered table_cnt" id="baggage_rules_details">
            <thead>
              <tr class="bg-j">
                <th class="ftclr">Pax<i class="fa fa-plane" aria-hidden="true"></i></th>
                <th class="ftclr">Baggage Details</th>   
              </tr>
            </thead>
            <tbody>
              <?php 
                for ($pc=0; $pc < count($flight_details['FlightDetails'][$i]['PCode']); $pc++) { 
              ?>
              <tr>
                <td><?php echo $flight_details['FlightDetails'][$i]['PCode'][$pc]; ?></td>
                <td><?php echo $flight_details['FlightDetails'][$i]['Weight_Allowance'][$pc]; ?></td>    
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </span>
      </div>    
    </td>
    <td>
    <?php //echo exact_class($flight_details[$i]['Cabin'][$j]); ?>
      <?php echo$flight_details['FlightDetails'][$i]['ResBookDesigCode'][$j]; ?>
    </td>

    <?php 
      $ori_city = explode('(', $flight_details['FlightDetails'][$i]['Origin'][$j]);
      $ori_code = str_replace(')', '', $ori_city[1]);

      $dest_city = explode('(', $flight_details['FlightDetails'][$i]['Destination'][$j]);
      $dest_code = str_replace(')', '', $dest_city[1]);
    ?>
    <td><?php echo $ori_city[0]; ?><br>(<?php echo $ori_code; ?>)</td>
    <td><?php echo $dest_city[0]; ?><br>(<?php echo $dest_code; ?>)</td>
    <td><?php echo date('d M Y ',strtotime($flight_details['FlightDetails'][$i]['DepartureDateTime_r'][$j])); ?><br><?php echo date('H:i ',strtotime($flight_details['FlightDetails'][$i]['DepartureDateTime_r'][$j])); ?></td>
    <td><?php echo date('d M Y ',strtotime($flight_details['FlightDetails'][$i]['ArrivalDateTime_r'][$j])); ?><br> <?php echo date('H:i ',strtotime($flight_details['FlightDetails'][$i]['ArrivalDateTime_r'][$j])); ?></td>
    <td><?php echo $flight_details['FlightDetails'][$i]['final_duration'];  ?></td>
    <td><?php echo $total_pax_qnt;  ?></td>
    <?php if($i == 0 && $j == 0) { ?>
    <td rowspan="4" style="vertical-align:middle;">
      <div class="tooltip1"><?php echo $this->display_icon." ".number_format(($flight_details['FlightDetails'][$i]['TotalFare'] * $this->curr_val), 2); ?>
        <span class="tooltiptext1">
          <table class="table table-bordered table_cnt">
            <thead>
              <tr class="bg-j">
                <th class="ftclr">Pax<i class="fa fa-plane" aria-hidden="true"></i></th>
                <th class="ftclr">Base</th>
                <th class="ftclr">Tax</th>
                <th class="ftclr">Total</th>               
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($data)) { 
              foreach ($data as $key => $value) {
              ?>
              <tr>
                <td><?php echo $value['pax']; ?></td>
                <td><?php echo number_format(($value['base'] * $this->curr_val), 2); ?></td>
                <td><?php echo number_format(($value['tax'] * $this->curr_val), 2); ?></td>
                <td><?php echo number_format(($value['total'] * $this->curr_val), 2); ?></td>      
              </tr>
            <?php } ?>
            <?php } else { ?>
              <p class="text-center">No data available</p>
            <?php } ?>
            </tbody>
          </table>
        </span>
      </div>
    </td>
    <?php
        $cal_data_v['sessionid'] = $flight_details['session_id'];
        $cal_data_v['id'] = $flight_details['flight_id'];
        $cal_data_v['search_id'] = @$search_id;
        $cal_data_v['search_module'] = 'FLIGHT';
        $uid  =  base64_encode(json_encode($cal_data_v));

    ?>
    <td rowspan="4" style="vertical-align:middle;">
    <a class="booknow FlightbookNow" data-target="_blank" data-attr="<?=$uid?>">Book</a>
      <!-- <form action="<?php echo base_url() . 'flight/addToCart/'.$uid; ?>" method="post">
      
        <input type="hidden" name="flight_data" value="<?php echo $uid; ?>">
        
        <input type="submit" value="Select" class="selcetbtn">
      </form> -->
    </td>
    <?php } ?>
  </tr>    
  <?php } } ?>
</tbody>
<?php } else { ?>
  <p class="text-center">No data available.</p>
<?php } ?>


