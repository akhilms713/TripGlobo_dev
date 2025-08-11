<style type="text/css">
   .add_anima_hotel{animation: shake 0.5s !important;}
</style>

<input type="hidden" id="getUrl1" value="<?php echo $_SERVER['REQUEST_URI']?>">
<div class="tab-pane tab_cus page_bus <?php if(isset($header_product) && $header_product == 'bus') echo 'active'; ?>" id="bus">
      <form autocomplete="off" action="<?php echo WEB_URL ?>bus/search" method="get" name="busSearchForm" id="busSearchForm">
         <!-- <input type="text" value="Bus search" name=""> -->
      </form>
   </div>
<span class="hide">
   <!-- <input type="hidden" id="pri_visible_room" value="<?=$visible_rooms?>"> -->
</span>


<script>
     var getUrl = ($('#getUrl1').val()).split('/');
    //  alert(getUrl[1]);
    if(getUrl[2] != ''){
        if(getUrl[2] != 'bus'){
            if($('.page_bus').hasClass('hide')){
                $('.page_bus').removeClass('hide');
            }    
        }
    }
 </script>