
<div class="col-lg-9 col-md-9" id="messages">
    <div id="placeholder" class="news well">
        <div class="alert alert-info">
            <h1><span class="glyphicon glyphicon-fire"></span>&nbsp;Nachrichten werden geladen</h1>
        </div>
    </div>

</div>

<div class="col-lg-3 col-md-3" id="sidebar">
    <div class="news well" id="upcoming_events">
        <p class="bg-warning"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Nächste Termine:</p>
        <ul>
            <li><b>29.03.2014<br /></b>Internationaler Tag der offenen Hackerspaces</li>
            <li><b>Mittwoch<br /></b>HackMi</li>
            <li><b>24.05.2014<br /></b>SaarCamp</li>
        </ul>
    </div>

    <div class="news well">
        <p class="bg-primary"><span class="glyphicon glyphicon-user">&nbsp;</span>Anwesende:</p>
        <ul id="anwesende">
            <li>User1</li>
            <li>User2</li>
            <li>User2</li>
        </ul>
    </div>
</div>


<script>
    if (typeof (EventSource) !== "undefined")
    {

        var source = new EventSource("<?php echo Yii::app()->createAbsoluteUrl("message/sse/"); ?>");

        source.addEventListener('messages', function(result) {
            if (('#' + result.lastEventId) !== '') {
                $('#messages').prepend('<div id="' + result.lastEventId + '"><div class=" pull-right panel-heading"></div><div class="panel-body"></div></div>');
                var resultData = $.parseJSON(result.data);
                $('#' + result.lastEventId + ' .panel-body').html(resultData.text);
                $('#' + result.lastEventId + ' .panel-heading').html(resultData.created + " (" + result.lastEventId + ")");
                $('#' + result.lastEventId).addClass("panel panel-" + resultData.infotype);
                $('#' + result.lastEventId + " a.embed").oembed(null, {
                    maxWidth: 600,
                    maxHeight: 400,
                    //includeHandle: true,
                    embedMethod: 'auto',
                });

                $('#placeholder').hide();
            }

            console.log(result);
            console.log(result.type + " " + result.lastEventId);

        }, false);

    }
    else
    {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
</script>

