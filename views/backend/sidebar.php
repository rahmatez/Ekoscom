<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=user()['user_fullname'];?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <!-- <li class="header">MAIN MENU</li> -->
        <li <?=isset($dashboard) ? 'class="active"':'';?>>
            <a href="<?= base_url('dashboard'); ?>">
                <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url(); ?>" target="_blank">
                <i class="fa fa-eye"></i> <span>VIEW SITE</span>
            </a>
        </li>

        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator' || $this->session->userdata('access') === 'user'): ?>
        <li class="treeview <?=isset($product) ? 'active':'';?>">
            <a href="#">
                <i class="fa fa-pencil-square-o"></i>
                <span>PRODUCT</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li <?=isset($allproduct) ? 'class="active"':'';?>><a href="<?=site_url('product?s=all');?>"><i
                            class="fa fa-angle-double-right"></i> All
                        Product</a></li>
                <li <?=isset($addproduct) ? 'class="active"':'';?>><a href="<?=site_url('product/create');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Add Product</a>
                </li>
                <li <?=isset($category) ? 'class="active"':'';?>><a href="<?=site_url('category');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Category Product</a>
                </li>
                <li <?=isset($image) ? 'class="active"':'';?>><a href="<?=site_url('image');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Image Product</a>
                </li>
            </ul>
        </li>
        <?php endif;?>
        <!-- <li class="treeview <?=isset($media) ? 'active':'';?>">
            <a href="#">
                <i class="fa fa-folder"></i>
                <span>MEDIA</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li <?=isset($library) ? 'class="active"':'';?>><a href="<?=site_url('library');?>"><i
                            class="fa fa-angle-double-right"></i> Library</a>
                </li>
                <li <?=isset($addlibrary) ? 'class="active"':'';?>><a href="<?=site_url('library/addlibrary');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Add New</a></li>
            </ul>
        </li> -->
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator' || $this->session->userdata('access') === 'user'): ?>
        <li <?=isset($transaction) ? 'class="active"':'';?>>
            <a href="<?=base_url('transaction');?>">
                <i class="fa fa-check-square-o"></i> <span>TRANSACTION</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <?php endif;?>
        <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator' || $this->session->userdata('access') === 'user'): ?>
        <li <?=isset($payment) ? 'class="active"':'';?>>
            <a href="<?=base_url('transaction/payment');?>">
                <i class="fa fa-money"></i> <span>PAYMENT</span>
                <span class="pull-right-container">
                </span>
            </a>
        </li>
        <?php endif;?>
        <li class="treeview <?=isset($plugin) ? 'active':'';?>">
            <a href="#">
                <i class="fa fa-desktop"></i> <span>PLUGIN</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li <?=isset($slider) ? 'class="active"':'';?>><a href="<?=site_url('plugin');?>"><i
                            class="fa fa-angle-double-right"></i> Sliders</a>
                </li>
                <li <?=isset($testimoni) ? 'class="active"':'';?>><a href="<?=site_url('plugin/testimoni');?>"><i
                            class="fa fa-angle-double-right"></i> Testimonial</a>
                </li>
                <li <?=isset($kurir) ? 'class="active"':'';?>><a href="<?=site_url('plugin/kurir');?>"><i
                            class="fa fa-angle-double-right"></i> Services</a>
                <li <?=isset($ongkir) ? 'class="active"':'';?>><a href="<?=site_url('plugin/ongkir');?>"><i
                            class="fa fa-angle-double-right"></i> Postal Fee</a>
                </li>
                <li <?=isset($bank) ? 'class="active"':'';?>><a href="<?=site_url('plugin/bank');?>"><i
                            class="fa fa-angle-double-right"></i> Bank Account</a>
                </li>
        </li>
        <!-- <li <?=isset($teamwork) ? 'class="active"':'';?>><a href="<?=site_url('landingpage?p=teamwork');?>"><i
                            class="fa fa-angle-double-right"></i> Team Kerja</a>
                </li>
                <li <?=isset($testimonial) ? 'class="active"':'';?>><a
                        href="<?=site_url('landingpage?p=testimonial');?>"><i class="fa fa-angle-double-right"></i>
                        Testimoni</a></li> -->
    </ul>
    </li>
    <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator'): ?>
    <li <?=isset($alluser) ? 'class="active"':'';?>>
        <a href="<?=base_url('user/alluser');?>">
            <i class="fa fa-users"></i> <span>USERS</span>
        </a>
    </li>
    <!-- <li class="treeview <?=isset($users) ? 'active':'';?>">
            <a href="#">
                <i class="fa fa-users"></i> <span>USERS</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li <?=isset($allusers) ? 'class="active"':'';?>><a href="<?=site_url('user/alluser');?>"><i
                            class="fa fa-angle-double-right"></i> All
                        Users</a></li>
                <li <?=isset($usersgroup) ? 'class="active"':'';?>><a href="<?=site_url('user/usergroup');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Users Group</a>
                </li>
                <li <?=isset($usersaccess) ? 'class="active"':'';?>><a href="<?=site_url('user/useraccess');?>"><i
                            class="fa fa-angle-double-right"></i>
                        Users Access</a>
                </li>
            </ul>
        </li> -->
    <?php endif;?>
    <?php if ($this->session->userdata('access') === 'super_user' || $this->session->userdata('access') === 'administrator'): ?>
    <li class="treeview <?=isset($settings) ? 'active':'';?>">
        <a href="#">
            <i class="fa fa-cog"></i> <span>SETTINGS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li <?=isset($general) ? 'class="active"':'';?>><a href="<?=site_url('settings');?>"><i
                        class="fa fa-angle-double-right"></i>
                    General</a></li>
            <li <?=isset($social_account) ? 'class="active"':'';?>><a
                    href="<?=site_url('settings/social_account');?>"><i class="fa fa-angle-double-right"></i>
                    Social Account</a></li>
            <li <?=isset($company_profile) ? 'class="active"':'';?>><a
                    href="<?=site_url('settings/company_profile');?>"><i class="fa fa-angle-double-right"></i>
                    Company Profile</a></li>
    </li>
    </ul>
    </li>
    <?php endif;?>
    <?php if ($this->session->userdata('access') === 'super_user'): ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> <span>MAINTENANCE</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?=site_url('maintenance/backup_database');?>"><i class="fa fa-angle-double-right"></i>
                    Backup Database</a>
            </li>
            <li><a href="<?=site_url('maintenance/backup_apps');?>"><i class="fa fa-angle-double-right"></i> Backup
                    Apps</a>
            </li>
        </ul>
    </li>
    <?php endif;?>
    <li class="header">UTILITY</li>
    <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs text-red"></i>
            <span>More Settings</span></a></li>
    </ul>
</section>
