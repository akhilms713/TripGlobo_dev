<div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        
                        <a href="<?php echo WEB_URL; ?>" class="site_title"><span><?php echo PROJECT_TITLE; ?></span></a>
                    </div>
                    <div class="clearfix"></div>


                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php echo PROJECT_LOGO; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $this->session->userdata('admin_name'); ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                   <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<?php
$menu_title_v = $this->general_model->get_side_bar_menu('privilege_title');

if(!empty($menu_title_v))
{
	
	for($j=0;$j<count($menu_title_v);$j++)
	{
?>

                        <div class="menu_section">
                            <h3><?php echo $menu_title_v[$j]->privilege_title; ?></h3>
                            <ul class="nav side-menu">
                            <?php
		$menu_module_v = $this->general_model->get_side_bar_menu('privilege_module',$menu_title_v[$j]->privilege_title);
					//echo $this->db->last_query();exit;
							echo '<pre/>';
print_r($menu_module_v);exit;
							for($j=0;$j<count($menu_module_v);$j++)
							{
							?>
						<li><a><i class="fa fa-home"></i> <?php echo $menu_module_v[$j]->privilege_module; ?> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                     <?php
							$menu_module_v1 = $this->general_model->get_side_bar_menu($gdata='',$menu_title_v[$j]->privilege_title,$menu_title_v[$j]->privilege_module);
							for($k=0;$k<count($menu_module_v1);$k++)
							{
							?>
                                        <li><a href="<?php echo WEB_URL; ?>subadmin/view"><?php echo $menu_module_v1[$k]->privilege_sub_module; ?></a>
                                        </li>
                                        <?php
							}
							?>
                                    </ul>
                                </li>
                                
                             <?php
							}
							?>
                                
                                                                
                               
                            </ul>
                        </div>
                    
                    </div>
                    <!-- /sidebar menu -->
<?php
	}
}
?>
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock" href="<?php echo WEB_URL; ?>login/lockoff">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo WEB_URL; ?>login/logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>