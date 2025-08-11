
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Modal Example</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body{
            background: #f6f6f6;
        }
        .InsuranceResult{
            padding: 30px;
        }
        .resultBoxwidth{
            width: 80%;
            margin: 0 auto;
        }
        .package-item {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .package-item:hover{
            box-shadow: 0px 1px 8px 3px rgba(0,0,0,0.3)
            }
        .package-details {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .package_flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            gap: 20px;
        }
        section.modifySearchInsurance {
            margin-top: 90px;
        }
        .package-price {
            font-size: 22px;
            font-weight: 700;
            color: #193960;
        }

        .package-button button {
            padding: 10px 20px;
            background-color: #fdb813;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }

        .package-button button:hover {
            background-color: #e09e00;
            transform: scale(1.05);
        }

        .info-button {
            border: none;
            background-color: #f6f6f6;
            color: #193960;
            border-radius: 20px;
            padding: 5px 15px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }

        .info-button span {
            padding: 0px 7px;
            border: 1px solid #193960;
            border-radius: 100%;
            font-size: 12px;
            margin-right: 5px;
            color: #193960;
        }

            .info-button1 {
            border: none;
            background-color: #f6f6f6;
            color: #193960;
            border-radius: 20px;
            padding: 5px 15px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }

        .info-button1 span {
            padding: 0px 7px;
            border: 1px solid #193960;
            border-radius: 100%;
            font-size: 12px;
            margin-right: 5px;
            color: #193960;
        }
        @media (max-width: 600px) {
            .package_flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .package-price {
                margin-bottom: 10px;
            }
        }


        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        .custom-table thead {
            background-color: #f2f2f2;
        }

        .custom-table th, .custom-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .custom-table th {
            background-color: ##efefef;
            color: #333;
            font-weight: bold;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .custom-table-rounded {
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-table-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .custom-table-responsive, .custom-table-responsive thead, .custom-table-responsive tbody, .custom-table-responsive th, .custom-table-responsive td, .custom-table-responsive tr {
                display: block;
            }

            .custom-table-responsive thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .custom-table-responsive tbody tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
            }

            .custom-table-responsive td {
                border: none;
                position: relative;
                padding-left: 50%;
                white-space: nowrap;
            }

            .custom-table-responsive td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                white-space: nowrap;
            }
        }
        .closeBtnInsurance{
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .insurance-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        .insurance-table thead {
            background-color: #efefef;
            color: #333;
        }

        .insurance-table th, .insurance-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .insurance-table th {
            font-weight: bold;
        }

        .insurance-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .insurance-table tbody tr:hover {
            background-color: #e1e1e1;
        }

        .insurance-table-rounded {
            border-radius: 8px;
            overflow: hidden;
        }

        .insurance-table-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .insurance-table, .insurance-table thead, .insurance-table tbody, .insurance-table th, .insurance-table td, .insurance-table tr {
                display: block;
            }

            .insurance-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .insurance-table tbody tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
            }

            .insurance-table td {
                border: none;
                position: relative;
                padding-left: 50%;
                white-space: nowrap;
            }

            .insurance-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                white-space: nowrap;
            }
        }
        .modalDialogBox{
            max-width:40%;
        }



        /* ----------------------modify search css start ------------------ */
.search-bar {
  display: flex;
  gap: 10px;
  padding: 20px;
  justify-content: space-around;
  background: #ededed;
}

.search-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.icon {
  font-size: 24px; /* Adjust icon size */
}

.search-info {
  font-weight: bold;
  margin-right: 10px;
  margin-bottom: 0;
}

.search-value {
  margin: 0;
  font-size: 18px;
}

.search-button {
  margin-top: 20px;
}

