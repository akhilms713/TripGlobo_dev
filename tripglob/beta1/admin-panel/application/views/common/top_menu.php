   <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
								<?php
								 $CI = get_instance();
								$CI->load->model('admin_model');
								$id =  $this->session->userdata('admin_id');
								$result =$CI->admin_model->getthe_image($id);								
								if(!empty($result[0]['admin_profile_pic'])){
									$profile_img =$result[0]['admin_profile_pic'];
								}else{
									$profile_img =PROJECT_LOGO;
								}
								
								?>
								
								
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <?php echo $this->session->userdata('admin_name'); ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo WEB_URL; ?>home/profile">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo WEB_URL; ?>home/change_password">
                                           Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo WEB_URL; ?>login/lockoff">Log Off</a>
                                    </li>
                                    <li><a href="<?php echo WEB_URL; ?>login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>                          

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


<script type="text/javascript">
var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 600000); // 1 minute 60000

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime >4) { // 20 minutes
    location.href = "https://tripglobo.com/beta1/admin-panel/login/lockoff";
   
    }
}
</script>   


