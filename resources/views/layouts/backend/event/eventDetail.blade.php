<div class="panel panel-default panel-border-color panel-border-color-primary">
  <div class="panel-body">
    <div class="col-md-12">
      <div class="user-display mb-10">
        <div class="user-display-bg" style="max-height: 400px;"><img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="Profile Background"></div>
        <div class="user-display-bottom">
          <div class="user-display-avatar"><img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="Avatar"></div>
          <div class="user-display-info">
            <div class="name">
              {{$event->title}} 

              <span class="icon mdi mdi-delete mr-5 event_delete pull-right pointer" data-url="/backend/event/delete/{{$event->id}}" style="color: #e72919;"></span>
              <span class="icon mdi mdi-edit mr-5 event_edit pull-right pointer" data-url="/backend/event/edit/{{$event->id}}" style="color: #4285f4;"></span>
            </div>
            <div class="nick"><span class="mdi mdi-account"></span> {{$event->user()->name}} </div>
          </div>
          <div class="row user-display-details">
            <div class="col-xs-4" style="border-right: 3px solid #ccc;">
              <div class="title">Address</div>
              <div class="counter">{{$event->address}}</div>
            </div>
            <div class="col-xs-4" style="border-right: 3px solid #ccc;">
              <div class="title">Date</div>
              <div class="counter">{{ \Carbon\Carbon::parse($event->dateTime)->format('d/m/ Y')}}</div>
            </div>
            <div class="col-xs-4">
              <div class="title">Time</div>
              <div class="counter">{{ \Carbon\Carbon::parse($event->dateTime)->format('h:i A')}}</div>
            </div>
          </div>
        </div>
      </div>  
    </div>

    <div class="col-md-12">
      {!! $event->content !!}
    </div>

    {{-- Comments --}}
    <div class="col-md-12 mt-15">
      <div class="panel panel-default" style="border-top: 3px solid #ccc;">
        <div class="panel-heading"><strong>Comments</strong></div>
        <div class="panel-body">
        @foreach($event->eventComments() as $comment)
          <div class="timeline-content mt-15">
            <div class="timeline-avatar"><img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="Avatar" class="circle">
            </div>
            <div class="timeline-header">
              <span class="timeline-time">
                @if($comment->is_approve == 0)
                <span class="icon mdi mdi-check mr-10 comment_approve pointer" data-url="/comment/approve/{{$comment->id}}" style="color: #48b164; font-weight: bold; font-size: 18px;"></span>
                @else
                <span class="icon mdi mdi-close mr-10 comment_disApprove pointer" data-url="/comment/disApprove/{{$comment->id}}" style="color: red; font-weight: bold; font-size: 18px;"></span>
                @endif

                <span class="icon mdi mdi-mail-reply mr-10 comment_reply pointer" data-id="{{$comment->id}}" style="color: #fbbc05; font-weight: bold; font-size: 18px;"></span>

                <span class="icon mdi mdi-edit mr-10 comment_edit pointer" data-url="/comment/edit/{{$comment->id}}" style="color: #4285f4; font-weight: bold; font-size: 18px;"></span>

                <span class="icon mdi mdi-delete mr-5 comment_delete pointer" data-url="/comment/delete/{{$comment->id}}" style="color: #e72919; font-weight: bold; font-size: 18px;"></span>
              </span>
              <span class="timeline-autor">{{$comment->user()->name}} </span>
              <p class="timeline-activity">{{$comment->created_at}}</p>
              <div class="timeline-summary">
                <p>{{$comment->comment}}</p>
              </div>
            </div>

            @foreach($comment->replies as $reply)
            <div class="timeline-content mt-15">
              <div class="timeline-avatar"><img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="Avatar" class="circle"></div>
              <div class="timeline-header">
                <span class="timeline-time">
                  @if($reply->is_approve == 0)
                  <span class="icon mdi mdi-check mr-10 reply_approve pointer" data-url="/reply/approve/{{$reply->id}}" style="color: #48b164; font-weight: bold; font-size: 18px;"></span>
                  @else
                  <span class="icon mdi mdi-close mr-10 reply_disApprove pointer" data-url="/reply/disApprove/{{$reply->id}}" style="color: red; font-weight: bold; font-size: 18px;"></span>
                  @endif

                  <span class="icon mdi mdi-mail-reply mr-10 comment_reply pointer" data-id="{{$comment->id}}" style="color: #fbbc05; font-weight: bold; font-size: 18px;"></span>

                  <span class="icon mdi mdi-edit mr-10 reply_edit pointer" data-url="/reply/edit/{{$reply->id}}" style="color: #4285f4; font-weight: bold; font-size: 18px;"></span>

                  <span class="icon mdi mdi-delete mr-5 reply_delete pointer" data-url="/reply/delete/{{$reply->id}}" style="color: #e72919; font-weight: bold; font-size: 18px;"></span>
                </span>
                <span class="timeline-autor">{{$reply->user()->name}} </span>
                <p class="timeline-activity">{{$reply->created_at}}</p>
                <div class="timeline-summary">
                  <p>{{$reply->reply}}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        @endforeach
          <hr>

          <div class="timeline-content">
            <div class="timeline-avatar"><img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="Avatar" class="circle"></div>
              <form id="form_comment">
                <div class="timeline-header pt-0">
                  <textarea id="comment" class="width-100" rows="4" name="comment"></textarea>
                  <input type="hidden" name="table" value="Event">
                </div>
                <div id="comment_submit_btns">
                  <button class="btn btn-sm btn-primary pull-right mt-5 btn-rounded btn-space" id="btn_cmt">Comment</button>
                  <button class="btn btn-sm btn-default pull-right mt-5 btn-rounded btn-space" id="cmt_cancel">Cancel</button>
                </div>

                <div id="reply_submit_btns" style="display: none;">
                  <button class="btn btn-sm btn-primary pull-right mt-5 btn-rounded btn-space" id="btn_reply">Reply</button>
                  <button class="btn btn-sm btn-default pull-right mt-5 btn-rounded btn-space" id="reply_cancel">Cancel</button>
                </div>

                <div id="comment_update_submit_btns" style="display: none;">
                  <button class="btn btn-sm btn-primary pull-right mt-5 btn-rounded btn-space" id="btn_cmt_update">Update Comment</button>
                  <button class="btn btn-sm btn-default pull-right mt-5 btn-rounded btn-space" id="update_cancel">Cancel</button>
                </div>

                <div id="reply_update_submit_btns" style="display: none;">
                  <button class="btn btn-sm btn-primary pull-right mt-5 btn-rounded btn-space" id="btn_reply_update">Update Reply</button>
                  <button class="btn btn-sm btn-default pull-right mt-5 btn-rounded btn-space" id="update_cancel">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#cmt_cancel').off('click').on('click', function(e){
    e.preventDefault();
    causeDeatail();
  });

  (function($){
    $.fn.setCursorToTextEnd = function() {
        var $initialVal = this.val();
        this.val($initialVal);
    };
})(jQuery);

  function causeDeatail(){
    let url = '/backend/event/detail/{{$event->id}}';
    $.ajax({
        method:'get',
        url:url,
        success:function(data)
        {
            $('#changable').html(data);
            toastr.success("Comment Added Successfully.");
        },
        error:function(e)
        {
            alert('dsadad');
        }
     });
  }

  $(document).off('click', '#btn_cmt').on('click','#btn_cmt', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_comment')[0]);        
    
    saveUpdateAction({
        url : '/comment/add/{{$event->id}}',
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        causeDeatail();
    });
  });

  $(document).off('click', '.cause_donation').on('click','.cause_donation', function(e){
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

  $(document).off('click', '.comment_reply').on('click','.comment_reply', function(e){
    e.preventDefault();
    let id = $(this).data('id');
    $('#comment_submit_btns').hide();
    $('#comment_update_submit_btns').hide();
    $('#reply_update_submit_btns').hide();
    $('#reply_submit_btns').show();

    $('#btn_reply').attr('data-id', id);
    $('#comment').focus();
  });

  $(document).off('click', '#btn_reply').on('click','#btn_reply', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_comment')[0]);
    let id = $(this).data('id');       
    saveUpdateAction({
        url : '/comment/reply/'+id,
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        causeDeatail();
    });
  });

  $(document).off('click', '#reply_cancel').on('click','#reply_cancel', function(e){
    e.preventDefault();
    $('#comment_submit_btns').show();
    $('#reply_submit_btns').hide();
  });

  $('.comment_approve').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');

    Swal.fire({
        title: 'Are you sure you want to Approve this comment?',
        text: 'You will not be able to recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Approve',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method:'get',
                url:url,
                success:function(data)
                {
                    causeDeatail();
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

  $('.comment_disApprove').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');

    Swal.fire({
        title: 'Are you sure you want to Disapprove this comment?',
        text: 'You will not be able to recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Disapprove',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method:'get',
                url:url,
                success:function(data)
                {
                    causeDeatail();
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

  $('.reply_approve').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');

    Swal.fire({
        title: 'Are you sure you want to Approve this comment?',
        text: 'You will not be able to recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Approve',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method:'get',
                url:url,
                success:function(data)
                {
                    causeDeatail();
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

  $('.reply_disApprove').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');

    Swal.fire({
        title: 'Are you sure you want to Disapprove this comment?',
        text: 'You will not be able to recover this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Disapprove',
        cancelButtonText: 'cancel'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method:'get',
                url:url,
                success:function(data)
                {
                    causeDeatail();
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

  $('.comment_delete').off('click').on('click', function(e){
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
                    causeDeatail();
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

  $('.reply_delete').off('click').on('click', function(e){
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
                    causeDeatail();
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

$(document).off('click', '.comment_edit').on('click','.comment_edit', function(e){
  e.preventDefault();
  $('#comment_submit_btns').hide();
  $('#reply_submit_btns').hide();
  $('#reply_update_submit_btns').hide();
  $('#comment_update_submit_btns').show();
  let url = $(this).attr('data-url');
  $.ajax({
      method:'get',
      url:url,
      success:function(data)
      {
        $('#comment').text(data.comment);
        $('#btn_cmt_update').attr('data-id', data.id);
      },
      error:function(e)
      {
          alert('dsadad');
      }
  });
  $('#comment').focus();
});

$(document).off('click', '.reply_edit').on('click','.reply_edit', function(e){
  e.preventDefault();
  $('#comment_submit_btns').hide();
  $('#reply_submit_btns').hide();
  $('#comment_update_submit_btns').hide();
  $('#reply_update_submit_btns').show();
  let url = $(this).attr('data-url');
  $.ajax({
      method:'get',
      url:url,
      success:function(data)
      {
        $('#comment').text(data.reply);
        $('#btn_reply_update').attr('data-id', data.id);
      },
      error:function(e)
      {
          alert('dsadad');
      }
  });
  $('#comment').focus();

});

$(document).off('click', '#btn_reply_update').on('click','#btn_reply_update', function(e){
  e.preventDefault();
  var formData = new FormData($('#form_comment')[0]);
  let id = $(this).data('id');       
  saveUpdateAction({
      url : '/reply/update/'+id,
      data: formData,
      contentType : false,
      processData: false,
      hasCb: true,            
  }, function (data) {
      console.log(data); 
      causeDeatail();
  });
});

$(document).off('click', '#btn_cmt_update').on('click','#btn_cmt_update', function(e){
    e.preventDefault();
    var formData = new FormData($('#form_comment')[0]);        
    let id = $(this).data('id');    
    saveUpdateAction({
        url : '/comment/update/'+id,
        data: formData,
        contentType : false,
        processData: false,
        hasCb: true,            
    }, function (data) {
        console.log(data); 
        causeDeatail();
    });
  });



</script>