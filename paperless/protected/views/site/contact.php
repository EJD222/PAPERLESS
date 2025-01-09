<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<?php if (Yii::app()->user->hasFlash('contact')) : ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else : ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="container">
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5 py-3">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                        <h1 class="fw-bolder">Contact</h1>
                        <p class="lead fw-normal text-muted mb-0">If you have business inquiries or other questions, feel free to contact us</p>
                    </div>

                    <div>
                        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7702.31464622746!2d120.59087454076933!3d15.14970234762239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f2402dee0d49%3A0x6ccb1574d15b576d!2sAngeles%20University%20Foundation!5e0!3m2!1sen!2sph!4v1704128411734!5m2!1sen!2sph" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <div class="info">
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>Angeles University Foundation (AUF)</p>
                                </div>

                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email:</h4>
                                    <p>paperless@gmail.com</p>
                                </div>

                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>+1 5589 55488 55</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 mt-5 mt-lg-0">
                            <!-- Your PHP Form -->
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'contact-form',
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                            ));
                            ?>			 

                            <div class="row gy-2 gx-md-3">
                                <div class="col-md-6 form-group">
                                    <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Your Name')); ?>
                                    <?php echo $form->error($model, 'name'); ?>
                                </div>
                                <div class="col-md-6 form-group">
                                    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Your Email')); ?>
                                    <?php echo $form->error($model, 'email'); ?>
                                </div>
                                <div class="form-group col-12">
                                    <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => 'Subject')); ?>
                                    <?php echo $form->error($model, 'subject'); ?>
                                </div>
                                <div class="form-group col-12">
                                    <?php echo $form->textArea($model, 'body', array('rows' => 5, 'cols' => 50, 'class' => 'form-control', 'placeholder' => 'Message')); ?>
                                    <?php echo $form->error($model, 'body'); ?>
                                </div>

                                <?php if (CCaptcha::checkRequirements()) : ?>
                                    <div class="form-group row">
                                        <?php echo $form->labelEx($model, 'verifyCode'); ?>
                                        <div>
                                            <?php $this->widget('CCaptcha'); ?>
                                            <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control')); ?>
                                        </div>
                                        <div class="hint">Please enter the letters as they are shown in the image above.<br />Letters are not case-sensitive.</div>
                                        <?php echo $form->error($model, 'verifyCode'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group col-12">
                                    <div class="align left"><?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-lg', 'id' => 'submitButton')); ?></div>
                                </div>
                            </div>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>