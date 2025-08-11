<?php $this->load->view('common/header');?>



<?php  

  $language = $this->session->userdata('language');

  if($language){ 

    $this->lang->load('Error_ER', $language); 

  } else { 

    $this->lang->load('Error_ER', 'english');  

  }

?>



<div id="fuornotfour" class="full marintopcnt contentvcr">

    <div class="container">

        <div class="container offset-0">

        	

            <div class="tablwe">

            <div class="col-md-4 celtb">

            	<h2 class="ooops"><?php echo $this->lang->line('ER_404_Oops'); ?></h2>

                

            </div>

            

            <div class="col-md-8 celtb">

            	<div class="fornot">

                	

                	<div class="ercod"><strong>Payment Fail</strong></div>
<span class="erordes"><?php echo $msg;?></span>

                    <span class="erordes">Order No : <?php echo $order_id;?></span>
                </div>

            </div>

            </div>

            

        </div>

    </div>

</div>



<?php $this->load->view('common/footer');?>

<script type="text/javascript">

/*	$(document).ready(function(){

		var windowht = $(window).height();

		$('#fuornotfour').css({'min-height':windowht})

	});*/

</script>

</body>

</html>