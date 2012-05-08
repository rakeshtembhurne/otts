var intervalId;

$(document).ready(function(){

    timer = function() {
        remainingTime = $('.timer').html();
        remainingTime = remainingTime - 1;

        if (remainingTime < 0)
        {
            clearInterval(intervalId);
            //$('.timer').html('<form id="testTimeOver" method="POST" action="'+window.location+'"><input type="hidden" name="timeOverMessage" value="Time is over" /></form>');
            //$('#testTimeOver').submit();
        }
        else
        {
            $('.timer').text(remainingTime);
            $('#clock').text(Math.floor(remainingTime/60) + ' minutes '+ remainingTime%60 + ' seconds');
        }
    };
    timer();
    intervalId = setInterval('timer()', 1000);
});

