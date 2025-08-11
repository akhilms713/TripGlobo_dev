<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PROJECT_TITLE; ?> </title>
	<link rel="icon" href="https://tripglobo.com/beta1/assets/theme_dark/images/favicon.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->

    <link href="<?php echo ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo ASSETS; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo ASSETS; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ASSETS; ?>css/icheck/flat/green.css" rel="stylesheet">
   <link type="text/css" rel="stylesheet" href="<?php echo ASSETS; ?>/css/common/toastr.css?1425466569" />

    <script src="<?php echo ASSETS; ?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form class="form form-validate  floating-label" novalidate  accept-charset="utf-8" method="post">
                       <h1><?php echo $this->session->userdata('admin_name'); ?></h1>
                       <div class="col-md-3"></div>
                        <div class="col-md-6">
                              <input class="form-control"   name="pattern"  id="patern" value="0" type="hidden"  required > <div id="patternHolder3"></div>
                        </div>
                        
                        
                        <div class="clearfix"></div>
                        <div class="separator">
					  <div>
                                <h1><i class="fa fa-lock" style="font-size: 26px;"></i> <?php echo PROJECT_TITLE; ?></h1>

                                <p>©2016 All Rights Reserved. <?php echo PROJECT_TITLE; ?></p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            
        </div> <div id="patternHolder3"></div>
    </div>

</body>

</html>
 <script src="<?php echo ASSETS; ?>/js/toastr/toastr.js"></script>
<link href="<?php echo ASSETS; ?>css/common/patternLock.css"  rel="stylesheet" type="text/css" />
<script src="<?php echo ASSETS; ?>js/pattern/patternLock.js"></script>
<script>

var lock6=new PatternLock('#patternHolder3',{
    mapper: function(idx){
		  $(".patt-holder").css("background", "#0aa89e"); 
		  
        return (idx%9);
     },
   onDraw:function(pattern){
    $("#patern").val(pattern);
	
	if($("#patern").val() == 0)
	{
	$(".patt-holder").css("background", "#da3d3d");  
	return false;
	}
	else
	{
		$.ajax({
				url: '<?php echo WEB_URL; ?>login/logoff_pattern/'+pattern,
				
				method: "POST",
				dataType: 'json',
				  beforeSend : function(){
					
				  },
				success: function(result) {
					if(result.status==1)
					{
						toastr.success("Correct Pattern", '');
						window.location = "<?php echo WEB_URL;?>home/index";
					}
					else
					{
						
						toastr.error("Incorrect Pattern", '');

					}
				}
			});	
	
	}

   }
});
function validates()
{


if($("#patern").val() == 0)
{
$(".patt-holder").css("background", "#da3d3d");  

return false;
}
else
{
	
return true;
}

}
<?php 
if(isset($status) && $status != '')
{
	?>
toastr.error("<?php echo $status; ?>", '');
<?php
}
?>
</script>
