<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View File #<?php echo $model->id; ?></h6>
            </div>
            <div class="card-body">
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
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo $model->id; ?></td>
                        </tr>
                        <tr>
                            <th>Record Number</th>
                            <td><?php echo $model->record_num; ?></td>
                        </tr>
                        <tr>
                            <th>Uploader</th>
                            <td><?php echo $model->uploaderUser->getFullname($model->uploaderUser->account_id);?></td>
                        </tr>
                        <tr>
                            <th>Original Filename</th>
                            <td><?php echo $model->original_filename; ?></td>
                        </tr>
                        <tr>
                            <th>File Extension</th>
                            <td><?php echo $model->file_extension; ?></td>
                        </tr>
                        <tr>
                            <th>E Filename</th>
                            <td><?php echo $model->e_filename; ?></td>
                        </tr>
                        <tr>
                            <th>File Path</th>
                            <td><?php echo $model->file_path; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php
                                    $fileStatus = $model->getFileStatus($model->id);
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
