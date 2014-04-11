<?php
/* @var $this MessagesController */
/* @var $model Messages */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'messages-new-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'onsubmit' => "return false;", /* Disable normal form submit */
            'onkeypress' => " if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text'); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<div class="col-lg-12 col-md-12" id="content">
    <div id="txtResult" class=" news well">
        <div id="message" class="alert"></div>
    </div>

    <div id="txtInput" class=" news well ">
        <textarea id="txtContent"  placeholder="Enter text ..." style="width: 100%; height: 300px"> 
        </textarea>

        <button id="txtSubmit" type="button" class="btn btn-primary">Primary</button>


        <script type="text/javascript">
            $('#txtResult').hide();

            $('#txtContent').wysihtml5({
                locale: "de-DE",
                "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": false, //Button which allows you to edit the generated HTML. Default false
                "link": true, //Button to insert a link. Default true
                "image": true, //Button to insert an image. Default true,
                "color": true, //Button to change color of font
                "size": 'md', //Button size like sm, xs etc.
                stylesheets: ["<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap3-wysiwyg5-color.css"]
            });

            $('#txtSubmit').click(function() {
                bshtml = $('#txtContent').val();
                $.ajax({
                    type: "POST",
                    url: '/push/save.php',
                    data: {html: bshtml},
                    success: function(mes, status) {

                        $('#txtInput').hide();
                        $('#txtResult').show();
                        $('#message').addClass('alert-success');
                        $('#message').html(mes.message);

                        console.log(mes);
                        console.log(status);

                    },
                    error: function() {
                        console.log("fehler");
                    }
                });
            });
        </script>

    </div>

</div>
<div class="col-lg-1 col-md-1"></div>

<script type="text/javascript">

    function send()
    {

        var data = $("#messages-new-form").serialize();


        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("message/ajax"); ?>',
            data: data,
            success: function(data) {
                alert(data);
            },
            error: function(data) { // if error occured
                alert("Error occured.please try again");
                alert(data);
            },
            dataType: 'html'
        });

    }

</script>