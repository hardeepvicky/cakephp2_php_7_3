<script type="text/javascript">
    var search = JSON.parse('<?= json_encode($search) ?>');
    var start_count = parseInt('<?= $start_count ?>');
    var record_count = parseInt('<?= count($records) ?>');
    $(document).ready(function ()
    {
        var loading = false;

        function get_params(search)
        {
            var list = [];
            for (var i in search)
            {
                list.push(i + ":" + search[i]);
            }

            return list.join("/");
        }

        function load_more(reach_to_end)
        {
            loading = true;

            var page = $('table#report').attr("data-page");

            if (typeof page == "undefined")
            {
                page = 1;
            } 
            else
            {
                page = parseInt(page);
            }

            search["page"] = page + 1;
            search["start_count"] = start_count + record_count;
            var url = '<?= $base_url ?>' + get_params(search);

            Loader.onShown = function ()
            {
                $(".tf-loader-container .help-block").html('Loading Page ' + search["page"]);
            }
            
            $.ajax(
            {
                url: url,
                global: false,
                beforeSend: function()
                {
                    Loader.show();
                },
                complete: function(result)
                {
                    Loader.hide();
                    
                    var response = result.responseText;
                    
                    if (response == "0")
                    {
                        $(".tf-loader-container .help-block").html('');
                        bootbox.alert("You reach at end of page");
                    }
                    else
                    {
                        loading = false;
                        $('table#report').attr("data-page", search["page"]);
                        $('table#report tbody').append(response);
                        
                        if (reach_to_end)
                        {
                            setTimeout(function()                            
                            {
                                load_more(true);
                            }, 800);
                            
                        }
                    }
                },
                error: function()
                {
                    $(".tf-loader-container .help-block").html("");
                    Loader.hide();
                }
            });
        }

        $(window).scroll(function ()
        {
            var hT = $('table#report').offset().top,
                    hH = $('table#report').outerHeight(),
                    wH = $(window).height(),
                    wS = $(this).scrollTop();

            if (wS > (hT + hH - wH))
            {
                if (!loading)
                {
                    load_more(false);
                }
            }
        });

        $("#load-all").click(function ()
        {
            load_more(true);
        })
    });
</script>