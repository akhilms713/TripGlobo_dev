<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo PROJECT_TITLE; ?></title>
	<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
	<link href="<?php echo ASSETS; ?>css/flight_result.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>assets/theme_dark/css/index.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/theme_dark/css/main_ff.css" rel="stylesheet" /> 
    
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
   .ui-state-active, .ui-widget-content .ui-state-active{background:#f45f0e !important;}
   .add_anima{animation: shake 0.5s !important;}

  /*----------------*/
  .lablform {
    color: #fff;
    font-size: 14px;
    margin: 0 0 5px;
}
.totlall {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #fff;
    cursor: pointer;
    float: left;
    font-size: 14px;
    height: 45px;
    line-height: 42px;
    padding: 0 10px 0px 35px;
    position: relative;
    width: 100%;
    border-radius: 0px;
    margin-bottom: 10px;
}
.remngwd {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
#flight_form .roomcount {
    max-width: 250px;
}
.roomcount {
    display: none;
    background: none repeat scroll 0 0 #fff;
    border-radius: 3px;
    box-shadow: 0 0 10px -5px #000;
    line-height: normal;
    position: absolute;
    right: 0;
    top: 55px;
    width: auto;
    transition: all 400ms ease-in-out;
    z-index: 10000;
}
.advance_opt {
    width: 100%;
    float: left;
    border-bottom: 1px solid #ddd;
    padding: 0px 4px 12px 0px;
}
.lablform2 {
    margin-top: 6px;
    color: #333;
    padding: 0px 10px !important;
    margin-bottom: 10px;
}
.alladvnce {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px dashed #00a9d6;
    color: #222426;
    cursor: pointer;
    font-size: 13px;
    height: 36px;
    line-height: 36px;
    padding: 0 10px;
    position: relative;
    width: 90%;
    margin: 5px auto;
}
.remngwd {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.advncedown.spladvnce {
    left: 0;
}
.advncedown {
    display: none;
    background: none repeat scroll 0 0 #f8f8f8;
    border: 1px solid #ddd;
    border-radius: 0px;
    line-height: normal;
    position: absolute;
    right: 0;
    top: 106%;
    width: auto;
    transition: all 400ms ease-in-out;
    z-index: 10000;
}
.scroladvc {
    display: block;
    overflow: hidden;
    padding: 10px;
}
.adscrla {
    color: #444;
    display: block;
    overflow: hidden;
    padding: 10px 15px;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 100%;
}
.lablform2 {
    margin-top: 6px;
    color: #333;
    padding: 0px 10px !important;
    margin-bottom: 10px;
}
.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important;
}
.alladvnce .select2.select2-container.select2-container--default {
    width: 100% !important;
}

.select2-container {
    box-sizing: border-box;
    display: inline-block;
    margin: 0;
    position: relative;
    vertical-align: middle;
}
.mobile_adult_icon {
    display: none;
}
.inallsn {
    display: table;
    width: 100%;
}
.oneroom.fltravlr {
}
.oneroom {
    display: table-cell;
    min-width: 250px;
    padding: 14px;
    vertical-align: top;
}
.oneroom.fltravlr .roomrow {
}
.roomrow {
    display: inline-block;
    width: 100%;
    border-bottom: 1px solid #ddd;
}
.oneroom.fltravlr .celroe {
}
.celroe {
    padding: 4px 0px;
    float: left;
    line-height: 31px;
}
.agemns {
    color: #666;
    padding-left: 5px;
    font-size: 11px;
    overflow: hidden;
}
.countmore {
    float: right;
}
.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
}
.roomrow .input-group-btn {
    width: auto;
}

.input-group-btn {
    position: relative;
    font-size: 0;
    white-space: nowrap;
}
.roomrow .form-control {
    border: none !important;
    width: 32px !important;
    box-shadow: none !important;
    padding: 0px !important;
    display: table-cell;
}
.roomrow .btn {
    padding: 5px !important;
    width: auto !important;
    border: 1px solid #00a9d6 !important;
    font-size: 14px !important;
    border-radius: 2px !important;
    background: #00a9d6 !important;
    color: #fff !important;
}
.centertext {
    text-align: center;
}
.done1.comnbtn_room1 {
    background: #359ff4;
    border: medium none;
    color: #ffffff;
    cursor: pointer;
    font-size: 13px;
    margin: 0;
    padding: 10px;
    text-align: center;
    display: none;
}
.flyinputsnor.contr_form {
    color: #333;
    height: 36px;
    border-radius: 0px;
}
</style>
<style type="text/css">
.flex-datess{
  margin-top: 15px;
}
.newcheck{
  width: 100%;
  float: left;
}
.flex-datess .squaredThree {
    float: left;
    margin-right: 8px;
    position: relative;
    width: 20px;
    z-index: 1;
}   
.flex-datess .squaredThree input[type="checkbox"] {
    visibility: hidden;
    margin: 0;
}  
.flex-datess .squaredThree label {
    left: 0;
    position: absolute;
    top: 0;
    background: #3b3b3b none repeat scroll 0 0;
    border: 2px solid #fff;
    cursor: pointer;
    height: 22px;
    width: 22px;
    border-radius: 0px;
}    
.flex-datess .squaredThree input[type="checkbox"]:checked + label {
    background: transparent;
    color: #fff;
}
.flex-datess .squaredThree input[type="checkbox"]:checked + label::after {
    opacity: 1;
    content: "\f00c";
    display: block;
    font-family: fontawesome;
    font-size: 12px;
    font-weight: 100;
    left: 0px;
    right: 0px;
    top: 0px;
    line-height: 18px;
    position: absolute;
    text-align: center;
} 
.lbllbl {
    color: #666666;
    display: block;
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
    margin: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    float: left;
}

