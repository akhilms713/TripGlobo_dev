<?php
ini_set('memory_limit', '-1');
     ignore_user_abort(true);
set_time_limit(0);
 // debug($TransferCode); 
 // debug($Vehicles); 
 // debug($srch_dta); 
 // die; 
/*$t = '{
   "country": "GB",
   "from": "Ravna Gora,London,GB        ",
   "from_station_ids": "",
   "from_city_id": "",
   "from_HotelId": "1346517",
   "to": "London Heathrow Airport (LHR)",
   "to_station_id": "126632",
   "to_HotelId": "",
   "to_station_code": "LHR",
   "depatures": "2024-9-18",
   "hours": "19",
   "minutes": "32",
   "nationality": "IN",
   "langauge": "4",
   "adult": "1",
   "child": "0",
   "infant": "0"
}';
$srch_dta = json_decode($t,true); */

 ?>
<style>
   .topssec{
   margin-top: -0px;
   position:fixed;
   }
   .wrapper_before_content{
   margin-top: 75px;
   }
   .bus_filter span#total_records {font-size: 16px;text-align: left;float: left;}
   .bus_filter{font-family: poppins; }
   #reset_filters{background: #1c2b59;
   padding: 5px;
   color: #fff;
   cursor: pointer;
   position: absolute;
   right: 10;
   top: 10px;
   } 
   .wrapper_reslut_bus{
   background: #f1f5f8 none repeat scroll 0 0;
   }
   .flight_list .sorta i {
   color: #fdb813!important;
   margin-right: 4px;
   font-weight: 500;
   }
   .flight_list a#arrival_sort {
   text-decoration: none!important;
   font-size: 13px!important;
   font-weight: 600!important;
   color: #203f7c!important;
   
   }
   .flight_list{
     cursor: pointer; 
   }
   .main_bus_details_head span {
   font-size: 15px;
   color: #333;
   font-weight: 400;
   }
   .sorta.active{
   text-decoration: none!important;
   font-size: 13px!important;
   font-weight: 600!important;
   color: #203f7c!important;
   }
   .flight_list.active {
   border-bottom: 3px solid #fdb813;
   }
   .flight_list:hover {
   /* border-bottom: 2px solid #fdb813;*/
   }
   .bus_datails_page{
        padding-left: 15px;
   }
  i.fa.fa-sort-desc {
    float: inline-end;
    margin-top: 12px;
    margin-right: 8px;
}
  i.fa.fa-sort-asc {
    float: inline-end;
    margin-top: 10px;
    margin-right: 8px;
}

/*---------------------modify_before_box css ---------------------*/
.modify-transfer {
    display: flex;
    flex-direction: column;
    gap: 1rem; /* Space between items */
    background-color: #ffffff; /* White background for the container */
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
}

.item {
    display:flex;
    align-items:center;
    gap: 0.75rem; /* Space between icon and content */
    padding: 0.75rem;
    border-radius: 0.25rem;
    background-color: #f9f9f9; /* Light grey background for each item */
    transition: background-color 0.3s ease;
}

.item:hover {
    background-color: #e0e0e0; /* Slightly darker grey on hover */
}

.icon {
    width: 7%; /* Size of icons */
}

.content {
    font-size: 1rem;
    color: #333; /* Dark grey for text */
    font-weight: 500;
}
.content_heading{
    font-size: 1rem;
    color: #333; /* Dark grey for text */
    font-weight: 600 !important;
}
.modify-button {
    align-self: end;
    padding: 0.75rem 1.5rem;
    font-size: 1.4rem;
    color: #ffffff;
    background-color: #203f7c;
    border: none;
    border-radius: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 0px 5px 10px 0px;
}

.modify-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}
/*-------------------modfy box pop up css ----------------------*/
/* Base styling for the transfer search engine container */
.transfer_search_engine {
    padding: 40px 15px 20px;
    background: #f8f9fa; /* Light background for better contrast */
    border-radius: 8px; /* Rounded corners for a modern look */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
    position: relative;
}

/* Styling for the form */
.transfer_search_engine form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Add spacing between elements */
}

/* Destination input styling */
.Dest_input {
    text-align: left;
    width: 45%;
    margin-bottom: 7px;
    position: relative;
}

/* Destination select styling */
.Dest_input select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 10px 7px; /* Adjust padding */
    outline: none;
    background: #fff;
    border-radius: 4px; /* Rounded corners for select */
}

/* Pick and Drop styling */
.pick_drop {
    display: flex;
    gap: 15px; /* Space between pick-up and drop-off */
    margin-bottom: 7px;
}

/* Styling for pick-up and drop-off select boxes */
.pick_drop select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 10px 7px;
    outline: none;
    background: #fff;
    border-radius: 4px; /* Rounded corners for select */
}

/* Date and time picker styling */
.date_pickup {
    display: flex;
    gap: 15px; /* Space between date and time pickers */
    margin-bottom: 7px;
}

.dat_pick input,
.pick_up_time select , .nationality select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    font-weight: 600;
    padding: 10px 7px;
    border-radius: 4px; /* Rounded corners */
    background: #fff;
}

.date_pickup select {
    background: #fff;
    display:flex;
}

