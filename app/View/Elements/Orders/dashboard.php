<?php
    $pending_order_count = $pending_item_count = 0;
    foreach($pending_orders as $record)
    {
        $pending_order_count += $record[0]["order_count"];
        $pending_item_count += $record[0]["item_count"];
    }
    
    $dispatch_order_count = $dispatch_item_count = 0;
    foreach($dispatch_orders as $record)
    {
        $dispatch_order_count += $record[0]["order_count"];
        $dispatch_item_count += $record[0]["item_count"];
    }
    
    $return_order_count = $return_item_count = 0;
    foreach($dispatch_orders as $record)
    {
        $return_order_count += $record[0]["order_count"];
        $return_item_count += $record[0]["item_count"];
    }
    
    $inventory_count = 0;
    foreach($inventories as $record)
    {
        $inventory_count += $record[0]["invoice_qty"];
    }
?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $pending_order_count ?>">  <?= $pending_order_count ?> </span>
                </div>
                <div class="desc"> Pending Orders </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $dispatch_order_count ?>"><?= $dispatch_order_count ?></span>
                </div>
                <div class="desc"> Dispatch Orders </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $pending_order_count + $dispatch_order_count ?>"><?= $pending_order_count + $dispatch_order_count ?></span>
                </div>
                <div class="desc"> Total Orders </div>
            </div>
        </a>
    </div>
</div>
<div class="row" style="padding-top: 10px;">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue-madison" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $pending_item_count ?>">  <?= $pending_item_count ?> </span>
                </div>
                <div class="desc"> Pending Items </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red-sunglo" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $dispatch_item_count ?>"><?= $dispatch_item_count ?></span>
                </div>
                <div class="desc"> Dispatch Items </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green-seagreen" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $pending_item_count + $dispatch_item_count ?>"><?= $pending_item_count + $dispatch_item_count ?></span>
                </div>
                <div class="desc"> Total Items </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green-jungle" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $inventory_count ?>"><?= $inventory_count ?></span>
                </div>
                <div class="desc"> Invoice Items </div>
            </div>
        </a>
    </div>
</div>
<div class="row" style="padding-top: 10px;">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $return_order_count ?>">  <?= $return_order_count ?> </span>
                </div>
                <div class="desc"> Return Orders </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple-medium" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?= $return_item_count ?>"><?= $return_item_count ?></span>
                </div>
                <div class="desc"> Return Items </div>
            </div>
        </a>
    </div>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark bold">Pending Orders</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">            
            <div class="col-lg-6 col-xs-12 col-sm-12 sticky-header-container" style="overflow: scroll; height : 500px;">
                <table class="table table-hover sr-databtable">
                    <thead>
                        <tr>
                            <th data-search="1">Party</th>
                            <th  class="text-center" data-sort="numeric">Order Count</th>
                            <th  class="text-center" data-sort="numeric">Order Item Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pending_orders as $record): ?>
                        <tr>
                            <td> <?= $record['L']['name'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['order_count'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['item_count'] ?></td>                
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div id="chart_pending_orders" style="height : 500px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark bold">Dispatch Orders</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">            
            <div class="col-lg-6 col-xs-12 col-sm-12 sticky-header-container" style="overflow: scroll; height : 500px;">
                <table class="table table-hover sr-databtable">
                    <thead>
                        <tr>
                            <th data-search="1">Party</th>
                            <th  class="text-center" data-sort="numeric">Order Count</th>
                            <th  class="text-center" data-sort="numeric">Order Item Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dispatch_orders as $record): ?>
                        <tr>
                            <td> <?= $record['L']['name'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['order_count'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['item_count'] ?></td>                
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div id="chart_dispatch_orders" style="height : 500px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark bold">Return Orders</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">            
            <div class="col-lg-6 col-xs-12 col-sm-12 sticky-header-container" style="overflow: scroll; height : 500px;">
                <table class="table table-hover sr-databtable">
                    <thead>
                        <tr>
                            <th data-search="1">Party</th>
                            <th class="text-center" data-sort="numeric">Order Count</th>
                            <th class="text-center" data-sort="numeric">Order Item Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($return_orders as $record): ?>
                        <tr>
                            <td> <?= $record['L']['name'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['order_count'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['item_count'] ?></td>                
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div id="chart_return_orders" style="height : 500px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark bold">Invoices</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">            
            <div class="col-lg-6 col-xs-12 col-sm-12 sticky-header-container" style="overflow: scroll; height : 500px;">
                <table class="table table-hover sr-databtable">
                    <thead>
                        <tr>
                            <th data-search="1">Party</th>
                            <th class="text-center" data-sort="numeric">Item Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($inventories as $record): ?>
                        <tr>
                            <td> <?= $record['L']['name'] ?></td>                
                            <td  class="text-center"> <?= $record[0]['invoice_qty'] ?></td>                
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <div id="chart_inventory" style="height : 500px;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">    
    function render_pie(id, data, title)
    {
        Highcharts.chart(id, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: title
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
                    name: '',
                    colorByPoint: true,
                    data: data
                }
            ]
        });
    };
    
    $(document).ready(function()
    {
        var pending_orders = JSON.parse('<?= json_encode($pending_orders); ?>')
        var chart_data = [];
        
        for(var i in pending_orders)
        {
            var record = pending_orders[i];
            chart_data.push({
                name : record['L']['name'],
                y : parseFloat(record[0]['order_count'])
            });
        }
        
        render_pie('chart_pending_orders', chart_data, '');
        
        
        var dispatch_orders = JSON.parse('<?= json_encode($dispatch_orders); ?>')
        var chart_data = [];
        
        for(var i in dispatch_orders)
        {
            var record = dispatch_orders[i];
            chart_data.push({
                name : record['L']['name'],
                y : parseFloat(record[0]['order_count'])
            });
        }
        
        render_pie('chart_dispatch_orders', chart_data, '');
        
        var return_orders = JSON.parse('<?= json_encode($return_orders); ?>')
        var chart_data = [];
        
        for(var i in return_orders)
        {
            var record = return_orders[i];
            chart_data.push({
                name : record['L']['name'],
                y : parseFloat(record[0]['order_count'])
            });
        }
        
        render_pie('chart_return_orders', chart_data, '');
        
        
        var inventories = JSON.parse('<?= json_encode($inventories); ?>')
        var chart_data = [];
        
        for(var i in inventories)
        {
            var record = inventories[i];
            chart_data.push({
                name : record['L']['name'],
                y : parseFloat(record[0]['invoice_qty'])
            });
        }
        
        render_pie('chart_inventory', chart_data, '');
        
    });
</script>