.ui-menu .ui-menu-item-with-icon a {
  padding-left: 20px;

}
span.group-item-icon,
span.file-item-icon {
  display: inline-block;
  height: 16px;
  width: 16px;
  margin-left: -16px;
}
span.flight-up-item-icon {
  background: url("https://banner2.kisspng.com/20180414/fcq/kisspng-airplane-icon-a5-computer-icons-flight-airplane-5ad24caf000348.7365708515237316310001.jpg") no-repeat left 4px;
}
span.flight-down-item-icon {
  background: url("/image/icons/product.png") no-repeat left 7px;
}
.swipe_icn{
  color: #007cff;
  font-size: 20px;
  margin: 10px -8px;
}
 /*.tab-content.custmtab {background: #000 !important; }*/ 
@media (min-width: 992px){
.rtn{
  width:22%;
  }
}
</style>
    </head>
    <body>

    	<!-- Navigation -->
    	<?php //echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  		
<!-- Header Carousel -->
	
	<div class="newmodify">
		<div class="container">
			<div class="contentsdw">
				<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 nopad">
					<div class="pad_ten">
						<div class="left_icon sprite marker_icon"></div>
						<div class="from_to_place">
							<h4 class="placename"><?= ($req->type == 'round') ? 'Round Trip' : 'One way' ;  ?></h4>
							<h3 class="contryname"><?= $req->origin .' To '. $req->destination; ?> </h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-xs-6 hidden-sm hidden-xs nopad">
					<div class="col-xs-6 nopad">
						<div class="pad_ten">
							<div class="left_icon sprite calendar_icon"></div>
							<div class="from_to_place">
								<div class="boxlabl">Departure</div>
								<div class="datein">
									<span class="calinn"> <?php echo date('M d,Y' , strtotime( $req->depart_date )); ?> </span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6 nopad <?php if($req->type != 'round') echo 'disabled'; ?>">
						<div class="pad_ten">
							<div class="left_icon sprite calendar_icon"></div>
							<div class="from_to_place">
								<div class="boxlabl">Return</div>
								<div class="datein">
									<?= $return_date =  ($req->type == 'round') ? date('M d,Y' , strtotime( $req->return_date )) : "-- --"; ?><span class="calinn">  </span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 hidden-md hidden-sm hidden-xs nopad">
					<div class="pad_ten">
						<div class="left_icon sprite pasnger_icon"></div>
						<div class="from_to_place">
							<div class="boxlabl textcentr">Passenger(s)</div>
							<div class="countlbl"><?= $req->ADT + $req->CHD + $req->INF; ?></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4 nopad">
					<div class="pad_ten">
						<button class="modifysrch" data-toggle="collapse" data-target="#modify_book"><strong>Modify</strong> <span class="down_caret"></span></button>
					</div>
				</div>
			</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="modify_search_wrap">
	<div class="container">
		<div id="modify_book" class="collapse">

		<?php 		
            $data['product'] 		= 'Flight';
			$data['triptype'] 		= $req->type;
			$origin1 				= $this->Flight_Model->get_airport_name($req->origin);
			$destination1 			= $this->Flight_Model->get_airport_name($req->destination);
			$data['origin'] 		= $origin1.' ('. $req->origin.')';
			$data['destination'] 	= $destination1.' ('. $req->destination.')';
			$data['depart_date'] 	= $req->depart_date;
			$data['return_date'] 	= $req->return_date;
			$data['ADT'] 			= $req->ADT;
			$data['CHD'] 			= $req->CHD;
			$data['INF'] 			= $req->INF;
			$data['class'] 			= $req->class;

            $data['search_id'] = $req->search_id;

     	
			echo $this->load->view(PROJECT_THEME.'/new_theme/search_tabs/flight_search', $data);
		?>
		</div>
	</div>
</div>

<!-- Page Content -->
    <?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
<!-- Script to Activate the Carousel --> 
</body>
</html>
