<div class="comments">

	<h4>COMMENTS</h4>


	<ul>

		@foreach($story->storyComments() as $comment)
		<li class="mt-5 mb-5">
			<div class="comment p-20">

				<div class="avatar" style="height: 70px; width: 70px;">
					<img style="height: 70px;" src="assets/images/resource/comment1.jpg" alt="">
					<a class="pointer comment_reply" data-id="{{$comment->id}}" title="" style="line-height: 10px;">REPLY</a>
				</div>

				<h5>
					{{$comment->user()->name}}
					@if($comment->userc_id === auth()->user()->id)
                  	<span class="icon mdi mdi-delete mr-5 comment_delete pointer pull-right" data-url="/comment/delete/{{$comment->id}}" style="color: #e72919; font-weight: bold; font-size: 18px;"></span>

					<span class="icon mdi mdi-edit mr-10 comment_edit pointer pull-right" data-url="/comment/edit/{{$comment->id}}" style="color: #4285f4; font-weight: bold; font-size: 18px;"></span>
					@endif
              	</h5>

				<span>{{ \Carbon\Carbon::parse($comment->created_at)->format('F')}}</span>
				 {{ \Carbon\Carbon::parse($comment->created_at)->format('d')}}, 
				 {{ \Carbon\Carbon::parse($comment->created_at)->format('Y')}} at 
				 <span>{{ \Carbon\Carbon::parse($comment->created_at)->format('h:i:s A')}}</span>

				<p class="pt-0" style="margin-left: 100px;">{{$comment->comment}}</p>

			</div><!-- COMMENT -->	

			<ul>
				@foreach($comment->replies as $reply)
				<li class="mt-5 mb-5">
					<div class="comment p-20">
						<div class="avatar" style="height: 70px; width: 70px;"><img style="height: 70px;" src="assets/images/resource/comment2.jpg" alt=""><a class="pointer comment_reply" data-id="{{$comment->id}}" title="" style="line-height: 10px;">REPLY</a></div>
						<h5>
							{{$reply->user()->name}}
							@if($reply->userc_id === auth()->user()->id)
							<span class="icon mdi mdi-delete mr-5 reply_delete pointer pull-right" data-url="/reply/delete/{{$reply->id}}" style="color: #e72919; font-weight: bold; font-size: 18px;"></span>

							<span class="icon mdi mdi-edit mr-10 reply_edit pointer pull-right" data-url="/reply/edit/{{$reply->id}}" style="color: #4285f4; font-weight: bold; font-size: 18px;"></span>
							@endif
						</h5>
						<span>{{ \Carbon\Carbon::parse($reply->created_at)->format('F')}}</span> {{ \Carbon\Carbon::parse($reply->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($reply->created_at)->format('Y')}} at <span>{{ \Carbon\Carbon::parse($reply->created_at)->format('h:i:s A')}}</span>
						<p class="pt-0" style="margin-left: 100px;">{{$reply->reply}}</p>
					</div><!-- COMMENT -->
				</li>
				@endforeach
			</ul>								

		</li>
		@endforeach
	</ul>
</div><!-- COMMENTS -->										

<div class="leave-comment">

	<h4><i class="fa fa-edit"></i> LEAVE A COMMENT</h4>

	<form id="form_comment">

		<textarea placeholder="Comment" name="comment" id="comment"></textarea>
		<input type="hidden" name="table" value="Story">

		<div id="comment_submit_btns">
			<input type="submit" value="Comment" id="btn_cmt">
			<input class="mr-10" type="submit" value="Cancel" id="cmt_cancel" style="background: #505050e6">
        </div>

        <div id="reply_submit_btns" style="display: none;">
        	<input type="submit" value="Reply" id="btn_reply">
			<input class="mr-10" type="submit" value="Cancel" id="reply_cancel" style="background: #505050e6">
        </div>

        <div id="comment_update_submit_btns" style="display: none;">
        	<input type="submit" value="Update Comment" id="btn_cmt_update">
			<input class="mr-10" type="submit" value="Cancel" id="update_cancel" style="background: #505050e6">
        </div>

        <div id="reply_update_submit_btns" style="display: none;">
          	<input type="submit" value="Update Reply" id="btn_reply_update">
			<input class="mr-10" type="submit" value="Cancel" id="update_cancel" style="background: #505050e6">
        </div>

	</form>
</div><!-- COMMENT FORM -->	

<script>
	(function($){
	    $.fn.setCursorToTextEnd = function() {
	        var $initialVal = this.val();
	        this.val($initialVal);
	    };
	})(jQuery);

	function storyDeatail(){
	    let url = '/frontend/story/detail/{{$story->id}}';
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

	$(document).off('click', '#btn_cmt').on('click','#btn_cmt', function(e){
	    e.preventDefault();
	    var formData = new FormData($('#form_comment')[0]);        
	    
	    saveUpdateAction({
	        url : '/comment/add/{{$story->id}}',
	        data: formData,
	        contentType : false,
	        processData: false,
	        hasCb: true,            
	    }, function (data) {
	        console.log(data); 
	        storyDeatail();
	    });
	});

	$('#cmt_cancel').off('click').on('click', function(e){
	    e.preventDefault();
	    storyDeatail();
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
	        storyDeatail();
	    });
	});

	$(document).off('click', '#reply_cancel').on('click','#reply_cancel', function(e){
		e.preventDefault();
	    storyDeatail();
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
	                    storyDeatail();
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
	                    storyDeatail();
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
	      storyDeatail();
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
	        storyDeatail();
	    });
	  });
</script>