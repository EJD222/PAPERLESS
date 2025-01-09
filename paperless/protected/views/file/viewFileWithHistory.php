<?php
/* @var $this FileController */
/* @var $file File */
/* @var $fileHistory FileHistory[] */

$this->breadcrumbs = array(
    'Files' => array('index'),
    $file->id,
);

?>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View File #<?php echo $file->id; ?></h6>
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
                        <td><?php echo $file->id; ?></td>
                    </tr>
                    <tr>
                        <th>Record Number</th>
                        <td><?php echo $file->record_num; ?></td>
                    </tr>
                    <tr>
                        <th>Uploader</th>
                        <td><?php echo isset($file->uploaderUser) ? $file->uploaderUser->getFullname($file->uploaderUser->account_id) : 'N/A';?></td>
                    </tr>
                    <tr>
                        <th>Original Filename</th>
                        <td><?php echo $file->original_filename; ?></td>
                    </tr>
                    <tr>
                        <th>File Extension</th>
                        <td><?php echo $file->file_extension; ?></td>
                    </tr>
                    <tr>
                        <th>E Filename</th>
                        <td><?php echo $file->e_filename; ?></td>
                    </tr>
                    <tr>
                        <th>File Path</th>
                        <td><?php echo $file->file_path; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php
                                $fileStatus = $file->getFileStatus($file->id);
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

                <div class="form-group row">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <div class="ml-auto mr-1">
                            <!-- Edit button -->
                            <button class="btn btn-success btn-icon-split" onclick="window.location='<?php echo $this->createAbsoluteUrl('file/update/'.$file->id); ?>'" class="btn btn-info btn-circle btn-sm">
                                <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                                <span class="text">Edit</span>
                            </button>

                            <!-- Print button -->
                            <button class="btn btn-info btn-icon-split" onclick="showPrintPopup('<?php echo CHtml::encode($file->record_num); ?>')">
                                <span class="icon text-white-50"><i class="fas fa-print"></i></span>
                                <span class="text">Print</span>
                            </button>
                        </div>

                        <!-- Download button -->
                        <div>
                            <button class="btn btn-primary btn-icon-split" id="download-button" onclick="showDownloadPopup('<?php echo CHtml::encode($file->record_num); ?>', '<?php echo CHtml::encode($file->status); ?>', '<?php echo CHtml::encode($file->file_path); ?>')">
                                <span class="icon text-white-50"><i class="fas fa-download"></i></span>
                                <span class="text">Download</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- File history section -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">File History of File #<?php echo $file->id; ?></h6>
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
            <?php if (!empty($fileHistory)): ?>
        <div class="table-responsive">

                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Parent File ID</th>
                        <th>Uploader</th>
                        <th>Original File Name</th>
                        <th>File Extension</th>
                        <th>Status</th>
                        <th>File Path</th>
                        <th>Delete</th>
                    </tr>
                    <?php foreach ($fileHistory as $historyRecord): ?>
                        <tr>
                            <td><?php echo CHtml::encode($historyRecord->id); ?></td>
                            <td><?php echo CHtml::encode($historyRecord->parent_file_id); ?></td>
                            <td><?php echo CHtml::encode(isset($historyRecord->uploaderUser) ? $historyRecord->uploaderUser->getFullname($historyRecord->uploaderUser->account_id) : 'N/A');?></td>
                            <td><?php echo CHtml::encode($historyRecord->original_filename); ?></td>
                            <td><?php echo CHtml::encode($historyRecord->file_extension); ?></td>
                            <td>
                                <?php
                                    $historyRecordStatus = $historyRecord->getFileStatus($historyRecord->id);
                                    $badgeClass = '';

                                    switch ($historyRecordStatus) {
                                            case 'Active':
                                                $badgeClass = 'badge-primary';
                                                break;
                                            case 'Draft':
                                                $badgeClass = 'badge-warning';
                                                break;
                                            case 'Versioned':
                                                $badgeClass = 'badge-info';
                                                break;
                                            case 'Approved':
                                                $badgeClass = 'badge-success';
                                                break;
                                            case 'Rejected':
                                                $badgeClass = 'badge-danger';
                                                break;
                                            // Add more cases as needed
                                            default:
                                                $badgeClass = 'badge-secondary';
                                                break;
                                    }
                                ?>
                                <span class="badge rounded-pill <?php echo $badgeClass; ?>">
                                    <?php echo $historyRecordStatus; ?>
                                </span>
						    </td>
                        <td><?php echo CHtml::encode($historyRecord->file_path); ?></td>
                        <?php 
                        // echo "<td>".CHtml::link('<i class="fas fa-info-circle"></i>', $this->createAbsoluteUrl('fileHistory/view/'.$historyRecord->id), array('class'=>'btn btn-info btn-circle btn-sm'))."</td>";
                        echo "<td>".CHtml::link('<i class="fas fa-trash"></i>', $this->createAbsoluteUrl('fileHistory/deleteFileHistory/'.$historyRecord->id),array('class'=>'btn btn-danger btn-circle btn-sm', 'onclick'=>'return confirm("Are you sure you want to delete this file?")'))."</td>";
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <p class="mt-3 mx-auto">No file history available.</p>
    <?php endif; ?>

    <!-- Print popup -->
    <!-- <div id="print-popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc; z-index: 1000;">
        <h4>Record Number</h4>
        <p>Your record number is <span id="record-number"></span>.</p>
        <button onclick="printRecord()">Print</button>
        <button onclick="cancelPrint()">Cancel</button>
    </div> -->

    <div id="print-popup" class="modal" tabindex="-1" role="dialog" aria-labelledby="printPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="queueSuccessPopupLabel" style="color: black;">Record Number</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 18px;">Your record number is 
                    <p style="font-weight: bold; font-size: 32px; color: black;"><span id="record-number"></span></p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success bi bi-printer" onclick="printRecord()"> Print</button>
                    <button type="button" class="btn btn-danger bi bi-x" onclick="cancelPrint()"> Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Download popup -->
    <div id="download-popup" class="modal" tabindex="-1" role="dialog" aria-labelledby="downloadPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="queueSuccessPopupLabel" style="color: black;">File Download</h5>
                </div>
                <div class="modal-body text-center">
                    <p id="download-message"></p>
                </div>
                <?php
                if ($file->status == 1) {
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-danger bi bi-x" onclick="cancelDownload()"> Cancel</button>';
                    echo '</div>';
                } elseif ($file->status == 2) {
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-success bi bi-download" onclick="printRecord(downloadFile(' . $file->id . ', \'' . $file->status . '\', \'' . $file->file_path . '\'))"> Download</button>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function showPrintPopup(recordNumber) {
            var printPopup = document.getElementById('print-popup');
            document.getElementById('record-number').innerText = recordNumber;
            printPopup.style.display = 'block';
        }

        function printRecord() {
            console.log('Printing record number: ' + document.getElementById('record-number').innerText);

            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('@media print { body { font-family: "Nunito", sans-serif; } }');
            printWindow.document.write('</style></head><body>');
            printWindow.document.write('<h1 style="text-align: center;">Your Record Number</h1>');
            printWindow.document.write('<h1 style="text-align: center; font-size: 40px; font-weight: bold; margin-top: 20px; text-decoration: underline;">' + document.getElementById('record-number').innerText + '</h1>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            printWindow.print();
            printWindow.close();

            closePrintPopup();
        }

        function closePrintPopup() {
            document.getElementById('print-popup').style.display = 'none';
        }

        function cancelPrint() {
            closePrintPopup();
        }

        function showDownloadPopup(recordNumber, fileStatus, filePath) {
            var downloadPopup = document.getElementById('download-popup');
            var downloadMessage = document.getElementById('download-message');

            if (fileStatus == 2) {
                downloadMessage.innerText = 'File ' + recordNumber + ' can be downloaded.';
                downloadPopup.style.display = 'block';
            } else if (fileStatus == 1) {
                downloadMessage.innerText = 'This file is not ready for download.';
                downloadPopup.style.display = 'block';
            } else {
                downloadMessage.innerText = 'Invalid file status for download.';
                downloadPopup.style.display = 'none';
            }
        }

        function cancelDownload() {
            closeDownloadPopup();
        }

        function closeDownloadPopup() {
            document.getElementById('download-popup').style.display = 'none';
        }

        function downloadFile(fileId, fileStatus, filePath) {
            console.log('Downloading file with ID: ' + fileId);
            const basePath = 'http://localhost/paperless/';  
            const fullPath = basePath + filePath;
            window.open(fullPath, '_blank');
            closeDownloadPopup();
        }
    </script>
</div>