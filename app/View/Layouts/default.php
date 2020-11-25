<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?= (isset($title_for_layout) ? $title_for_layout : "") ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Seven Rocks International" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-dialog/bootstrap-dialog.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/select2/css/select2.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap3-editable/css/bootstrap-editable.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/assets/global/css/components.min.css?<?= VERSION_LIB ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/assets/global/css/plugins.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <link type="text/css" rel="stylesheet" href="/assets/global/plugins/fancybox/dist/jquery.fancybox.min.css?<?= VERSION_LIB ?>" />
        <link type="text/css" rel="stylesheet" href="/assets/global/plugins/fancybox/src/css/slideshow.css?<?= VERSION_LIB ?>" />
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/assets/layouts/layout/css/layout.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/assets/layouts/layout/css/themes/darkblue.min.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="/assets/layouts/layout/css/custom.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        
        <link href="/node_modules/sr-basic-feature/dist/sr-basic-feature.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/node_modules/sr-bootstrap-components/dist/sr-ajax-file-upload.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        <link href="/node_modules/sr-bootstrap-components/dist/sr-datatable.css?<?= VERSION_LIB ?>" rel="stylesheet" type="text/css" />
        
        <link href="/css/bootstrap-extend.css?<?= VERSION_CSS ?>" rel="stylesheet" type="text/css" />
        <link href="/css/style.css?<?= VERSION_CSS ?>" rel="stylesheet" type="text/css" />
        
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="/favicon.ico" /> 
        <script src="/assets/global/plugins/jquery.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
    </head>
        <!-- END HEAD -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div id="text-to-speech" style="display: none;"></div>
        <div class="page-wrapper">
            <?php echo $this->element("header"); ?>
            <div class="clearfix"> </div>
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <?php echo $this->element("sidebar"); ?>
                <div class="page-content-wrapper">
                    <div class="page-content">                        
                        <?php echo $this->fetch("content"); ?>
                    </div>
                </div>
            </div>
            <!-- END CONTAINER -->
            <?php echo $this->element("footer"); ?>
            
            <div style="background-color: #fff">
            <?php 
                if (Configure::read("debug") > 0)
                {
                    echo $this->element('sql_dump');
                }
            ?>
            </div>
        </div>
        <!--[if lt IE 9]>
        <script src="/assets/global/plugins/respond.min.js"></script>
        <script src="/assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>        
        <script src="/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->        
        <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-dialog/bootstrap-dialog.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/select2/js/select2.full.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootbox.min.js?<?= VERSION_LIB ?>"></script>
        <script src="/assets/global/plugins/File-Validator/file-validator.js?<?= VERSION_LIB ?>" type="text/javascript" charset="utf-8"></script>
        <script src="/assets/global/plugins/bootstrap3-editable/js/bootstrap-editable.min.js?<?= VERSION_LIB ?>" type="text/javascript" charset="utf-8"></script>
        <script src="/assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js?<?= VERSION_LIB ?>" type="text/javascript" charset="utf-8"></script>
        <script src="/assets/global/plugins/jquery.pulsate.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        
        <script type="text/javascript" src="/assets/global/plugins/fancybox/dist/jquery.fancybox.min.js?<?= VERSION_LIB ?>"></script>
        <script type="text/javascript" src="/assets/global/plugins/fancybox/src/js/slideshow.js?<?= VERSION_LIB ?>"></script>
        <script type="text/javascript" src="/assets/global/plugins/fancybox/src/js/wheel.js?<?= VERSION_LIB ?>"></script>

        <script type="text/javascript" src="/assets/global/plugins/Lightweight-jQuery-Based-Text-To-Speech/articulate.min.js?<?= VERSION_LIB ?>"></script>
        <script type="text/javascript" src="/assets/global/plugins/jquery.form.min.js?<?= VERSION_LIB ?>"></script>
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/assets/global/scripts/app.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/assets/layouts/layout/scripts/layout.min.js?<?= VERSION_LIB ?>" type="text/javascript"></script>        
        <!-- END THEME LAYOUT SCRIPTS -->
        
        <script src="/node_modules/sr-basic-feature/dist/sr-basic-functions.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/node_modules/sr-basic-feature/dist/sr-basic-feature.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/node_modules/sr-bootstrap-components/dist/sr-datatable.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        <script src="/node_modules/sr-bootstrap-components/dist/sr-ajax-file-upload.js?<?= VERSION_LIB ?>" type="text/javascript"></script>
        
        <script src="/js/basic_functions.js?<?= VERSION_JS ?>" type="text/javascript"></script>
        <script src="/js/jquery-extend.js?<?= VERSION_JS ?>" type="text/javascript"></script>                
        <script src="/js/bootstrap-extend.js?<?= VERSION_JS ?>" type="text/javascript"></script>                
        <script src="/js/jquery-input-validate.js?<?= VERSION_JS ?>" type="text/javascript"></script>
        <script src="/js/ajax.js?<?= VERSION_JS ?>" type="text/javascript"></script>        
        
        <script src="/js/default.js?<?= VERSION_JS ?>" type="text/javascript"></script>
    </body>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("body").srLoader();
            
            $(document).on("change", ".submit-search-on-change", function ()
            {
                var form = $(this).parents("form");                
                if( form[0].checkValidity()) 
                {
                    $(this).parents("form").trigger("submit");
                }
                else
                {
                    form[0].reportValidity();
                }
            });
            
            $("#page-summary").on("click", ".ajax-paginator a, table > thead > tr > th > a", function()
            {
                var href = $(this).attr("href");
                $("#page-summary").load(href, function()
                {
                    App.initAjax();
                    window.history.pushState({url : href}, document.title, href);
                });
                
                return false;
            });
            
            window.addEventListener('popstate', function(e) 
            {
                if (e.state) 
                {
                    $("#page-summary").load(e.state.url, function()
                    {
                        App.initAjax();
                    });
                }
            });
            
            $(document).on("submit", "form[method='get']", function()
            {
                $(this).find("input").each(function()
                {
                    var v = $(this).val().trim();
                    
                    if (v)
                    {
                        v = encodeURIComponent(v);
                        $(this).val(v);
                    }
                })
            });
        });
    </script>   
</html>