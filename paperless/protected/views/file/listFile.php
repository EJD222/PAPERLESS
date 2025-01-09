<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">List of Files</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<?php if(Yii::app()->user->hasFlash('success')):?>
					<div class="border-bottom-success ">
						<?php echo Yii::app()->user->getFlash('success'); ?>
					</div>
					<?php endif; ?>
					<?php if(Yii::app()->user->hasFlash('error')):?>
						<div class="border-bottom-danger ">
							<?php echo Yii::app()->user->getFlash('error'); ?>
						</div>
					<?php endif; ?>
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
					<tr>
								<th>ID</th>
						<th>Record Number</th>
								<th>Uploader</th>
						<th>Original File Name</th>
						<th>File Extension</th>
						<th>File Path</th>
								<th>Status</th>
						<th>View</th>
								<th>Assign</th>
								<th>Edit</th>
								<th>Delete</th>
					</tr>
					</thead>
					
						<tbody>
							<?php 
								foreach($listOfFiles as $modelValue)
								{
							?>
									<tr>
										<td><?php echo $modelValue->id;?></td>
										<td><?php echo $modelValue->record_num;?></td>
										<td><?php echo isset($modelValue->uploaderUser) ? $modelValue->uploaderUser->getFullname($modelValue->uploaderUser->account_id) : 'N/A';?></td>
										<td><?php echo $modelValue->original_filename;?></td>
										<td><?php echo $modelValue->file_extension;?></td>
										<td><?php echo $modelValue->file_path;?></td>
										<td>
											<?php
												$fileStatus = $modelValue->getFileStatus($modelValue->id);
												$badgeClass = '';

												switch ($fileStatus) {
														case 'Not Downloadable':
															$badgeClass = 'badge-danger';
															break;
														case 'Downloadable':
															$badgeClass = 'badge-success';
															break;
														// Add more cases as needed
														default:
															$badgeClass = 'badge-secondary';
															break;
												}
											?>
											<span class="badge rounded-pill <?php echo $badgeClass; ?>">
												<?php echo $fileStatus; ?>
											</span>
										</td>

										<?php 
											echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('file/viewFileWithHistory/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
											echo "<td>" . CHtml::link(
												'<i class="fa-solid fa-user-plus"></i>',
												array(
													'fileAssignment/AssignToDepartment',
													'fileId' => $modelValue->id,
													'departmentId' => $modelValue->uploader->department_id,
													'receiverId' => Yii::app()->user->getId(),  // Default to the currently logged-in user if not provided */
												),
												array('class' => 'btn btn-warning btn-circle btn-sm')
											);										
											echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('fileHistory/updateFileHistory/'.$modelValue->id), array('class'=>'btn btn-success btn-circle btn-sm'));
											echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('file/deleteFile/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this file?")'))."</td>";
										?>
									</tr>

							<?php		
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>