			<?php
		 	
if(isset($user_type))
{
$user_type=$user_type;
}
else
{
	$user_type='';
}

$overall_booking_reports = $this->home_model->overall_booking_reports($user_type);
 							?>
                             		<h4>Products</h4>
                                    <?php 
									if($overall_booking_reports!='') {
										for($i=0;$i<count($overall_booking_reports);$i++)
										{
$a  = ($overall_booking_reports[$i]->product_count / $overall_booking_reports[0]->product_count)*100;
											
											?>
                                    <div class="widget_summary">
                                        <div class="w_left w_25">
                                            <span><?php echo $overall_booking_reports[$i]->product_name; ?></span>
                                        </div>
                                        <div class="w_center w_55">
                                            <div class="progress">
                                                <div class="progress-bar "  role="progressbar" aria-valuenow="<?php echo $a; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $a; ?>%; background-color:#<?php echo $color = $this->home_model->random_color(); ?>">
                                                    <span class="sr-only"><?php echo $a; ?>% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w_right w_20">
                                            <span><?php echo $overall_booking_reports[$i]->product_count; ?></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php
										}
									}
									?>
                                    
                                      
                                    
