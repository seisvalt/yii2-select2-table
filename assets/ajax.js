function handleAjaxLink(e) {

    e.preventDefault();

    var
        $link = $(e.target),
        callUrl = $link.attr('href'),
        formId = $link.data('formId'),
        onDone = $link.data('onDone'),
        onFail = $link.data('onFail'),
        onAlways = $link.data('onAlways'),
        data = $("#blinbid1").val(),
        ajaxRequest;

    ajaxRequest = $.ajax({
        type: "post",
        dataType: 'json',
        url: callUrl,
        data: {

            'data': data,
            'model': model

        },
        success: function (data, textStatus, jqxhr) {
            console.log("success");

        }
    });
    ajaxRequest.fail(function (jqXHR, textStatus) {
        console.log("fail");
        console.log(jqXHR);
    });
    ajaxRequest.done(function (msg) {
        console.log("bla");
    });

    // Assign done handler
    if (typeof onDone === "string" && ajaxCallbacks.hasOwnProperty(onDone)) {
        ajaxRequest.done(ajaxCallbacks[onDone]);
    }

    // Assign fail handler
    if (typeof onFail === "string" && ajaxCallbacks.hasOwnProperty(onFail)) {
        ajaxRequest.fail(ajaxCallbacks[onFail]);
    }

    // Assign always handler
    if (typeof onAlways === "string" && ajaxCallbacks.hasOwnProperty(onAlways)) {
        ajaxRequest.always(ajaxCallbacks[onAlways]);
    }

}


var ajaxCallbacks = {

    'simpleDone': function (response) {
        // This is called by the link attribute 'data-on-done' => 'simpleDone'
        console.log("hola");
        console.dir(response);
        $('#ajax_result_01').html(response.body);
    },

    'linkFormDone': function (response) {
        // This is called by the link attribute 'data-on-done' => 'linkFormDone';
        // the form name is specified via 'data-form-id' => 'link_form'
        $('#ajax_result_02').html(response.body);
    }

}