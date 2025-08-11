<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Form</title>
    <style>
        /* Existing CSS */
        .form-container {
            margin: 0px auto;
            padding: 30px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .trip-type-container, .destination-container, .depart-date-container, .pax-container, .age-container,.return-date-container,.duration-container {
            margin-bottom: 10px;
            position: relative;
        }

        .trip-type-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .customRadioInsurance {
            display: flex;
            align-items: center;
            gap: 5px;
            position: relative;
            cursor: pointer;
            font-size: 14px;
        }

        .customRadioInsurance input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .customRadioInsurance-box {
            position: absolute;
            left: 0;
            height: 16px;
            width: 16px;
            background-color: #eee;
            border: 2px solid #fdb813;
            border-radius: 3px;
            display: none;
        }

        .customRadioInsurance_bg {
            padding: 5px 15px;
            border-radius: 3px;
            border: 1px solid #ccc;
            transition: 0.1s all linear;
        }

        .customRadioInsurance input:checked ~ .customRadioInsurance_bg {
            background-color: #fdb813;
        }

        .formLabelInsurance {
            font-weight: 400;
            margin-bottom: 5px;
            display: block;
            color: #333;
            position: absolute;
            top: 3px;
            left: 10px;
            color: #fdb813;
        }

        .formInputInsurance, .formSelectInsurance {
            width: 100%;
            padding: 21px 10px 0px 10px;
            border: 1px solid #fdb813;
            border-radius: 4px;
            font-size: 14px;
            height: 48px;
            outline: none;
        }

        .formButtonInsurance {
            padding: 12px 20px;
            background-color: #193960;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: flex-end;
        }

        .formButtonInsurance:hover {
            background-color: #193960;
        }

        .age-restriction-note {
            font-size: 12px;
            color: #666;
        }

        .insuranceDtlsInput {
            display: flex;
            flex-wrap: wrap;
        }

        .destination-container {
            width: 43%;
            margin-right: 5px;
        }

        .depart-date-container {
            width: 30%;
            margin-right: 5px;
        }

        .pax-container {
            width: 21%;
            margin-right: 5px;
        }

        .age-container {
            width: 100%;
        }

        .ageDetailsPax {
            width: 17%;
            margin-right: 5px;
        }

        .ageDetailsPax h5 {
            text-align: left;
            color: #333;
            margin-bottom: 5px;
        }

        .additional-fields {
            display: none;
            margin-right: 5px;
        }
        .durationsInsurance h5{
            text-align: left;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container page_insurance" id="insuranceFormContainer">
        <form autocomplete="off" action="<?php echo WEB_URL ?>insurance/search" name="flight" id="flight">
            <input type="hidden" value="1" name="page">

            <div class="trip-type-container">
                <label class="customRadioInsurance">
                    <input type="radio" name="trip_type" value="single" id="singleTrip" checked>
                    <span class="customRadioInsurance-box"></span>
                    <span class="customRadioInsurance_bg">Single Trip</span>
                </label>
                <label class="customRadioInsurance">
                    <input type="radio" name="trip_type" value="annual-multi" id="annualMultiTrip">
                    <span class="customRadioInsurance-box"></span>
                    <span class="customRadioInsurance_bg">Annual Multi Trip</span>
                </label>
            </div>

            <div class="insuranceDtlsInput">
                <div class="destination-container">
                    <label for="destinationInsurance" class="formLabelInsurance">Destination:</label>
                    <select type="text" id="destinationInsurance" class="formInputInsurance"  name="destinations" list="destinations" placeholder="Type or Select from list" required="">
                </select>
                </div>

                <div class="depart-date-container">
                    <label for="depart-date" class="formLabelInsurance">Depart Date:</label>
                    <input type="text" id="depart_date" class="formInputInsurance " name="depart_date" placeholder="Select Date" required>
                </div>
                    <div class="return-date-container additional-fields" id="return-datee">
                        <label for="return-date" class="formLabelInsurance">Return Date:</label>
                        <input type="text" id="return_date"  name="return_date"  class="formInputInsurance" placeholder="Select Date" required>
                    </div>
                    <div class="durationsInsurance additional-fields">
                        <h5>Durations</h5>
                        <div class="duration-container ">
                            <label for="duration" class="formLabelInsurance">Duration:</label>
                            <input type="text" id="duration" name="duration" class="formInputInsurance" placeholder="Enter Duration">
                        </div>
                    </div>
         
                    <div class="pax-container">
                        <label for="no-of-pax" class="formLabelInsurance">No of Pax:</label>
                        <select  id="no-of-pax" class="formSelectInsurance"name="pax">   
                             <option value="1">1</option>
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="4">4</option>
                             <option value="5">5</option>
                             <option value="6">6</option>
                        </select>
                    </div>

                    <div class="ageDetailsPax" id="age-details-container">
                        <h5>Age Details</h5>
                        <div class="age-container" >
                            <label for="age" class="formLabelInsurance">Age:</label>
                            <input type="number" min="1" max="70"   step="1" id="duration" name="age[]" class="formInputInsurance" placeholder="Enter Age" pattern="^[0-9]*$"  required>
                        
                            <p class="age-restriction-note">Minimum age: 1 year / Maximum age: 70 years</p>
                        </div>
                    </div>
            </div>

            <button type="submit" class="formButtonInsurance">Search</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            const singleTripRadio = $('#singleTrip');
            const annualMultiTripRadio = $('#annualMultiTrip');
            const additionalFields = $('.additional-fields');
            const paxField = $('.pax-container');
            const destinationInput = $("#destinationInsurance");
        
            function toggleAdditionalFields() {
                if (singleTripRadio.is(':checked')) {
                    additionalFields.show();
                    destinationInput.val("").trigger('change');
                    paxField.css('margin-top', '21px');
                    updateDatalist(['Domestic', 'US/Canada', 'Non US']);
                } else {
                    additionalFields.hide();
                    paxField.css('margin-top', '0px');
                    destinationInput.val("").trigger('change');
                    updateDatalist(['Worldwide']);
                }
        
                $('.formSelectInsurance').val("1").trigger('change');
            }
            function updateDatalist(options) {
                destinationInput.empty(); // Clear current options
                options.forEach(option => {
                    destinationInput.append(`<option value="${option}">${option}</option>`);
                });
            }
        
            toggleAdditionalFields();
        
            singleTripRadio.on('change', toggleAdditionalFields);
            annualMultiTripRadio.on('change', toggleAdditionalFields);
        });
    </script>
 
    <script type="text/javascript">
    $('#depart_date').datepicker({
                               // defaultDate: "+1w",d-m-
                                changeMonth: true,
                                changeYear:true,
                                dateFormat : 'yy-m-d',
                                // dateFormat : 'dd-m-yy',
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

     $('#return_date').datepicker({
                               // defaultDate: "+1w",d-m-
                                changeMonth: true,
                                changeYear:true,
                                dateFormat : 'yy-m-d',
                                // dateFormat : 'dd-m-yy',
                                numberOfMonths: 1,
                                minDate:0,
                                onSelect:function()
                                {
                                  var id_v = $(this).data('id');
                                  $("#to_m_"+ (id_v+1)).focus(); 
                                  var to_m =$('#to_m_1').val();
                                  $("#from_m_2").val(to_m);
                                  var t = $("#depart_date").val()
                                  var t1 = $("#return_date").val()

                                  // alert(t);
                                  // alert(t1);
                                  // alert('iiiiii');
                                  date1 = new Date(t);
                                  date1_ = date1.getFullYear() + '-' + date1.getDate() + '-' +  date1.getMonth();
                                  // alert(date1_);
                                  date2 = new Date(t1);

                                  // alert(date2);
                                  date2_ = date2.getFullYear() + '-' + date2.getDate() + '-' +  date2.getMonth();
                                  // alert(date2_);
                                  var d1=new Date(t); 
                                  var d2=new Date($('#return_date').val()); 
                                  // var d2=new Date(date2_); 
                                  $('#duration').val((Math.abs((d2-d1)/86400000))); 

                                }


                          }); 
$('#return-datee').click(function(){
    // var t = $("#depart-date").val()
    // alert(t);
});



// $('#return-date').click(function(){
    // console.log('test');
    // alert('tewhdshfdshkjf');
           // var fromdate=$('#depart-date').value;
           // var t = $("#depart-date").val()
           // alert(fromdate);
// });
//       $('#return-date').on('click',function(){

// alert('test');
//         var fromdate=$('$depart-date').value;
//         alert(fromdate);

//       });


//     $(document).ready(function(){

//          // var t = $("#depart-date").val()

//          // alert(t);
//    var $datepicker1 =  $( "#depart-date" );
//    // alert(datepicker1);
//    var $datepicker2 =  $( "#return-date" );
//    $datepicker1.datepicker();
//    $datepicker2.datepicker({
//        onClose: function() {
//            var fromDate = $datepicker1.datepicker('getDate');
//            var toDate = $datepicker2.datepicker('getDate');
//            // date difference in millisec
//            var diff = new Date(toDate - fromDate);
//            // date difference in days
//            var days = diff/1000/60/60/24;

//            alert(days);
//        }
//    });
// });



    
</script>

<script>
$(document).ready(function () {
    $('#no-of-pax').on('change', function () {
        var numOfPax = $(this).val(); 
        var maxPax = 6;
        numOfPax = parseInt(numOfPax);
        var currentAgeFields = $('.ageDetailsPax').length;

        if (numOfPax > currentAgeFields) {
            for (var i = currentAgeFields + 1; i <= numOfPax; i++) {
                var ageInputHtml = `
                  <div class="ageDetailsPax">
                        <h5>Age Details</h5>
                        <div class="age-container">
                            <label for="age" class="formLabelInsurance">Age :</label>
                            <input type="number" min="1" max="70" step="1" id="age-${i}" name="age[]" 
                                class="formInputInsurance" placeholder="Enter Age" pattern="^[0-9]*$" />
                            <p class="age-restriction-note">Minimum age: 1 year / Maximum age: 70 years</p>
                        </div>
                  </div>  
                `;
                $('.insuranceDtlsInput').append(ageInputHtml); 
            }
        } 
        else if (numOfPax < currentAgeFields) {
            $('.ageDetailsPax').slice(numOfPax).remove();
        }
    });
   
});

</script>
</body>
</html>
