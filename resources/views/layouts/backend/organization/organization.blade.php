<style>
  .fixed-table-toolbar{
    display: none;
  }
</style>
<div class="be-content">
  <div class="page-head">
    <h2 class="page-head-title">Organization Structure
      <button class="btn btn-rounded btn-sm btn-space btn-primary pull-right" id="add_member_position" data-url="/backend/organization/add"><i class="icon icon-left mdi mdi-plus"></i> Add Member Position</button>
    </h2>
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Organization Structure</li>
    
    </ol>
  </div>
  <div class="main-content container-fluid">
    <div class="row" id="changable">
      <table 
        id="user-position-table" 
        data-pagination="true" 
        data-page-size="10" 
        data-page-list="[all]" 
        data-search="true" 
        data-show-refresh="true" 
        data-sort-name="id" 
        data-sort-order="asc" 
        data-id-field="course_title"
        data-advanced-search="false" 
        data-show-columns="true" 
        data-id-table="user-position-table" 
        data-url="/backend/organization/list" data-show-footer="true" 
        data-row-style="attendanceRowStyle" 
        data-show-export="true" 
        class="table table-condensed table-striped">
        <input type="hidden" id="page_print_header" value="Attendance">
        <thead>
            <tr>
                <th data-field="name" data-sortable="true">Name
                </th>
                <th data-field="email" data-sortable="true">Email
                </th>
                <th data-field="position_name" data-sortable="true">Position Name
                </th>
                <th data-formatter="userPositionActionBtn" class="action-sm remove_print_header text-right">Action</th>
            </tr>
        </thead>
    </table>
    </div>
  </div>
</div>

<script>
  $('#user-position-table').bootstrapTable();

  function userPositionActionBtn(value, row, index) {
    return "<button data-id='" + row.id + "' data-url='/backend/organization/edit/"+ row.id + "' class='btn member_position_edit btn-info btn-sm' style='line-height:0; padding: .45rem 0.5rem;'><span style='font-size:12px;' class='mdi mdi-edit'></span></button><button data-id='" + row.id + "' data-url='/backend/organization/delete/"+ row.id + "' class='btn member_position_delete mt-5btn-space btn-danger btn-sm' style='line-height:0; margin-left:5px; padding: .45rem 0.5rem;'><span class='mdi mdi-delete' style='font-size:12px;'></span></button>";
  }

  $('#add_member_position').off('click').on('click', function(e){
    e.preventDefault();
    let url = $(this).attr('data-url');
    $.ajax({
        method:'get',
        url:url,
        success:function(data)
        {
            $('#add_member_position').hide();
            $('#changable').html(data);
        },
        error:function(e)
        {
            alert('dsadad');
        }
     });
  });

  $(document).off('click', '.member_position_edit').on('click', '.member_position_edit', function(e){
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

  $(document).off('click', '.member_position_delete').on('click', '.member_position_delete', function(e){
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
                    $('#user-position-table').bootstrapTable('refresh');
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


</script>