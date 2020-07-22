
<div class="calender-inline" id="calendar-<?= $operation_type_id ?>"></div>

<script type="text/javascript">
    var records = JSON.parse('<?= json_encode($records) ?>');
    var manufacture_target_max_qty = parseInt('<?= $manufacture_target_max_qty ?>');
    var calendar_select_date = null;

$(document).ready(function()
{
    $('#calendar-<?= $operation_type_id ?>').datepicker({
        defaultDate : null,
        minDate : "+0D",
        beforeShow: addCustomInformation,
        beforeShowDay: function (date)
        {
            var calender_date = date.getFullYear() + '-0' + (date.getMonth() + 1) + '-' + ('0' + date.getDate()).slice(-2);
            if (typeof records[calender_date] != "undefined")
            {
                var record = records[calender_date];

                if (!record["enabled"])
                {
                    return [false, "not-available-date"];
                }
            }
            return [true, ""];
        },
        onChangeMonthYear: addCustomInformation,
        onSelect: addCustomInformation
    });
    
    $('#calendar-<?= $operation_type_id ?>').datepicker("setDate", null);
    $('#calendar-<?= $operation_type_id ?>').find('.ui-state-active').removeClass('ui-state-active').removeClass('ui-state-hover');

    function addCustomInformation(dateText, inst)
    {        
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        
        setTimeout(function () {
            $(".ui-datepicker-calendar td").each(function () {
                
                var day = $(this).text();
                var d = day;
                if (d < 10)
                {
                    d = "0" + d;
                }

                var month = $(".ui-datepicker-month").html();
                var m = months.indexOf(month);
                var y = $(".ui-datepicker-year").html();

                if (m && y)
                {
                    m = parseInt(m) + 1;
                    if (m < 10)
                    {
                        m = "0" + m;
                    }
                    var y = parseInt(y);
                    var date = y + "-" + m + "-" + d
                    
                    if (typeof records[date] != "undefined")
                    {
                        var record = records[date];
                        $(this).find("a,span").attr("data-custom", record["aviablable_qty"]);
                    }
                    else
                    {
                        $(this).find("a,span").attr("data-custom", manufacture_target_max_qty);
                    }
                }
            });
        }, 0);
        
        if (typeof inst == "object")
        {
            var y = inst.selectedYear;
            var m = parseInt(inst.selectedMonth) + 1;
            if (m < 10)
            {
                m = "0" + m;
            }
            var d = parseInt(inst.selectedDay);
            if (d < 10)
            {
                d = "0" + d;
            }
            
            calendar_select_date = d + "-" + m + "-" + y;
        }
    }

    addCustomInformation();
});
</script>