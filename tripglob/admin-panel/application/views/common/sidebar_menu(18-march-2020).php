    <?php
                                     $CI = get_instance();
                                    $CI->load->model('admin_model');
                                
                                //$this->load->model("admin_model");
                                $id =  $this->session->userdata('admin_id');
                                $result =$CI->admin_model->getthe_image($id);
                                $result1=$CI->admin_model->get_admin_details($id);
                                
                                if(!empty($result[0]['admin_profile_pic'])){
                                    $profile_img =$result[0]['admin_profile_pic'];
                                }else{
                                    $profile_img =PROJECT_LOGO;
                                }
                                
                                ?>

<div class="col-md-3 left_col">
                <div class="left_col scroll-view1">

                    <div class="navbar nav_title" style="border: 0;">
                        <!-- <img src="<?php// echo $profile_img; ?>" alt=""> -->

                        <a href="<?php echo WEB_URL; ?>" class="site_title">
                            <!-- <span><?php //echo PROJECT_TITLE; ?></span> -->
                            <img src="<?php echo $profile_img; ?>" width="120px">
                        </a>
                    </div>
                    <div class="clearfix"></div>


                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
						
                            <img src="<?php echo $profile_img; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $result1->admin_name; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                   <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                         <h3>Booking Reports</h3>
                         <ul class="nav side-menu">
                            <li><a href="<?php echo base_url()?>reports/search_report" target="_blank"><i class="fa fa-search"></i>Search</a>
                            <li><a><i class="fa fa-pie-chart"></i> B2C <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="<?php echo base_url()?>reports/flight_b2c_reports" target="_blank"><i class="fa fa-plane"></i>Flight</a>
                                    </li>
                                 <!--     <li><a  href="<?php echo base_url()?>reports/hotel_b2c_reports" target="_blank"><i class="fa fa-bed"></i>Hotel</a>
                                    </li>
                                    <li><a href="<?php echo base_url()?>reports/car_b2c_reports" target="_blank"><i class="fa fa-car"></i>Car</a></li> -->
                                  </ul>
                                </li>   
                                <li><a><i class="fa fa-pie-chart"></i> B2B <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="<?php echo base_url()?>reports/flight_b2b_reports" target="_blank"><i class="fa fa-plane"></i>Flight</a></li>
<!-- 
                                    <li><a  href="<?php echo base_url()?>reports/hotel_b2b_reports" target="_blank"><i class="fa fa-bed"></i>Hotel</a></li>
                                    <li><a href="<?php echo base_url()?>reports/car_b2b_reports" target="_blank"><i class="fa fa-car"></i>Car</a></li> -->
                                  </ul>
                                </li>   
                                <!--<li><a><i class="fa fa-pie-chart"></i> Offline Booking <span class="fa fa-chevron-down"></span></a>-->
                                <!--<ul class="nav child_menu" style="display: none">-->
                                <!--    <li><a href="<?php// echo base_url()?>offline_booking/add_booking" target="_blank"><i class="fa fa-plane"></i>Add Offline Booking</a></li>-->
                                <!--    <li><a href="<?php// echo base_url()?>offline_booking/offline_booking_report" target="_blank"><i class="fa fa-plane"></i>Booking Reports</a></li>-->

                                    
                                <!--  </ul>-->
                                <!--</li>                                   -->
                            </ul>
                        </div>
                   <!-- <div class="menu_section">
                     <ul class="sidebar-menu tree " data-widget="tree">

                       <li class="treeview">
                                      <a><i class="fa fa-book"></i>Booking Reports<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
            
                                        <ul class="treeview-menu">
                                             <li class="treeview"><a><i class="fa fa-area-chart"></i> B2c<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>
                                              
                                                <ul class="treeview-menu">
                                                    <li><a href="<?php echo base_url()?>reports/flight_b2c_reports" target="_blank"><i class="fa fa-plane"></i>Flight</a></li>

                                                    <li><a  href="<?php echo base_url()?>reports/hotel_b2c_reports" target="_blank"><i class="fa fa-bed"></i>Hotel</a></li>
                                                    <li><a href="<?php echo base_url()?>reports/car_b2c_reports" target="_blank"><i class="fa fa-car"></i>Car</a></li>
                                                </ul>

                                            </li>

                                            <li class="treeview"><a><i class="fa fa-area-chart"></i> B2B<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>
                                              
                                                <ul class="treeview-menu">
                                                    <li><a href="<?php echo base_url()?>reports/flight_b2b_reports" target="_blank"><i class="fa fa-plane"></i>Flight</a></li>

                                                    <li><a  href="<?php echo base_url()?>reports/hotel_b2b_reports" target="_blank"><i class="fa fa-bed"></i>Hotel</a></li>
                                                    <li><a href="<?php echo base_url()?>reports/car_b2b_reports" target="_blank"><i class="fa fa-car"></i>Car</a></li>
                                                </ul>

                                            </li>

                                        </ul>


                                    </li>  
                     </ul>
            </div>    -->
<?php
$menu_title_v = $this->general_model->get_side_bar_menu_v1('privilege_title');
// echo "<pre>";
// print_r($menu_title_v);
// exit;
if(!empty($menu_title_v))
{
	
	for($jd=0;$jd<count($menu_title_v);$jd++)
	{
?>

                        <div class="menu_section">
                            <h3><?php echo $menu_title_v[$jd]->privilege_title; ?></h3>
                            <ul class="nav side-menu">
                            <?php
		$menu_module_v = $this->general_model->get_side_bar_menu_v1('privilege_module',$menu_title_v[$jd]->privilege_title);
       
					//echo $this->db->last_query();exit;

							for($j=0;$j<count($menu_module_v);$j++)
							{
							?>
						<li><a><i class="fa fa-<?php echo $menu_module_v[$j]->privilege_icon; ?>"></i> <?php echo $menu_module_v[$j]->privilege_module; ?> <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                     <?php
									// echo $menu_title_v[$j]->privilege_title.'-'.$menu_title_v[$j]->privilege_module;
							$menu_module_v1 = $this->general_model->get_side_bar_menu_v1($gdata='',$menu_title_v[$jd]->privilege_title,$menu_module_v[$j]->privilege_module);
							// echo '<pre/>';
							// print_r($menu_module_v1);
                         //   exit;
							for($k=0;$k<count($menu_module_v1);$k++)
							{
							?>
                                        <li><a href="<?php echo WEB_URL; ?><?php echo $menu_module_v1[$k]->controller_name; ?>/<?php echo $menu_module_v1[$k]->function_name; ?>"><?php echo $menu_module_v1[$k]->privilege_sub_module; ?></a>
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
                    
                  
                    <!-- /sidebar menu -->
<?php
	}
}
// exit();
?>  </div>
                    <!-- /menu footer buttons -->
                <!--     <div class="sidebar-footer hidden-small ">
                        <a data-toggle="tooltip" data-placement="top" title="Settings" class="hide">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen" class="hide">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock" href="<?php echo WEB_URL; ?>login/lockoff">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo WEB_URL; ?>login/logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div> -->
                    <!-- /menu footer buttons -->
                </div>
            </div>
