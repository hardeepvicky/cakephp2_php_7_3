<script src="/assets/global/plugins/jspdf/jspdf.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/addimage.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/annotations.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/autoprint.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/canvas.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/cell.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/context2d.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/deflate.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/filesaver.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/html2canvas.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/javascript.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/outline.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/png.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/png_support.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/prevent_scale_to_fit.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/split_text_to_size.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/standard_fonts_metrics.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/svg.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/total_pages.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/zlib.js"></script>

<script src="/assets/global/plugins/jspdf/jspdf-extend.js"></script>
<script src="/js/jspdf/barcode_label.js?<?= VERSION_JS ?>"></script>
<script src="/assets/global/plugins/barcode/JsBarcode.all.min.js"></script>
<script src="/js/basic_functions.js?<?= VERSION_JS ?>" type="text/javascript"></script>

<div style="display: none">
    <canvas id="canvas-barcode"></canvas>
</div>
<script type="text/javascript">
    var canvas = document.getElementById("canvas-barcode");
    var records = [];
    
    function textToBase64Barcode(i, callback)
    {
        var count = records.length;
        
        var text = records[i]['code'];
        
        JsBarcode(canvas, text, {
            format : "CODE128",
            displayValue : true,
            text: text
        });

        var image = new Image();

        image.src = canvas.toDataURL("image/jpeg");

        image.onload = function () {

            var context = canvas.getContext("2d");
            var degrees = 90;

            if(degrees == 90 || degrees == 270) {
                canvas.width = image.height;
                canvas.height = image.width;
            } else {
                canvas.width = image.width;
                canvas.height = image.height;
            }

            context.clearRect(0,0, canvas.width, canvas.height);
            if(degrees == 90 || degrees == 270) 
            {
                context.translate(image.height/2,image.width/2);
            } 
            else 
            {
                context.translate(image.width/2,image.height/2);
            }

            context.rotate(degrees*Math.PI/180);
            context.drawImage(image, -image.width/2, -image.height/2);

            records[i]['barcode'] = canvas.toDataURL("image/jpeg");

            if (i < count - 1)
            {
                i++;
                textToBase64Barcode(i, callback);
            }
            else
            {
                callback();
            }
        }
    }
    
    function imgToDataUrl(i, callback)
    {
        var count = records.length;
        
        var image = new Image();
        image.src = records[i]['file'];

        image.onload = function () {

            var context = canvas.getContext("2d");
            var degrees = 90;

            if(degrees == 90 || degrees == 270) {
                canvas.width = image.height;
                canvas.height = image.width;
            } else {
                canvas.width = image.width;
                canvas.height = image.height;
            }

            context.clearRect(0,0, canvas.width, canvas.height);
            if(degrees == 90 || degrees == 270) 
            {
                context.translate(image.height/2,image.width/2);
            } 
            else 
            {
                context.translate(image.width/2,image.height/2);
            }

            context.rotate(degrees*Math.PI/180);
            context.drawImage(image, -image.width/2, -image.height/2);

            records[i]['barcode'] = canvas.toDataURL("image/jpeg");

            if (i < count - 1)
            {
                i++;
                imgToDataUrl(i, callback);
            }
            else
            {
                callback();
            }
        }
    }
    
    function generate_barcode_pdf(batch_id)
    {
         $.get("/Batches/get_pdf_barcode_label_records/" + batch_id, function(data)
         {
            records = JSON.parse(data);
            
            if (records.length == 0)
            {
                bootbox.alert("No Data Found");
                return;
            }
            
            textToBase64Barcode(0, function()
            {
                var doc = new jsPDF('P', 'px', [300 * 0.18, 1200 * 0.18]);
                
                jspdf_extend.records = records;
                
                jspdf_extend.generate(doc,
                {
                    page : {
                        width : 300,
                        height : 1200,
                        rows : 1,
                        cols : 1,
                        margin : {
                            top : 50,
                            left : 20
                        }
                    },
                    card : 
                    {
                        width : 220,
                        height : 1140,
                        vSpace : 1,
                        hSpace : 1,
                    },
                    onComplete : function ()
                    {
                    }
                });
            });
            
         });
    }
    
</script>