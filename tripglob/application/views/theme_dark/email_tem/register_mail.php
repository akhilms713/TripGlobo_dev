<!DOCTYPE html>
<?php //debug($user_data);exit(); ?>
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
                                    <td style="background: #f9f8f8;">
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
                                                                    <td style="font-family: Arial, Helvetica, sans-serif;  margin-top: 15px;float: right;font-size: 17px;color: #5a5c5d;" align="left">
                                                                        <?=@$data['header']?>
                                                                    </td>
                                                                   
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
                                                    <td style="font-family: Arial, Helvetica, sans-serif; line-height: 20px; font-size: 13px; color: #676767; padding-left: 16px; padding-right: 16px;">
                                                        <span style="font-family: Arial, Helvetica, sans-serif; color: #0f1858; font-size: 14px;"><?php echo str_replace('{%%USERNAME%%}',$user_data->user_name ,$data['content']->header_content); ?> </span><br>                                                        
                                                            
                                                        <p><?=@$data['content']->email_body?></p>
                                                        
                                                            
                                                      
                                                    </td>
                                                </tr>
                                                <?php if ($data['content']->type == 'FORGET_PASSWORD') {?>
                                                  <td style="padding: 8px 10px;height: 36px;background: #193960c4;float: left;margin-left: 33%;color: #ffffff" align="center"><a style="color: #ffffff;border:#193960c4; text-decoration: none; font-size: 14px" href="<?=$reset_link?>" target="_blank" rel="noreferrer">Click here to reset your password</a></td>
                                                <?php }elseif ($data['content']->type == 'USER_CONFIRMAIOTN_LINK') {?>
                                                    <td style="padding: 8px 10px;height: 36px;background: #193960c4;float: left;margin-left: 33%;color: #ffffff" align="center"><a style="color: #ffffff;border:#193960c4; text-decoration: none; font-size: 14px" href="<?php echo $confirm_link ?>" target="_blank" rel="noreferrer">Click here to confirm your account</a></td>
                                               <?php    }else{ 
                                                $user_data_email = explode('::', $data['content']->table_content);
                                                $user_unique_id= str_replace('{%%USERID%%}',$user_data->user_unique_id, $user_data_email[array_search('{%%USERID%%}', $user_data_email)]) ;
                                                $email= str_replace('{%%EMAILID%%}',$user_data->user_email_id, $user_data_email[array_search('{%%EMAILID%%}', $user_data_email)]) ;
                                                 $otp= str_replace('{%%OTP%%}',$email_opt_number, $user_data_email[array_search('{%%OTP%%}', $user_data_email)]) ;
                                                // debug($full_name);exit();
                                                ?>
                                                <tr><td height="28"></td></tr>
                                                <tr>
                                                    <td>
                                                        <table style="background: #d3d3d3; color: #343434; font-size: 13px; font-family: Arial, Helvetica, sans-serif;" width="100%" cellspacing="1" cellpadding="1" border="0">
                                                            <tbody>
                                                                
                                                                
                                                                 <?php if(!empty($user_unique_id)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">TripGlobo ID :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=ucwords(@$user_unique_id)?></td>
                                                                </tr>
                                                                <?php }?>                                                                
                                                                <?php if(!empty($email)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Email Id :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$email?></td>
                                                                </tr>
                                                                <?php }?>
                                                                <?php if(!empty($otp)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">OTP :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$otp?></td>
                                                                </tr>
                                                            <?php }?>
                                                             
                                                            
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
                                                        <?=@$data['content']->support_content?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="40px"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 15px; padding-right: 15px; font-weight: bold; line-height: 20px; font-size: 13px; font-family: Arial, Helvetica, sans-serif;">
                                                       <?=@$data['content']->fooder_content?><br />
                                                        <!-- Registration &amp; Sales Team, --><br />
                                                       <p><?=@$data['footer']?></p>
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
