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

    <!-- Heading -->
    <div class="sidebar-heading">
       User Management
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-people"></i><span>Manage Accounts</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseDoctors', 'aria-expanded'=>'true', 'aria-controls'=>'collapseDoctors')); ?>

            <div id="collapseDoctors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Accounts', $this->createAbsoluteUrl('account/createAccount'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Accounts', $this->createAbsoluteUrl('account/listAccount'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
       Organization Management
    </div>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-bank"></i><span>Manage Departments</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePatients', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePatients')); ?>

            <div id="collapsePatients" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Departments', $this->createAbsoluteUrl('department/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Departments', $this->createAbsoluteUrl('department/listDepartment'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-diagram-3"></i><span>Manage Positions</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePositions', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePositions')); ?>
            <div id="collapsePositions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Position', $this->createAbsoluteUrl('position/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Positions', $this->createAbsoluteUrl('position/listPosition'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
        Workflow Management
        </div>
        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-arrow-left-right"></i><span>Manage Transactions</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseTransactions', 'aria-expanded'=>'true', 'aria-controls'=>'collapseTransactions')); ?>

            <div id="collapseTransactions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Transactions', $this->createAbsoluteUrl('transaction/create'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('List Transactions', $this->createAbsoluteUrl('transaction/listTransaction'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-1-square"></i><span>Manage Queue</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapseQueue', 'aria-expanded'=>'true', 'aria-controls'=>'collapseQueue')); ?>

            <div id="collapseQueue" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Department Queues', $this->createAbsoluteUrl('queue/showQueue'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Control Window Queue', $this->createAbsoluteUrl('windowQueue/showWindowQueue'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>
        
        <li class="nav-item">
            <?php echo CHtml::link('<i class="bi bi-file-text"></i><span>Manage Files</span>', '', array('class'=>'nav-link collapsed', 'data-toggle'=>'collapse', 'data-target'=>'#collapsePrescriptions', 'aria-expanded'=>'true', 'aria-controls'=>'collapsePrescriptions')); ?>

            <div id="collapsePrescriptions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions:</h6>
                    <?php echo CHtml::link('Add Files', $this->createAbsoluteUrl('file/uploadFile'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Department Files', $this->createAbsoluteUrl('file/departmentFiles'), array('class'=>'collapse-item')); ?>
                    <?php echo CHtml::link('Assigned Files', $this->createAbsoluteUrl('fileAssignment/assignFiles'), array('class'=>'collapse-item')); ?>
                    <?php //echo CHtml::link('View File Histories', $this->createAbsoluteUrl('fileHistory/showFileHistory'), array('class'=>'collapse-item')); ?>
                </div>
            </div>
        </li>
        
        <!-- Heading -->
        <div class="sidebar-heading">
        System Settings
        </div>
        <li class="nav-item">
            <?php echo CHtml::link('<i class="fas fa-fw fa-cog"></i><span>Settings</span></a>', $this->createAbsoluteUrl('account/settings'), array('class'=>'nav-link')); ?>
        </li>
    <!-- Nav Item - Login/Logout -->
    <li class="nav-item">
        <?php if(Yii::app()->user->isGuest): ?>
            <?php echo CHtml::link('<i class="bi bi-door-open"></i><span>Login</span>', $this->createAbsoluteUrl('site/login'), array('class'=>'nav-link')); ?>
        <?php else: ?>
            <?php echo CHtml::link('<i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span>', $this->createAbsoluteUrl('site/logout'), array('class'=>'nav-link')); ?>
        <?php endif; ?>
    </li>
</ul>
<!-- End of Sidebar -->