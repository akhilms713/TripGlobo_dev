<style type="text/css">

   .add_anima_hotel{animation: shake 0.5s !important;}

   #new_busda h4 {

    background: #fff;

    font-size: 12px;

    text-align: left;

    padding-left: 15px;

    padding-bottom: 0;

    margin: 0px;

    color: #000;

    padding-top: 5px;

}
.btns_serachs {
 margin-top: 1px !important;
    padding: 11px 20px;
}
/* .col-md-3.col-sm-12.bus_apt {
        margin: 0px 6px;
    width: 27%;
} */
.col-md-6.col-sm-6.nopad.brde_on.brde_onq.bus_brdq {
    width: 47%;
    margin: 0px 7px;
}
.btn_newdaqas{    margin-top: 2px;} 

@media (max-width: 768px) {

  #new_busda{
    display:grid;
    gap:4px;
    padding: 0 2rem;
  }
  .busBtn{
    position: static;
  }

}

@media (min-width: 769px) {
  .busBtn{
    position: absolute;
    top:7.5rem;
    left:86%;
  }
  #new_busda{
    padding: 0 2rem;
    display: flex;
    gap: 1rem;
  }
}
</style>



  <input type="hidden" id="getUrl1" value="<?php echo $_SERVER['REQUEST_URI']?>">

  <div class="tab-pane tab_cus page_bus <?php if(isset($header_product) && $header_product == 'bus') echo 'active'; ?>" id="bus">
    <form autocomplete="off" action="<?php echo WEB_URL ?>index.php/bus/search" method="get" name="busSearchForm" id="busSearchForm">
      <div class="intabs" >
        <div class="inner-form row" id="new_busda" >
          <div class="col-md-4 col-sm-4 col-sm-12 bus_apt" style="padding: 0;border: 2px solid #1356F7;"  > 
            <div class="  nopad" >
              <h4>From</h4>
              <div class="input-field first-wrap" >
                <input id="bus-station-from" name="from" type="text" class=" ft frombus mytextbox iconLoc contr_form" placeholder="From" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list" />
                <input class="hide loc_id_holder" name="from_station_id" type="hidden" value="">
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-sm-12 bus_apt" style="padding: 0;border: 2px solid #1356F7;"  > 
            <div class="  nopad" >
              <h4 class="pad_twofive_label">To</h4>
              <div class="input-field first-wrap">
                <input name="to" id ="bus-station-to" class="ft departbus mytextbox iconLoc contr_form pad_twofive"   placeholder="To" value="<?php echo isset($destination) ? $destination : $toCity ?>"  type="text"  autoComplete="off" aria-autocomplete="list"/>
                <input class="hide loc_id_holder" name="to_station_id" type="hidden" value="">
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-sm-12 bus_apt" style="padding: 0;border: 2px solid #1356F7;"> 
            <div class="nopad">
              <h4 class="pad_twofive_label">Depature Date</h4>
              <div class="input-field first-wrap" style="display:flex;height: 27px;">
                <input name ="bus_depature" class="ft departflight mytextbox iconLoc contr_form pad_twofive" id="bus_depature" placeholder="Depature Date" value="" type="text" />
                <i class="fa fa-calendar" style="margin-right:3%; color:#1356F7;"></i>   
              </div>
            </div>
          </div>
          <div class="col-md-1 col-sm-1  nopad busBtn" style="text-align:center;">
            <button class="srchbutn comncolor btn btn-search search_fly btn_newdaqas btns_serachs" style="">Search<i class="fa fa-arrow-right fa-xl" style="width:40px"></i></button>
          </div>
        </div>
      </div> 
      <span id="searchbus_error" class="hide" style="color: red;"></span>
    </form>
  </div>



<span class="hide">

   <!-- <input type="hidden" id="pri_visible_room" value="<?=$visible_rooms?>"> -->

</span>




<script>
 $("#busSearchForm").submit(function(e){
           var _from_loc = $('#busSearchForm #bus-station-from').val();
           var _to_loc = $('#busSearchForm #bus-station-to').val();
            var bus_depature = $('#busSearchForm #bus_depature').val();

           if(_from_loc == '' || _to_loc == ''){
            // alert('Please Enter the location');
            $('#searchbus_error').html('Please Enter the location');
            $('#searchbus_error').removeClass('hide');
            setTimeout(function(){ $('#searchbus_error').addClass('hide'); }, 5000);
            return false;
           }
          if(_from_loc==_to_loc){
            // alert('From location and To location cannot be same');
            $('#searchbus_error').html('From location and To location cannot be same');
            $('#searchbus_error').removeClass('hide');
            setTimeout(function(){ $('#searchbus_error').addClass('hide'); }, 5000);
            return false
          }
           if(bus_depature == ''){
            $('#searchbus_error').html('Please select depature date');
            $('#searchbus_error').removeClass('hide');
            setTimeout(function(){ $('#searchbus_error').addClass('hide'); }, 5000);
            return false
          }
          
       });

     var getUrl = ($('#getUrl1').val()).split('/');

    //  alert(getUrl[1]);

    if(getUrl[2] != ''){

        if(getUrl[2] != 'bus'){

            if($('.page_bus').hasClass('hide')){

                $('.page_bus').removeClass('hide');

            }    

        }

    }

 </script>

  <script type="text/javascript">
   
      $('#bus_depature').datepicker({

           // defaultDate: "+1w",

            changeMonth: true,

            changeYear:true,

            dateFormat : 'M d,yy',

            numberOfMonths: 1,

            minDate:0





            //minDate: $( "#depature").val(),

      });                        

    </script>