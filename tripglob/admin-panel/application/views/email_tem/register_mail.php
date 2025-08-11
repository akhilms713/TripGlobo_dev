<!DOCTYPE html>
<?php //debug($user_data);exit(); ?>
<html>
   <head>
  <meta charset="UTF-8">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="author" content="John Doe">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                                                            src="https://tripglobo.com/assets/theme_dark/images/logo_transparent.png"
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
                                                    <?php if (!empty($user_data->user_name)) {
                                                        $user_name=$user_data->user_name;
                                                    }else{
                                                        $user_name=$user_data->admin_name;

                                                    } ?>
                                                    <td style="font-family: Arial, Helvetica, sans-serif; line-height: 20px; font-size: 13px; color: #676767; padding-left: 16px; padding-right: 16px;">
                                                        <span style="font-family: Arial, Helvetica, sans-serif; color: #0f1858; font-size: 14px;"><?php echo str_replace('{%%USERNAME%%}',$user_name ,$data['content']->header_content); ?> </span><br>                                                        
                                                            
                                                        <p><?php echo str_replace('{%%EMAILID%%}',$user_data->user_email ,$data['content']->email_body);?></p>
                                                        
                                                            
                                                      
                                                    </td>
                                                </tr>
                                                <?php if ($data['content']->type == 'FORGET_PASSWORD') {?>
                                                  <td style="padding: 8px 10px;height: 36px;background: #193960c4;float: left;margin-left: 33%;color: #ffffff" align="center"><a style="color: #ffffff;border:#193960c4; text-decoration: none; font-size: 14px" href="<?=$reset_link?>" target="_blank" rel="noreferrer">Click here to reset your password</a></td>
                                                <?php }elseif ($data['content']->type == 'USER_CONFIRMAIOTN_LINK') {?>
                                                    <td style="padding: 8px 10px;height: 36px;background: #193960c4;float: left;margin-left: 33%;color: #ffffff" align="center"><a style="color: #ffffff;border:#193960c4; text-decoration: none; font-size: 14px" href="<?php echo $confirm_link ?>" target="_blank" rel="noreferrer">Click here to confirm your account</a></td>
                                               <?php    }else {                  
                                                if (!empty($user_data->user_email)) {
                                                    $email_id=$user_data->user_email;
                                                }else{                                                    
                                                    $email_id=$user_data->admin_email;
                                                }
                                                if (empty($email_id)) {
                                                    
                                                    $email_id=$user_data->email;
                                                }
                                                $user_data_email = explode('::', $data['content']->table_content);
                                                foreach ($user_data_email as $key => $value) {
                                                // debug($value);
                                                    if ($value=='{%%USERID%%}') {
                                                          $user_unique_id= str_replace('{%%USERID%%}',$user_data->user_unique_id,$value) ;
                                                    }
                                                    if ($value=='{%%EMAILID%%}') {
                                                          $email= str_replace('{%%EMAILID%%}',$email_id,$value) ;
                                                    }
                                                    if ($value=='{%%URL%%}') {
                                                          $urli= str_replace('{%%URL%%}',$URL,$value) ;
                                                    }
                                                    if ($value=='{%%GROUPID%%}') {
                                                          $GROUPID= str_replace('{%%GROUPID%%}',$group_code,$value) ;
                                                    }
                                                    
                                                }
                                               
                                                ?>
                                                <tr><td height="28"></td></tr>
                                                <tr>
                                                    <td>
                                                        <table style="background: #d3d3d3; color: #343434; font-size: 13px; font-family: Arial, Helvetica, sans-serif;" width="100%" cellspacing="1" cellpadding="1" border="0">
                                                            <tbody>
                                                                 <?php if(!empty($urli)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">URL :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=@$urli?></td>
                                                                </tr>
                                                                <?php }?> 
                                                                
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
                                                                <?php if(!empty($GROUPID)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">GROUP ID :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$GROUPID?></td>
                                                                </tr>
                                                            <?php }?>
                                                             <?php if(!empty($remark)){ ?>
                                                                <tr style="background: #fff;">
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #eeeeee;">Remark :</td>
                                                                    <td style="padding-left: 15px; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; background: #fff;"><?=$remark?></td>
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
