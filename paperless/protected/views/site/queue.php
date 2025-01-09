<!-- Your existing HTML and styles -->
<!DOCTYPE HTML>

<body class="d-flex flex-column">
  <main class="flex-shrink-0">
    <!-- Page content-->
    <section class="py-5">
      <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
          <div class="text-center py-3">
            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-1-square"></i></div>
            <h1 class="fw-bolder">Queue</h1>
            <!-- <p class="lead fw-normal text-muted mb-0">Please print your queue number</p> -->
          </div>
          <div class="left-side">
            <div class="col-md-10 offset-md-1">
              <div class="">
                <div class="">
                  <div class="container-fluid">
                    <div class="">
                      <!-- Add any additional content you need for the view -->
                    </div>
                    <br>
                    <div class="card">
                      <div class="card-header bg-primary text-white">
                        <h3 class="text-center py-2"><b>Now Serving</b></h3>
                      </div>
                      <div class="card-body">
                        <?php if ($latestQueue !== null) : ?>
                        <h1 class="text-center" id="name"><?= $latestQueue->queue->queue_no ?></h1> <!-- Change here -->
                        <hr class="divider">
                        <h2 class="text-center" id="window"><?= $latestQueue->queue_counter ?></h2>
                        <hr class="divider">
                        <?php else : ?>
                        <p class="text-center">No queue data available.</p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

          <script>
            $(document).ready(function() {
              setInterval(function() {
                $.ajax({
                  url: '<?php echo $this->createUrl("site/getQueue"); ?>',
                  method: "POST",
                  data: {
                    ajax_request: 1
                  },
                  success: function(resp, textStatus, xhr) {
                    console.log('Response:', resp);

                    try {
                      resp = JSON.parse(resp);
                      if (resp.data) {
                        console.log('Queue No from JSON:', resp.data.queue_no); // Change here
                        console.log('Queue Counter from JSON:', resp.data.queue_counter);

                        // Update HTML elements
                        $('#name').html(resp.data.queue_no); // Change here
                        $('#window').html(resp.data.queue_counter);
                        // Add additional code to handle other properties if needed
                      } else {
                        console.log('No data in the response.');
                      }
                    } catch (e) {
                      console.error('Error parsing JSON:', e);
                    }
                  },
                  error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                  }
                });
              }, 5000);
            });

          </script>
