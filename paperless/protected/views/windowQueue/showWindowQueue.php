<?php
/* @var $this WindowQueueController */
/* @var $queueDetails array */
?>

<div class = "row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-6">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		        <h6 class="m-0 font-weight-bold text-primary">Control Window Queue</h6>
		    </div>
		    <div class="card-body">
				
<div id="queue-container" class="queues">
    <div id="queue-content" class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 py-3 text-center">
        <!-- Initially show a start message -->
        <p id="start-message">Click "Next" to start the queue.</p>
        <!-- Display the current queue details -->
        <div id="queue-details" style="display:none;">
            <?php if (!empty($queueDetails)) : ?>
                <?php foreach ($queueDetails as $index => $queue) : ?>
                    <?php
                    // Check if a record with the same queue_id already exists
                    $existingRecord = WindowQueue::model()->findByAttributes(['queue_id' => $queue['id']]);
                    if (!$existingRecord) :
                    ?>
                        <strong>Queue ID:</strong> <?php echo $queue['queue_no']; ?><br>
                        <strong>Date Created:</strong> <?php echo $queue['date_created']; ?><br>
                        <strong>Date Updated:</strong> <?php echo $queue['date_updated']; ?><br>
                        <strong>Type:</strong> <?php echo $queue['type']; ?><br>
                        <strong>Status:</strong> <?php echo $queue['status']; ?><br>

                        
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
</div>

    <div class="form-group py-2 text-center">
        <button id="next-button" data-current-index="-1" class="btn btn-success btn-icon-split ml-auto mr-1">
            <span class="icon text-white-50"><i class="fas fa-forward"></i></span>
            <span class="text">Next</span>
        </button>
    </div>

</div>

</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    var queues = <?php echo json_encode($queueDetails); ?>;
    var currentIndex = -1;

    $("#next-button").on("click", function () {
        currentIndex++;

        if (currentIndex === 0) {
            // If it's the first click, hide the start message and show the queue details
            $("#start-message").hide();
            $("#queue-details").show();
        }

        if (currentIndex < queues.length) {
            // Update the content with the next queue details
            displayQueueDetails(queues[currentIndex]);

            console.log('Queue ID before AJAX request:', queues[currentIndex]['id']);
            updateWindowQueue(queues[currentIndex]['id']);
        } else {
            // No more queues
            console.log('No more queues');
            $("#queue-content").html("<p class='text-center py-3'>No more queues.</p>");
            $("#next-button").prop("disabled", true);
        }
    });

// Function to display queue details
function displayQueueDetails(queue) {
    $("#queue-details").html(
        '<div class="text-center">' +
            '<div>' +
                '<div class="display-5 fw-bold">Now Serving</div>' +
                '<span class="display-3 fw-bolder">' + queue['queue_no'] + '</span>' +
            '</div>' +
            '<div class="queue-info mt-3 text-center">' +
            '<hr class="my-3">' + // Divider added here
                '<div><strong>Type:</strong> ' + queue['type'] + '</div>' +
                '<div><strong>Status:</strong> ' + queue['status'] + '</div>' +
            '</div>' +
        '</div>'
    );
}


    // Function to update tbl_window_queue with the details of the next queue
    function updateWindowQueue(queueId) {
        // Make an AJAX request to update the tbl_window_queue
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->createUrl("updateWindowQueue"); ?>',
            data: {
                queueId: queueId,
            },
            success: function (response) {
                if (response.error) {
                    // Handle the error received from the server
                    console.error('Error updating window queue:', response.error);
                } else {
                    // Process the successful response and log details
                    console.log('Window queue updated successfully.');
                    console.log('Details retrieved:', response);
                }
            },
        });
    }
});

</script>