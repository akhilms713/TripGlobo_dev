<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <table
            style="background: #fff; border-top: #193960c4 6px solid; border-left: 1px solid #d3d3d3; border-right: 1px solid #d3d3d3; border-bottom: 1px solid #d3d3d3;"
            width="727"
            cellspacing="0"
            cellpadding="0"
            border="0"
            align="center"
        >
            <tbody>
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="background: #f9f8f8; padding-left: 29px; padding-top: 27px; padding-right: 29px; padding-bottom: 27px;">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="background: #f9f8f8; padding-left: 29px; padding-top: 27px; padding-right: 29px; padding-bottom: 27px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="191">
                                                                        <img
                                                                            src="https://tripglobo.com/beta1/assets/theme_dark/images/logo_transparent.png"
                                                                            width="140px;"
                                                                        />
                                                                    </td>
                                                                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #5a5c5d;" align="left">
                                                                        One of the travel leadings wholesaler companies.
                                                                    </td>
                                                                    <td style="color: #6eb9d7; font-family: Arial, Helvetica, sans-serif; font-size: 20px;" align="right"><a href="<?=$url?>" style="text-decoration: none; color: #15285d;" target="_blank"><?=$login_data?></a> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px;">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family: Arial, Helvetica, sans-serif; line-height: 20px; font-size: 13px; color: #676767; padding-left: 16px; padding-right: 16px; padding-top: 20px;">
                                                        <span style="font-family: Arial, Helvetica, sans-serif; color: #0f1858; font-size: 14px;">Dear <?php  if ($first_name) {
                                                          echo ucwords(@$first_name).' '.ucwords($last_name);
                                                        } else{
                                                            echo $full_name;
                                                        }

                                                         ?>,</span><br>                                                        
                                                            
                                                        <p><?=$first_body?></p>
                                                        <?php if (!empty($message)) {?>
                                                        <p><?=ucwords($message)?></p>
                                                            
                                                       <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr><td height="28"></td></tr>
                                                <tr>
                                                    <td>
                                                        <table style="background: #d3d3d3; color: #343434; font-size: 13px; font-family: Arial, Helvetica, sans-serif;" width="100%" cellspacing="1" cellpadding="1" border="0">
                                                            <tbody>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;" width="50%">URL:</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;" width="50%">
                                                                        <a
                                                                            href="<?=$url?>"
                                                                            target="_blank"
                                                                            >
                                                                            <?=$url?>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php if(!empty($first_name)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Username:</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=ucwords(@$first_name).' '.ucwords($last_name)?></td>
                                                                </tr>
                                                                <?php }?>  
                                                                 <?php if(!empty($full_name)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Username:</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=ucwords(@$full_name)?></td>
                                                                </tr>
                                                                <?php }?>                                                                
                                                                <?php if(!empty($email)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Email Id:</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$email?></td>
                                                                </tr>
                                                                <?php }?>
                                                                <?php if(!empty($boookers_pass)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Password :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$boookers_pass?></td>
                                                                </tr>
                                                            <?php }?>
                                                             <?php if(!empty($mobile)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Mobile :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$mobile?></td>
                                                                </tr>
                                                            <?php }?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="28"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="
                                                            padding-left: 15px;
                                                            padding-top: 10px;
                                                            padding-right: 15px;
                                                            padding-bottom: 10px;
                                                            background: #eeeeee;
                                                            font-size: 13px;
                                                            font-family: Arial, Helvetica, sans-serif;
                                                            border: 1px solid #d3d3d3;
                                                        "
                                                    >
                                                        Should you have any query, feel free to contact us at
                                                        <span style="color: #329ac4;"><a href="<?=$support_email_url?>" style="text-decoration: none; color: #329ac4;" target="_blank"><?=$support_email?></a></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="40px"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 15px; padding-right: 15px; font-weight: bold; line-height: 20px; font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
                                                        Thank You,<br />
                                                        <!-- Registration &amp; Sales Team, --><br />
                                                       <a href="<?=$url?>" style="text-decoration: none; color:black;" target="_blank"><b>Boookers.com</b></a> 
                                                        <span style="color: #329ac4;"> - One of the travel leadings wholesaler companies.</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="30px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
