<style>
.select2-container--default .select2-selection--single .select2-selection__arrow b:after {
    content: "";
    font-family: 'Material Icons';
    font-size: 25px;
    font-weight: normal;
    line-height: 46px;
    color: #404040;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #999;
    line-height: 30px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px !important;
    height: 26px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 5px !important;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
}
</style>
<div class="panel panel-default panel-border-color panel-border-color-primary">
  <div class="panel-heading panel-heading-divider">Edit Event</div>
  <div class="panel-body">
    <form id="form_event">
      <div class="col-md-9">
        <div class="form-group xs-pt-10">
          <label>Title</label>
          <input type="text" name="title" placeholder="Title" value="{{$event->title}}" class="input-xs form-control">
        </div>
      </div>
      <div class="col-md-3 pt-10">
        <div class="form-group">
          <label>Category</label>
          <select name="category_id" class="select2">
            <option value="{{$event->id}}">{{$event->name}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-9 no-padding">
        <div class="col-md-6">
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" placeholder="Address" value="{{$event->address}}" class="form-control input-xs">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Date & Time</label>
            <input type="text" name="dateTime" id="dateTime" placeholder="Date & Time" value="{{$event->dateTime}}" class="form-control input-xs">
          </div>
        </div>
      </div>
      
      <div class="col-md-3">
        <div class="form-group">
          <label class="d-block">File</label>
          <input type="file" name="file" id="file" data-multiple-caption="{count} files selected" multiple="" class="inputfile">
          <label for="file" class="btn-default width-100"> <i class="mdi mdi-upload"></i><span>Browse files...          </span></label>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group xs-pt-10">
          <label>Content</label>
          <textarea name="content" id="summernote" class="form-control">{{$event->content}}</textarea>
        </div>
      </div>
      
      <div class="row xs-pt-15">
        <div class="col-xs-6 pull-right mr-10">
          <p class="text-right">
            <button type="submit" class="btn btn-space btn-primary" id="update_event">Update</button>
            <button class="btn btn-space btn-default" id="cancel_event">Cancel</button>
          </p>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
   $('#dateTime').datetimepicker({
            startView: 2,
            minView: 0,
            autoclose: true,
            format:'yyyy-mm-dd h:i',
        }).on('hide', function () {
            return false;
    });

  function fileValidation(type)
{
    var typeC=['image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'application/pdf',
        'image/bmp',
        'image/webp',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/plain'
    ];
    return typeC.indexOf(type) > -1;

}

  $('.inputfile').on('change', function (e) {
        var $input   = $( this ),
                $label   = $input.next( 'label' ),
                labelVal = $label.html();
        var fileName = '';
        fileName = e.target.value.split('\\').pop();

        if (fileName){
            $label.find('span').html(fileName);
            $(this).html(fileName);
        }
        else{
            $label.html(labelVal);
            $(this).html(labelVal);
        }
        for(var i=0;i<this.files.length;i++)
        {
            var type=this.files[i].type;
            var valid=fileValidation(type);
            if(!valid)
            {
                $('#invalidType').show();
                $('#AddEcommerceCustomer').prop('disabled',true)
            }
            else {
                $('#invalidType').hide();
                $('#AddEcommerceCustomer').prop('disabled',false)
            }

        }
    });

  $(document).ready(function() {
    $('.select2').select2({
      placeholder: 'Select Category',
      width: '100%',
      height:"20px",
      ajax: {
          method: 'POST',
          url: '/backend/categories',
          processResults: function(data) {
              let res = [];
              $.each(data, function(i, obj) {
                  res.push({
                      id: obj.id,
                      text: obj.name
                  });
              });
              return {
                  results: res
              };
          }
      }
    });

    $('#summernote').summernote({
      height: 200,
    });
  });

  $('#cancel_event').off('click').on('click', function(e){
    e.preventDefault();
    event();
  });

  $(document).off('click', '#update_event').on('click','#update_event', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_event')[0]);        
    
    saveUpdateAction({
        url : '/backend/event/update/{{$event->id}}',
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        if (data.id) {
          event();
          toastr.success("Event Updated Successfully.");
        }    
    });
  });

  function event(){
    let url = '/backend/event';
    $.ajax({
        method:'get',
        url:url,
        success:function(data)
        {
            $('#section-wrapper').html(data);
        },
        error:function(e)
        {
            alert('dsadad');
        }
     });
  }

</script>