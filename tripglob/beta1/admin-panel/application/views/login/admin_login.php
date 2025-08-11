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

<body style="background:#fff;">
    
    <div class="back_gradi">
        <div class="back_gradi_img"></div>
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content1">
                    <div class="admin_logo">
                         <img src="<?php echo WEB_URL?>assets/images/logo.png" alt="">
                    </div><br>
                    <!-- <div class="reltivefligtgo">        <div class="flitfly"></div>        </div> -->
                    <form class="form form-validate  floating-label" onSubmit="return validates();" novalidate action="<?php echo WEB_URL; ?>login " accept-charset="utf-8" method="post">
                    <div class="log_full_bg login_content">
                        <div class="log_form col-sm-6">
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" name="username" required />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" name="password" required /> <input class="form-control"   name="pattern"  id="patern" value="0" type="hidden"  required >
                            </div>
                            <div>
                            <button class="btn btn-default submit" id="loginbtn" type="submit">Login</button>
                           
                                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
    					        <div>
                                    <h1><i class="fa fa-lock" style="font-size: 26px;"></i> <?php echo PROJECT_TITLE; ?></h1>
                                    <p>©<?=date('Y')?> All Rights Reserved. <?php echo PROJECT_TITLE; ?>. Privacy and Terms</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6"><div id="patternHolder3"></div></div>
                    </div>
                  
                    </form>
                    <!-- form -->
               </section>
                <!-- content -->
            </div>
            
        </div>
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
