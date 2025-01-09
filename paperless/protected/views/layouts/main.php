<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PAPERLESS</title>

        <!-- Custom Fonts -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900&display=swap" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Custom Styles -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <?php $isUserLoggedIn = !Yii::app()->user->isGuest; ?>

        <?php if (!$isUserLoggedIn): ?>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" rel="stylesheet">
        <?php endif; ?>
    </head>

    <body>
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php $isUserLoggedIn = !Yii::app()->user->isGuest; ?>
                <?php
                    if (!Yii::app()->user->isGuest) {
                        $loggedInUser = User::model()->findByPk(Yii::app()->user->id);

                        if ($loggedInUser !== null && isset($loggedInUser->account->account_type)) {
                            $accountType = $loggedInUser->account->account_type;

                            switch ($accountType) {
                                case 1:
                                    require('sidebarAdmin.php');
                                    break;
                                case 2:
                                    require('sidebarCityOfficial.php');
                                    break;
                                case 3:
                                    require('sidebarDepartmentHead.php');
                                    break;
                                default:
                                    require('sidebarEmployee.php');
                                    break;
                            }
                        }
                    }
                ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    
                    <!-- Topbar -->
                    <?php if ($isUserLoggedIn): ?>
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <?php endif; ?>
                    
                    <!-- Topbar -->
                    <?php if (!$isUserLoggedIn): ?>
                        <nav class="navbar navbar-expand navbar-light topbar fixed-top shadow" style="background-color: #004160;">
                    <?php endif; ?>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navigation Links -->
                    <?php if (!$isUserLoggedIn): ?>
                        <div class="container px-5">
                            <a class="navbar-brand" href="<?php echo $this->createAbsoluteUrl('site/home'); ?>" style="font-weight: bold; color: white;">PAPERLESS</a>
                            <!-- Uncomment below if you prefer to use an image logo -->
                                <!-- <a class="logo me-auto" href="<?php //echo $this->createAbsoluteUrl('site/home'); ?>">
                                    <img src=
                                        "data:image/png;base64,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" alt="" style="height:45px; width: auto;">
                                </a> -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item"> <?php echo CHtml::link('Home', $this->createAbsoluteUrl('site/home'), array('class'=>'nav-link')); ?> </li>
                                    <li class="nav-item"> <?php echo CHtml::link('Services', $this->createAbsoluteUrl('site/services'), array('class'=>'nav-link')); ?> </li>
                                    <li class="nav-item"> <?php echo CHtml::link('Queue', $this->createAbsoluteUrl('site/viewQueue'), array('class'=>'nav-link')); ?> </li>
                                    <li class="nav-item"> <?php echo CHtml::link('Track', $this->createAbsoluteUrl('site/Search'), array('class'=>'nav-link')); ?> </li>
                                    <li class="nav-item"><a href="home/#about" class="nav-link scrollto">About</a></li>
                                    <li class="nav-item"> <?php echo CHtml::link('Contact', $this->createAbsoluteUrl('site/contact'), array('class'=>'nav-link')); ?> </li>
                                </ul>
                            </div>
                    <?php endif; ?>

                    <!-- Topbar Search -->
                    <?php //if ($isUserLoggedIn): ?>
                    <!-- 
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->
                    <?php //endif; ?>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo User::model()->getFullname(Yii::app()->user->id); ?>
                                </span>
                                <img class="img-profile rounded-circle" src="data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!-- Generator: Adobe Illustrator 25.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) --%3E%3Csvg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 108.3 108.3' style='enable-background:new 0 0 108.3 108.3;' xml:space='preserve'%3E%3Cstyle type='text/css'%3E .st0%7Bfill:%23E6E6E6;%7D .st1%7Bfill:%23FFB8B8;%7D .st2%7Bfill:%23575A89;%7D .st3%7Bfill:%232F2E41;%7D%0A%3C/style%3E%3Cg id='Group_45' transform='translate(-191 -152.079)'%3E%3Cg id='Group_30' transform='translate(282.246 224.353)'%3E%3Cpath id='Path_944' class='st0' d='M17.1-18.1c0,10.5-3,20.8-8.8,29.6c-1.2,1.9-2.5,3.6-4,5.3c-3.4,4-7.3,7.4-11.6,10.3 c-1.2,0.8-2.4,1.5-3.6,2.2c-6.5,3.6-13.7,5.8-21,6.5c-1.7,0.2-3.4,0.2-5.1,0.2c-4.7,0-9.4-0.6-14-1.8c-2.6-0.7-5.1-1.6-7.6-2.6 c-1.3-0.5-2.5-1.1-3.7-1.8c-2.9-1.5-5.6-3.3-8.2-5.3c-1.2-0.9-2.3-1.9-3.4-2.9C-95.8,1.3-97.1-33-76.8-54.9s54.6-23.3,76.5-2.9 C10.8-47.6,17.1-33.2,17.1-18.1L17.1-18.1z'/%3E%3Cpath id='Path_945' class='st1' d='M-50.2-13.2c0,0,4.9,13.7,1.1,21.4s6,16.4,6,16.4s25.8-13.1,22.5-19.7s-8.8-15.3-7.7-20.8 L-50.2-13.2z'/%3E%3Cellipse id='Ellipse_185' class='st1' cx='-40.6' cy='-25.5' rx='17.5' ry='17.5'/%3E%3Cpath id='Path_946' class='st2' d='M-51.1,34.2c-2.6-0.7-5.1-1.6-7.6-2.6l0.5-13.3l4.9-11c1.1,0.9,2.3,1.6,3.5,2.3 c0.3,0.2,0.6,0.3,0.9,0.5c4.6,2.2,12.2,4.2,19.5-1.3c2.7-2.1,5-4.7,6.7-7.6L-8.8,9l0.7,8.4l0.8,9.8c-1.2,0.8-2.4,1.5-3.6,2.2 c-6.5,3.6-13.7,5.8-21,6.5c-1.7,0.2-3.4,0.2-5.1,0.2C-41.8,36.1-46.5,35.4-51.1,34.2z'/%3E%3Cpath id='Path_947' class='st2' d='M-47.7-0.9L-47.7-0.9l-0.7,7.2l-0.4,3.8l-0.5,5.6l-1.8,18.5c-2.6-0.7-5.1-1.6-7.6-2.6 c-1.3-0.5-2.5-1.1-3.7-1.8c-2.9-1.5-5.6-3.3-8.2-5.3l-1.9-9l0.1-0.1L-47.7-0.9z'/%3E%3Cpath id='Path_948' class='st2' d='M-10.9,29.3c-6.5,3.6-13.7,5.8-21,6.5c0.4-6.7,1-13.1,1.6-18.8c0.3-2.9,0.7-5.7,1.1-8.2 c1.2-8,2.5-13.5,3.4-14.2l6.1,4L4.9,7.3l-0.5,9.5c-3.4,4-7.3,7.4-11.6,10.3C-8.5,27.9-9.7,28.7-10.9,29.3z'/%3E%3Cpath id='Path_949' class='st2' d='M-70.5,24.6c-1.2-0.9-2.3-1.9-3.4-2.9l0.9-6.1l0.7-0.1l3.1-0.4l6.8,14.8 C-65.2,28.3-67.9,26.6-70.5,24.6L-70.5,24.6z'/%3E%3Cpath id='Path_950' class='st2' d='M8.3,11.5c-1.2,1.9-2.5,3.6-4,5.3c-3.4,4-7.3,7.4-11.6,10.3c-1.2,0.8-2.4,1.5-3.6,2.2l-0.6-2.8 l3.5-9.1l4.2-11.1l8.8,1.1C6.1,8.7,7.2,10.1,8.3,11.5z'/%3E%3Cpath id='Path_951' class='st3' d='M-23.9-41.4c-2.7-4.3-6.8-7.5-11.6-8.9l-3.6,2.9l1.4-3.3c-1.2-0.2-2.3-0.2-3.5-0.2l-3.2,4.1 l1.3-4c-5.6,0.7-10.7,3.7-14,8.3c-4.1,5.9-4.8,14.1-0.8,20c1.1-3.4,2.4-6.6,3.5-9.9c0.9,0.1,1.7,0.1,2.6,0l1.3-3.1l0.4,3 c4.2-0.4,10.3-1.2,14.3-1.9l-0.4-2.3l2.3,1.9c1.2-0.3,1.9-0.5,1.9-0.7c2.9,4.7,5.8,7.7,8.8,12.5C-22.1-29.8-20.2-35.3-23.9-41.4z' /%3E%3Cellipse id='Ellipse_186' class='st1' cx='-24.9' cy='-26.1' rx='1.2' ry='2.4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E%0A">
                            </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <?php if(Yii::app()->user->isGuest): ?>
                            <!-- If user is not logged in, show the login link -->
                                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('site/login'); ?>">
                                    <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Login
                                </a>
                            <?php else: ?>
                            <!-- If user is logged in, show the profile, settings, and logout links -->
                            <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                </a> -->
                            <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('site/home'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                </a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <?php echo $content; ?>
                    </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span><b>PAPERLESS</b></span><br /><br />
                        <span>Copyright &copy; PAPERLESS 2023.</span><br />
                        <!--<span>Powered by: CASCAN</span>-->
                    </div>
                </div>
            </footer> <!-- End of Footer -->
        
            </div> <!-- End of Content Wrapper -->
        
        </div> <!-- End of Page Wrapper -->
        
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Logout</a>
                </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/chart.js/Chart.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/chart-area-demo.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/chart-pie-demo.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/datatables-demo.js"></script>

    </body>
</html>