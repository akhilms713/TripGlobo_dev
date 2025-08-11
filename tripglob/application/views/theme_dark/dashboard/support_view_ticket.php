<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/dataTables.tableTools.css">
<link href="<?php echo ASSETS; ?>css/toggle-switch.css" rel="stylesheet" media="screen">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/header'); ?>
  
<div class="clearfix"></div>
<div class="dash-img"> 
</div>
<!--sidebar start-->
<div class="container">
<div class="dashboard_section">
<div class="col-md-12 ">
<aside  class="aside">
  <?php echo $this->load->view(PROJECT_THEME.'/dashboard/top_menu'); ?>
</aside>
<!--sidebar end-->
<div id="appendReply">
<?php 
 
if(!empty($ticket))
{
for($i=0;$i<count($ticket);$i++){

if($ticket[$i]->last_updated_by == 'ADMIN'){

?>
	<div class="chatrow adminchat">
	<div class="chaterimage">
	<img src="<?php echo ASSETS;?>images/user.jpg" alt="" />
	</div>
	<div class="chaterdetail">
	<div class="chatip"></div>
	<div class="insidechat">
		<div class="chatername">View</div>
	    <div class="chattime"><span class="icon icon-clock"></span><?php echo $this->support_model->calculate_time_ago($ticket[$i]->last_update_time); ?></div>
	    <div class="chatermsg">
	    	<?php echo $ticket[$i]->message; ?>
		<?php
		if($ticket[$i]->file_path!=''){
		$file = strtr(base64_encode('admin-panel/'.$ticket[$i]->file_path),array('+' => '.','=' => '-','/' => '~'));
		$a = explode('support_ticket', $ticket[$i]->file_path);
		 $name1 = substr($a[1],2);
		?>
		    <p><a  href="<?php echo WEB_URL; ?>dashboard/download_file/<?php echo $file; ?>"><i class="icon-paper-clip"></i>Download The Attachment <?php echo $name1; ?></a>  </p>
		<?php } ?>
	    </div>
	</div>
	</div>
	</div>
    
    
	
	<?php } else{ 
	
	?>

	<div class="chatrow">
	<div class="chaterimage">
	<img src="<?= base_url()?>photo/users/<?php echo $userInfo->profile_picture; ?>" alt="" width="100" />
	</div>
	<div class="chaterdetail">
	<div class="chatip"></div>
	<div class="insidechat">
		<div class="chatername"><?php echo $userInfo->user_name; ?></div>
	    <div class="chattime"><span class="icon icon-clock"></span><?php echo $this->support_model->calculate_time_ago($ticket[$i]->last_update_time); ?></div>
	    <div class="chatermsg">
		<?php echo $ticket[$i]->message; ?>
		<?php
		if($ticket[$i]->file_path!=''){
		$file = strtr(base64_encode('admin-panel/'.$ticket[$i]->file_path),array('+' => '.','=' => '-','/' => '~'));
		$a = explode('support_ticket', $ticket[$i]->file_path);
		 $name1 = substr($a[1],2);
		?>
		    <p><a  href="<?php echo WEB_URL; ?>dashboard/download_file/<?php echo $file; ?>"><i class="icon-paper-clip"></i> Download The Attachment <?php echo $name1; ?></a>  </p>
		<?php } ?>
	    </div>
	</div>
	</div>
	</div>
	<?php } }
}
	 
	?>
	</div>
    <div class="clear"></div>
    
	<div class="tab-pane" id="addticket">
    <span class="size16 padtabnenopad bold">
    	<span class="tickthed">Reply Ticket</span>
    </span>
	<div class="chaterimage">
		<img src="<?= base_url()?>photo/users/<?php echo $userInfo->profile_picture;?>" alt="" width="100" />
	</div>
    <div class="withedrow">
        <div class="rowit chngecolr">
          <div class="addtiktble">
       
         <form action="<?php echo WEB_URL; ?>dashboard/reply_ticket/<?php echo $id; ?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal' id="addComment">   
 
        <input type="hidden" name="support_ticket_id" value="<?php echo $ticketrow->support_ticket_id; ?>">
            <div class="likrticktsec">
                <div class="cobldo">Attachment</div>
                <div class="coltcnt">
                	<input type="file" name="rfile_name" class="payinput" id="files"> 
                </div>
            </div>
            
            <div class="likrticktsec">
                <div class="cobldo">Message</div>
                <div class="coltcnt">
                	<textarea class="tikttext" name="message" id="replaymess" required ></textarea>
                </div>
            </div>
            
            <div class="likrticktsec">
            	<div class="cobldo">&nbsp;</div>
                <div class="coltcnt">
            	<input type="submit" class="adddtickt" value="Add Ticket">
                </div>
            </div>
            </form>
          </div>
        </div>
    </div>
</div>

</body>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/new_theme/common/load_common_js'); ?>
</html>
<script type="text/javascript">
$(document).ready(function (e) {	
$("#addComment").on('submit',function(e) {
	e.preventDefault();
	$("#viewticktLdr").show();
	var message = $("#replaymess").val();
	if(message){
	var action = $("#addComment").attr('action');
	var data = new FormData(this);
	var files =  document.getElementById('files').files[0];
	$.ajax({
			type: "POST",
			url: action,
			data: new FormData(this),
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false, 
			dataType: "json",
			success: function(data){
			    alert("Reply sent.");
			    location.reload();
		
		});
		return false;
	}else{
		return false;
	}
	});
});
</script>