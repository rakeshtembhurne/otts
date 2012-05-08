$(function() {
    // Initializing redirect url.
    redirectUrl = null;

    // Function used to calulate url of last reviewed question.
    timer = function() {
        // Calculates url upto controller name.
        var url        = window.location.href;
        var controller = url.indexOf("/tests/");
        var baseUrl    = url.substr(0, controller);
        var lastSlash  = url.lastIndexOf("/");
        var lastParam  = url.substr(lastSlash+1);

        // Gets last question via post method and calculates redirect url
        $.post(
            baseUrl + '/tests/get_last_question',
            function(response) {
                redirectUrl = baseUrl + '/tests/auto_review';
                if (response.testId) {
                    redirectUrl += '/' + response.testId;
                }
                if (response.lastQuestion) {
                    redirectUrl += '/' + response.lastQuestion;

                    // If last_question and currently displayd questions are same, won't redirect.
                    if (lastParam == response.lastQuestion) {
                        redirectUrl = null;
                    }
                } else {
                    // No last_question found, so won't redirect unnecessarily
                    redirectUrl = null;
                }
            },
            'json'
        );

        // Redirects to the review of last question.
        if (redirectUrl) window.location = redirectUrl;
    };

    // Calls as soon as the page is loaded.
    timer();

    // Calls timer() function every 5 seconds.
    intervalId = setInterval('timer()', 5000);
});

