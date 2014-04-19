<?php
/* @var $this MessagesController */
/* @var $model Messages */
/* @var $form CActiveForm */
?>

<div class="col-lg-9 col-md-9" id="messages">
    <div id="txtResult" class=" news well">
        <div id="message" class="alert"></div>
        <button id="newMessage" type="button" class="btn btn-success">Noch eine Nachricht schreiben</button>
        <button id="showInfoscreen" type="button" class="btn">Infoscreen anzeigen</button>
    </div>

    <div id="txtInput" class=" news well ">
        <textarea id="txtContent"  placeholder="Enter text ..." style="width: 100%; height: 300px"> 
        </textarea>
    </div>

</div>
<div class="col-lg-3 col-md-3" id="options">
    <div class="form-group" id="board">

        <label for="board">Infoboard</label>
        <select class="form-control">
            <option value="1">Alle</option>
            <option value="2">Werkstatt</option>
            <option value="3">Plenum</option>
            <option value="1337">Trollette</option>
        </select>
    </div>
    <div class="form-group" id="infotype">

        <label for="meldung">Meldung</label>
        <select class="form-control">
            <option value="info">Information</option>
            <option value="warning">Hinweis</option>
            <option value="danger">Wichtig</option>
        </select>
    </div>

    <button id="txtSubmit" type="button" class="btn btn-primary btn-block">Speichern</button>


</div>



<!-- Modal -->
<div id="alertBox" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>


 <script type="text/javascript">
            $('#txtResult').hide();

            $('#txtContent').wysihtml5({
                locale: "de-DE",
                "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": true, //Button which allows you to edit the generated HTML. Default false
                "link": true, //Button to insert a link. Default true
                "image": true, //Button to insert an image. Default true,
                "color": true, //Button to change color of font
                "size": 'md', //Button size like sm, xs etc.
                stylesheets: ["<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap3-wysiwyg5-color.css"]
            });

            $('#txtSubmit').click(function() {
                bshtml = $('#txtContent').val();
                board = $('#board').find(":selected").val();
                infotype = $('#infotype').find(":selected").val();

                $.ajax({
                    type: "POST",
                    url: '<?php echo Yii::app()->createAbsoluteUrl("message/ajax"); ?>',
                    data: {message: bshtml, board: board, infotype: infotype},
                    success: function(mes, status) {
                        if (mes.result === true) {
                            $('#txtInput').hide();
                            $('#txtResult').show();
                            $('#message').addClass('alert-success');
                            $('#message').html(mes.data);
                        } else {
                            $('.modal-content .alert').html(mes.data);
                            $('.modal-content .alert').addClass('alert-danger');

                            $('#alertBox').modal({keyboard: true})

//                            console.log("Fehler: ", mes.data);
//
//                            if (mes.model) {
//                                console.log("Model: ", mes.model);
//                            }
//                            if (mes.postdata) {
//                                console.log("POST: ", mes.postdata);
//                            }
                        }

//                        console.log("Mes:", mes);
//                        console.log(status);

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