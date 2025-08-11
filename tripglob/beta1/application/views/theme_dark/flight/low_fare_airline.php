<div class="col-sm-2">
			 <a class="allairlines" onClick="show_airline_data('all')"> <label>All Airlines</label></a>
			</div>
			<div class="col-sm-10">
			  <div id="airLinesList" class="carousel slide" data-ride="carousel" data-wrap="false" data-interval="false">
				<!-- Controls -->
				<a class="left carousel-control" href="#airLinesList" role="button" data-slide="prev">
				  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
				  	<div class="item active">
                    <?php
	$val1 = (array)$val;
foreach($val1 as $key=>$vall)
{
	?><a onClick="show_airline_data('<?php echo $key; ?>')">
					  	<div class="list">
							<img src="<?php echo ASSETS; ?>images/airline_logo/<?php echo $key; ?>.gif">
							<div class="carousel-caption">
							  <h5><?php echo $this->flight_model->get_airline_name($key); ?></h5>
							  <label><?php echo $this->display_icon.' '.$vall; ?></label>
							</div>				  		
					  	</div>
				</a>	
                <?php
}
?>
				  	</div>
					
				</div>
				<a class="right carousel-control" href="#airLinesList" role="button" data-slide="next">
				  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
			  </div>
			</div>
            
            
            
                    