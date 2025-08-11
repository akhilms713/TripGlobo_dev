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

            <div class="col-md-6 celtb">

            	<h2 class="ooops"><?php echo $this->lang->line('ER_E_Expiry'); ?></h2>

                <span class="erordes"><?php echo $this->lang->line('ER_E_Cant_Seem'); ?></span>

                <div class="ercod"><?php echo $this->lang->line('ER_E_Timeout'); ?></div>

                <div class="rellinks"><?php echo $this->lang->line('ER_E_Helpful'); ?></div>

                  <div class="erorredrctwrp"><a href="/" class="erorredrct"><?php echo $this->lang->line('ER_E_menu1'); ?></a></div>

              

                <div class="erorredrctwrp"><a href="/" class="erorredrct"><?php echo $this->lang->line('ER_E_menu2'); ?></a></div>

            </div>

            

            <div class="col-md-6 celtb">

            	<div class="fornot">

                	<img width="300" src="<?php echo ASSETS; ?>images/wired_time_bomb_800_clr_12217.png" alt="" />

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