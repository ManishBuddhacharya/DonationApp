
<div class="be-content">
  <div class="page-head">
    <h2 class="page-head-title">Setting
      {{-- <button class="btn btn-rounded btn-sm btn-space btn-primary pull-right" id="add_blog" data-url="/backend/blog/add"><i class="icon icon-left mdi mdi-plus"></i> Add Blog</button> --}}
    </h2>
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Setting</li>
    
    </ol>
  </div>
  <div class="main-content container-fluid">
    <div class="row" id="changable">
      <div class="col-md-12">
        <div class="user-display">
          <div class="user-display-bg"><img src="{{asset('img/user-profile-display.png')}}" alt="Profile Background"></div>
          <div class="user-display-bottom">
            <div class="user-display-avatar"><img class="profilePic pointer" src="{{$user->profile_img?"/images/".$user->profile_img:asset('img/avatar-150.png')}}" alt="Avatar"></div>
            <div class="user-display-info">
              <div class="name">{{ucwords($user->name)}}</div>
              <div class="nick"><span class="mdi mdi-email"></span> &nbsp; {{$user->email}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default">
          <div class="tab-container">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#changePassword" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div id="profile" class="tab-pane active cont">
                <form id="form_profile">
                  <div class="col-md-6">
                    <div class="form-group xs-pt-10">
                      <label>Name</label>
                      <input type="text" name="name" readonly value="{{$user->name}}" placeholder="Name" class="input-xs form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group xs-pt-10">
                      <label>Address</label>
                      <input type="text" name="address" readonly value="{{$user->address}}" placeholder="Address" class="input-xs form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group xs-pt-10">
                      <label>Phone</label>
                      <input type="text" name="phone" readonly value="{{$user->phone}}" placeholder="Phone" class="input-xs form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group xs-pt-10">
                      <label>Email</label>
                      <input type="text" name="email" readonly value="{{$user->email}}" placeholder="Email" class="input-xs form-control">
                    </div>
                  </div>
                 
                  <div class="row xs-pt-15">
                    <div class="col-xs-6 pull-right mr-10" id="editProfileButtons">
                      <p class="text-right">
                        <button class="btn btn-space btn-default" id="editProfile">Edit</button>
                      </p>
                    </div>
                    <div class="col-xs-6 pull-right mr-10" id="updateProfileButtons" style="display: none;">
                      <p class="text-right">
                        <button type="submit" class="btn btn-space btn-primary" id="updateProfile">Update Profile</button>
                        <button class="btn btn-space btn-default" id="cancel_update_profile">Cancel</button>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
              <div id="changePassword" class="tab-pane cont">
                <form id="form_password">
                  <div class="col-md-6 ">
                    <div class="form-group xs-pt-10">
                      <label>New Password</label>
                      <input type="password" name="password"  placeholder="New Password" class="input-xs form-control">
                    </div>
                  </div>

                  <div class="col-md-6 ">
                    <div class="form-group xs-pt-10">
                      <label>Confirm Password</label>
                      <input type="password" name="Confirm_password" placeholder="Confirm Password" class="input-xs form-control">
                    </div>
                  </div>
                 
                  <div class="row xs-pt-15">
                    <div class="col-xs-6 pull-right mr-10" id="updatePasswordButtons" >
                      <p class="text-right">
                        <button type="submit" class="btn btn-space btn-primary" id="updatePassword">Update Password</button>
                        <button class="btn btn-space btn-default" id="cancel_update_password">Cancel</button>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(e){
    Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone(".profilePic", { 
          url: "/backend/setting/profile/picture/update/{{$user->id}}",
          headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
          success: function(file, response){
              setting();
          }
      });
  })

  $('#editProfile').off('click').on('click', function(e){
    e.preventDefault();
    $('#editProfileButtons').hide();
    $('#updateProfileButtons').show();
    $.each($('input[type=text]'),function(){
      $(this).prop("readonly", false);
    });
  });


$('#editPassword').off('click').on('click', function(e){
    e.preventDefault();
    $('#editPasswordButtons').hide();
    $('#updatePasswordButtons').show();
    $.each($('input[type=password]'),function(){
      $(this).prop("readonly", false);
    });
  });

  $('#cancel_update_profile').off('click').on('click', function(e){
    e.preventDefault();
    setting();
  });

  $(document).off('click', '#updateProfile').on('click','#updateProfile', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_profile')[0]);        
    
    saveUpdateAction({
        url : '/backend/setting/profile/update/{{$user->id}}',
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        if (data.id) {
          toastr.success("Profile Updated Successfully.");
          setting();
        }    
    });
  });

  $(document).off('click', '#updatePassword').on('click','#updatePassword', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_password')[0]);        
    
    saveUpdateAction({
        url : '/backend/setting/password/update/{{$user->id}}',
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        if (data.id) {
          toastr.success("Password Updated Successfully.");
          setting();
        }    
    });
  });

  $('.cause_edit').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');
    $.ajax({
        method:'get',
        url:url,
        success:function(data)
        {
            $('#changable').html(data);
        },
        error:function(e)
        {
            alert('dsadad');
        }
     });
  });

  $('.cause_delete').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');

    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: 'You will not be able to recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method:'get',
                url:url,
                success:function(data)
                {
                    cause();
                },
                error:function(e)
                {
                    alert('dsadad');
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Data is safe :)',
                'error'
            )
        }
    })
  });

  function setting(){
    let url = '/backend/setting';
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