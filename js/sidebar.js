$(document).ready(function() {


    setInterval(refreshChatBox, 10000);
   
    // function sending message
    function refresh_status()
    {
        $.post( 'ajax/refresh_status_user.php',{},function(data){
                //set delay for append users to container
                    $('.main-panel').children('.row').children('.col-md-4').remove();
                    $('.main-panel').children('.row').prepend(data);

            });
    }

    function refreshChatBox()
    {
        refresh_status();
    }

});