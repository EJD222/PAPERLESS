<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="sb-admin-2.css">
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Page content-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-3 py-3">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-search"></i></div>
                        <h1 class="fw-bolder">Track</h1>
                        <p class="lead fw-normal text-muted mb-0">Track your document status</p>
                    </div>

                    <div class="mx-auto text-center">
                        <form class="text-center" action="<?php echo Yii::app()->createUrl('site/search'); ?>" method="post">
                            <div class="form-group d-inline-block">
                                <input type="text" name="record_number" class="form-control" placeholder="Enter a valid record number" required style="width: 300px; height: 40px;">
                            </div>
                            <div class="form-group d-inline-block">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <?php if (isset($_POST['record_number'])) : ?>
                            <h3 class="mt-3">Search Result</h3>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($status !== null) : ?>
                    <?php if (!empty($fileAssignments)) : ?>
                        <div class="table-responsive">
                            <h2 class="mt-4">Tracking Details For <?php echo CHtml::encode($recordNumber); ?></h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date and Time</th>
                                        <th>Status</th>
                                        <th>Department</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fileAssignments as $fileAssignment) : ?>
                                        <tr>
                                            <td><?php echo Yii::app()->dateFormatter->formatDateTime($fileAssignment->date_updated, 'medium', 'short'); ?></td>
                                            <td>
											<?php
												$fileAssignmentStatus = $fileAssignment->getFileAssignmentStatus($fileAssignment->id);
												$badgeClass = '';

												switch ($fileAssignmentStatus) {
													case 'Returned':
														$badgeClass = 'badge-warning';
														break;
													case 'Rejected':
														$badgeClass = 'badge-danger';
														break;
													case 'Passed':
														$badgeClass = 'badge-info';
														break;
													case 'Approved':
														$badgeClass = 'badge-success';
														break;
													default:
														$badgeClass = 'badge-secondary';
														break;
												}
												?>
												<span class="badge rounded-pill <?php echo $badgeClass; ?>">
                                						<?php echo $fileAssignmentStatus; ?>
                            					</span>
											</td>
                                            <td><?php echo $fileAssignment->department->department_name; ?></td>
                                            <td><?php echo $fileAssignment->remarks; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="mt-4">No additional occurrences found.</p>
                    <?php endif; ?>
                <?php elseif (isset($_POST['record_number'])) : ?>
                    <p class="mt-4">No record found</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>