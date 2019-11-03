<style>
    .fixed-table-toolbar{
        display: none;
    }
</style>
<div class="be-content">
    <div class="page-head">
      <h2 class="page-head-title">Dashboard</h2>
    </div>
    <div class="main-content container-fluid">
      <h3 class="text-center">Welcome to Donation Application Dashboard</h3>
      <div class="col-md-6">
          <div id="myChart"></div>
      </div>

      <div class="col-md-6">
          <table 
            id="doanation-table" 
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
            data-id-table="doanation-table" 
            data-url="/getDonationInfo/table" 
            data-show-footer="true" 
            data-row-style="attendanceRowStyle" 
            data-show-export="true" 
            class="table table-condensed table-striped">
            <input type="hidden" id="page_print_header" value="Attendance">
            <thead>
                <tr>
                    <th data-field="title" data-sortable="true">Cause Name
                    </th>
                    <th data-field="goal" data-sortable="true">Goal ($)
                    </th>
                    <th data-field="raised" data-sortable="true">Raised ($)
                    </th>
                </tr>
            </thead>
        </table>
      </div>


    </div>
</div>

<script>
  var ctx = document.getElementById('myChart');

  $(document).on('ready', function(e){
    e.preventDefault();
    $('#doanation-table').bootstrapTable();
    $.ajax({
            method:'get',
            url:'/getDonationInfo',
            success:function(response)
            {
                chart(response);
            },
            error:function(e)
            {
                alert('dsadad');
            }
       });
  });
    function chart(datas){
        console.log(datas)
;        var options = {
                    theme: "light1", // "light2", "dark1", "dark2"
                    animationEnabled: false,
                        title: {
                            text: "Donation Chart"
                        },
                        data: [{
                            // Change type to "doughnut", "line", "splineArea", etc.
                            type: "column",
                            dataPoints: JSON.parse(datas)
                        }]
                    };

        $("#myChart").CanvasJSChart(options);
    }


 
</script>