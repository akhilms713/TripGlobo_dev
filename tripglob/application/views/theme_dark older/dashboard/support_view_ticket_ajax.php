 
<div class="chatrow">
<div class="chaterimage">
<img src="<?php echo $user_details->profile_picture; ?>" alt="" />
</div>
<div class="chaterdetail">
<div class="chatip"></div>
<div class="insidechat">
	<div class="chatername"><?php echo $user_details->user_name; ?></div>
    <div class="chattime"><span class="icon icon-clock"></span><?php echo $this->support_model->calculate_time_ago($ticket->last_update_time); ?></div>
    <div class="chatermsg">
	<?php echo $ticket->message; ?>
	<?php
	if($ticket->file_path!=''){
	$file = strtr(base64_encode('admin-panel/'.$ticket->file_path),array('+' => '.','=' => '-','/' => '~'));
	$a = explode('support_ticket', $ticket->file_path);
	 $name1 = substr($a[1],2);
	?>
	    <p><a  href="<?php echo base_url(); ?>dashboard/download_file/<?php echo $file; ?>"><i class="icon-paper-clip"></i> Download The Attachment <?php echo $name1; ?></a>  </p>
	<?php } ?>
    </div>
</div>
</div>
</div>