.search-button button {
  padding: 10px 20px;
  background-color: #fdb813; /* Primary color */
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.search-button button:hover {
  background-color: #fdb813; /* Darker shade for hover */
}


/* -----------------------drop down css start ------------------------ */
.form-containerInsurancePage {
    margin: 0px auto;
    padding: 30px 100px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.trip-type-containerInsurancePage, .destination-containerInsurancePage, .depart-date-containerInsurancePage, .pax-containerInsurancePage, .age-containerInsurancePage, .return-date-containerInsurancePage, .duration-containerInsurancePage {
    margin-bottom: 10px;
    position: relative;
}

.trip-type-containerInsurancePage {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    align-items: center;
}

.customRadioInsurancePage {
    display: flex;
    align-items: center;
    gap: 5px;
    position: relative;
    cursor: pointer;
    font-size: 14px;
}

.customRadioInsurancePage input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.customRadioInsurance-boxPage {
    position: absolute;
    left: 0;
    height: 16px;
    width: 16px;
    background-color: #eee;
    border: 2px solid #fdb813;
    border-radius: 3px;
    display: none;
}

.customRadioInsurance_bgPage {
    padding: 5px 15px;
    border-radius: 3px;
    border: 1px solid #ccc;
    transition: 0.1s all linear;
    font-weight: 500;
}

.customRadioInsurancePage input:checked ~ .customRadioInsurance_bgPage {
    background-color: #fdb813;
}

.formLabelInsurancePage {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
    color: #333;
    position: absolute;
    top: 3px;
    left: 10px;
    color: #fdb813;
    font-size: 14px;
}

.formInputInsurancePage, .formSelectInsurancePage {
    width: 100%;
    padding: 17px 10px 0px 10px;
    border: 3px solid #fdb813;
    border-radius: 4px;
    font-size: 14px;
    height: 48px;
    outline: none;
}
.formSelectInsurancePage{
    -webkit-appearance: listbox !important;
}
.formButtonInsurancePage {
    padding: 12px 20px;
    background-color: #193960;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    align-self: flex-end;
    margin-top: 40px;
}

.formButtonInsurancePage:hover {
    background-color: #193960;
}

.age-restriction-noteInsurancePage {
    font-size: 12px;
    color: #666;
    position: absolute;
}

.insuranceDtlsInputPage {
    display: flex;
    flex-wrap: wrap;
}

.destination-containerInsurancePage {
    width: 43%;
    margin-right: 5px;
}

.depart-date-containerInsurancePage {
    width: 30%;
    margin-right: 5px;
}

.pax-containerInsurancePage {
    width: 21%;
    margin-right: 5px;
}

.age-containerInsurancePage {
    width: 12%;
}

.ageDetailsPaxInsurancePage {
    width: 100%;
}

.ageDetailsPaxInsurancePage h5 {
    text-align: left;
    color: #333;
    margin-bottom: 5px;
}

.additional-fields {
    display: none;
    margin-right: 5px;
}

.durationsInsurancePage h5 {
    text-align: left;
    margin-bottom: 5px; 
    font-size: 15px;
}
.ageDetailsPaxInsurancePage h5{
    font-size: 15px;
}
/* Dropdown styles */
.dropdownContainerInsurancePage {
    position: relative;
    display: inline-block;
    width: 100%;
}

.dropdownContentInsurancePage {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 300px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1;
    width: 100%;
}

.dropdownContentInsurancePage.show {
    display: block;
}

.age-restriction-note_resultpage {
    font-size: 12px;
    color: #666;
    line-height: 13px;
}
.package_info{
    padding: 10px;
}
.age-containerInsurancePage h5{
    margin-bottom: 6px;
}
.age-containerInsurancePage.col-md-2 {
    margin-right: 5px;
}
    </style>

</head>
<body>
  <section class="modifySearchInsurance">
            <div class="search-bar">
                <div class="search-item">
                    <span class="icon"><i class="fa fa-map-marker"></i></span>
                    <div class="search-details">
                    <p class="search-info">Destination:</p>
                    <h5 class="search-value"><?php echo $destinations ?></h5>
                    </div>
                </div>
                <div class="search-item">
                    <span class="icon"><i class="fa fa-calendar"></i></span>
                    <div class="search-details">
                    <p class="search-info">Depart:</p>
                    <h5 class="search-value"><?php echo $depart_date ?></h5>
                    </div>
                </div>
                <div class="search-item">
                    <span class="icon"><i class="fa fa-calendar"></i></span> <!-- Calendar icon for Return Date -->
                    <div class="search-details">
                        <p class="search-info">Return:</p>
                        <h5 class="search-value"><?php echo $return_date ?></h5>
                    </div>
                </div>
                <div class="search-item">
                    <span class="icon"><i class="fa fa-clock-o"></i></span> <!-- Clock icon for Duration -->
                    <div class="search-details">
                        <p class="search-info">Duration:</p>
                        <h5 class="search-value"><?php echo $duration ?> Days</h5>
                    </div>
                </div>
                <div class="search-item">
                    <span class="icon"><i class="fa fa-users"></i></span>
                    <div class="search-details">
                        <p class="search-info">No of Pax:</p>
                        <h5 class="search-value"><?php echo $pax ?></h5>
                    </div>
                </div>
                <div class="search-item">
                    <span class="icon"><i class="fa fa-user"></i></span>
                    <div class="search-details">
                    <p class="search-info">Age:</p>
                    <h5 class="search-value"><?php echo $age[0] ?></h5>    
                    </div>
                </div>
                <div class="search-button">
                    <button id="modifySearchBtn">Modify Search</button>
                </div>
            </div>

             <!-- Dropdown Content -->
             <div class="dropdownContainerInsurancePage">
                <div class="dropdownContentInsurancePage" id="dropdownContent">
                    <div class="form-containerInsurancePage" id="insuranceFormContainer">
                           <?php echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/insurance_search');?>
                 <!--        <form autocomplete="off" action="<?php echo WEB_URL ?>insurance/search" name="flight" id="flight">
                            <input type="hidden" value="1" name="page">

                            <div class="trip-type-containerInsurancePage">
                                <label class="customRadioInsurancePage">
                                    <input type="radio" name="trip-type" value="single" id="singleTrip" checked>
                                    <span class="customRadioInsurance-boxPage"></span>
                                    <span class="customRadioInsurance_bgPage">Single Trip</span>
                                </label>
                                <label class="customRadioInsurancePage">
                                    <input type="radio" name="trip-type" value="annual-multi" id="annualMultiTrip">
                                    <span class="customRadioInsurance-boxPage"></span>
                                    <span class="customRadioInsurance_bgPage">Annual Multi Trip</span>
                                </label>
                            </div>

                            <div class="insuranceDtlsInputPage row">
                                <div class="destination-containerInsurancePage col-md-4">
                                    <label for="destinationInsurance" class="formLabelInsurancePage">Destination:</label>
                                    <input type="text" id="destinationInsurance" class="formInputInsurancePage" list="destinations" placeholder="Type or Select from list">
                                    <datalist id="destinations"> 
                                        <option value="New York"></option>
                                        <option value="London"></option>
                                        <option value="Paris"></option>
                                    </datalist>
                                </div>

                                <div class="depart-date-containerInsurancePage col-md-2">
                                    <label for="depart-date" class="formLabelInsurancePage">Depart Date:</label>
                                    <input type="text" id="depart-date" class="formInputInsurancePage" placeholder="Select Date">
                                </div>

                                <div class="return-date-containerInsurancePage additional-fields col-md-2">
                                    <label for="return-date" class="formLabelInsurancePage">Return Date:</label>
                                    <input type="text" id="return-date" class="formInputInsurancePage" placeholder="Select Date">
                                </div>

                                <div class="durationsInsurancePage additional-fields col-md-2">
                                    <div class="duration-containerInsurancePage">
                                        <label for="duration" class="formLabelInsurancePage">Duration:</label>
                                        <input type="text" id="duration" class="formInputInsurancePage" placeholder="Enter Duration">
                                    </div>
                                </div>

                                <div class="pax-containerInsurancePage col-md-1">
                                    <label for="no-of-pax" class="formLabelInsurancePage">No of Pax:</label>
                                    <select id="no-of-pax" class="formSelectInsurancePage">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>

                                <div class="age-containerInsurancePage col-md-2">
                                    <div class="ageDetailsPaxInsurancePage">
                                        <label for="no-of-pax" class="formLabelInsurancePage">Age:</label>
                                        <input type="text" id="duration" class="formInputInsurancePage" placeholder="Enter Age">
                                        <p class="age-restriction-note_resultpage">Minimum age: 1 year / Maximum age: 70 years</p>
                                    </div>
                                </div>

                               
                            </div>
                            <button type="submit" class="formButtonInsurancePage">Search</button>
                        </form> -->
                    </div>
                </div>
            </div>

  </section>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  <?php //debug($response['Response']['TraceId']); die; ?>
  <section class="InsuranceResult">
        <div class="container">

            <?php foreach ($response['Response']['Results'] as $key => $value) { 

                // debug($value); die;
                ?>
                
          <div class="resultBoxwidth">
                <div class="row">
                    <div class="package-item">
                        <div class="package-details">
                           <?php echo $value['PlanName']; ?>
                        </div>
                        <div class="package_flex">
                            <div class="package-price">
                                <?php echo $value['PremiumList'][0]['Price']['Currency'] ?>  <?php echo $value['PremiumList'][0]['Price']['PublishedPriceRoundedOff']; ?> &nbsp;
                            </div>
                            <div class="package-button">
                                    <?php $d =array(); 
                                          $d['ResultIndex']=$value['ResultIndex'];
                                          $d['search_id']=$search_id;
                                          $d['TraceId']=$response['Response']['TraceId']; 
                                          $dataa = urlencode(serialize($d)); 
                                    ?>
                                <a href="<?php echo WEB_URL ?>insurance/addToCart/<?php echo $dataa; ?>">
                                <button >Book Now</button>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="package_info">
                        <button class="info-button" data-toggle="modal" data-target="#coverDetailsModal_<?php echo $key ?>"><span>i</span>Cover Details</button>
                        <button class="info-button1" data-toggle="modal" data-target="#priceBreakupModal_<?php echo $key ?>"><span>i</span>Price Breakup</button>
                    </div>
                </div>
          </div>

        
            <!-- Cover Details Modal -->
            <div class="modal fade" id="coverDetailsModal_<?php echo $key ?>" tabindex="-1" role="dialog" aria-labelledby="coverDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog modalDialogBox">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Close button for Bootstrap 3.x -->
                            <button type="button" class="close closeBtnInsurance" data-dismiss="modal" aria-label="Close">&times;</button>
                            <table class="table insurance-table insurance-table-rounded insurance-table-shadow">
                                <thead>
                                    <tr>
                                        <th>Coverage</th>
                                        <th>Sum Insured</th>
                                        <th>Excess</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($value['CoverageDetails'] as $keys => $value1) { ?>
                                    <tr>
                                        <td data-label="Coverage"><?php echo $value1['Coverage']; ?></td>
                                        <td data-label="Sum Insured"><?php echo $value1['SumInsured']; ?></td>
                                        <td data-label="Excess"><?php echo $value1['Excess']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Price Breakup Modal -->
            <div class="modal fade" id="priceBreakupModal_<?php echo $key ?>" tabindex="-1" role="dialog" aria-labelledby="priceBreakupModalLabel" aria-hidden="true">
                <div class="modal-dialog modalDialogBox">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close closeBtnInsurance" data-dismiss="modal" aria-label="Close">&times;</button>
                            <table class="table custom-table custom-table-rounded custom-table-shadow custom-table-responsive">
                                <thead>
                                    <tr>
                                        <th>Pax</th>
                                        <th>Age</th>
                                        <th>Group</th>
                                        <th>Premium</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($value['PremiumList'] as $keyss => $value2) { ?>
                                    <tr>
                                        <td data-label="Pax">Pax-<?php echo $value2['PassengerCount'] ?></td>
                                        <td data-label="Age"><?php echo $value2['MaxAge'] ?></td>
                                        <td data-label="Group"><?php echo $value2['MinAge'] ?>-<?php echo $value2['MaxAge'] ?></td>
                                        <td data-label="Premium"><?php echo $value2['Price']['PublishedPriceRoundedOff']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


               <?php  } ?>
        </div>

  </section>

     <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>
    <script>
          document.getElementById('modifySearchBtn').addEventListener('click', function() {
            var dropdownContent = document.getElementById('dropdownContent');
            dropdownContent.classList.toggle('show');
        });
    </script>
     <script>
       document.addEventListener('DOMContentLoaded', function() {
            const singleTripRadio = document.getElementById('singleTrip');
            const annualMultiTripRadio = document.getElementById('annualMultiTrip');
            const additionalFields = document.querySelectorAll('.additional-fields');

            // Toggle additional fields based on selected trip type
            function toggleAdditionalFields() {
                additionalFields.forEach(field => {
                    if (singleTripRadio.checked) {
                        field.style.display = 'block';
                    } else {
                        field.style.display = 'none';
                    }
                });
                $('.formSelectInsurancePage').val("1").trigger('change');
            }
          
            // Initialize on load
            toggleAdditionalFields();

            // Add event listeners
            singleTripRadio.addEventListener('change', toggleAdditionalFields);
            annualMultiTripRadio.addEventListener('change', toggleAdditionalFields);
        });



    $('coverDetailsModal').click(function() {
        alert('info-button');
        var more_desc = $(this).data('desc');
        var more_tc = $(this).data('tc');
        var more_mp = $(this).data('mp');  
        $(".descDiv").click();

        $('#description').html(more_desc);
        $('#transfer-conditions').html(more_tc);
        $('#meeting-point').html(more_mp);


  });

    </script>
    <input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url();?>">
<link rel="icon" href="<?php echo base_url(); ?>assets/theme_dark/images/favicon.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome5.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap Core CSS -->
<!-- <link href="<?php echo base_url(); ?>assets/theme_dark/css/bootstrap.min.css" rel="stylesheet" /> -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/jquery_ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/animation.css" rel="stylesheet" />
<!-- Custom Fonts -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme_dark/css/backslider.css" type="text/css" media="screen" />
<!-- <link href="<?php //echo base_url(); ?>assets/theme_dark/css/custom.css" rel="stylesheet" /> -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/custom_style.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery-1.11.0.js"></script>
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery.jsort.0.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme_dark/js/jquery_ui.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/theme_dark/js/bootstrap.min.js"></script>
<link href="<?= ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?= ASSETS; ?>css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= ASSETS; ?>css/jquery_ui.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
<link href="<?= ASSETS; ?>css/animation.css" rel="stylesheet" />
<link href="<?= ASSETS; ?>css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="<?= ASSETS; ?>css/backslider.css" type="text/css" media="screen" />
<link href="<?= ASSETS; ?>css/custom_style.css" rel="stylesheet" />

<!-- <script src="<?= ASSETS; ?>js/jquery-1.11.0.js"></script>
   <script src="<?= ASSETS; ?>js/jquery_ui.js"></script> -->
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_search.js"></script>
<script type="text/javascript" src="<?= ASSETS; ?>js/bus_search_result.js"></script>

<script>
$(document).ready(function () {
    $('#no-of-pax').on('change', function () {
        var numOfPax = $(this).val(); 
        var maxPax = 6;
        numOfPax = parseInt(numOfPax);
        var currentAgeFields = $('.age-containerInsurancePage').length;

        if (numOfPax > currentAgeFields) {
            for (var i = currentAgeFields + 1; i <= numOfPax; i++) {
                var ageInputHtml = `
                  <div class="age-containerInsurancePage col-md-2">
                                    <div class="ageDetailsPaxInsurancePage">
                                        <label for="no-of-pax" class="formLabelInsurancePage">Age:</label>
                                        <input type="text" id="duration" class="formInputInsurancePage"  name="age[]"  placeholder="Enter Age" >
                                        <p class="age-restriction-note_resultpage">Minimum age: 1 year / Maximum age: 70 years</p>
                                    </div>
                                </div>
                `;
                $('.insuranceDtlsInputPage').append(ageInputHtml); 
            }
        } 
        else if (numOfPax < currentAgeFields) {
            $('.age-containerInsurancePage').slice(numOfPax).remove();
        }
    });
   
});

</script>

</body>
</html>
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