<?php
/* @var $this FileController */
/* @var $account Account */
/* @var $user User */

$this->breadcrumbs = array(
    'Account' => array('index'),
    $account->id,
);
?>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">View Account Information #<?php echo $account->id; ?></h6>
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
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email Address</th>
            <th>Account Type</th>
            <th>Department</th>
            <th>Position</th>
            <th>Status</th>
          </tr>
          <tbody>
            <tr>
              <td><?php echo $account->id; ?></td>
              <td><?php echo $account->username; ?></td>
              <td><?php echo $account->email_address; ?></td>
              <td><?php echo $account->getAccountType($account->id); ?></td>
              <td><?php echo $account->department->department_name; ?></td>
              <td><?php echo $account->position->position_name; ?></td>
              <td>
                <?php
                  $accountStatus = $account->getAccountStatus($account->id);
                  $badgeClass = '';

                  switch ($accountStatus) {
                    case 'Active':
                      $badgeClass = 'badge-primary';
                      break;
                    case 'Locked':
                      $badgeClass = 'badge-secondary';
                      break;
                    case 'Deleted':
                      $badgeClass = 'badge-warning';
                      break;
                  }
                ?>
                <span class="badge rounded-pill <?php echo $badgeClass; ?>">
                  <?php echo $accountStatus; ?>
                </span>
						  </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="file-view">


  <?php if ($user): ?>
  <!-- User Information section -->
  <div class="row">
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">View User Information #<?php echo $user->id; ?></h6>
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
                <td><?php echo $user->id; ?></td>
              </tr>
              <tr>
                <th>Account ID</th>
                <td><?php echo $user->account_id; ?></td>
              </tr>
              <tr>
                <th>First Name</th>
                <td><?php echo $user->firstname; ?></td>
              </tr>
              <tr>
                <th>Middle Name</th>
                <td><?php echo $user->middlename; ?></td>
              </tr>
              <tr>
                <th>Last Name</th>
                <td><?php echo $user->lastname; ?></td>
              </tr>
              <tr>
                <th>Qualifier</th>
                <td><?php echo $user->qualifier; ?></td>
              </tr>
              <tr>
                <th>Date of Birth</th>
                <td><?php echo $user->dob; ?></td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo $user->getGender($user->id); ?></td>
              </tr>
              <tr>
                <th>Local Address</th>
                <td><?php echo $user->local_address; ?></td>
              </tr>
              <tr>
                <th>Barangay</th>
                <td><?php echo $user->barangay->barangay_name; ?></td>
              </tr>
              <tr>
                <th>City</th>
                <td><?php echo $user->getCityName(); ?></td>
              </tr>
              <tr>
                <th>Province</th>
                <td><?php echo $user->region->region_name; ?></td>
              </tr>
              <tr>
                <th>Region</th>
                <td><?php echo $user->province->province_name; ?></td>
              </tr>
              <tr>
                <th>Zip Code</th>
                <td><?php echo $user->zip_code; ?></td>
              </tr>
            </tbody>
          </table>



        </div>
        <?php else: ?>
        <p>No user information available.</p>
        <?php endif; ?>
      </div>
