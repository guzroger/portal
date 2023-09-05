<div class="topbar-main">
    <div class="container-fluid">

        <!-- Logo container-->
        <div class="logo">
            <!-- Text Logo -->
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="logo">
                <span class="logo-small"><img src="<?php echo Yii::app()->baseUrl;?>/images/cmt_icon.png" height="35" /></span>
                <span class="logo-large"><img src="<?php echo Yii::app()->baseUrl;?>/images/cmt_logo.png" height="35" /></span>
            </a>
            <!-- Image Logo -->
            <!--<a href="index.html" class="logo">-->
            <!--<img src="<?php echo Yii::app()->theme->baseUrl;?>/assets/images/logo_dark.png" alt="" height="24" class="logo-lg">-->
            <!--<img src="<?php echo Yii::app()->theme->baseUrl;?>/assets/images/logo_sm.png" alt="" height="24" class="logo-sm">-->
            <!--</a>-->

        </div>
        <!-- End Logo container-->


        <div class="menu-extras topbar-custom">

            <ul class="list-inline float-right mb-0">

                <li class="menu-item list-inline-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>
                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect" onclick="jQuery('.loader_div').show();" href="<?php echo Yii::app()->createUrl('groups/directory'); ?>" data-toggle="tooltip" data-placement="bottom" title="Directorio de Funcionarios">
                        <i class="fa fa-address-book-o fa-lg text-white"></i>
                    </a>
                </li>
                <li class="list-inline-item dropdown notification-list">
                    <?php // $this->renderPartial('//options/notification'); ?>
                </li>

                <li class="list-inline-item dropdown notification-list">
                    <?php $this->renderPartial('//options/profile'); ?>
                </li>

            </ul>
        </div>
        <!-- end menu-extras -->

        <div class="clearfix"></div>

    </div> <!-- end container -->
</div>
<!-- end topbar-main -->
