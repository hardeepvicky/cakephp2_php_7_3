<script src="/frontend/vendor/animsition/js/animsition.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/bootstrap/js/popper.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/bootstrap/js/bootstrap.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/select2/select2.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/daterangepicker/moment.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/daterangepicker/daterangepicker.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/slick/slick.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/js/slick-custom.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/parallax100/parallax100.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/MagnificPopup/jquery.magnific-popup.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/isotope/isotope.pkgd.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/sweetalert/sweetalert.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script src="/frontend/vendor/perfect-scrollbar/perfect-scrollbar.min.js?<?= VERSION_FONTEND_LIB ?>"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    });

    $('.parallax100').parallax100();

    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<script src="/frontend/js/main.js?<?= VERSION_FONTEND_JS ?>"></script>
<script src="/js/jquery-extend.js?<?= VERSION_JS ?>" type="text/javascript"></script>
<script src="/js/ajax.js?<?= VERSION_JS ?>" type="text/javascript"></script>
<script src="/js/tf-loader/tf-loader.js?<?= VERSION_JS ?>" type="text/javascript"></script>
<script src="/js/cascade.js?<?= VERSION_JS ?>" type="text/javascript"></script>        
<script src="/js/jquery-input-validate.js?<?= VERSION_JS ?>" type="text/javascript"></script>    