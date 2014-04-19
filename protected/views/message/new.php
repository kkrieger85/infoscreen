<?php
/* @var $this MessagesController */
/* @var $model Messages */
/* @var $form CActiveForm */
?>

<div class="col-lg-12 col-md-12" id="messages">
    <div id="txtResult" class=" news well">
        <div id="message" class="alert"></div>
        <button id="newMessage" type="button" class="btn btn-success">Noch eine Nachricht schreiben</button>
        <button id="showInfoscreen" type="button" class="btn">Infoscreen anzeigen</button>
    </div>

    <div id="txtInput" class=" news well ">
        <textarea id="txtContent"  placeholder="Enter text ..." style="width: 100%; height: 300px"> 
        </textarea>

        <button id="txtSubmit" type="button" class="btn btn-primary">Speichern</button>


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
                console.log("Inhalt: " + bshtml);
                $.ajax({
                    type: "POST",
                    url: '<?php echo Yii::app()->createAbsoluteUrl("message/ajax"); ?>',
                    data: {message: bshtml},
                    success: function(mes, status) {
                        if (mes.result) {
                            $('#txtInput').hide();
                            $('#txtResult').show();
                            $('#message').addClass('alert-success');
                            $('#message').html(mes.data);
                        } else {
                            $('.modal-content .alert').html(mes.data);
                            $('.modal-content .alert').addClass('alert-danger');
                            $('#alertBox').modal({keyboard: true})
                            if (mes.model) {
                                console.log("Model: ", mes.model);
                            }
                        }

                        console.log("Mes:", mes);
                        console.log(status);

                    },
                    error: function() {
                        console.log("fehler");
                    }
                });
                $('#newMessage').click(function() {
                    window.location = "<?php echo Yii::app()->createAbsoluteUrl("message/new"); ?>";
                });
                $('#showInfoscreen').click(function() {
                    window.location = "<?php echo Yii::app()->createAbsoluteUrl("message/"); ?>";
                });

            });
        </script>

    </div>

</div>
<div class="col-lg-1 col-md-1"></div>




<!-- Modal -->
<div id="alertBox" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert"></div>

                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>