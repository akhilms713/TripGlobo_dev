<style type="text/css">

   .add_anima_hotel{animation: shake 0.5s !important;}

   #new_busda h4 {

    background: #fff;

    font-size: 12px;

    text-align: left;

    padding-left: 15px;

    padding-bottom: 0;

    margin: 0px;

    color: #fdb813;

    padding-top: 5px;

}
.btns_serachs {
 margin-top: 1px !important;
    padding: 11px 20px;
}
.col-md-3.col-sm-12.bus_apt {
        margin: 0px 6px;
    width: 27%;
}
.col-md-6.col-sm-6.nopad.brde_on.brde_onq.bus_brdq {
    width: 47%;
    margin: 0px 7px;
}
.btn_newdaqas{    margin-top: 2px;} 
.bus_list1_from{
    overflow:auto;
}
div#ui-datepicker-div{
    Top:318px!important;
    overflow-y:hidden;
    overflow-x:hidden;
    max-height:400px;
}
ul#ui-id{
    overflow:auto;
}
.ui-widget-content{
    overflow-y:auto;
    overflow-x:hidden;
    max-height:200px;
}
</style>



<input type="hidden" id="getUrl1" value="<?php echo $_SERVER['REQUEST_URI']?>">

<div class="tab-pane tab_cus page_bus <?php if(isset($header_product) && $header_product == 'bus') echo 'active'; ?>" id="bus">

      <form autocomplete="off" action="<?php echo WEB_URL ?>index.php/bus/search" method="get" name="busSearchForm" id="busSearchForm">



<div class="intabs" >



        

            <div class="inner-form" id="new_busda">

          <div class="col-md-7 col-sm-12" > 

          <div class="col-md-6 col-sm-6  nopad brde_on brde_onq bus_brdq">

            <h4>From</h4>

          <div class="input-field first-wrap" >

            <input id="bus-station-from" name="from" type="text" class=" ft frombus mytextbox iconLoc contr_form bus_list1_from" placeholder="From" style="" value="<?php if(isset($origin)){ echo $origin; } ?>" autoComplete="off" aria-autocomplete="list" />

            <input class="hide loc_id_holder" name="from_station_id" type="hidden" value="">

          </div>

          

        

 

          </div>

            



     <div class="col-md-6 col-sm-6  nopad" style="padding: 0;border: 2px solid #fdb813;" >

            <h4 class="pad_twofive_label">To</h4>

           <div class="input-field first-wrap">

            <input name="to" id ="bus-station-to" class="ft departbus mytextbox iconLoc contr_form pad_twofive"   placeholder="To" value="<?php echo isset($destination) ? $destination : $toCity ?>"  type="text"  autoComplete="off" aria-autocomplete="list"/>

            <input class="hide loc_id_holder" name="to_station_id" type="hidden" value="">

          </div>

    </div>

        </div>

    

          <div class="col-md-3 col-sm-12 bus_apt" style="padding: 0;border: 2px solid #fdb813;"> 

     <div class="col-md-12 col-sm-12  nopad">

            <h4 class="pad_twofive_label">Depature Date</h4>

           <div class="input-field first-wrap">

            <input name ="bus_depature" class="ft departflight mytextbox iconLoc contr_form pad_twofive" id="bus_depature" placeholder="Depature Date" value="" type="text" />

          </div>

    </div>

        </div>

    

     <div class="col-md-1 col-sm-1  nopad">

           

   <button class="srchbutn comncolor btn btn-search search_fly btn_newdaqas btns_serachs" style="">Search</button>

    </div>

    



</div>
 
          

             </div> 
             <span id="searchbus_error" class="hide" style="color: red;"></span>

               </div>

          

      </form>



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