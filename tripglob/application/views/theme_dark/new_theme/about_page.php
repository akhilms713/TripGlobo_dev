<!DOCTYPE html>
<html lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?php echo PROJECT_TITLE; ?></title>
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
      <style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
  float: left;
  border-top: 1px solid #ccc;
  background-color: #fff;
  width: 30%;
  min-height: 200px;
  height:auto;
  color:#666;
  padding-top: 25px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 15px 12px;
  border-top: 1px solid #ccc;
  border-left: 1px solid #ccc;
  width: 70%;
  min-height: 200px;
  height: auto;
}
.tab ul li{
  list-style: none;
  padding: 9px 20px 9px;
  font-size: 18px;
}
.tab ul {
    width: 100%;
    float: left;
    padding-top: 40px;
    padding-left: 18%;
}
.tab ul li .fa-angle-right{float:right;font-weight: 600;
    font-size: 20px;}
.tab li.tablinks.active {
    border-left: 4px solid #fdb813;
    color: #203f7c;
    font-weight: 500;
    font-style: normal;}
.topic_hd {
    width: 100%;
    float: left;
    font-size: 20px;
    line-height: 0;
    font-weight: 500;
    font-style: normal;
    color: #333;
    padding-left: 18%;
    text-align: left;
}
.rgt_hd{
   font-size: 20px;
    line-height: 1;
    color: #203f7c;
    font-weight: 500;
    font-style: normal;
  }
  .mt33{margin-top:33px;}
  .mt33 ul{padding-left: 15px;}
  .mt33 ul li{padding-bottom: 10px;}
  .pd_btm{padding-bottom: 20px;}
  .input_bx{    height: 40px;
    border-radius: 0px;}
  .btn_bk{height: 40px;
    background: #fdb813;
    border-radius: 0px;}
  .navbar-inverse {
  background-color: #203f7c;
  border-color: #203f7c;}
  .navbar{margin-bottom: 0px;}
  .navbar-inverse .navbar-nav>li>a {
    color: #fff;
}
.navbar-nav>li {padding: 0px 15px;display: inline-flex;}
.ab li.active a {
    background: #ffffff00!important;
    border-bottom: 3px solid #fdb813;
}
.ab li a:hover{border-bottom: 3px solid #fdb813;}
.sec3ss{color:#fff;}
.pd20{padding: 20px;}
.brdr_rgt{border-right:1px solid;height: 150px;}
h3, h1{  margin-top: 20px;
    margin-bottom: 10px;}
p {margin: 0 0 10px;}
</style>
</head>
   <body>
      <!-- Navigation -->
      <?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
      <div class="clearfix"></div>

<div class="col-md-12" style="padding-top: 20px; background: #203f7c; color:#fff;">
  <div class="container">
    <div class="head_sec">
        <h1><center>24/7 go Support & Help</center></h1>
        <h4><center>We are here to help, Manage your booking or raise concern against your booking</center></h4><br>
        <div class="col-md-12 pd_btm">
            <div class="col-md-2"></div>
            <div class="col-md-3">
              <input type="text" class="form-control input_bx">
            </div>
            <div class="col-md-1">
              <h4><center>and</center></h4>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control input_bx">
            </div>
            <div class="col-md-3">
              <button class="btn btn_bk">Go To Your Booking</button>
            </div>
      </div>
    </div>

  </div>
<div class="container">
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
   
    <div>
      <div class="  " id="myNavbar">
        <ul class="nav navbar-nav ab">
          <li class="active"><a href="#sec1" > <i class="fa fa-ticket" aria-hidden="true"></i> &nbsp
 My Bookings</a></li>
          <li><a href="#sec2"><i class="fa fa-comments-o" aria-hidden="true"></i>
 &nbsp Frequently Asked Questions</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav> 
</div>

</div>

<div class="col-md-12" id="sec1" style="background: #f3f3f3;">
  <div class="container">
     <h1><center>24/7 go Support & Help</center></h1>
     <h4><center>We are here to help, Manage your booking or raise concern against your booking</center></h4><br>
  </div>
</div>

<div class="col-md-12" id="sec2">
<div class="container">

<h3><i class="fa fa-comments-o" aria-hidden="true" style="color: #203f7c;"></i> &nbsp Frequently Asked Questions</h3>

<div class="tab">
  <span class="topic_hd">Topics</span>
        <ul>
            <li class="tablinks" onclick="openCity(event, 't1')" id="defaultOpen">Account Settings <i class="fa fa fa-angle-right"></i></li>
            <li class="tablinks" onclick="openCity(event, 't2')">Payments & Refund <i class="fa fa fa-angle-right"></i></li>
            <li class="tablinks" onclick="openCity(event, 't3')">UPI Payments <i class="fa fa fa-angle-right"></i></li>
        </ul>
</div>

<div id="t1" class="tabcontent">
  <span class="rgt_hd">Account Settings</span>
  <div class="mt33">
    <ul>
      <li>How can I create a Tripglobo Account?</li>
      <li>Updating Email and Mobile number</li>
      <li>Subscription & Notification Settings</li>
      <li>How to activate my Tripglobo account?</li>
      <li>How can I create a Tripglobo Account?</li>
      <li>Updating Email and Mobile number</li>
      <li>Subscription & Notification Settings</li>
      <li>How to activate my Tripglobo account?</li>
    </ul>
  </div>
</div>

<div id="t2" class="tabcontent">
  <span class="rgt_hd">Payments & Refund</span>
  <div class="mt33">
    <ul>
      <li>How can I create a Tripglobo Account?</li>
      <li>Updating Email and Mobile number</li>
      <li>Subscription & Notification Settings</li>
      <li>How to activate my Tripglobo account?</li>
    </ul>
  </div> 
</div>

<div id="t3" class="tabcontent">
  <span class="rgt_hd">UPI Payments</span>
  <div class="mt33">
    <ul>
      <li>How can I create a Tripglobo Account?</li>
      <li>Updating Email and Mobile number</li>
      <li>Subscription & Notification Settings</li>
      <li>How to activate my Tripglobo account?</li>
    </ul>
  </div>
</div>

</div>
</div>

<div class="col-md-12" style="background: #203f7c; padding: 15px 0px;">
  <div class="container">

    <div class="col-md-4">
      <div class="sec3ss brdr_rgt pd20">
        <center>
          <h3 style="margin-top: 0px;">Reach out to us</h3>
          <img src="https://www.goibibo.com/styleguide/images/supportImg.png" width="80px">
        </center>
      </div>
    </div>
    <div class="col-md-4">
       <div class="sec3ss pd20 brdr_rgt">
          <center>
           <p> Let us know<br>
          what you need help for</p>
          <button class="btn btn_bk">Chat with us</button>
          </center>
        </div>
    </div>
    <div class="col-md-4">
       <div class="sec3ss pd20">
          <center>
            <p>Still having a trouble, just write to the management , and we will make sure that we help you on priority</p>
            <button class="btn btn_bk">Chat with us</button>
          </center>
        </div>
    </div>

  </div>
</div>

 <div class="clearfix"></div>
 <?php echo $this->load->view(PROJECT_THEME.'/new_theme/comonfooter'); ?>

<script>
$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#myNavbar a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});
</script>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>
