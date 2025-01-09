<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'account-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation' => true,
		'htmlOptions'=>array(
		'class'=>'user',
		),
	));
  	?>

  	<p class="note">Fields with <span class="required">*</span> are required.</p>

  	<?php echo $form->errorSummary(array($account,$user)); ?>

	<div class="form-group row">
		<div class="col-sm-3">
			<img id="photo-preview" src="#" alt="Preview" style="max-width: 100%; height: auto; display: block; margin: auto;">
			<br />
			<?php echo $form->labelEx($user, 'photo'); ?>
			<?php 
				echo $form->fileField($user, 'photo', array(
					'class' => 'form-control',
					'id' => 'photo-input',
					'onchange' => 'previewPhoto(this)',
					'style' => 'padding-bottom: 35px;'
				)); 
			?>
		</div>

		<div class="col-sm-9">
			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'username'); ?>
					<?php echo $form->textField($account,'username', array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'password'); ?>
					<?php echo $form->passwordField($account,'password', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'retypepassword', array('label' => 'Retype Password')); ?>
					<?php echo $form->passwordField($account,'retypepassword',array('size'=>60,'maxlength'=>255, 'class'=>'form-control', 'id' => 'new-password')); ?>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'account_type'); ?>
					<?php echo $form->DropdownList($account, 'account_type', array('' => 'Select Account Type', '1' => 'Admin', '2' => 'City Official', '3' => 'Department Head', '4' => 'Employee' ), array('class' => 'form-control', 'value' => '')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account, 'position'); ?>
					<?php echo $form->dropDownList($account, 'position_id', Position::getAllPositions(), array('empty' => 'Select Position', 'class'=>'form-control', 'id' => 'positionDropdown')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'department'); ?>
					<?php echo $form->dropDownList($account, 'department_id', Department::getAllDepartments(), array('empty' => 'Select Department', 'class' => 'form-control', 'id' => 'departmentDropdown',  'value' => $account->department_id)); ?>
				</div>
			</div>
			
			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'status'); ?>
					<?php echo $form->DropdownList($account, 'status', array('' => 'Select Status', '1' => 'Active', '2' => 'Deleted', '3' => 'Locked'), array('class' => 'form-control', 'value' => '')); ?>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'firstname', array('label' => 'First Name')); ?>
					<?php echo $form->textField($user,'firstname', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'middlename', array('label' => 'Middle Name')); ?>
					<?php echo $form->textField($user,'middlename', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'lastname', array('label' => 'Last Name')); ?>
					<?php echo $form->textField($user,'lastname', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'qualifier', array('label' => 'Qualifier (Jr., Sr., III)')); ?>
					<?php echo $form->textField($user,'qualifier', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($account,'email_address'); ?>
					<?php echo $form->textField($account,'email_address', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
				<?php echo $form->labelEx($user,'dob'); ?><br />
				<?php //echo $form->textField($model,'dob',array('size'=>60,'maxlength'=>128));
					$form->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $user,		
					//'attribute' => 'DOB',
					'name' => 'User[dob]',
					'value' => ($user->dob!=''&&$user->dob!='0000-00-00')?date('F d,Y', strtotime($user->dob)):null,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=> 'MM dd,yy',
						'changeMonth'=>'true',
						'changeYear'=>'true',
						'yearRange'=>(date('Y')-80).':'.(date('Y')-18),
					),
					'htmlOptions'=>array(
						'class'=>'form-control',
						//'tabindex'=>'15',
					),
					));
				?> 
				</div>
			</div>

			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'gender'); ?>
					<?php echo $form->DropdownList($user, 'gender', array('' => 'Select Gender', '1' => 'Male', '2' => 'Female'), array('class' => 'form-control', 'value' => '')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'local_address', array('label' => 'Local Address (House No., Street)')); ?>
					<?php echo $form->textField($user,'local_address', array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'region'); ?>
					<?php echo $form->dropDownList($user, 'region_id', Region::getAllRegions(), array(
            			'empty' => 'Select Region',
						'class' => 'form-control',
						'ajax' => array(
							'type' => 'POST',
							'url' => Yii::app()->controller->createUrl('user/updateProvinces'),
							'dataType' => 'json',
							'data' => array('region_id' => 'js:this.value'),
							'success' => 'function(data) {
								$("#User_province_id").html(data.dropDownProvinces);
								$("#User_city_id").html("<option value=\"\">Select City</option>");
								$("#User_barangay_id").html("<option value=\"\">Select Barangay</option>");
							}',
           				 ),
        			)); ?>
				</div>
    		</div>
			
			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'province'); ?>
					<?php echo $form->dropDownList($user, 'province_id', array(), array(
						'empty' => 'Select Province',
						'class' => 'form-control',
						'ajax' => array(
							'type' => 'POST',
							'url' => Yii::app()->controller->createUrl('user/updateCities'),
							'dataType' => 'json',
							'data' => array('province_id' => 'js:this.value'),
							'success' => 'function(data) {
								$("#User_city_id").html(data.dropDownCities);
								$("#User_barangay_id").html("<option value=\"\">Select Barangay</option>");
							}',
						),
					)); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'city'); ?>
					<?php echo $form->dropDownList($user, 'city_id', array(), array(
						'empty' => 'Select City',
						'class' => 'form-control',
						'ajax' => array(
							'type' => 'POST',
							'url' => Yii::app()->controller->createUrl('user/updateBarangays'),
							'update' => '#User_barangay_id',
							'data' => array('city_id' => 'js:this.value'),
						),
					)); ?>
				</div>
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'barangay', array('id' => 'selectedBarangayId')); ?>
					<?php echo $form->dropDownList($user, 'barangay_id', array(), array(
						'empty' => 'Select Barangay',
						'class' => 'form-control',
					)); ?>
				</div>
    		</div>

			<div class="form-group row">
				<div class="col-sm-4 mb-4 mb-sm-0">
					<?php echo $form->labelEx($user,'zip_code'); ?>
					<?php echo $form->textField($user,'zip_code', array('size'=>60,'maxlength'=>128, 'class'=>'form-control')); ?>
				</div>
			</div>
			
			<div class="form-group row">
    			<div class="col-sm-12 d-flex justify-content-end">
					<div class="ml-auto mr-1">
						<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-times"></i></span><span class="text">Cancel</span>',$this->createAbsoluteUrl('account/listAccount'), array('class'=>'btn btn-danger btn-icon-split', 'onclick'=>'return confirm("Are you sure you want to cancel creating an account?")')); ?>
					</div>
					<div>
						<?php echo CHtml::link('<span class="icon text-white-50"><i class="fas fa-user-check"></i></span><span class="text">Save</span>', 'javascript:document.getElementById("account-form").submit();', array('class'=>'btn btn-success btn-icon-split')); ?>
					</div>
    			</div>
			</div>

		</div>	
	</div>
	
	<?php $this->endWidget(); ?>
	
