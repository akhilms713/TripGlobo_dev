<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo PROJECT_TITLE; ?></title>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_css'); ?>
<link href="<?php echo ASSETS; ?>css/dashboard.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="noside">
<!-- Navigation -->
<?php echo $this->load->view(PROJECT_THEME.'/common/header'); ?>
  
<div class="clearfix"></div>
  
<!--main content start-->
<section class="top80 noother">
<section class="wrapper">

<div class="main-chart">
<?php  
if(isset($redirectUrl) && $redirectUrl != "") {
    $currentUrl_f = trim($redirectUrl);
} else {
    $currentUrl_f = WEB_URL.'/dashboard';
}
?>

        <?php  
    $currentUrl = $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : '';
    
    $getUrl = $this->input->get('url');

    if(isset($getUrl) && $getUrl != "") {
        if($currentUrl != '') {
            $redirectUrlArray = explode('url=', $currentUrl);
            $redirectUrl = $redirectUrlArray[1]; //get variable's url value
        } else {
            $redirectUrl = '';
        }
    } else {
        $redirectUrl = '';
    }
    
?>
<div class="twostep withpadd">
    <div class="cenerstepbox">
        <h4 class="twostp">2-step verification</h4>
        <div class="imagemsg"><img src="<?php echo ASSETS;?>images/secqus.png" alt="" /></div>
        <div class="stpnote">Answer the security question below.</div>
        <div class="clearfix"></div>
        <div class="qstn qstn_very">
            <span class="secqstn"><?php echo $security_question->security_question; ?></span>
            <input type="text" id="ans" class="typecodeans" placeholder="" />
            <span style="font-size: small; color: red;" class="errAns"></span>
        </div>
        
        <button type="submit" style="width: 100%" class="fullverify" id="submitAns">Submit</button>
    </div>
</div>
<input type="hidden" value="<?php echo $security_question->security_question; ?>" id="qus" >

</div>

</section>
</section>

<div class="clearfix"></div>





<!-- Page Content -->

<?php echo $this->load->view(PROJECT_THEME.'/common/footer'); ?>
<?php echo $this->load->view(PROJECT_THEME.'/common/load_common_js'); ?>

<!-- Script to Activate the Carousel --> 

<script type="text/javascript">
    $('#submitAns').on('click', function() {
        var qus = $('#qus').val();
        var ansec = $('#ans').val();
        if(ansec && qus) {
            ansec = ansec.trim();
            qus = qus.trim();
            if(ansec.length > 0 && qus.length > 0) {
                $.ajax({
                    url: "<?php echo WEB_URL.'security/checkSecurityAnswer' ?>",
                    method: "POST",
                    data: {'qus': qus, 'ansec': ansec},
                    dataType: "JSON",
                    success: function(r){ 
                        console.log(r.status);
                        if(r.status == 1) {
                            $('.errAns').html('');
                            window.location.href = "<?php echo WEB_URL.'security/loginBySecurityAnswer?url='.$redirectUrl; ?>"
                        } else {
                           $('.errAns').html('The answer did not matched.');
                        }
                    }
                })
            }
        } else {
            $('.errAns').html('Please enter the security answer.');
        }
    })
</script>

</body>
</html>
