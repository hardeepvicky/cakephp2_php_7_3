/**
 * @author     Hardeep
 */
$(document).ready(function()
{
    $("form").find("div.error-message").parents(".form-group").addClass("has-error"); 
   
    $("input[type='checkbox'].chk-select-all").chkSelectAll();

    $(".copy-text").copyText();
    
    $(".copy-value").copyValue();
    
    $(".css-toggler").cssToggler();
    
    $("input[type='checkbox'].checkbox-css-toggler").checkboxCssToggler();
    
    $(".ajax-loader").ajaxLoader();
    
    $('.mt-multiselect').multiselect({
        enableFiltering: true,
        allSelectedText: 'No option left',
        maxHeight : 300
    });
    
    $(".fancybox").fancybox();
    
    $(".fancybox-ajax").fancybox({
        type            : 'ajax',
        autoSize	: false,
    });

    $(".date-picker").datepickerExtend();
    
    $(".date-month-picker").datepickerExtend({
        format: "M-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });
    
    $(".date-time-picker").datetimepickerExtend();
    
    $('.time-picker').timepicker({
        defaultTime : ""
    });
    
    $(".more-text").moreText();
    
    $(".data-table").DataTable( {
        colReorder: true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    });
    
    $(".js-export-csv").jsExportCsv();
    
    $(".invalid-char").invalidURLChar();
    
    $("input[type='text'].invalid-sql-char, input[type='number'].invalid-sql-char, textarea.invalid-sql-char").invalidSqlChar();
    
    $('.editable-text').editable();
    
    $(".sr-databtable").srDatatable();
    
    $("a.toggle-tinyfield").toggleTinyField();
    
    $(".char-limit-required").charLimitRequired();
    
    if (typeof onEventBindFinish == "function")
    {
        onEventBindFinish();
    }
});