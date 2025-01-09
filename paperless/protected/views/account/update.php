<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	            <h6 class="m-0 font-weight-bold text-primary">Update Account</h6>
	      </div>
	      <div class="card-body">
				<?php echo $this->renderPartial('updateAccount', array('account' => $account, 'user' => $user)); ?>
			</div>
		</div>
		<br/>
	</div>
</div>
<div class = "row">
<div class="col-xl-12 col-lg-12">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	        <h6 class="m-0 font-weight-bold text-primary">List of Accounts</h6>
	    </div>
	    <div class="card-body">
	    	 <div class="table-responsive">
			 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	    	 		<thead>
	                    <tr>
							<th>Account ID</th>
                            <th>Account Type</th>
							<th>Full Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>V</th>
							<th>E</th>
							<th>D</th>
	                    </tr>
	                </thead>
	                <tbody>
						<?php 
							foreach($listOfAccounts as $modelValue)
							{
						?>
								<tr>
									<td><?php echo $modelValue->id;?></td>
                                    <td><?php echo $modelValue->account_type;?></td>
                                    <td><?php echo $modelValue->user->getFullname($modelValue->id);?></td>
                                    <td><?php echo $modelValue->department->department_name;?></td>
                                    <td><?php echo $modelValue->position->position_name;?></td>
                                    <td><?php echo $modelValue->status;?></td>
                                    <?php 
										echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('account/viewAccountAndUser/'.$modelValue->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
		                            	echo "<td>".CHtml::link('<i class="fas fa-edit"></i>', $this->createAbsoluteUrl('account/updateAccount/'.$modelValue->id), array('class'=>'btn btn-success btn-circle btn-sm'))."</td>";
		                            	echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('account/deleteAccount/'.$modelValue->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this account? Deleting this account will delete all data associated with it including unpaid obligations.")'))."</td>";
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
