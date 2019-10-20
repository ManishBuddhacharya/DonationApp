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
  <div class="panel-heading panel-heading-divider">Edit Story</div>
  <div class="panel-body">
    <form id="form_story">
      <div class="col-md-12">
        <div class="form-group xs-pt-10">
          <label>Title</label>
          <input type="text" name="title" placeholder="Title" value="{{$story->title}}" class="input-xs form-control validate">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Category</label>
          <select name="category_id" class="select2 validate">
            <option value="{{$story->id}}">{{$story->name}}</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="d-block">File</label>
          <input type="file" name="file" id="file" data-multiple-caption="{count} files selected" multiple="" class="inputfile">
          <label for="file" class="btn-default width-100"> <i class="mdi mdi-upload"></i><span>Browse files...          </span></label>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group xs-pt-10">
          <label>Content</label>
          <textarea name="content" id="summernote" class="form-control validate">{{$story->content}}</textarea>
        </div>
      </div>
      
      <div class="row xs-pt-15">
        <div class="col-xs-6 pull-right mr-10">
          <p class="text-right">
            <button type="submit" class="btn btn-space btn-primary" id="update_story">Update</button>
            <button class="btn btn-space btn-default" id="cancel_story">Cancel</button>
          </p>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
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
            }
            else {
                $('#invalidType').hide();
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

  $('#cancel_story').off('click').on('click', function(e){
    e.preventDefault();
    story();
  });

  $(document).off('click', '#update_story').on('click','#update_story', function(e){
    e.preventDefault();
    if (validate() === 0){
      var formData = new FormData($('#form_story')[0]);        
      saveUpdateAction({
          url : '/backend/story/update/{{$story->id}}',
          data: formData,
          contentType : false,
          processData: false,
          hasCb: true,            
      }, function (data) {
          console.log(data); 
          if (data.id) {
            story();
            toastr.success("Cause Updated Successfully.");
          }    
      });
    }
  });

  function story(){
    let url = '/backend/story';
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