<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="chart_my_task" style="height : 500px;"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="chart_assign_task" style="height : 500px;"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var task = JSON.parse('<?= json_encode($task) ?>');
    $(document).ready(function()
    {
        var my = task["my"];
        my["pending"] = Math.round(my["pending"] * 100 / my["total"], <?= ROUND_DIGIT ?>);
        my["completed"] = Math.round(my["completed_un_verified"] * 100 / my["total"], <?= ROUND_DIGIT ?>);
        my["verified"] = Math.round(my["verified"] * 100 / my["total"], <?= ROUND_DIGIT ?>);
        my["expire"] = Math.round(my["expire"] * 100 / my["total"], <?= ROUND_DIGIT ?>);
        
        var assign = task["assign"];
        
        assign["pending"] = Math.round(assign["pending"] * 100 / assign["total"], <?= ROUND_DIGIT ?>);
        assign["completed"] = Math.round(assign["completed_un_verified"] * 100 / assign["total"], <?= ROUND_DIGIT ?>);
        assign["verified"] = Math.round(assign["verified"] * 100 / assign["total"], <?= ROUND_DIGIT ?>);
        assign["expire"] = Math.round(assign["expire"] * 100 / assign["total"], <?= ROUND_DIGIT ?>);
        
        if (typeof Highcharts == "undefined")
        {
            return;
        }
        
        Highcharts.chart('chart_my_task', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'My Task (' + my["total"] + ")"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [
                {
                    name: 'My Task',
                    colorByPoint: true,
                    data: [
                        {
                            name: 'Pending',
                            y: my["pending"],
                        }, 
                        {
                            name: 'Completed',
                            y: my["completed"],
                        }, 
                        {
                            name: 'Verified',
                            y: my["verified"],
                        }, 
                        {
                            name: 'Expired',
                            y: my["expire"],
                        }                        
                    ]
                }
            ]
        });
        
        Highcharts.chart('chart_assign_task', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Assign Task (' + assign["total"] + ")"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [
                {
                    name: 'Assign Task',
                    colorByPoint: true,
                    data: [
                        {
                            name: 'Pending',
                            y: assign["pending"],
                        }, 
                        {
                            name: 'Completed',
                            y: assign["completed"],
                        }, 
                        {
                            name: 'Verified',
                            y: assign["verified"],
                        }, 
                        {
                            name: 'Expired',
                            y: assign["expire"],
                        }                        
                    ]
                }
            ]
        });
    });
</script>