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
// echo "<pre/>";print_r($overall_booking_reports);die;
 							?> <div id="graph_bar" style="width:100%; height:200px;"></div>
                                    <div class="col-xs-12 bg-white progress_summary">
  <?php 
 
									if($overall_booking_reports!='') {
										for($i=0;$i<count($overall_booking_reports);$i++)
										{
$a  = ($overall_booking_reports[$i]->total_amount / $overall_booking_reports[0]->total_amount)*100;
											
											?>
                                        <div class="row">
                                            <div class="progress_title">
                                                <span class="left"><?php echo $overall_booking_reports[$i]->product_name; ?></span>
                                                <span class="right"><?php echo BASE_CURRENCY_ICON; ?> <?php echo $overall_booking_reports[$i]->total_amount; ?></span>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="col-xs-10">
                                                <div class="progress progress_sm">
                                                    <div class="progress-bar " style=" background-color:#<?php echo $color = $this->home_model->random_color(); ?>" role="progressbar" data-transitiongoal="<?php echo $a; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2 more_info">
                                                <span><?php echo $a; ?>%</span>
                                            </div>
                                        </div>
                                        
                                        <?php
										}
									}
										?>
                                        
                                        
                                        
                                        
                                        

                                    </div>