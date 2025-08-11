<!--<?
$SessionDetails = $this->session->all_userdata();
$hot_id=$SessionDetails['hotel'];
?>
<form class="form-horizontal" action='<? echo BASE_URL();?>index.php/property/hotel_chain_select' name="viewUserdets"  method="post"  id="Change-hotel-form" onSubmit="return validate();" style='max-width:350px;'>
	<div class="form-group">
		<label class="col-md-4 col-xs-4 control-label">Change Hotel<span class="textRed">*</span></label>
		<div class="col-md-8 col-xs-8">
			<select name="hotel" required id="change-hotel-head" class="form-control" title='Please select a hotel'>
					<option value=''>Select Hotel</option>
					<?
					$HotelListQ=mysql_query("SELECT * FROM crs_hotel_supplier_details WHERE supplier_id='$this->entity_user_id'");
					while($HotelListF=mysql_fetch_array($HotelListQ))
					{
						$CHotId=$HotelListF['hotel_id'];
						if($hot_id==$CHotId)
						{?>
							<option value="<?php echo $HotelListF['hotel_id'];?>" selected><?php echo $HotelListF['hotel_name'];?></option>
						<?}
						else
						{?>
							<option value="<?php echo $HotelListF['hotel_id'];?>"><?php echo $HotelListF['hotel_name'];?></option>
						<?}
					}
					?>
			</select>
		</div>
	</div>
	<div class="form-group" style='display:none;'>
			<label class="col-md-2 col-xs-12 control-label"></label>
			<div class="col-md-9 col-xs-12">
				<input type="submit" class='btn btn-primary pull-right' value='Change Hotel' id='change-hotel-submitt' name="change_hotel_submit">
			</div>
	</div>
</form>
<script>
	$('#change-hotel-head').change(function(){
		$('#change-hotel-submitt').click();
	});
</script>

-->
