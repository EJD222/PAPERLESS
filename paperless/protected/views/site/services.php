<?php
/* @var $this QueueController */
/* @var $model Queue */
/* @var $form CActiveForm */
?>

<div class="form">

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Page content-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5 py-3">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-check2-square"></i></div>
                        <h1 class="fw-bolder">Service Request Form</h1>
                        <p class="lead fw-normal text-muted mb-0">Please provide the requested information</p>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <!-- Your PHP Form -->
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'queue-form',
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => false,
                            )); ?>
                            
                            <?php echo $form->errorSummary(array($queue, $department)); ?>

                            <!-- Department Dropdown-->
                            <div class="form-group">
                                <?php echo $form->labelEx($department, 'id', array('label' => 'Department')); ?>
                                <?php echo $form->dropDownList($department, 'id', Department::getAllDepartments(), array(
                                    'empty' => 'Select Department',
                                    'class' => 'form-control',
                                    'id' => 'departmentDropdown',
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => $this->createUrl('transaction/getTransactionsByDepartment'),
                                        'dataType' => 'json',
                                        'update' => '#transactionDropdown',
                                        'data' => array('department_id' => 'js:this.value'),
                                    ),
                                )); ?>
                                <?php echo $form->error($department, 'id'); ?>
                            </div>

                            <!-- Transaction Dropdown -->
                            <div class="form-group">
                                <?php echo $form->labelEx($queue, 'transaction_id'); ?>
                                <?php echo $form->dropDownList($queue, 'transaction_id', array(), array(
                                    'empty' => 'Select Transaction',
                                    'class' => 'form-control',
                                    'id' => 'transactionDropdown',
                                )); ?>
                                <?php echo $form->error($queue, 'transaction_id'); ?>
                            </div>

                            <!-- Type Dropdown-->
                            <div class="form-group">
                                <?php echo $form->labelEx($queue, 'type'); ?>
                                <?php echo $form->dropDownList($queue, 'type',
                                    array(
                                        1 => 'Regular',
                                        2 => 'PWD',
                                        3 => 'Pregnant',
                                        4 => 'Senior Citizen',
                                    ),
                                    array('class' => 'form-control')
                                ); ?>
                                <?php echo $form->error($queue, 'type'); ?>
                            </div>

                            <!-- Submit Button-->
                            <div class="form-group d-grid">
                                <?php echo CHtml::submitButton($queue->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-lg', 'id' => 'submitButton')); ?>
                            </div>

                            <?php $this->endWidget(); ?>
                            <!-- End of Your PHP Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery.ui')?>
    <?php
    Yii::app()->clientScript->registerScript('updateDropdowns', "
    $(document).ready(function () {
        console.log('Document ready'); 

        // Event handler for the department dropdown
        $('#departmentDropdown').on('change', function () {
            var selectedDepartmentId = $(this).val();
            console.log('Selected Department ID: ' + selectedDepartmentId);
            updateTransactions(selectedDepartmentId);
        });

        // Event handler for the transaction dropdown
        $('#transactionDropdown').on('change', function () {
            var selectedTransactionId = $(this).val();
            console.log('Selected Transaction ID: ' + selectedTransactionId);
        });

        // Form submission handling
        $('#queue-form').submit(function (event) {
            // Check if the department and transaction are selected
            console.log('Form submission event triggered');
            var selectedDepartmentId = $('#departmentDropdown').val();
            var selectedTransactionId = $('#transactionDropdown').val();

            if (!selectedDepartmentId || !selectedTransactionId) {
                // Display an error message or handle as needed
                console.log('Department and transaction cannot be blank.');
                event.preventDefault(); // Prevent form submission
            }

            // Continue with the form submission
            // You can access selectedDepartmentId and selectedTransactionId here
            // Add your additional logic here if needed
        });
    });

    function updateTransactions(selectedDepartmentId) {
        $.ajax({
            type: 'POST',
            url: '" . Yii::app()->createUrl('transaction/getTransactionsByDepartment') . "',
            data: { 'department_id': selectedDepartmentId },
            dataType: 'json',
            success: function (data) {
                $('#transactionDropdown').html(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }

    ");
    Yii::app()->clientScript->registerScript('logFormSubmission', "
    $(document).ready(function () {
        $('#queue-form').submit(function () {
            console.log('Form submitted');
        });
    });
");
?>
</script>