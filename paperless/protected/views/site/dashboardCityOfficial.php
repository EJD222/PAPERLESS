<style>
    /* Custom styles for FullCalendar */
    #calendar {
        height: 500px;
    }
</style>

<!-- Dashboard Section -->
<div class="row">
    <div class="col-xl-12 mb-4">
        <!-- Welcome Header -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
            </div>
            <div class="card-body">
                <h1 class="h3 mb-0 font-weight-bold text-gray-800" style="font-size: 50px;">Welcome to PAPERLESS,
                    <?php
                    if (!Yii::app()->user->isGuest) {

                        $userId = Yii::app()->user->id;
                        $userModel = User::model()->findByPk($userId);

                        if ($userModel !== null) {
                            $username = $userModel->account->username;
                            echo $username;
                        }
                    }
                    ?>
                </h1>
                <p>PAPERLESS stands for Public Administration Platform for Efficient Records and Local Electronic System
                    Streamlined. It is a comprehensive CMS application that combines record management, document tracking, and a queuing
                    system, designed to streamline administrative processes and improve efficiency in public administration settings.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Count Section -->
<div class="row">
    
    <!-- Department Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Departments
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalDepartmentCount ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-building-columns fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- File Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Department Files
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalFileCount ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-file fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assigned Files Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Assigned Files
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $getAssignedFileTallyForUser ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-file-export fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Count -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Accounts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalAccountCount ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Calendar Section -->
<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Calendar</h6>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<!-- Tally Section -->
<div class="row">
    <div class="col-xl-6 mb-4">
        <!-- Department Employees Tally -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Department Employees Tally</h6>
            </div>
            <div class="card-body">
                <?php foreach ($departmentTally as $departmentInfo => $percentage) : ?>
                    <h4 class="small font-weight-bold"><?php echo $departmentInfo; ?> <span class="float-right"><?php echo $percentage; ?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage; ?>%"
                            aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Positions Tally Section -->
    <div class="col-xl-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Positions Tally</h6>
            </div>
            <div class="card-body">
                <?php foreach ($positionTally as $positionInfo => $percentage) : ?>
                    <h4 class="small font-weight-bold"><?php echo $positionInfo; ?> <span class="float-right"><?php echo $percentage; ?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage; ?>%"
                            aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<!-- Calendar Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content dynamically inserted here -->
            </div>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css' />
<script src='https://cdn.jsdelivr.net/npm/moment/min/moment.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek,listDay'
            },
            initialView: 'dayGridMonth',
            views: {
                timeGridWeek: { // customize options for the timeGridWeek view
                    titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
                    // Add more customization options if needed
                },
                listWeek: { buttonText: 'list week' }, // customize the button text for listWeek view
            },
            events: '<?php echo $this->createUrl("site/EventsDocSec"); ?>',
            eventClick: function(info) {
                const date = moment(info.event.start).format('MMMM DD, YYYY');
                const time = moment(info.event.start).format('h:mm A');
                const patientName = info.event.extendedProps.patientName;
                // Build the content for the modal
                const modalContent = `
                    <div class="modal-header">
                        <h5 class="modal-title">Event Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Event:</strong> ${info.event.title}</p>
                        <p><strong>Description</strong> ${info.event.extendedProps.desc}</p>
                        <p><strong>Date:</strong> ${date}</p>
                        <p><strong>Time:</strong> ${time}</p>
                        <p><strong>Patient:</strong> ${patientName}</p>
                    </div>
                `;

                // Create a Bootstrap Modal
                const modal = new bootstrap.Modal(document.getElementById('eventModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                // Set the content and show the modal
                document.getElementById('modalContent').innerHTML = modalContent;
                modal.show();
            },
        });
        calendar.render();
    });
</script>