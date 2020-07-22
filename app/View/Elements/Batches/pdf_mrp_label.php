<div style="display: none">
    <canvas id="canvas-qrcode"></canvas>
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
<script src="/js/jspdf/mrp_label.js?<?= VERSION_JS ?>"></script>
<script src="/assets/global/plugins/QRious/qrious.min.js"></script>
<script src="/js/basic_functions.js?<?= VERSION_JS ?>" type="text/javascript"></script>

<script type="text/javascript">
    function create_qrcode(code, qr_size)
    {
       var qrcodeObj = new QRious({
            element: document.getElementById('canvas-qrcode'),
            value: code,
            background: 'white', // background color
            foreground: 'black', // foreground color
            backgroundAlpha: 1,
            foregroundAlpha: 1,
            level: 'L', // Error correction level of the QR code (L, M, Q, H)
            mime: 'image/png', // MIME type used to render the image for the QR code
            size: 250, // Size of the QR code in pixels.
            padding: null // padding in pixels
        });
        
        return qrcodeObj.toDataURL("image/png");
    }
    
    function generate_mrp_pdf(batch_id)
    {
         $.get("/Batches/get_pdf_mrp_label_records/" + batch_id, function(data)
         {
            var records = JSON.parse(data);
            
            if (records.length == 0)
            {
                bootbox.alert("No Data Found");
                return;
            }
            
            for ( var i in records)
            {
                records[i]['qrcode'] = create_qrcode(records[i]['serial_code']);
            }

            var doc = new jsPDF('L', 'px', [840 * 0.18, 460 * 0.18]);
            
            jspdf_extend.records = records;
            
            jspdf_extend.generate(doc,
            {
                page : {
                    width : 840,
                    height : 475,
                    rows : 1,
                    cols : 1,
                    margin : {
                        top : 20,
                        left : 20
                    }
                },
                card : 
                {
                    width : 800,
                    height : 440,
                    vSpace : 1,
                    hSpace : 1,
                },
                onComplete : function ()
                {
                }
            });
        });
    }
</script>