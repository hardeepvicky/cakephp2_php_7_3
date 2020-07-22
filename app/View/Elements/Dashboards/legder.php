<style>
    
</style>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark bold">Expense</span>
        </div>
        <div class="col-md-6 pull-right" style="display:inline-block;">
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" class="form-control date-picker" id="expense_from_date" placeholder="From Date" data-date-end="input#expense_to_date" autocomplete="off" />
                    <span class="error-message"></span>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control date-picker" id="expense_to_date" placeholder="To Date" data-date-start="input#expense_from_date" autocomplete="off" />
                    <span class="error-message"></span>
                </div>
                <div class="col-sm-3">
                    <span class="btn blue" id="expense-search">Search</span>
                </div>
            </div>
            
            
        </div>
    </div>
    <div class="portlet-body" id="expense-block">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#expense-search").click(function()
        {
            var from = $("#expense_from_date").val();
            var to = $("#expense_to_date").val();
            
            if (!from)
            {
                $("#expense_from_date").parent().find(".error-message").html("Please Enter Date");
                return;
            }
            
            if (!to)
            {
                $("#expense_to_date").parent().find(".error-message").html("Please Enter Date");
                return;
            }
            
            $("#expense-block").load('/Dashboards/ajaxExpense', {from_date : from, to_date : to});
        });
    });
</script>