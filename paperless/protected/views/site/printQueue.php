<!-- success.php -->

<!-- <div id="queue-success-popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc; z-index: 1000;">
    <h4>Queue Number</h4>
    <p>Your queue number is <?//php //echo $queueNumber; ?>.</p>
    <button onclick="printQueue('<?//php// echo $queueNumber; ?>')">Print</button>
    <button onclick="cancelAction()">Cancel</button>
</div> -->

<div id="queue-success-popup" class="modal" tabindex="-1" role="dialog" aria-labelledby="queueSuccessPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="queueSuccessPopupLabel" style="color: black;">Your Queue Number</h5>
            </div>
            <div class="modal-body text-center">
                <p style="font-size: 18px;">Your queue number is 
                <p style="font-weight: bold; font-size: 32px; color: black;"><?php echo $queueNumber; ?></p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success bi bi-printer" onclick="printQueue('<?php echo $queueNumber; ?>')"> Print</button>
                <button type="button" class="btn btn-danger bi bi-x" onclick="cancelAction()"> Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to print the queue number
    function printQueue(queueNumber) {
        // You can implement the logic to trigger the printer here
        // For example, make an AJAX request to a server endpoint that handles printing
        console.log('Printing queue number: ' + queueNumber);
        
        // Open a new window with a printable content
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('@media print { body { font-family: "Nunito", sans-serif; } }');
        printWindow.document.write('</style></head><body>');
        printWindow.document.write('<h1 style="text-align: center;">Your Queue Number</h1>');
        printWindow.document.write('<h1 style="text-align: center; font-size: 40px; font-weight: bold; margin-top: 20px; text-decoration: underline;">' + queueNumber + '</h1>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Trigger the print dialog
        printWindow.print();
        
        // Close the new window after printing
        printWindow.close();

        closePopup();
    }

    // JavaScript function to close the popup
    function closePopup() {
        document.getElementById('queue-success-popup').style.display = 'none';
    }

    // JavaScript function to handle the cancel action
    function cancelAction() {
        // Redirect to site/viewQueue
        window.location.href = '<?php echo Yii::app()->createUrl('/site/viewQueue'); ?>';
    }

    // Display the success popup
    document.getElementById('queue-success-popup').style.display = 'block';
</script>
