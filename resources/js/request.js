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

function saveUpdateAction(option, cb = ''){
    var url=option.url;
    var data=option.data;
    var content_holder=option.content_holder;

    var content_type=option.contentType;
    var processData=option.processData;


    if(typeof processData=="undefined")
    {
        processData=true;
    }
    if(typeof content_type=="undefined")
    {
        content_type='application/x-www-form-urlencoded'
    }

    if(!option.content_holder)
        content_holder='#body-container';
    if (xhr && xhr.readyState !== 400 && xhr.status !== 200) {
        xhr.abort();
    }

    xhr=$.ajax({
        url:url,
        method: option.hasOwnProperty('method') ? option.method : 'post',
        data:data,
        // dataType: 'html',
        contentType: content_type,
        processData: processData,        
        cache:false,
      /*  beforeSend:function () {
            oldHtml=$(option.formId).html();
            $(option.formId).addClass('page-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>');
        },*/
        success:function(data){
            // debugger;
            // console.log("about to run");
            if(option.hasOwnProperty("hasCb"))
            {
                cb(data);
                
            }
            else
            {

                if(option.hasOwnProperty('callback')){
                    callback = option.callback;
                    if(typeof callback == "function"){
                        console.log("called back");
                        callback();
                    }
                }
            }

            //App.dialog.close();
        },
        error:function (data) {
            // $(option.formId).removeClass('page-loader');
            // $(option.formId).html(oldHtwl);
            responseError(data);
            var text=JSON.parse(data.responseText);
            var messsage=text.message;
            if(typeof text.errors != "undefined")
                messsage+="<br />"+JSON.stringify(text.errors);
            // $.extend($.gritter.options, { position: 'top-right' });
            // $.gritter.add({
            //     title: 'Error',
            //     text: responseError(data),
            //     class_name: 'color danger'
            // });
        },
        complete:function () {
            $(option.formId).removeClass('page-loader');
        }
    })
}