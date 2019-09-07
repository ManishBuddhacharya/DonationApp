<div class="be-content">
  <div class="page-head">
    <h2 class="page-head-title">Cause
      <button class="btn btn-rounded btn-sm btn-space btn-primary pull-right" id="add_cause" data-url="/backend/cause/add"><i class="icon icon-left mdi mdi-plus"></i> Add Cause</button>
    </h2>
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Cause</li>
    
    </ol>
  </div>
  <div class="main-content container-fluid">
    <div class="row" id="changable">
      @foreach($causes as $cause)
      <div class="col-md-12" >
        <div class="panel panel-border">
          <div class="panel-heading panel-heading-divider">{{$cause->title}}
            <div class="tools dropdown">
              <span class="icon mdi mdi-edit mr-5 cause_edit pointer" data-url="/backend/cause/edit/{{$cause->id}}" style="color: #4285f4;"></span>
              <span class="icon mdi mdi-delete mr-5 cause_delete pointer" data-url="/backend/cause/delete/{{$cause->id}}" style="color: #e72919;"></span>
            </div><span class="panel-subtitle">Created by {{$cause->user()->fname}}</span>
          </div>
          <div class="panel-body detail_view" data-url="/backend/cause/detail/{{$cause->id}}">
            <div class="col-md-4" >
              <img src="{{"/images/".$cause->file_name?:'/img/gallery/img11.jpg'}}" class="img img-thumbnail width-100" style="height: 210px;">
            </div>
            <div class="col-md-8">
              <div style="height: 210px; overflow: hidden;">{!! $cause->content !!}</div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<script>
  $('#add_cause').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');
    $.ajax({
        method:'get',
        url:url,
        success:function(data)
        {
            $('#add_cause').hide();
            $('#changable').html(data);
        },
        error:function(e)
        {
            alert('dsadad');
        }
     });
  });

  $('.detail_view').off('click').on('click', function(e){
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

  function cause(){
    let url = '/backend/cause';
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