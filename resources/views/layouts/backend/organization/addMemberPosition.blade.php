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
  <div class="panel-heading panel-heading-divider">Add Member Position</div>
  <div class="panel-body">
    <form id="form_blog">
      <div class="col-md-4">
        <div class="form-group xs-pt-10">
          <label>Member</label>
          <select name="user_id" id="member" class="select2 validate">
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group xs-pt-10">
          <label>Posiiton</label>
          <select name="position_id" id="position" class="select2 validate">
          </select>
        </div>
      </div>
      
      <div class="row xs-pt-15">
        <div class="col-xs-6 pull-right mr-10">
          <p class="text-right">
            <button type="submit" class="btn btn-space btn-primary" id="add_blog">Add</button>
            <button class="btn btn-space btn-default" id="cancel_blog">Cancel</button>
          </p>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#member').select2({
      placeholder: 'Select Members',
      width: '100%',
      height:"20px",
      ajax: {
          method: 'POST',
          url: '/backend/users',
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

    $('#position').select2({
      placeholder: 'Select Position',
      width: '100%',
      height:"20px",
      ajax: {
          method: 'POST',
          url: '/backend/positions',
          processResults: function(data) {
              let res = [];
              $.each(data, function(i, obj) {
                  res.push({
                      id: obj.id,
                      text: obj.position_name
                  });
              });
              return {
                  results: res
              };
          }
      }
    });

  });

  $('#cancel_blog').off('click').on('click', function(e){
    e.preventDefault();
    organization();
  });

  $(document).off('click', '#add_blog').on('click','#add_blog', function(e){
    e.preventDefault();
    if (validate() === 0){
      var formData = new FormData($('#form_blog')[0]);        
      saveUpdateAction({
          url : '/backend/organization/add',
          data: formData,
          contentType : false,
          processData: false,
          hasCb: true,            
      }, function (data) {
          console.log(data); 
          if (data.id) {
            toastr.success("Member Position Added Successfully.");
            organization();
          }    
      });
    }
  });

  function organization(){
    let url = '/backend/organization';
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