</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript('updateDropdowns', "
	$(document).ready(function () {
		// Event handler for the department dropdown
		$('#departmentDropdown').on('change', function () {
			var selectedDepartmentId = $(this).val();
			console.log('Selected Department ID: ' + selectedDepartmentId);
		});

		// Event handler for the position dropdown
		$('#positionDropdown').on('change', function () {
			var selectedPositionId = $(this).val();
			console.log('Selected Position ID: ' + selectedPositionId);
		});

		// Form submission handling
		$('#account-form').submit(function (event) {
			// Check if both position and department are selected
			var selectedDepartmentId = $('#departmentDropdown').val();
			var selectedPositionId = $('#positionDropdown').val();

			if (!selectedDepartmentId || !selectedPositionId) {
				// Display an error message or handle as needed
				console.log('Position and Department cannot be blank.');
				event.preventDefault(); // Prevent form submission
			}

			// Continue with the form submission
			// Add your additional logic here if needed

		});
	});
");
?>

<script>

	//For Photo Preview
	function previewPhoto(input) {
		var preview = document.getElementById('photo-preview');

		if (input.files && input.files[0]) {
			var file = input.files[0];
			var reader = new FileReader();

			// Check if the file type is allowed
			var allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
			if (allowedTypes.includes(file.type)) {
				reader.onload = function (e) {
					preview.src = e.target.result;
				};

				reader.readAsDataURL(file);
			} else {
				alert('Please select a valid image file (PNG, JPG, or JPEG).');
				input.value = ''; // Clear the input to allow selecting another file
			}
		} else {
			var defaultImage = '<?php echo Yii::app()->request->baseUrl . "/images/default-image.png"; ?>';
			preview.src = defaultImage;
		}
	}

	// Call previewPhoto initially to display the default image
	previewPhoto(document.getElementById('photo-input'));

</script>

<?php
Yii::app()->clientScript->registerScript('updateProvinces', "
    $('#" . CHtml::activeId($user, 'region_id') . "').change(function(){
        $.ajax({
            type:'POST',
            url:'" . Yii::app()->createUrl('user/updateProvinces') . "',
            data:{'region_id':$(this).val()},
            dataType:'json',
            success:function(data){
                $('#" . CHtml::activeId($user, 'province_id') . "').html(data.dropDownProvinces);
                $('#" . CHtml::activeId($user, 'city_id') . "').html('<option value=\"\">Select City</option>');
                $('#" . CHtml::activeId($user, 'barangay_id') . "').html('<option value=\"\">Select Barangay</option>');
            }
        });
    });

    $('#" . CHtml::activeId($user, 'province_id') . "').change(function () {
        $.ajax({
            type: 'POST',
            url: '" . Yii::app()->createUrl('user/updateCities') . "',
            dataType: 'json',
            data: { 'province_id': $(this).val() },
            success: function (data) {
                $('#" . CHtml::activeId($user, 'city_id') . "').html(data.dropDownCities);
                $('#" . CHtml::activeId($user, 'barangay_id') . "').html('<option value=\"\">Select Barangay</option>');
            }
        });
    });

	$('#" . CHtml::activeId($user, 'city_id') . "').change(function () {
        console.log('City dropdown changed');

		$.ajax({
            type: 'POST',
            url: '" . Yii::app()->createUrl('user/updateBarangays') . "',
            dataType: 'json',
            data: { 'city_id': $(this).val() },
            success: function (data) {
                // Change this to the actual ID of your Barangay dropdown
                var dropdown = $('#selectedBarangayId');

                // Clear existing options and append the 'Select Barangay' option
                dropdown.html('<option value=\"\">Select Barangay</option>');

                // Iterate over the received data and append each option
                $.each(data, function (index, barangay) {
                    dropdown.append('<option value=\"' + barangay.value + '\">' + barangay.name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
");