/* Language and Nationality select styling */
.lang_num_pass {
    display: flex;
    width: 60%;
    gap: 15px; /* Space between language and nationality */
}

.lang_num_pass select {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    font-weight: 600;
    padding: 10px 7px;
    border-radius: 4px; /* Rounded corners */
    background: #fff;
}

/* Styling for various input fields */
.fromtransfer.mytextbox.iconLoc.contr_form,
.droptransfer.mytextbox.iconLoc.contr_form {
    width: 100%;
    height: 50px;
    border: 2px solid #fdb816 !important;
    color: #333;
    font-weight: 600;
    padding: 10px 7px;
    border-radius: 4px; /* Rounded corners */
    background: #fff;
    outline: none;
}

/* Button styling */
.srchbutn {
    background-color: #fdb816;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px; /* Rounded corners */
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.srchbutn:hover {
    background-color: #e0a800;
}

/* Cross button styling */
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #f44336; /* Red color for close button */
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
    z-index:99;
}

.close-btn:hover {
    background-color: #d32f2f;
}

/* Animation for showing and hiding the form */
.form-container {
    position: fixed;
    top: -100%; /* Initially hide the form above the viewport */
    left: 0;
    right: 0;
    background: #fff;
    transition: top 0.5s ease; /* Smooth transition */
    z-index: 9999; /* Ensure form is above other content */
}

.form-container.show {
    top: 0; /* Show the form */
}

/* Responsive Design */
@media (max-width: 768px) {
    .transfer_search_engine form {
        flex-direction: column;
    }
    .pick_drop, .date_pickup, .lang_num_pass {
        width: 100%;
    }
}
.pax-count-wrapper .input-number{
    background: #fff !important;
    border: none;
    margin-bottom: 0;
    text-align: center;
    box-shadow: none;
}
.flyinputsnor.contr_form {
    color: #333;
    border-radius: 5px;
    border: 2px solid #fdb816 !important;
    height: 50px !important;
}
.div_flex select {
    width: 70px;
}
/*---------------pop up more info css  in modify--------------------*/
/* Basic Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    overflow: hidden !important; /* Prevent scrolling on the whole modal */
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 0px !important;
    border: 1px solid #ccc;
    width: 50%;
    max-height: 80vh; /* Limits the modal height */
    overflow-y: auto; /* Enables vertical scrolling inside modal */
    position: relative;
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: blue pink; /* For Firefox */
}

/* Custom scrollbar for WebKit browsers (Chrome, Safari, etc.) */
.modal-content::-webkit-scrollbar {
    width: 8px; /* Width of the scrollbar */
}

.modal-content::-webkit-scrollbar-track {
    background: pink; /* Background color of the scrollbar track */
}

.modal-content::-webkit-scrollbar-thumb {
    background-color: blue; /* Scrollbar thumb color */
    border-radius: 4px; /* Rounded corners for the scrollbar thumb */
    border: 2px solid pink; /* Optional border to give some space */
}

/* Header styles for modal */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 10px;
    background:#d4e6f1;
}
.modal-header h2{
    font-size: 19px;
    font-weight: bold;
}
.close-button {
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    color: red;
}

.tab-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.tab {
    padding: 10px 20px;
    cursor: pointer;
    background-color: #d4e6f1;
    color: #203f7c;
    border-right: 1px solid #ccc;
    text-align: center;
    border-radius: 10px 10px 0px 0px;
    margin-right:10px;
    font-weight:bold;
}

.tab.active {
    background-color: #fff;
    color: #203f7c;
    border: 1px solid #ccc;
    border-bottom: none;

}

.tab-content {
    display: none;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #fff;
    margin-top: 20px;
}

.modal-footer {
    text-align: center !important;
    margin-top: 20px;
}

.close-modal {
    padding: 10px 20px;
    background-color: #203f7c;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.transferBookingSection{
  margin-top:85px;
}
.transferTravellerDtls{
  width: 73% !important;
  margin-right: 10px;
}

.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: -5px;
  left: 105%;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>

<style>
/* General Styles */
:root{
  --color-bg-primary: #fdb813; /* Light primary background */
  --color-side-bg-secondary: #eeedfa; /* Slightly darker background for side elements */
  --color-bg-white: #ffffff; /* White background */
  --color-dark-gray: #343534; /* Dark gray text */
  --color-light-gray: #ccc; /* Light gray for borders */
  --color-primary: #002d5b; /* Primary color for headings and buttons */
  --color-secondary: #fdb816; /* Secondary color */
  --color-hover: #f4600c; /* Hover color */
}
body {
  font-family: 'Arial', sans-serif;
  background-color: #f5faff; /* Light background */
  margin: 0;
  padding: 0;
  color: #343534; /* Dark gray text */
}

.container {
  margin-top: 20px;
}

ul {
  padding: 0;
  list-style: none;
}

li {
  font-size: 1rem;
  margin-bottom: 5px;
}

