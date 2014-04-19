<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="de" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" /> <!-- Please use the newest Version of Bootstrap 3.0.X -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/src/bootstrap-wysihtml5.css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/bootstrap3-wysihtml5.js" type="text/javascript"></script>
        <!-- End Bootstrap -->

        <!-- Need this for WYSIWYG -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/locales/bootstrap-wysihtml5.de-DE.js" type="text/javascript"></script>
        <!-- End WYSIWYG -->

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/holder.js"></script>

        <!-- Eigenes CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />


        <!-- jquery.oembed -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.oembed.css" />
        <script src= "<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.oembed.js"></script>
        <!-- end jquery.oembed -->


    </head>

    <body>

        <!--
        <div id="header">
            <div id="logo"><?php //echo CHtml::encode(Yii::app()->name);           ?></div>
        </div><!-- header -->

        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">

                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("message/", array('board'=>1)); ?>">
                            <button type="button" class="btn btn-default navbar-btn">
                                <span class="glyphicon glyphicon-th-list">
                                </span>
                                Infoboard
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("message/", array('board'=>2)); ?>">
                            <button type="button" class="btn btn-default navbar-btn">
                                <span class="glyphicon glyphicon-wrench">
                                </span>
                                Werkstatt
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("message/", array('board'=>3)); ?>">
                            <button type="button" class="btn btn-default navbar-btn">
                                <span class="glyphicon glyphicon-fire">
                                </span>
                                Plenum
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("message/", array('board'=>1337)); ?>">
                            <button type="button" class="btn btn-default navbar-btn">
                                <span class="glyphicon glyphicon-eye-open">
                                </span>
                                Trollette
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl("message/new"); ?>">
                            <button type="button" class="btn btn-primary navbar-btn">
                                <span class="glyphicon glyphicon-pencil">
                                </span>
                                Neue Nachricht
                            </button>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
            ));
            ?><!-- breadcrumbs -->
        <?php endif ?>


        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer">
            Verbesserungsvorschläge? Schick mir eine Mail an <a target="_blank" href="mailto:kkrieger85@gmail.com" >kkrieger85@gmail.com </a><br/>
        </div><!-- footer -->


    </body>
</html>
