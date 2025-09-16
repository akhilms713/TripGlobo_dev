<!--search_tab-->



            
                <div class="totopp">
            <div class="col-lg-12 nopad">
              <div class="tabbable customtab">
				 <?php  if(!isset($product)){ ?>
				<ul class="nav nav-tabs">
                  <li class="active"><a href="#flight_search" data-toggle="tab"><span class="spanfa sprite faflight"></span>Flight</a></li>
                  <li ><a href="#hotel" data-toggle="tab"><span class="spanfa sprite fahotel"></span>Hotel</a></li>
                  <li><a href="#package" data-toggle="tab"><span class="spanfa sprite fapack"></span>Packages</a></li>
                  <li><a href="#activity" data-toggle="tab"><span class="spanfa sprite faact"></span>Activities</a></li>
                  <li><a href="#rail" data-toggle="tab"><span class="spanfa sprite farail"></span>Rail</a></li>
                  <li><a href="#cruise" data-toggle="tab"><span class="spanfa sprite facruise"></span>Cruise</a></li>
                  <li><a href="#car" data-toggle="tab"><span class="spanfa sprite facar"></span>Cars</a></li>
                  <li><a href="#transfer" data-toggle="tab"><span class="spanfa sprite fatrans"></span>Transfers</a></li>
                </ul>
                <?php } ?>
                <div class="tab-content">
                  <div class="tab-pane <?php if(isset($product) && $product == 'Flight') echo 'active'; if(!isset($product)) echo 'active';  ?>" id="flight_search">
					 <form  autocomplete="off" action="<?php echo WEB_URL ?>flight/search" name="flight" id="flight" >
                    <div class="intabs">
                      <div class="waywy">
                      	<div class="smalway">
							<input type="hidden" class="triprad iradio_flat-blue" id="trip_type" name="trip_type" value="circle"/>
                        	 <a class="wament <?php if(isset($triptype) && $triptype == 'O') echo 'active'; ?>" id="oneway">One Way</a>
                             <a class="wament <?php if(isset($triptype) && $triptype == 'R') echo 'active'; else echo 'active'; ?>" id="circle">Round Trip</a>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="outsideserach">
                          <div class="col-lg-6 col-md-6 col-sm-6  marginbotom10"> <span class="formlabel">From</span>
                            <div class="relativemask"> <span class="maskimg mfrom"></span>                             
                              <input type="text" required class="ft fromflight" id="from" name="from" placeholder="From, Airport Name or Airport City" value="<?php if(isset($origin)) echo $origin; ?>" />
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6  marginbotom10"> <span class="formlabel">To</span>
                            <div class="relativemask"> <span class="maskimg mto"></span>
                              <input type="text" required class="ft departflight" name="to"  id="to"  placeholder="To, Airport Name or Airport City" value="<?php if(isset($destination)) echo $destination; ?>" />
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-6 marginbotom10 nopad">
                            <div class="col-xs-6 fiveh"> <span class="formlabel">Departure</span>
                              <div class="relativemask"> <span class="maskimg caln"></span>
                                 <input  name="depature" id="depature" required type="text" class="forminput" value="<?php if(isset($depart_date)) echo $depart_date; ?>" placeholder="Depature Date" />
                              </div>
                            </div>
                            <div class="col-xs-6 fiveh"> <span class="formlabel">Return</span>
                              <div class="relativemask"> <span class="maskimg caln"></span>
                                <input type="text" name="return" id="return" required class="forminput" value="<?php if(isset($return_date)) echo $return_date; ?>" placeholder="Return Date" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 nopad">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fiveh"> <span class="formlabel">Adult</span>
                              <div class="selectedwrapnum">
                                <div class="onlynumwrap">
                                  <div class="onlynum">
                                        <button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="adult"> <span class="fa fa-minus"></span> </button>
                                        <input type="text" name="adult" id="adult" class="form-control input-number centertext" value="<?php if(isset($ADT)) echo $ADT; else echo '1'; ?>" data-min="1" data-max="9">
                                      
                                        <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="adult"> <span class="fa fa-plus"></span> </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fiveh"> <span class="formlabel">Child<strong>(2-11 yrs)</strong></span>
                              <div class="selectedwrapnum">
                                <div class="onlynumwrap">
                                  <div class="onlynum" id="childs">
                                        <button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="child"> <span class="fa fa-minus"></span> </button>
                                        <input type="text" name="child" id="child" class="form-control input-number centertext" value="<?php if(isset($CHD)) echo $CHD; else echo '0'; ?>" data-min="0" data-max="8">
                                      
                                        <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="child"> <span class="fa fa-plus"></span> </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 fiveh"> <span class="formlabel">Infant<strong>(0-2 yrs)</strong></span>
                              <div class="selectedwrapnum">
                                <div class="onlynumwrap">
                                   <div class="onlynum">
                                        <button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="infant"> <span class="fa fa-minus"></span> </button>
                                        <input type="text" id="infant" name="infant" class="form-control input-number centertext" value="<?php if(isset($INF)) echo $INF; else echo '0'; ?>" data-min="0" data-max="9">
                                      
                                        <button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="infant"> <span class="fa fa-plus"></span> </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-xs-6 nopad">
                               <div class="col-xs-6 fiveh"> <span class="formlabel">Class</span>
                                  <div class="selectedwrap">
                                    <select class="mySelectBoxClass flyinputsnor" id="class" name="class" required>
										<option value="All" <?php if(isset($class) && $class == 'All') echo 'Selected'; ?>>All</option>
                                        <option value="0" <?php if(isset($class) && $class == '0') echo 'Selected'; ?>>Economy With Restrictions</option>
										<option value="1" <?php if(isset($class) && $class == '1') echo 'Selected'; ?>>Economy Without Restrictions</option>
										<option value="2" <?php if(isset($class) && $class == '2') echo 'Selected'; ?>>Economy Premium</option>
										<option value="3" <?php if(isset($class) && $class == '3') echo 'Selected'; ?>>Business</option>
										<option value="4" <?php if(isset($class) && $class == '4') echo 'Selected'; ?>>First</option>
                                    </select>
                                  </div>
                                </div>
                               <!-- <div class="col-xs-6 fiveh"> <span class="formlabel">Prefered Airline</span>
                                  <div class="selectedwrap">
                                    <select class="mySelectBoxClass flyinputsnor">
                                      <option>Economy</option>
                                      <option selected>Standard</option>
                                    </select>
                                  </div>
                                </div> -->
                           </div>
                          
                          <div class="col-xs-6">
                            <div class="formsubmit">
                              <button class="srchbutn comncolor">Search Flights <span class="srcharow"></span></button>
                            </div>
                          </div>
                      </div>
                    </div>
					</form>
                  </div>
                  <div class="tab-pane <?php if(isset($product) && $product == 'Hotel') echo 'active';  ?>" id="hotel">
                      <form autocomplete="off" action="<?php echo WEB_URL; ?>hotel/search" name="hotelSearchForm" id="hotelSearchForm">
                       <div class="intabs">
                       		<div class="outsideserach">
                            	<div class="col-lg-6 col-md-6 col-sm-6  marginbotom10"> <span class="formlabel">Going to</span>
                                    <div class="relativemask"> <span class="maskimg hfrom"></span> 
                                      <input type="text" placeholder="Region, City, Area (Worldwide)" class="ft hotelCityIp">
                                    </div>
                                </div>
                                <div class="col-md-6 marginbotom10 nopad">
                                    <div class="col-xs-6 fiveh"> <span class="formlabel">Check-in</span>
                                      <div class="relativemask"> <span class="maskimg caln"></span>
                                         <input type="text" id="check-in" name="hotel_checkin" class="forminput" placeholder="Check-in" />
                                      </div>
                                    </div>
                                    <div class="col-xs-6 fiveh"> <span class="formlabel">Check-out</span>
                                      <div class="relativemask"> <span class="maskimg caln"></span>
                                        <input type="text" id="check-out" name="hotel_checkout" class="forminput" placeholder="Check-out" />
                                      </div>
                                    </div>
                                </div>
                                <div id="room1" class="roomss">
									<div class="col-md-6 marginbotom10 nopad">
										<div class="col-xs-6 fiveh"> <span class="formlabel">Room(s)</span>
											<div class="selectedwrap">
												<select class="mySelectBoxClass flyinputsnor" id="noofrooms" name="rooms">
													<option value="1">1</option>
													<option value="2">2</option>
												</select>
											</div>
										</div>
										<div class="col-xs-6 fiveh">
											<span class="formlabel">&nbsp;</span>
											<div class="roomnum">
												<span class="numroom">Room 1</span>
											</div>
										</div>
									</div>
									<div class="col-md-6 marginbotom10 nopad">
										<div class="col-xs-6 fiveh"> <span class="formlabel">Adult</span>
											<div class="selectedwrapnum">
												<div class="onlynumwrap">
													<span class="maskimg hadult"></span> 
													<div class="onlynum newhpad">
														<button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="adult_0"> <span class="fa fa-minus"></span> </button>
														<input type="text" name="adult[]" id="adult_0" class="form-control input-number centertext" value="1" data-min="1" data-max="4">
														<button type="button" class="btn btn-default btn-number btnpot btn_right" data-type="plus" data-field="adult_0"> <span class="fa fa-plus"></span> </button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-6 fiveh"> <span class="formlabel">Child<strong>(2-11 yrs)</strong></span>
											<div class="selectedwrapnum">
												<div class="onlynumwrap">
													<span class="maskimg hchild"></span> 
													<div class="onlynum newhpad">
														<button type="button" class="btn btn-default btn-number btnpot agecount chdrm1" disabled="disabled" data-type="minus" data-field="child_0"> <span class="fa fa-minus"></span> </button>
														<input type="text" name="child[]" id="child_0" class="form-control input-number centertext" value="0" data-min="0" data-max="2">
														<button type="button" class="btn btn-default btn-number btnpot btn_right agecount chdrm1" data-type="plus" data-field="child_0"> <span class="fa fa-plus"></span> </button>
													</div>
													<div class="roomcount child_0_age">
														<div class="inallsn">
															<div id="child_0_agesdata">
																<div class="col-xs-12 fiveh" id="child_0_ages"> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                                </div>
                                <div id="rooms">
									
								</div>
								<div class="col-xs-6 nopad">
                               <div class="col-xs-12 fiveh"> <span class="formlabel">Residency</span>
                                  <div class="selectedwrap">
                                   <select class="mySelectBoxClass flyinputsnor" id="nationality" name="nationality" required>
											<option value="">Select Residency</option>
											<?php foreach($nationality_countries as $nck){ ?>
													<option value="<?php echo $nck->country_code; ?>"><?php echo $nck->country_name; ?>
                                                    </option>
											<?php } ?>
										</select> 
                                  </div>
                                </div>
                           </div>
                          
                          <div class="col-xs-6">
                            <div class="formsubmit">
                              <button class="srchbutn comncolor">Search Hotels <span class="srcharow"></span></button>
                            </div>
                          </div>
                            </div>
                       </div>
						</form>
                  </div>
                  <div class="tab-pane" id="package"><span class="cmsoom">Coming Soon</span></div>
                  <div class="tab-pane" id="activity"><span class="cmsoom">Coming Soon</span></div>
                  <div class="tab-pane" id="rail"><span class="cmsoom">Coming Soon</span></div>
                  <div class="tab-pane" id="cruise"><span class="cmsoom">Coming Soon</span></div>
                  <div class="tab-pane" id="car"><span class="cmsoom">Coming Soon</span></div>
                  <div class="tab-pane" id="transfer"><span class="cmsoom">Coming Soon</span></div>
                </div>
              </div>
            </div>
          </div>
      
            


