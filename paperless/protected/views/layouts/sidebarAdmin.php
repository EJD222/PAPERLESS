<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php $this->createAbsoluteUrl('site/index') ?>">
        <div class="sidebar-brand-icon">
            <img style="max-width: 50px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-v6.png"/>
        </div>
        <div class="sidebar-brand-text mx-3">
            <div>PAPERLESS</div>
            <div style="font-size: 55%; font-weight: 600; color: #fff; margin-top: 2%;">SCAN. SECURE. SERVE.</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <?php echo CHtml::link('<i class="bi bi-speedometer2"></i><span>Dashboard</span>', $this->createAbsoluteUrl('site/index'), array('class'=>'nav-link')); ?>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
       Admin Controls
    </div>

    <!-- Divider -->


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
            <?php echo CHtml::link('<i class="fa-solid fa-user"></i><span>Manage Accounts</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseDoctors', 'aria-expanded'=>'true', 'aria-controls'=>'collapseDoctors')); ?>

            <div id="collapseDoctors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Accounts', $this->createAbsoluteUrl('account/createAccount'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Accounts', $this->createAbsoluteUrl('account/listAccount'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fa-solid fa-building-columns"></i><span>Manage Departments</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePatients', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePatients')); ?>

            <div id="collapsePatients" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Departments', $this->createAbsoluteUrl('department/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Departments', $this->createAbsoluteUrl('department/listDepartment'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fa-solid fa-sitemap"></i><span>Manage Positions</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePositions', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePositions')); ?>
            <div id="collapsePositions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Positions', $this->createAbsoluteUrl('position/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Positions', $this->createAbsoluteUrl('position/listPosition'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-arrow-left-right 2x"></i><span>Manage Transactions</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseTransactions', 'aria-expanded'=>'true', 'aria-controls'=>'collapseTransactions')); ?>

            <div id="collapseTransactions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Transactions', $this->createAbsoluteUrl('transaction/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Transactions', $this->createAbsoluteUrl('transaction/listTransaction'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-1-square-fill"></i><span>Manage Queue</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseQueue', 'aria-expanded'=>'true', 'aria-controls'=>'collapseQueue')); ?>

            <div id="collapseQueue" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Department Queues', $this->createAbsoluteUrl('queue/showQueue'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Control Window Queue', $this->createAbsoluteUrl('windowQueue/showWindowQueue'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="fa-solid fa-file"></i><span>Manage Files</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePrescriptions', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePrescriptions')); ?>

            <div id="collapsePrescriptions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Files', $this->createAbsoluteUrl('file/uploadFile'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Department Files', $this->createAbsoluteUrl('file/departmentFiles'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Assigned Files', $this->createAbsoluteUrl('fileAssignment/assignFiles'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>
    </li>     
    <!-- Nav Item - Login/Logout -->
    <li class="nav-item">
        <?php if(Yii::app()->user->isGuest): ?>
            <?php echo CHtml::link('<i class="bi bi-door-open"></i><span>Login</span>', $this->createAbsoluteUrl('site/login'), array('class'=>'nav-link')); ?>
        <?php else: ?>
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span>
            </a>
        <?php endif; ?>
    </li>

    <!-- Logout Modal -->
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
                    <?php echo CHtml::link('Logout', $this->createAbsoluteUrl('site/logout'), array('class' => 'btn btn-primary')); ?>
                </div>
            </div>
        </div>
    </div>
</ul>
<!-- End of Sidebar -->