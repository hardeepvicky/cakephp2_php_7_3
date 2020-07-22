<div style="display: none">
    <canvas id="canvas-barcode"></canvas>
</div>
<script src="/assets/global/plugins/jspdf/jspdf.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/addimage.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/annotations.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/autoprint.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/canvas.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/cell.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/context2d.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/deflate.js"></script>
<script src="/assets/global/plugins/jspdf/plugins/filesaver.js"></script>
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

<script src="/assets/global/plugins/barcode/JsBarcode.all.min.js"></script>

<script src="/assets/global/plugins/jspdf/jspdf-extend.js"></script>
<script src="/js/jspdf/listing_id.js?<?= VERSION_JS ?>"></script>
<script src="/js/basic_functions.js?<?= VERSION_JS ?>" type="text/javascript"></script>

<script type="text/javascript">
    function create_qrcode(code)
    {
        var canvas = document.getElementById("canvas-barcode");
        JsBarcode(canvas, code, {
            width: 5,
            height : 250,
            displayValue : true,
            text: code,
            fontSize : 40
        });
        
        return canvas.toDataURL("image/png");
    }
    
    var records = JSON.parse('<?= json_encode($records) ?>');
    
    for(var i in records)
    {
        records[i]["barcode"] = create_qrcode(records[i]["code"]);
    }
    
    var doc = new jsPDF('L', 'px', [885 * 0.18, 295 * 0.18]);
            
    jspdf_extend.records = records;

    jspdf_extend.generate(doc,
    {
        page : {
            width : 885,
            height : 295,
            rows : 1,
            cols : 1,
            margin : {
                top : 20,
                left : 20
            }
        },
        card : 
        {
            width : 860,
            height : 280,
            vSpace : 1,
            hSpace : 1,
        },
        onComplete : function ()
        {
            doc.output('save', 'Listing Id.pdf');
        }
    });
</script>