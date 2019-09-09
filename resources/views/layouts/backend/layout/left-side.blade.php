<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Blank Page</a>
      <div class="left-sidebar-spacer">
        <div class="left-sidebar-scroll">
          <div class="left-sidebar-content">
            <ul class="sidebar-elements">
              <li class="divider">Menu</li>
              <li class="parent"><a href="#"><i class="icon mdi mdi-home"></i><span>Home</span></a>
                <ul class="sub-menu">
                  <li class="active"><a class="pointer load_page" data-url="/backend/dashboard">Dashboard</a>
                  </li>
                  <li ><a class="pointer load_page" data-url="/backend/cause">Cause</a>
                  </li>
                  <li><a class="pointer load_page" data-url="/backend/event" >Event</a>
                  </li>
                  <li><a class="pointer load_page" data-url="/backend/story">Story</a>
                  </li>
                  <li><a class="pointer load_page" data-url="/backend/gallary">Gallary</a>
                  </li>
                  <li><a class="pointer load_page" data-url="/backend/organization">Organization Structure</a>
                  </li>
                  <li><a class="pointer load_page" data-url="/backend/setting" >Setting</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
 </div>

 <script>
   $('.load_page').off('click').on('click', function(e){
    var nthis= $(this);
    $('.load_page').parent().parent().find('li').each(function(){
        $('.load_page').parent().removeClass("active");
    });
    nthis.parent().addClass('active');

    let url = $(this).attr('data-url');
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
  });

</script>