/* Guest Details Steps */
.GuestDetails ul {
  display: flex;
  justify-content: flex-start;
  background-color: #ffffff; /* White background */
  padding: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.GuestDetails ul li {
  display: flex;
  align-items: center;
  color: #343534; /* Dark gray text */
  margin-right: 15px;
  
}
.GuestDetails ul li.active span:first-child {
    background: #fdb816;
}
.GuestDetails li.active span:last-child{
    color: #fdb816 !important; /* Secondary color */
    font-weight: bold;
}
.GuestDetails ul li.active {
  color: #fdb816 !important; /* Secondary color */
  font-weight: bold;
}
.GuestDetails li span:last-child {
    color: #ccc;
    font-weight: 500;
}
.GuestDetails ul li span:first-child {
  background-color: #ccc; /* Secondary color */
  color: #ffffff; /* White text */
  width: 25px;
  height: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px;
  margin-right: 10px;
}

/* Transfer Details */
.transferDetails,
.lead-passenger,
.pickup-details,
.drop-off-details,
.cancellation-charges {
  background-color: #ffffff; /* White background */
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Transfer Details Table */
.transfer-details table,
.cancellation-charges table,
.sale-summary table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

.transfer-details table td,
.cancellation-charges table th,
.cancellation-charges table td,
.sale-summary table td {
  padding: 8px;
  text-align: left;
}

.cancellation-charges table th {
  background-color: #f5faff; /* Light background */
  font-weight: bold;
}

/* Input Styles */
input[type="text"],
input[type="date"],
select,
textarea {
  padding: 8px;
  margin: 5px 0;
  border: 1px solid #ccc; /* Light gray border */
  border-radius: 4px;
  box-sizing: border-box;
}

/* Button Styles */
.choose-another-transfer {
  color: #333333; /* White text */
  text-decoration: none;
  border:none;
  background: transparent;
  position: relative;
}
.choose-another-transfer::after{
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: #333;
    left: 3px;
    top: 22px;
}
/* Sale Summary */
.sale-summary {
  border: 1px solid #ccc; /* Light gray border */
}

.sale-summary h2 {
  color: #002d5b; /* Primary color */
  padding:10px 15px;
}

.sale-summary p {
  color: var(--color-bg-primary); /* Dark gray text */
  font-weight: bold;
}

.sale-summary a {
  color: #002d5b; /* Primary color */
  text-decoration: none;
}

.sale-summary a:hover {
  text-decoration: underline;
}

/* Utility Classes */
.table-header { 
  font-weight: bold;
  background-color: #efeeee; /* Light gray background */
}
.pickup-details td{
    white-space: nowrap;
    padding:10px;
}
.text-center {
  text-align: center;
}
.pickup-details input {
    width: 90%;
}
/* Alignment Utilities */
.d-flex {
  display: flex;
  align-items: center;
}

.justify-content-between {
  justify-content: space-between;
}

.m-0 {
  margin: 0;
}

.mt-20 {
  margin-top: 20px;
}
/* ---------------modify by sangram ---------------*/
.transferDetails{
    display: flex;
    justify-content: space-between;
}
span.cancellation-date {
    display: block;
    color: red;
    font-weight: bold;
}
.cancellation-info {
    text-align: center;
    padding: 5px 40px;
    border: 1px solid #ccc;
    border-radius: 25px;
    background: var(--color-bg-white);
}
span.car-type {
    color: #55588d;
    font-weight: bold;
    font-size: 18px;
}
.transfer-details h2{
    background: var(--color-bg-primary);
    font-size: 19px;
    font-weight: 600;
    padding: 10px 15px;
    margin-bottom: 0px;
}
.transfer-details table{
    border: 1px solid #9fb6d3;
    margin-top: 0px;
}
.PassengerDtlssections{
    margin-top: 10px;
}
.EnterPassengerDtls h2{
    background: var(--color-bg-primary);
    font-size: 19px;
    font-weight: 600;
    padding: 10px 15px;
    margin-bottom: 0px;
}
.lead-passenger{
    padding: 8px;
}
.lead-passenger h2{
    /* background: var(--color-side-bg-secondary); */
    font-size: 16px;
    font-weight: 600;
    padding: 10px 0;
    margin-bottom: 0px;
}
.pan-details {
    padding: 10px;
}
.panNumberValidate{
    display: flex;
    align-items: center;
    width: 60%;
}
.panInputBtn{
    display: flex;
}



/* Lead Passenger Section */
.lead-passenger {
  padding: 15px;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.lead-passenger h2 {
  font-size: 16px;
  font-weight: 600;
  /* background: var(--color-side-bg-secondary); */
  padding: 10px 0;
  margin-bottom: 10px;
  border-radius: 4px;
}

.pan-details {
  padding: 10px 0;
  margin-bottom: 10px;
  border-bottom: 1px solid #ccc; /* Light gray border */
}

.panNumberValidate {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 5px;
}

.panInputBtn {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: 20%;
}

.panInputBtn input[type="text"] {
  padding: 5px 10px;
  width: 250px;
  border: 1px solid #ccc; /* Light gray border */
  border-radius: 4px;
}

.panInputBtn button {
  padding: 5px 15px;
  background-color: #002d5b; /* Primary color */
  color: #ffffff; /* White text */
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.panInputBtn button:hover {
  background-color: #f4600c; /* Secondary color */
}

.passenger-details,
.mobile-details {
  margin-bottom: 15px;
  display: flex;
}

.passenger-details input[type="text"],
.mobile-details input[type="text"],
.passenger-details select {
  padding: 8px;
  width: calc(100% - 20px);
  border: 1px solid #ccc; /* Light gray border */
  border-radius: 4px;
  margin-top: 5px;
  box-sizing: border-box;
}

.mobile-details {
  display: flex;
}

.mobile-details label {
  margin-bottom: 5px;
}

/* Pickup and Drop Off Details */
.pickup-details,
.drop-off-details {
  margin-top: 20px;
  padding: 15px;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.pickup-details h2,
.drop-off-details h2 {
  font-size: 19px;
  font-weight: 600;
  background: var(--color-primary); /* Light secondary background */
  padding: 10px 15px;
  margin-bottom: 10px;
  border-radius: 4px;
  color: #fff;
}

.pickup-details div,
.drop-off-details div {
  margin-bottom: 10px;
  display: flex;
  align-items: center;
}
.pickup-time select {
    width: 7%;
    margin-right: 10px;
}
.pickup-time span{
    margin-right: 5px;
}
.pickup-date input{
    width: 25%;
}
.pickup-details label,
.drop-off-details label {
  display: block;
  margin-bottom: 5px;
  font-weight: 500;
  color: #343534; /* Dark gray text */
  margin-right: 20px;
}
.flight-details input{
    margin-right: 5px;
}
.pickup-details input[type="text"],
.drop-off-details input[type="text"],
.pickup-details select,
.drop-off-details select,
.drop-off-details textarea {
  padding: 8px;
  border: 1px solid #ccc; /* Light gray border */
  border-radius: 4px;
  box-sizing: border-box;
}

textarea {
  height: 80px;
  resize: vertical;
}

/* Cancellation and Charges Section */
.cancellation-charges {
  margin-top: 20px;
  padding: 15px;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.cancellation-charges h2 {
  font-size: 19px;
  font-weight: 600;
  background: var(--color-primary); /* Light secondary background */
  padding: 10px 15px;
  margin-bottom: 10px;
  border-radius: 4px;
  color: #fff;
}

.cancellation-charges table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

.cancellation-charges table th,
.cancellation-charges table td {
  padding: 10px;
  border: 1px solid #ddd; /* Light border */
  text-align: left;
}

/* Button Container */
.button-container {
  display: flex;
  gap: 15px;
  margin-top: 20px;
  justify-content: end;
  align-items: center;
  margin-bottom: 20px;
}

.button-container button {
      margin-left: 81%;
  background-color: #002d5b; /* Primary color */
  color: #ffffff; /* White text */
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* Sale Summary */
.sale-summary {
  background-color: #ffffff;
  border: 1px solid #ccc; /* Light gray border */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.sale-summary h2 {
  font-size: 19px;
  font-weight: bold;
  color: #002d5b; /* Primary color */
  margin-bottom: 0px !important;
  border-radius: 8px 8px 0px 0px;
}

.sale-summary p {
  color: #343534; /* Dark gray text */
}

.sale-summary a {
  color: #002d5b; /* Primary color */
  text-decoration: none;
  font-weight: bold;
}

.sale-summary a:hover {
  text-decoration: underline;
}

.sale-summary table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

.sale-summary table td {
  padding: 8px;
  text-align: left;
}

.sale-summary table td:first-child {
  font-weight: bold;
}

.sale-summary table td:last-child {
  text-align: right;
}

/* Utility Classes */
.text-center {
  text-align: center;
}

.d-flex {
  display: flex;
  align-items: center;
}

.justify-content-between {
  justify-content: space-between;
}

.m-0 {
  margin: 0;
}

.mt-20 {
  margin-top: 20px;
}
p.notePan {
    font-size: 13px;
}
.nameInputSection{
    display: flex;
    width: 77%;
    margin-left: 11%;
}
.nameInputSection select{
    width: 30%;
    margin-right: 5px
}
.nameInputSection input{
    margin-right: 5px;
}
.mobile-details input{
    width: 32% !important;
    margin-left: 7.3%;
}
.airportFlightName {
    display: flex;
    justify-content: space-between;
}
.airport-details {
    display: flex;
    justify-content: space-around;
    align-items: center;
}
.flight-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.validateBtn{
    background: #2b569a;
    color: #fff;
    padding: 4px 9px;
}
.lead-passenger table , .pickup-details table ,.drop-off-details table{
    width: 100%;
    border-collapse: collapse;
}
.lead-passenger input[type="text"]{
    width: 35%;
    height: 40px;
}
.lead-passenger select{
    height: 40px;
}


/* ------------summary css start ---------------*/
.sale-summary {
  border: 1px solid var(--color-light-gray); /* Light gray border */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
  color: var(--color-dark-gray);
}

.sale-summary h2 {
  font-size: 20px;
  font-weight: 600;
  color: var(--color-primary); /* Primary color for heading */
  background: var(--color-bg-primary);
}

.sale-summary p {
  margin: 0;
  padding:10px ;
  font-size: 13px;
  color: var(--color-dark-gray);
}

.sale-summary a {
  color: var(--color-primary); /* Link color */
  text-decoration: none;
  font-weight: bold;
}

.sale-summary a:hover {
  text-decoration: underline; /* Hover effect for link */
}

.sale-summary table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  background-color: var(--color-bg-white); /* White background for table */
  border: 1px solid var(--color-light-gray); /* Border around table */
  border-radius: 4px;
  overflow: hidden;
}

.sale-summary table td {
  padding: 10px;
  font-size: 14px;
}

.sale-summary table td:first-child {
  font-weight: 500; /* Slightly bold for labels */
}

.sale-summary table td:last-child {
  text-align: right; /* Align prices to the right */
  color: var(--color-dark-gray);
}

.sale-summary table tr:last-child td {
  font-weight: 600; /* Bold for grand total */
  color: var(--color-primary); /* Emphasized color for grand total */
  /* background: var(--color-bg-primary); */
}

/* .sale-summary table tr:last-child td:last-child {
  color: var(--color-secondary); 
} */

.sale-summary table td br {
  line-height: 1.5; /* Line height for spacing */
}
.showDetails {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.HoursMin{
  width:12% !important;
} 
.airlineCode input{
  display: block;
}
</style>

<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
<?php //debug($raw_transfer_list['TransferSearchResult']['TransferSearchResults']); die;   ?>
<?php
   // $this->load->helper('bus/tbo');
   
   
   
   // $data = array();
   
   
   
   
   
   
   
   /*$bus_search_params =json_decode('{"bus_date_1":"24-08-2020","trip_type":"One Way","bus_station_from":"Bangalore","bus_station_to":"Chennai","from_station_id":"1190","to_station_id":"2553","search_id":235}', true);
   
   
   
   $data['result'] = $bus_search_params;*/
   
   
   
   // debug($data);
   
   
   
   // $mini_loading_image ='';
   
   
   
   ?>
<input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url();?>">
<link rel="icon" href="<?php echo base_url(); ?>assets/theme_dark/images/favicon.png" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato|Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome5.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/theme_dark/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>assets/theme_dark/css/bootstrap.min.css" rel="stylesheet" />
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
 

     <div class="container">
        <div class="row">
            <!-- <div class="GuestDetails">
                <ul>
                    <li><span>1</span> <span>Transfer Search</span></li>
                    <li><span>2</span> <span>Transfer Result</span></li>
                    <li class="active"><span>3</span> <span>Guest Details</span></li>
                    <li><span>4</span> <span>Review Booking</span></li>
                    <li><span>5</span> <span>Confirmation</span></li>
                </ul>
            </div> -->
        </div>
        <div class="row transferBookingSection">
            <div class="col-md-9 transferTravellerDtls">
                <div class="transferDetails">
                    <span class="car-type"><?php echo $Vehicles[0]['Vehicle']; ?></span>
                    <div class="cancellation-info ">
                      <label>Last cancellation date:</label>
                      <span class="cancellation-date"><?php echo $Vehicles[0]['LastCancellationDate']; ?> </span>
                       <span class="tooltiptext"> 
                          
                       </span>
                    </div>
                    <!-- <a class="choose-another-transfer">Choose Another Transfer</a> -->
                </div>
                <div class="transfer-details">
                    <h2>Transfer Details</h2>
                    <table>
                      <tr>
                        <td>Transfer Date:</td>
                        <td><?php echo $srch_dta['depatures']; ?></td>
                        <td>Pick Up:</td>
                        <td>   <?php if($srch_dta['from_station_ids']!=""){
                          echo "Airport";
                        }else{
                          echo "Accommodation";
                        } ?></td>
                      </tr>
                      <tr>
                        <td>Transfer Time:</td>
                        <td><?php echo $srch_dta['hours']; ?> hr <?php echo $srch_dta['minutes']; ?> mins</td>
                        <td>Drop Off:</td>
                        <td>

                           <?php if($srch_dta['to_HotelId']!=""){
                          echo "Accommodation";
                        }else{
                          echo "Airport";
                        } ?></td>
                      </tr>
                      <tr>
                        <td>Language:</td>
                        <td>
                       <?php $get_langauge = $this->Home_Model->get_lang($srch_dta['langauge']);
                        // debug($get_langauge[0]['langauge']); die;
                       echo $get_langauge[0]['langauge'];
                        ?>
                      </td>
                        <td>No of Pax:</td>
                        <?php // $total_pax = ($srch_dta['adult']) + ($srch_dta['child']) + ($srch_dta['infant']); ?>
                        <td><?//=$total_pax?><?php echo $srch_dta['adult']; ?> adult(s)</td>
                        <!-- <td><?php echo $srch_dta['child']; ?> childs(s)</td>
                        <td><?php echo $srch_dta['infant']; ?> infants(s)</td> -->
                      </tr>
                    </table>
                </div>

                <form  autocomplete="off" action="<?php echo WEB_URL ?>transfer/Booking/<?php echo $search_id ?>" name="flight" id="flight" >
                <div class="PassengerDtlssections">
                    <div class="EnterPassengerDtls">
                        <h2>Enter Passenger Details</h2>
                    </div>
                    <div class="lead-passenger">
                        <h2>Lead Passenger</h2>
                        <table>
                            <tr>
                                <td colspan="2"><input type="checkbox" id="parentGuardianPan"> Parent/Guardian PAN No.</td>
                            </tr>
                          <tr>
                            <td><label for="parentGuardianPan">PAN</label></td>
                            <td>
                              <input type="text" id="pan" name="pan" placeholder="PAN">
                              <!-- <button type="button" class="validateBtn" onclick="validatePan()">Validate</button> -->
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <p class="notePan">Note: Please enter valid PAN linked with Aadhaar. And if PAN not exists, click on "Parent/Guardian PAN" and then provide details.</p>
                            </td>
                          </tr>
                          <tr>
                            <td>Name:</td>
                            <td>
                              <select id="title" name="title">
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Dr.">Dr.</option>
                              </select>
                              <input type="text" id="firstName" name="firstName" placeholder="Traveller's First Name as per PAN">
                              <input type="text" id="lastName" name="lastName" placeholder="Traveller's Last Name as per PAN">
                            </td>
                          </tr>
                          <tr>
                            <td>Mobile No.:</td>
                            <td><input type="text" id="mobileNo" name="mobileNo" placeholder="91"></td>
                          </tr>
                        </table>
                      </div>
                      


                      <?php  if($srch_dta['from_station_ids']!=""){ ?>
                      <div class="pickup-details">
                        <h2>Pick Up Details</h2>
                        <table>
                          <tr>
                            <td class="me-2">Airport Name:</td>
                            <td><input type="text" id="airportName" name="airportName" placeholder="Dubai International airport" value="<?php echo $srch_dta['from']; ?>" readonly></td>
                            <td class="me-2">Flights Details:</td>
                            <td class="airlineCode">
                                <input type="text" id="airlineCode" name="airlineCode" placeholder="AirlineCode">
                                <input type="text" id="flightNumber" name="flightNumber" placeholder="FlightNumber">
                              </td>
                          </tr>
                          <tr>
                            <td>Pick Up Time:</td>
                            <td>
                              <input type="text" id="pickupHours" name="pickupHours"  class="HoursMin" value="<?php echo $srch_dta['hours']; ?>" readonly>
                              <span>Hrs</span>
                              <input type="text" id="pickupMinutes" name="pickupMinutes" class="HoursMin" value="<?php echo $srch_dta['minutes']; ?>" readonly>
                              <span>Min</span>
                            </td>
                          </tr>
                          <tr>
                            <td>Pick Up Date:</td>
                            <td><input type="text" id="pickupDate" name="pickupDate" value="<?php echo $srch_dta['depatures']; ?>" readonly=""></td>
                          </tr>
                        </table>
                      </div>


                    <?php }if($srch_dta['to_HotelId']!=""){ ?>

                      <?php $get_address =  $this->Home_Model->get_address($srch_dta['to_HotelId']);  
                      // debug($get_address); die;
                            $get_country_name=$this->Home_Model->get_country_name($get_address[0]['CountryCode']);  
                            // debug($get_country_name[0]['Name']); die;
                      ?>
                      <div class="drop-off-details">
                        <h2>Drop Off Details</h2>
                        <table>
                          <tr>
                            <td>Hotel Name:</td>
                            <td><input type="text" id="hotelName" name="hotelName" placeholder="Metropolitan Hotel Dubai" value="<?php echo $srch_dta['to']; ?>" readonly></td>
                            <td>City:</td>
                            <td><input type="text" id="city" name="city" placeholder="Dubai" value="<?php echo $get_address[0]['CityName'];  ?>" readonly></td>
                          </tr>
                          <tr>
                            <td>Address:</td>

                            <?php 
                             
                             // debug($get_address[0]['AddressLine1']); die;
                             ?>
                            <td><input type="text" name="address1" placeholder="Sheikh Zayed Road Exit 41\" value="<?php echo $get_address[0]['AddressLine1'];  ?>" readonly/>
                                <input type="text" style="display: block;" name="address2" placeholder="nExit 41, Al Thanya Street P.O." value="<?php echo $get_address[0]['AddressLine2'];  ?>" readonly/></td>
                            <td>Zipcode:</td>

                            <?php 
                                  $vhcle = base64_encode(json_encode($Vehicles));  
                                  $r = base64_decode($vhcle);  
                                  $rr = $res = str_replace( array(  '[', ']' ), ' ', $r);  
                             ?>
                            <td><input type="text" id="zipcode" name="zipcode" placeholder="31588" value="<?php echo $get_address[0]['PostalCode'];  ?>" readonly>
                                <input type="hidden" id="TransferCode" name="TransferCode"  value="<?php echo $TransferCode ?>">
                                <input type="hidden" id="Vehicles" name="Vehicles"  value="<?php echo $vhcle; ?>">
                                <input type="hidden" id="TraceId" name="TraceId"  value="<?php echo $TraceId; ?>">
                                <input type="hidden" id="Condition" name="Condition"  value="<?php echo $Condition; ?>">
                                <input type="hidden" id="ResultIndex" name="ResultIndex"  value="<?php echo $ResultIndex; ?>">
                            </td>    
                          </tr>
                          <tr>
                            <td>Departure Time:</td>
                            <td>
                         <!--      <select id="departureHours" name="departureHours">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="23">23</option>
                              </select> -->
                              <select id="departureHours" name="departureHours">
                              <?php for($i=0;$i<=24;$i++){  ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>

                              </select>
                              <span>Hrs</span>
                              <select id="departureMinutes" name="departureMinutes">
                              <?php for($i=0;$i<=60;$i++){  ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>

                              </select>
                              <!-- <select id="departureMinutes" name="departureMinutes">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                              </select> -->
                              <span>Min</span>
                            </td>
                            <td>Country:</td>
                            <td>
                               <!-- <select id="country" name="country"> -->
                                <!-- <option value="United Arab Emirates">United Arab Emirates</option> -->
                              <!-- </select> -->  
                              <!-- <input type="text" name="country" id="country" value="<?php echo $get_country_name[0]['Name'] ?>" readonly> -->
                             <select id="country"  class="country"  name="country"  > 
                                       <?php foreach ($transfer_country_list as $key => $value) {?>
                        
                <option value="<?php echo $value['Code']; ?>"><?php echo $value['Name']; ?></option> 

                 <?php    } ?>
                             </select> 
                            </td>
                          </tr>
                        </table>
                      </div>
                      <?php  } ?>

 

                      <?php  if($srch_dta['from_station_ids']==""){ ?>
                      <div class="pickup-details">
                        <h2>Pick Up Details</h2>
                              
<?php // debug($srch_dta); die;?>
                                <?php $get_address =  $this->Home_Model->get_address($srch_dta['from_HotelId']);  
                      // debug($get_address); die;
                            $get_country_name_from=$this->Home_Model->get_country_name($get_address[0]['CountryCode']);  
                            // debug($get_country_name_from[0]['Name']); die;
                      ?>

                        <table>
                          <tr>
                            <td>Hotel Name:</td>
                            <td><input type="text" id="hotelName" name="hotelName" placeholder="Metropolitan Hotel Dubai" value="<?php echo $srch_dta['from']; ?>" readonly></td>
                            <td>City:</td>
                            <td><input type="text" id="city" name="city" placeholder="Dubai" value="<?php echo $get_address[0]['CityName'];  ?>" readonly></td>
                          </tr>
                          <tr>
                            <td>Address:</td>
                            <td>
                              <input type="text" name="address1" placeholder="Sheikh Zayed Road Exit 41\"  value="<?php echo $get_address[0]['AddressLine1'];  ?>" readonly />
                              <input type="text" style="display: block;" name="address2" placeholder="nExit 41, Al Thanya Street P.O." value="<?php echo $get_address[0]['AddressLine2'];  ?>" readonly/></td>
                            <td>Zipcode:</td>
                            <td><input type="text" id="zipcode" name="zipcode" placeholder="31588" value="<?php echo $get_address[0]['PostalCode'];  ?>" readonly>

                            <?php 
                                  $vhcle = base64_encode(json_encode($Vehicles));  
                                  $r = base64_decode($vhcle);  
                                  $rr = $res = str_replace( array(  '[', ']' ), ' ', $r);  
                             ?>
                                <input type="hidden" id="TransferCode" name="TransferCode"  value="<?php echo $TransferCode ?>">
                                <input type="hidden" id="Vehicles" name="Vehicles"  value="<?php echo $vhcle; ?>">
                                <input type="hidden" id="TraceId" name="TraceId"  value="<?php echo $TraceId; ?>">
                                <input type="hidden" id="Condition" name="Condition"  value="<?php echo $Condition; ?>">
                                <input type="hidden" id="ResultIndex" name="ResultIndex"  value="<?php echo $ResultIndex; ?>">


                            </td>    
                          </tr>
                          <tr>
                            <td>Departure Time:</td>
                            <td>
                         <!--      <select id="departureHours" name="departureHours">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="23">23</option>
                              </select> -->
                              <select id="departureHours" name="departureHours">
                              <?php for($i=0;$i<=24;$i++){  ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>

                              </select>
                              <span>Hrs</span>
                              <select id="departureMinutes" name="departureMinutes">
                              <?php for($i=0;$i<=60;$i++){  ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>

                              </select>
                              <!-- <select id="departureMinutes" name="departureMinutes">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                              </select> -->
                              <span>Min</span>
                            </td>
                            <td>Country:</td>
                            <td>
                           <!--    <select id="country" name="country">
                                <option value="United Arab Emirates">United Arab Emirates</option>
                              </select> -->
                              <!-- $get_country_name_from[0]['Name'] -->
                              <!-- <input type="text" name="country" id="country" value="<?php echo $get_country_name_from[0]['Name']; ?>" readonly> -->
                               <select id="country"  class="country"  name="country"  > 
                                       <?php foreach ($transfer_country_list as $key => $value) {?>
                        
                <option value="<?php echo $value['Code']; ?>"><?php echo $value['Name']; ?></option> 

                 <?php    } ?>
                             </select>
                            </td>
                          </tr>
                        </table>
                      </div>


<?php }if($srch_dta['to_HotelId']==""){ ?>

                      
                      <div class="drop-off-details">
                        <h2>Drop Off Details</h2>

                            <table>
                          <tr>
                            <td class="me-2">Airport Name:</td>
                            <td><input type="text" id="airportName" name="airportName" placeholder="Dubai International airport" value="<?php echo $srch_dta['to']; ?>" readonly></td>
                            <td class="me-2">Flights Details:</td>
                            <td >
                                <input type="text" id="airlineCode" name="airlineCode" placeholder="AirlineCode">
                                <input type="text" id="flightNumber" name="flightNumber" placeholder="FlightNumber">
                              </td>
                          </tr>
                          <tr>
                            <td>Pick Up Time:</td>

                              <td>
                              <input type="text" id="pickupHours" name="pickupHours"  class="HoursMin" value="<?php echo $srch_dta['hours']; ?>" readonly>
                              <span>Hrs</span>
                              <input type="text" id="pickupMinutes" name="pickupMinutes" class="HoursMin" value="<?php echo $srch_dta['minutes']; ?>" readonly>
                              <span>Min</span>
                            </td>
                      <!--       <td>
                              <select id="pickupHours" name="pickupHours">
                                <option value="01" selected=""><?php echo $srch_dta['hours']; ?></option> 
                              </select>
                              <span>Hrs</span>
                              <select id="pickupMinutes" name="pickupMinutes">
                                <option value="00" selected=""><?php echo $srch_dta['minutes']; ?></option> 
                              </select>
                              <span>Min</span>
                            </td> -->
                          </tr>
                          <tr>
                            <td>Pick Up Date:</td>
                            <td><input type="text" id="pickupDate" name="pickupDate" value="<?php echo $srch_dta['depatures']; ?>" readonly=""></td>
                          </tr>
                        </table>



                      </div>
                      <?php  } ?>
</form>

                    <div class="cancellation-charges">
                        <h2>Cancellation and Charges:</h2>
                        <table>
                          <tr>
                            <th>Cancelled on or After</th>
                            <th>Cancelled on or Before</th>
                            <th>Cancellation Charges</th>
                          </tr>
                          <tr>

                            <?php $timeStamp = $Vehicles[0]['TransferCancellationPolicy'][0]['FromDate'];
                                  $timeStamp_from = date( "d-m-Y", strtotime($timeStamp)); 

                                  $timeStamp_to = $Vehicles[0]['TransferCancellationPolicy'][0]['ToDate'];
                                  $timeStamp_to = date( "d-m-Y", strtotime($timeStamp_to)); ?>

                            <td><?php echo $timeStamp_from; ?></td>
                            <td><?php echo $timeStamp_to; ?></td>
                            <td><?php echo $Vehicles[0]['TransferCancellationPolicy'][0]['Charge']; ?>%</td>
                          </tr>
                        </table>
                    </div>
                    <div class="button-container">
                        <!-- <a class="choose-another-transfer">Choose Another Transfer</a> -->
                        <button class="proceed-to-booking-review">Proceed to Booking</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sale-summary">
                    <h2>Sale Summary</h2>
                    <div class="showDetails">
                        <p><?php echo $Vehicles[0]['Vehicle']; ?></p>
                        <!-- <p><a href="#">+ Show Details</a></p> -->
                    </div>
                    <table>
                      <tr>
                        <td>Rate</td>
                        <td><?php 
                        // debug($Vehicles); die;
                        echo $Vehicles[0]['TransferPrice']['CurrencyCode']; ?> <?php echo $Vehicles[0]['TransferPrice']['PublishedPriceRoundedOff']; ?></td>
                      </tr>
                      <tr>
                        <td>No of vehicles</td>
                        <td><?php if($Condition!=""){
                          echo $Condition;
                        }else{
                          echo 1;
                        } ?></td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>
                          <?php 
                           $total_pax = ($srch_dta['adult']) + ($srch_dta['child']) + ($srch_dta['infant']);  

                          // debug($total_pax); die;
                            ?>
                          <?php echo $Vehicles[0]['TransferPrice']['CurrencyCode']; ?>
                           <?php 
                            if($Condition!=""){
                                  $no_of_vehicle = $Condition;
                            }else{
                                  $no_of_vehicle = 1;
                            }
                            $totals = $Vehicles[0]['TransferPrice']['PublishedPriceRoundedOff']*$no_of_vehicle;

                           echo $totals; 
                           

                           ?>
                           <br>(<?php echo $Vehicles[0]['TransferPrice']['PublishedPriceRoundedOff']; ?> X <?php if($Condition!=""){
                              echo $Condition;
                          }else{
                            echo 1;
                          } ?><?//=$total_pax?>)</td>
                      </tr>
                      <tr>
                        <td>Service Tax</td>
                        <td> <?php echo $Vehicles[0]['TransferPrice']['CurrencyCode']; ?> <?php echo $Vehicles[0]['TransferPrice']['Tax']; ?></td>
                      </tr>
                      <tr>
                        <td>Total GST</td>
                        <td><?php echo $Vehicles[0]['TransferPrice']['CurrencyCode']; ?> <?php echo $Vehicles[0]['TransferPrice']['Tax']; ?></td>
                      </tr>
                      <tr>
                        <td>Grand Total</td>
                        <td><?php echo $Vehicles[0]['TransferPrice']['CurrencyCode']; ?> <?php echo
                         $Vehicles[0]['TransferPrice']['PublishedPriceRoundedOff']; 
                        $totals;
                        ?></td>
                      </tr>
                    </table>
                  </div>
            </div>
        </div>
    </div>
 <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>