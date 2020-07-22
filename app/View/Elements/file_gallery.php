<?php if (isset($width)): ?>
<style>
    <?php 
        $w = $width . "px";
    ?>
    .img-block
    {
        margin-top: 15px;
        margin-bottom: 15px;
        width : <?= $w ?>;
        margin-left: 20px;
        margin-right: 20px;
        float: left;
    }
        
    .img-container
    {
        border: 1px solid #BBB;
        border-radius: 5px !important;
        background-color: #EEE;
        padding: 5px;
        position: relative;
        text-align: center;
    }
    
    .img-container a.fancybox{
        width : 100%;
        display: block;
        text-align: center;
    }
    
    .img-container .main-img{
        height: 140px;
        width : auto;
        max-width: 100%;
    }
    
    .img-container .cross-btn
    {
        position: absolute;
        right : -10px;
        top: -11px;
        background-color: #EEE;
        color : #ff0033;
        padding: 2px 8px;
        font-size: 24px;
        border-radius: 50% !important;
    }
    
    .img-container .edit-btn
    {
        position: absolute;
        left : -10px;
        top: -11px;
        background-color: #EEE;
        color : #1BBC9B;
        padding: 2px 8px;
        font-size: 24px;
        border-radius: 50% !important;
    }
    
    .img-container .download-btn
    {
        position: absolute;
        right : -10px;
        bottom: -11px;
        background-color: #EEE;
        color : #578EBE;
        padding: 2px 8px;
        font-size: 24px;
        border-radius: 50% !important;
    }
    
    .img-container .name
    {
        margin : 2px 0;
        color : #000;
        text-align: center;
        overflow: hidden;
    }
</style>
<?php endif; ?>

<div class="row file_gallery-<?= $group ?>">
    <?php 
        $default_icons = array(
            "jpg" => "img/dummy.jpg",
            "png" => "img/dummy.jpg",
            "gif" => "img/dummy.jpg",
            "jpeg" => "img/dummy.jpg",
            "bmp" => "img/dummy.jpg",
            
            "csv" => "img/excel.png",
            "xlr" => "img/excel.png",
            "ods" => "img/excel.png",
            "xls" => "img/excel.png",
            "xlsx" => "img/excel.png",
            
            "doc" => "img/doc.png",
            "docx" => "img/doc.png",
            "odt" => "img/doc.png",
            
            "pdf" => "img/pdf.png",
            "txt" => "img/txt.png",
            
            "sql" => "img/sql.png",
            "xml" => "img/xml3.png",
            
            "exe" => "img/exe.png",
            
            "mp3" => "img/music.png",
            "wma" => "img/music.png",
            
            "mp4" => "img/video.png",
            "mov" => "img/video.png",
            "wmv" => "img/video.png",
            "m4v" => "img/video.png",
            "mpeg" => "img/video.png",
            "avi" => "img/video.png",
            
            "zip" => "img/zip.png",
            "rar" => "img/zip.png",
        );
        foreach($records as $record): 
            $ext = trim(strtolower(pathinfo($record["file"], PATHINFO_EXTENSION)));
            $ext = explode("?", $ext)[0];
        
            if (!isset($record["thumnail"]))
            {
                $record["thumnail"] = isset($default_icons[$ext]) ? $default_icons[$ext] : "img/file.png";
            }
            
        $cols = isset($style["columns"]) ? $style["columns"] : 4;
        
        $cls = "col-md-" . $cols . " col-sm-" . ceil($cols . 1.5) . " col-xs-" . ($cols * 2);
         
    ?>
    <div class="img-block">            
        <div class="img-container">
            <?php if ( isset($record["delete"]) ): ?>
                <a class="delete-file cross-btn" href="<?= $record["delete"] ?>">
                    <i class="fa fa-trash"></i>
                </a>
            <?php endif; ?>
            
            <?php if ( isset($record["edit"]) ): ?>
                <a class="edit-btn" href="<?= $record["edit"] ?>">
                    <i class="fa fa-edit"></i>
                </a>
            <?php endif; ?>
            
            <?php if ( isset($record["download"]) ): ?>
                <a class="download-btn" href="<?= $record["download"] ?>" download>
                    <i class="fa fa-download"></i>
                </a>
            <?php endif; ?>
            
            <?php if (in_array($ext, array("jpg", "jpeg", "gif", "png", "bmp"))): ?>
                <a href="/<?= $record["file"] ?>" class="fancybox" data-fancybox='group-<?= $group ?>'>
                    <img class="main-img" src="/<?= $record["thumnail"] ?>">
                </a>
            <?php else: ?>
                <img class="main-img" src="/<?= $record["thumnail"] ?>">
            <?php endif; ?>
                
            <?php if ( isset($record["name"]) ): ?>
                <div class="name"><?= $record["name"] ?></div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $(".file_gallery-<?= $group ?>").on("click", ".delete-file", function ()
        {
            var _this = $(this);
            var href = $(this).attr("href");
            
            bootbox.confirm({
                message: "Are You sure to Delete. This can not be undo.",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) 
                {
                    if (result)
                    {
                        $.get(href, function (data)
                        {
                            if (data == "1")
                            {
                                _this.parents(".img-block").remove();
                            }
                            else
                            {
                                bootbox.alert(data);
                            }
                        });
                    }
                }
            });
            
            return false;
        });
    })
</script>
