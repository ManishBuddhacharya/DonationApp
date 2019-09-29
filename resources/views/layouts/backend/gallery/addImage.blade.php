<div id="modal_add_image" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="width: 400px;">
      <div class="modal-header" style="background: #2572f2">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #fff;">Add Image</h4>
      </div>
      <div class="modal-body">
        <form id="form_image">
          <div class="col-md-12">
            <div class="form-group">
              <label class="d-block">File</label>
              <input type="file" name="file" id="file" data-multiple-caption="{count} files selected" multiple="" class="inputfile">
              <label for="file" class="btn-default width-100"> <i class="mdi mdi-upload"></i><span>Browse files...          </span></label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="upload_image">Upload</button>
      </div>
    </div>
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
                $('#AddEcommerceCustomer').prop('disabled',true)
            }
            else {
                $('#invalidType').hide();
                $('#AddEcommerceCustomer').prop('disabled',false)
            }

        }
    });

  $(document).off('click', '#upload_image').on('click','#upload_image', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_image')[0]);        
    
    saveUpdateAction({
        url : '/backend/gallery/add',
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        if (data.id) {
          $('#modal_add_image').modal('hide');
          toastr.success("Image uploaded Successfully.");
          gallery();
        }    
    });
  });

  function gallery(){
    let url = '/backend/gallery';
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