<script type="text/javascript">
$(document).ready(function(){
	
	$(document).on('click', '.agecount', function(e){
    //$(".agecount").click(function(){
		var value=$(this).attr('data-type');
		var field=$(this).attr('data-field');
		var childs = $('#'+field).val();
		if(value == 'plus'){
			childs = parseInt(parseInt(childs)+1);
		} else {
			childs = parseInt(parseInt(childs)-1);
		}
		if(childs > 0){
			$('#'+field+'_ages').empty();
			$("."+field+"_age").show();
			for(var i=0; i<childs; i++){
				var cid = parseInt(parseInt(i)+1);
				var childsdata = '<span class="formlabel">Child age '+cid+'</span><div class="selectedwrapnum"><div class="onlynumwrap"><div class="onlynum"><button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="'+field+'_age'+cid+'"> <span class="fa fa-minus"></span> </button><input type="text" name="child_age'+cid+'_room1" id="'+field+'_age'+cid+'" class="form-control input-number centertext" value="0" data-min="0" data-max="12"><button type="button" class="btn btn-default btn-number btnpot" data-type="plus" data-field="'+field+'_age'+cid+'"> <span class="fa fa-plus"></span> </button></div></div></div>';
				$('#'+field+'_ages').append(childsdata);
			}
		} else {
			$('#'+field+'_ages').empty();
			$("."+field+"_age").hide();
		}
    });
	
	
	
	
	
	$('.flyinputsnor').change(function(){
		if($(this).val() == 2){
		roomLength = $( "div.roomss" ).length;
		var co = roomLength+1;
		//if(co <= 3){}else{return false;}
		var room = '<div id="room'+co+'" class="roomss">'+
									'<div class="col-md-6 marginbotom10 nopad">'+
										'<div class="col-xs-6 fiveh"> </div>'+
										'<div class="col-xs-6 fiveh">'+
											'<span class="formlabel">&nbsp;</span>'+
											'<div class="roomnum">'+
												'<span class="numroom">Room '+co+'</span>'+
											'</div>'+
										'</div>'+
									'</div>'+
									'<div class="col-md-6 marginbotom10 nopad">'+
										'<div class="col-xs-6 fiveh"> <span class="formlabel">Adult</span>'+
											'<div class="selectedwrapnum">'+
												'<div class="onlynumwrap">'+
													'<span class="maskimg hadult"></span> '+
													'<div class="onlynum newhpad">'+
														'<button type="button" class="btn btn-default btn-number btnpot" disabled="disabled" data-type="minus" data-field="adult_'+roomLength+'"> <span class="fa fa-minus"></span> </button>'+
														'<input type="text" name="adult[]" id="adult_'+roomLength+'" class="form-control input-number centertext" value="1" data-min="1" data-max="4">'+
														'<button type="button" class="btn btn-default btn-number btnpot" data-type="plus" data-field="adult_'+roomLength+'"> <span class="fa fa-plus"></span> </button>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>'+
										'<div class="col-xs-6 fiveh"> <span class="formlabel">Child<strong>(2-11 yrs)</strong></span>'+
											'<div class="selectedwrapnum">'+
												'<div class="onlynumwrap">'+
													'<span class="maskimg hchild"></span> '+
													'<div class="onlynum newhpad">'+
														'<button type="button" class="btn btn-default btn-number btnpot agecount chdrm1" disabled="disabled" data-type="minus" data-field="child_'+roomLength+'"> <span class="fa fa-minus"></span> </button>'+
														'<input type="text" name="child[]" id="child_'+roomLength+'" class="form-control input-number centertext" value="0" data-min="0" data-max="2">'+
														'<button type="button" class="btn btn-default btn-number btnpot agecount chdrm1" data-type="plus" data-field="child_'+roomLength+'"> <span class="fa fa-plus"></span> </button>'+
													'</div>'+
													'<div class="roomcount child_'+roomLength+'_age">'+
														'<div class="inallsn">'+
															'<div id="child_'+roomLength+'_agesdata">'+
																'<div class="col-xs-12 fiveh" id="child_'+roomLength+'_ages"> </div>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
                                '</div>';
			
			if(co <= 2){ 
			  $('#rooms').append(room);
			}
		} else {
			$('#rooms').empty();
		}
	}); 
$(document).on('click', '.btn-number', function(e){
//$('.btn-number').on('click', function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[id='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('data-min')) {
               if(fieldName == 'adult' || fieldName == 'child'){
                    //flight
                    var max = 9;
                    var chd = parseInt($('#child').val()); 
                    var adt = parseInt($('#adult').val());
                    var inf = parseInt($('#infant').val());
                    var persons = adt + chd;
                    
                    if(persons < max){
                        input.val(currentVal - 1).change();
                    }

                    if(fieldName == 'adult'){
                        //console.log(inf +'>='+ adt);
                        if(inf >= adt){
                            $('#infant').val(adt-1).change();
                        } 
                    }
                                        
                }if(fieldName == 'infant'){
                    var adt = parseInt($('#adult').val());
                    var inf = parseInt($('#infant').val());
                    if(inf <= adt){
                        input.val(currentVal - 1).change();
                    }                    
                }else{
                    input.val(currentVal - 1).change();
                }
            } 
            if(parseInt(input.val()) == input.attr('data-min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('data-max')) {
                if(fieldName == 'adult' || fieldName == 'child'){
                    //flight
                    var max = 9;
                    var chd = parseInt($('#child').val());
                    var adt = parseInt($('#adult').val());
                    var persons = adt + chd;
                    if(persons < max){
                        //console.log(persons +'<'+ max);
                        input.val(currentVal + 1).change();
                    }                    
                }else if(fieldName == 'infant'){
                    var adt = parseInt($('#adult').val());
                    var inf = parseInt($('#infant').val());
                    if(inf < adt){
                        input.val(currentVal + 1).change();
                    }
                }else{
                    input.val(currentVal + 1).change();
                } 
            }
            if(parseInt(input.val()) == input.attr('data-max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('data-min'));
    maxValue =  parseInt($(this).attr('data-max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('id');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});



	$('#flight').validate({ // initialize plugin within DOM ready
    // other options,
	    rules: {
	        'from[]': {
	            required: true
	        }
	    },
	});
	

	
	$('.wament').click(function(event){
		$('.wament').removeClass('active');
		$(this).addClass('active');

		$("#trip_type").val($(this).attr('id'));
		if ($(this).attr('id') == 'oneway'){
			$('#return').prop('disabled',true);
			$('#return').prop('required',false);
			$('#returnDiv').addClass('ifonway');
		}
		if ($(this).attr('id') == 'circle'){			
			$('#return').prop('disabled',false);
			$('#return').prop('required',true);
			$('#returnDiv').removeClass('ifonway');
		}
		
	});
	
	
	
		$(function() {
  $(".fromflight").autocomplete({
    source: "<?php echo WEB_URL;?>flight/get_flight_suggestions",
    minLength: 2,//search after two characters
    autoFocus: true, // first item will automatically be focused
    select: function(event,ui){
        $(".departflight").focus();
        //$(".flighttoo").focus();
    }
    
  });
 
  $(".departflight").autocomplete({
    source: "<?php echo WEB_URL;?>flight/get_flight_suggestions",
    minLength: 2,//search after two characters
    autoFocus: true, // first item will automatically be focused
    select: function(event,ui){
        $("#depature").focus();
    }
  });

 $("#swap").on('click', function() {
	  var from = $('#from').val();
  var destination = $('#to').val();
  $('#from').val(destination);
  $('#to').val(from);
	  }); 

jQuery( "#depature" ).datepicker({
	minDate: 0,
	dateFormat: 'dd-mm-yy',
	maxDate: "+1y",
	numberOfMonths: 2,
	onChange : function(){
	},
	onClose: function( selectedDate ) {
		$( "#return" ).datepicker( "option", "minDate", selectedDate );
		var type = $("#trip_type").val();
		console.log(type);
		$( '#return' ).focus();
	}
});
jQuery( "#return" ).datepicker({
	minDate: 0,
	dateFormat: 'dd-mm-yy',
	maxDate: "+1y",
	numberOfMonths: 2,
	onClose: function( selectedDate ) {
		$( "#depature" ).datepicker( "option", "maxDate", selectedDate );
	}
}); 

  
 
});
        /*Start Home page Flight search*/
$(function() {
    $( "#dept_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: false,
	  dateFormat : 'dd-mm-yy',
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#return_date" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#return_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: false,
	  	  dateFormat : 'dd-mm-yy',
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#dept_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });

    change_infant_option($('#ADT').val());
    change_child_option($('#ADT').val());

     $('#ADT').on('change', function() {
           
           $(".childs_ADT").find("option[val='0']").attr("selected", true);
           var self = $('.childs_ADT');
           self.val(self.find('option[selected]').val());
        change_infant_option($(this).val());
        change_child_option($(this).val());
      });


//hotel search related
 $(function() {
	$(".hotelCityIp").autocomplete({
      source: "<?php echo WEB_URL;?>home/get_hotel_cities",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
           $("#check-in").focus();
      },
      change: function (event, ui) {
        if(!ui.item){
          $(".hotelCityIp").val("");
        }
      }
    });
    });
jQuery( "#check-in" ).datepicker({
	minDate: 0,
	dateFormat: 'dd-mm-yy',
	maxDate: "+1y",
	numberOfMonths: 2,
	onChange : function(){
	},
	onClose: function( selectedDate ) {
		$( "#check-out" ).datepicker( "option", "minDate", selectedDate );
		//var type = $("#trip_type").val();
		//console.log(type);
		$( '#check-out' ).focus();
	}
});
jQuery( "#check-out" ).datepicker({
	minDate: 0,
	dateFormat: 'dd-mm-yy',
	maxDate: "+1y",
	numberOfMonths: 2,
	onClose: function( selectedDate ) {
		$( "#check-in" ).datepicker( "option", "maxDate", selectedDate );
	}
}); 

    function change_child_option(adt_count)
     {
        var length =   9 - adt_count ; 
        $("#CHD").empty();
        for ( var i = 0; i <= length; i++) 
        {
            $("#CHD").append("<option value='" +i+ "'>" +i+ "</option>");
        }
     }
     function change_infant_option(adt_count)
     {
        $("#INF").empty();
        for ( var i = 0; i <= adt_count; i++) 
        {
            $("#INF").append("<option value='" +i+ "'>" +i+ "</option>");
        }
     }

      is_it_roundTrip($('input[name=type]:checked').val());
       $(".type").click(function(){

         is_it_roundTrip($(this).val());

       });

    function is_it_roundTrip(type)
    {
        if(type == 'R')
        {
            $("#return_date").attr('required',true);
        }
        else
        {
             $("#return_date").attr('required',false);   
        }
    }
});


</script>
