<style>
.Dest_input {
     text-align: left;
     width: 45%;
     margin-bottom:7px;
     position:relative;
}
.Dest_input select {
    width: 98%;
    height:50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 20px 0 0px 7px;
    outline:none;
    background:#fff;
}
.transfer_search_engine form {
    display: flex;
    flex-wrap: wrap;
}
.pick_drop select {
    width: 100%;
    height:50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 20px 0 0px 7px;
    outline:none;
    background:#fff;
}
.pick_drop{
    width:55%;
    display:flex;
    margin-bottom:7px;
}
.date_pickup input {
    width: 100%;
    height: 50px;
    margin-right:7px;
    border: 2px solid #fdb816 !important;
    outline:none;
    font-weight: 600;
    padding: 20px 0 0px 7px;
}
.date_pickup {
    width: 100%;
    text-align: left;
    display: flex;
    margin-bottom: 7px;
}
.date_pickup select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 20px 0 0px 7px;
    outline:none;
    background:#fff;
}
.lang_num_pass select {
    width: 100%;
    height: 50px;
    margin-right:7px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 20px 0 0px 7px;
    outline:none;
    background:#fff;
}
.lang_num_pass {
    display: flex;
    width: 60%;
}
.transfer_search_engine {
    padding: 20px;
}
.pick_up {
    width: 100%;
    text-align: left;
    margin-right: 7px;
    position:relative;
}
.drop_me {
    width: 100%;
    text-align: left;
    position:relative;
}
.dat_pick {
    width: 25%;
    position:relative;
}.pick_up_time {
    width: 50%;
    display: flex;
    margin:0px 7px;
    position:relative;
}
.nationality {
    width: 25%;
    position:relative;
}
.lang_select {
    width: 50%;
    position:relative;
}.pass_select {
    width: 50%;
    position:relative;
    margin-left: 7px;
}
.details_of_input{
    position:absolute;
    top:5px;
    left:10px;
    font-size: 14px;
    color:#fdb816;
}
.fromtransfer.mytextbox.iconLoc.contr_form{
    width:100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 20px 0 0px 7px;
    outline: none;
    background: #fff;
}


.droptransfer.mytextbox.iconLoc.contr_form{
    width:100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 20px 0 0px 7px;
    outline: none;
    background: #fff;
}

