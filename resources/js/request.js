$width=500;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var xhr = new window.XMLHttpRequest();

function saveDataFromModal(options, cb = '', error = '') {
    var url=options.url;
    var data=options.formData;
    if (xhr && xhr.readyState !== 400 && xhr.status !== 200) {
        xhr.abort();
    }
    xhr=$.ajax({
        url: url,
        method: 'post',
        data: data,
        // dataType: 'html',
        // beforeSend: function(){
        //     $('#travel_modal').modal('show');
        //     $('#travel_modal').css("width", options.width);
        // },
        success:function (response) {
            if(typeof cb === "function") {
                cb(response);
            }

        },
        error:function(data) {
            responseError(data);
            // console.log(data);
            var text=JSON.parse(data.responseText);
            var messsage=text.message;
            if(typeof(error) === 'function' )
                error(text.errors);
        }
    });
}

function getData(url,id,title,formId,content_holder = "#body-container", callback = '')
{

    var data=$('#'+formId+' :input').serializeArray();   
    saveUpdateAction(
        {
            url:url,
            data:data,
            id:id,
            title:title,
            content_holder:content_holder,
            callback: callback,
            formId:'#'+formId
        });
}

function responseError(data) {
    if(data.hasOwnProperty("responseText")) {
        var error = JSON.parse(data.responseText);
        var messages = {};
        var error_message = "";

        if(Object.keys(error).length) {
            if(error.hasOwnProperty("errors")) {
                for (key in error) {
                    messages = error[key];
                }
                for(key in messages) {
                    error_message += messages[key]+"<br/>";
                }
            }

            if(error.hasOwnProperty("message") && !error.hasOwnProperty("errors")) {
                error_message = error.message;
            }
        }
        return error_message;
    }
}