<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas" style="min-height: 2038px;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <!--<div class="pull-left image">
                <img alt="User Image" class="img-circle" src="img/avatar3.png">
            </div> -->
            <div class="pull-left info">
                <p>Hello, <?php echo $this->user_session['uname'];?></p>

                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- search form -->
        <?php /*<form class="sidebar-form" method="get" action="#">
            <div class="input-group">
                <input type="text" placeholder="Search..." class="form-control" name="q">
                <span class="input-group-btn">
                    <button class="btn btn-flat" id="search-btn" name="seach" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>*/ ?>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?=get_active_tab("dashboard")?>">
                <a href="<?=admin_path()."dashboard"?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>


            <?php

                if (@in_array("users",@array_keys(config_item('user_role')[$this->user_session['role']] ) ) || $this->user_session['role'] == 'a') {
            ?>
                <li class="<?=get_active_tab("users")?>">
                    <a href="<?=admin_path()."users"?>">
                        <i class="fa fa-dashboard"></i> <span>Users</span>
                    </a>
                </li>
            <?php
                }
            ?>


            <?php
                if (@in_array("dealer", @array_keys(config_item('user_role')[$this->user_session['role']])) || $this->user_session['role'] == 'a') {
            ?>
                <li class="<?=get_active_tab("dealer")?>">
    				<a href="<?=admin_path()."dealer"?>">
                        <i class="fa fa-dashboard"></i> <span>Dealer</span>
                    </a>
                </li>
			<?php
                }
            ?>


            <?php
                if (@in_array("category", @array_keys(config_item('user_role')[$this->user_session['role']])) || $this->user_session['role'] == 'a') {
            ?>
                <li class="<?=get_active_tab("category")?>">
                    <a href="<?=admin_path()."category"?>">
                        <i class="fa fa-dashboard"></i> <span>Category</span>
                    </a>
                </li>
            <?php
                }
            ?>


            <?php
                if (@in_array("deal", @array_keys(config_item('user_role')[$this->user_session['role']])) || $this->user_session['role'] == 'a') {
            ?>
                <li class="<?=get_active_tab("deal")?>">
    				<a href="<?=admin_path()."deal"?>">
                        <i class="fa fa-th"></i> <span>Deal</span>
                    </a>
                </li>
            <?php
                }
            ?>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
