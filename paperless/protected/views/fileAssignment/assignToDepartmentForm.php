<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'file-assignment-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    )); ?>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Assign File #<?php echo $file->id; ?></h6>
                </div>
                <div class="card-body">
                    <?php if (Yii::app()->user->hasFlash('success')): ?>
                        <div class="border-bottom-success ">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (Yii::app()->user->hasFlash('error')): ?>
                        <div class="border-bottom-danger ">
                            <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>
                    <?php endif; ?>


                    <div class="form-group row">
                        <div class="col-sm-6">
                            <?php echo $form->labelEx($fileAssignment, 'department_id'); ?>
                            <?php echo $form->dropDownList($fileAssignment, 'department_id', Department::getAllDepartments(), array(
                                'empty' => 'Select Department',
                                'class' => 'form-control',
                                'id' => 'departmentDropdown',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => $this->createUrl('account/getAccountsByDepartment'),
                                    'dataType' => 'json',
                                    'update' => '#employeeDropdown',
                                    'data' => array('department_id' => 'js:this.value'),
                                ),
                            )); ?>
                            <?php echo $form->error($fileAssignment, 'department_id'); ?>
                        </div>

                        <div class="col-sm-6">
                            <?php echo $form->labelEx($fileAssignment, 'receiver_id'); ?>
                            <?php echo $form->dropDownList($fileAssignment, 'receiver_id', array(), array(
                                'empty' => 'Select Employee',
                                'class' => 'form-control',
                                'id' => 'employeeDropdown',
                            )); ?>
                            <?php echo $form->error($fileAssignment, 'receiver_id'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <?php echo $form->labelEx($fileAssignment, 'remarks'); ?>
                            <?php echo $form->textField($fileAssignment, 'remarks', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
                            <?php echo $form->error($fileAssignment, 'remarks'); ?>
                        </div>

                        <div class="col-sm-6">
                            <?php echo $form->labelEx($fileAssignment, 'status'); ?>
                            <?php echo $form->dropDownList(
                                $fileAssignment,
                                'status',
                                array(
                                    '1' => 'Returned',
                                    '2' => 'Rejected',
                                    '3' => 'Passed',
                                    '4' => 'Approved',
                                ),
                                array('class' => 'form-control')
                            ); ?>
                            <?php echo $form->error($fileAssignment, 'status'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="ml-auto mr-1">
                                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>', $this->createAbsoluteUrl('fileAssignment/assignFiles'), array('class' => 'btn btn-danger btn-icon-split', 'onclick' => 'return confirm("Are you sure you want to cancel assigning a file?")')); ?>
                            </div>
                            <div>
                                <?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("file-assignment-form").submit();', array('class' => 'btn btn-success btn-icon-split')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>


<?php
Yii::app()->clientScript->registerScript('updateDropdowns', "
    $(document).ready(function () {
        console.log('Document ready'); 
        // Event handler for the department dropdown
        $('#departmentDropdown').on('change', function () {
            var selectedDepartmentId = $(this).val();
            console.log('Selected Department ID: ' + selectedDepartmentId);
            updateEmployees(selectedDepartmentId);
        });

        // Event handler for the employee dropdown
        $('#employeeDropdown').on('change', function () {
            var selectedEmployeeId = $(this).val();
            console.log('Selected Employee ID: ' + selectedEmployeeId);
        });

        // Form submission handling
        $('#file-assignment-form').submit(function (event) {
            // Check if the department is selected
            var selectedDepartmentId = $('#departmentDropdown').val();

            if (!selectedDepartmentId) {
                // Display an error message or handle as needed
                console.log('Department cannot be blank.');
                event.preventDefault(); // Prevent form submission
            }

            // Continue with the form submission
            // Add your additional logic here if needed
        });
    });

    function updateEmployees(selectedDepartmentId) {
        $.ajax({
            type: 'POST',
            url: '" . Yii::app()->createUrl('account/getAccountsByDepartment') . "',
            data: { 'department_id': selectedDepartmentId },
            dataType: 'json',
            success: function (data) {
                $('#employeeDropdown').html(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    }
");
?>