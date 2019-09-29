<div class="be-content">
  <div class="page-head">
    <h2 class="page-head-title">Blog
      <button class="btn btn-rounded btn-sm btn-space btn-primary pull-right" id="add_Image" data-url="/backend/gallery/add"><i class="icon icon-left mdi mdi-plus"></i> Add Gallery</button>
    </h2>
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Gallery</li>
    
    </ol>
  </div>
  <div class="main-content container-fluid">
    <div class="row" id="changable">
      <div class="gallery-container">
      @foreach($images as $image)
        <div class="item col-md-4" style="width: 33%;">
              <div class="photo">
                <div class="img"><img src="{{"/images/".$image->file_name?:'/img/gallery/img11.jpg'}}" alt="Gallery Image">
                  <div class="over">
                    <div class="info-wrapper width-100">
                      <div class="info width-100">
                        <div class="func" style="margin: auto;">
                          <a class="pointer image_edit" data-url="/backend/gallery/edit/{{$image->id}}"><i class="icon mdi mdi-edit"></i></a>
                          <a class="pointer image_delete" data-url="/backend/gallery/delete/{{$image->id}}"><i class="icon mdi mdi-delete"></i></a>
                          <a class="image-popup" href="{{"/images/".$image->file_name?:'/img/gallery/img11.jpg'}}"><i class="icon mdi mdi-eye"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      @endforeach
    </div>
    </div>
  </div>
</div>

<div id="modal_edit_image" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" id="modal-image-edit" style="width: 400px;">
      
    </div>
  </div>
</div>

@include('layouts.backend.gallery.addImage')

<script>
  $('#add_Image').off('click').on('click', function(e){
    e.preventDefault();
    $('#modal_add_image').modal();
  });

  $('.image-popup').magnificPopup({
    type: 'image'
    // other options
  });

  $('.image_edit').off('click').on('click', function(e){
    e.preventDefault();
    $('#modal_edit_image').modal();
    let url = $(this).attr('data-url');
    $.ajax({
        method:'get',
        url:url,
        success:function(data)
        {
            $('#modal-image-edit').html(data);
        },
        error:function(e)
        {
            alert('dsadad');
        }
     });
  });

  $('.image_delete').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');

    Swal.fire({
        title: 'Are you sure you want to delete this image?',
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
                    gallery();
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