select {
    -webkit-appearance: listbox !important;
}
</style>
<div class="transfer_search_engine">
    <div class="transfer_row page_transfer">
         <form  autocomplete="off" action="<?php echo WEB_URL ?>transfer/search" name="flight" id="flight" >
            <div class="Dest_input">
                <span class="details_of_input">Destinations</span>
    
                             <select id="country"  class="country"  name="country"  required="required"> 
                                       <?php foreach ($transfer_country_list as $key => $value) {?>
                        
                <option value="<?php echo $value['Code']; ?>"><?php echo $value['Name']; ?></option> 

                 <?php    } ?>
                             </select>
            </div>
            <div class="pick_drop">
                     <div class="pick_up">
                         <span class="details_of_input">Pick Up</span>
                                 <div class="input-field first-wrap" >

            <input id="transfer-station-from" name="from" type="text" class=" ft fromtransfer mytextbox iconLoc contr_form" placeholder="" style="" value="<?php  if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list" required />

            <input class="hide loc_id_holde " name="from_station_ids" id="from_station_ids" type="hidden" value="" >
            <input class="hide from_city_id " name="from_city_id" id="from_city_id" type="hidden" value="" >
            <input class="hide from_HotelId" name="from_HotelId" id="from_HotelId" type="hidden" value="">

          </div>
                             <!--<select>

                                   <?php foreach ($transfer_pickup_airport as $key => $value) {?>

                                 <option value="<?php echo $value['AirportCode']; ?>">
                                    <?php echo $value['AirportName']; ?> 

                                 </option>

                             <?php }?>
                             </select>-->
                     </div>
                      <div class="drop_me">
                          <span class="details_of_input">Drop off</span>

                                          <div class="input-field first-wrap" >

            <input id="transfer-station-to" name="to" type="text" class=" ft droptransfer mytextbox iconLoc contr_form" placeholder="" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list" required />

            <input class="hide loc_id_holder" name="to_station_id" id="to_station_id" type="hidden" value="">
            <input class="hide to_HotelId" name="to_HotelId"  id="to_HotelId" type="hidden" value="">
            <input class="hide to_station_code" name="to_station_code"  id="to_station_code" type="hidden" value="">

          </div>
                          <!--   <select>
 
     <?php foreach ($transfer_drop_airport as $key => $value) {?>

                                  <option  value="<?php echo $value['HotelId']; ?>" ><?php echo $value['HotelName'] ?></option>
                              <?php } ?>
                            </select> -->
                     </div>
            </div>
            <div class="date_pickup">
                 <div class="dat_pick">
                     <span class="details_of_input">Date</span>
                          <input class="datepicker contr_form" name="depatures" id="depature_date" type="text" class="forminput date_picker contr_form" readonly="readonly" placeholder="Departure Date" value="<?php if(isset($depart_date)) echo date('M d', strtotime($depart_date)).','.date("Y", strtotime($depart_date)); ?>" required="required" />
                 </div>
                 <div class="pick_up_time">
                     <span class="details_of_input">Pick up time</span>
                     <select name="hours">
                               <?php for($i=0;$i<=24;$i++){  ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                
                     </select>
                    <select name="minutes">
                        <?php for($i=0;$i<=60;$i++){  ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>

                    </select>
                 </div>
                 <div class="nationality">
                     <span class="details_of_input">Nationality</span>
                     <select name="nationality" required>
                        <?php 
                          $query = $this->db->query('select * from activity_country_list'); 
                          $transfer_country_lists =  $query->result_array();


                        foreach ($transfer_country_lists as $key => $value) { ?>
                            
                                  <option  value="<?php echo $value['Code']; ?>" ><?php echo $value['Name'] ?></option>

                        <?php } ?>
                    </select>
                 </div>
            </div>
            <div class="lang_num_pass">
                <div class="lang_select">
                    <span class="details_of_input">Language</span>
                    <select name="langauge">
                      <?php
                      // debug($PreferredLanguage); die;
                       foreach ($PreferredLanguage as $key => $value) {?>
 
                      
 <option  value="<?php echo $value->code; ?>" ><?php echo $value->langauge; ?></option>

                       <?php } ?>
                    </select>
                </div>
               <div class="pass_select">
                   <span class="details_of_input">Passengers</span>
                   <select name="adult">
                      <?php
                      // debug($PreferredLanguage); die;
                       for($i=1;$i<=23;$i++) {?>
                            <option  value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                       <?php } ?>
                    </select> 
                        
               </div>
              
            </div>
            <div class="col-md-12" style="text-align:center;">
                            <button class="srchbutn comncolor btn btn-search search_fly btn_newdaqas" style="">Search</button>
            </div>
       </form>
    </div>
</div>


<script type="text/javascript">
    $('#depature_date').datepicker({
                               // defaultDate: "+1w",d-m-
                                changeMonth: true,
                                changeYear:true,
                                dateFormat : 'yy-m-d',
                                numberOfMonths: 1,
                                minDate:0,
                                onSelect:function()
                                {
                                  var id_v = $(this).data('id');
                                  $("#to_m_"+ (id_v+1)).focus(); 
                                  var to_m =$('#to_m_1').val();
                                  $("#from_m_2").val(to_m);
                                } 
                          }); 
    
</script>


  <!--       <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="04">05</option>
                        <option value="05">06</option>
                        <option value="06">07</option>
                        <option value="07">08</option>
                        <option value="08">09</option> 
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option> -->