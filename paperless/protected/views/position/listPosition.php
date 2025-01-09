<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Positions</h6>
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
							<th>Position Name</th>
							<th>Status</th>
							<th>View</th>
							<th>Edit</th>
							<th>Delete</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfPositions as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->id;?></td>
									<td><?php echo $modelValue->position_name; ?></td>
									<td>
										<?php
											$positionStatus = $modelValue->getPositionStatus($modelValue->id);
											$badgeClass = '';

											switch ($positionStatus) {
													case 'Open':
														$badgeClass = 'badge-success';
														break;
													case 'Closed':
														$badgeClass = 'badge-danger';
														break;
													case 'Pending Approval':
														$badgeClass = 'badge-warning';
														break;
													case 'Filled':
														$badgeClass = 'badge-info';
														break;
	
											}
										?>

										<span class="badge rounded-pill <?php echo $badgeClass; ?>">
											<?php echo $positionStatus; ?>
										</span>
									</td>
									<?php 
									echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('position/view/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('position/update/'.$modelValue->id),array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('position/deletePosition/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this position?")'))."</td>";
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
