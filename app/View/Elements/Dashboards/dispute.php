<style>
    #dispute-list{
        height: 250px;
        overflow-y: scroll;
    }
    
    #dispute-list li .content
    {
        display: flex;
        justify-content: space-between;
        align-items : center;
        align-content: flex-start;
        padding: 5px;
    }
    
    #dispute-list li .content > div:nth-child(1)
    {
        width : 7%;
    }
    
    #dispute-list li .content > div:nth-child(2)
    {
        width : 68%;
    }
    
    #dispute-list li .content > div:nth-child(3)
    {
        width : 25%;
        padding-left: 10px;
    }
    
</style>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-share font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Disputes</span>
        </div>
    </div>
    <div class="portlet-body">
        <ul class="feeds" data-page="0" id="dispute-list">

        </ul>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function()
{
    var loading_dispute = false;
    function load_disputes()
    {
        var page = parseInt( $("ul#dispute-list").attr("data-page") );
        page += 1;

        if ( page <= parseInt('<?= $total_pages; ?>') && !loading_dispute )
        {
            var url = "/Disputes/ajaxIndex/page:" + page;
            loading_dispute = true;
            $.get(url, function (data)
            {
                $("ul#dispute-list").attr("data-page", page);
                $("ul#dispute-list").append(data);
                loading_dispute = false;
            });
        }
    }
    
    $("ul#dispute-list").on('scroll', function() 
    {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) 
        {
            load_disputes();
        }
    });
    
    load_disputes();
})
</script>