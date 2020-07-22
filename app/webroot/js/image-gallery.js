jQuery.fn.extend({
    browseGallery : function ()
    {
        return this.each(function()
        {
            var _this = $(this);
            
            $(this).hide();
            
            var value = $(this).val();
            var multiple = $(this).attr("multiple");
            multiple = multiple ? 1 : 0;
                        
            var btn = "<span class='image-gallery-browse btn blue'>Browse</span><span class='image-gallery-files-info' style='margin-left:5px;'></span>";
            
            $(this).parent().append(btn);
            
            var html = '<div class="modal fade" id="image-gallery-modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">';
                    html += '<div class="modal-dialog modal-full">';
                        html += '<div class="modal-content">';
                            html += '<div class="modal-header">';
                                html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>';
                                html += '<h4 class="modal-title">Image Gallery</h4>';
                            html += '</div>';
                        html += '<div class="modal-body"> </div>';
                    html += '<div class="modal-footer">';
                        html += '<button class="btn blue de-select">De-Select All</button>';
                        html += '<button class="btn green select">Select</button>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
            html += '</div>';
            
            var image_gallery_modal = $("#image-gallery-modal");
            
            if (image_gallery_modal.length == 0)
            {
                $("body").append(html);
                image_gallery_modal = $("#image-gallery-modal");
            }
            
            btn = $(this).parent().find(".image-gallery-browse");
            
            btn.click(function ()
            {
                $(image_gallery_modal).find(".modal-body").load("/Images/index", {value : value, multiple : multiple});
                $(image_gallery_modal).modal({ show: true});
            });
            
            var list = value ? value.split(",") : [];
            var file_info = $(this).parent().find(".image-gallery-files-info");
            file_info.html(list.length + " files Selected");
            
            image_gallery_modal.find(".modal-footer button.select").click(function()
            {
                var list = [];
                $("#image-gallery-container .img-container.selected").each(function()
                {
                    var id = $(this).data("id");
                    list.push(id);
                });
                
                if (list.length == 0)
                {
                    bootbox.alert("Please select at least one Image");
                }
                else
                {
                    file_info.html(list.length + " files Selected");

                    _this.val(list.join(","));

                    $(image_gallery_modal).modal('hide');
                }
            });
            
            image_gallery_modal.find(".modal-footer button.de-select").click(function()
            {
                $("#image-gallery-container .img-container").removeClass("selected");
                $("#image-gallery-container .img-container .selection-area").html("");
            });
        });
    },
});