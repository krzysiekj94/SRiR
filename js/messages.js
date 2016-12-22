$(document).ready(function() {

    var countActualMessage = $('.message').length;

    // event click button send
	$('#sendMessageButton').click(function(){

        var messageContent = $('#messageContent').val();
        sending_messages(messageContent);
        setPositionScrollBottom();

	});

    // event enter key after send message
    $('#messageContent').bind("enterKey",function(e){
    
        var messageContent = $('#messageContent').val();
        sending_messages(messageContent);
        setPositionScrollBottom();

    });
    $('#messageContent').keyup(function(e){

        if(e.keyCode == 13 && $(this).val() != "")
        {
            $(this).trigger("enterKey");
        }

    });
   
    // function sending message
    function sending_messages(contentMessage)
    {
        countActualMessage++;

        $.post( 'ajax/sending_messages.php',
         { 
            'contentMessage': contentMessage},
            
            function(data){
                //set delay for append users to container
                
                $("#historyContent").append(data);
                $('#messageContent').val("");

            });
    }

    setInterval(get_messages, 2000);

    function get_messages()
    {

         $.post( 'ajax/loading_new_messages.php', {'countActualMessage': countActualMessage }, function(data){
                
                
                var str = data
                if(!(jQuery.trim( str )).length==0)
                 {
                    $("#historyContent").append(data);
                    setPositionScrollBottom();
                 }

                var len = $.grep($.parseHTML(data), function(el, i) {
                     return $(el).hasClass("message")
                }).length;

                 countActualMessage += len;
            });
    }

    // set position scroll bottom
    setPositionScrollBottom();

    function setPositionScrollBottom()
    {
        var height = 0;
        $('#historyContent').children().each(function(i, value){
            height += parseInt($(this).height());
        });

        height += '';

        $('#historyContent').animate({scrollTop: height*2});
    }

});