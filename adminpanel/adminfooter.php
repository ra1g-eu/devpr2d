<footer class="app-footer">
    <div class="container text-center py-3">
        <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
        <small class="copyright">Designed with <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>

    </div>
</footer><!--//app-footer-->

<!-- Javascript -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/js/confirmation.js"></script>
<script src='../js/tinymce/tinymce.min.js'></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>
<script>
    $(document).ready(function() {
        $('#rolechangetable').DataTable({
            paging: true,
            "columnDefs": [
                { "orderable": false, "targets": [3] },
                { "orderable": true, "targets": [0, 1, 2] }
            ]
        });
        $('#menuedittable').DataTable({
            paging: true,
            "columnDefs": [
                { "orderable": false, "targets": [5] },
                { "orderable": true, "targets": [0, 1, 2, 3, 4] }
            ]
        });
        $('#allreleases').DataTable({
            paging: true,
            "columnDefs": [
                { "orderable": false, "targets": [6] },
                { "orderable": true, "targets": [0, 1, 2, 3, 4, 5] }
            ]
        });
        $('#latestreleases').DataTable({
            paging: true,
            "columnDefs": [
                { "orderable": false, "targets": [6] },
                { "orderable": true, "targets": [0, 1, 2, 3, 4, 5] }
            ]
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".modalmenuedit").on('click', function (e) { //trigger when link clicked
            e.preventDefault();
            $('#menuBox').modal('show'); //force modal to show
            $('.modal-content').load($(this).attr('href')); //load content from link's href
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".modaledituser").on('click', function (e) { //trigger when link clicked
            e.preventDefault();
            $('#userBox').modal('show'); //force modal to show
            $('.modal-content').load($(this).attr('href')); //load content from link's href
        });
    });
</script>
<script>
    tinymce.init({
        selector: 'textarea#changelogtextf',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | bold italic underline strikethrough | numlist bullist | forecolor backcolor removeformat | charmap | fullscreen  preview |link anchor codesample | ltr rtl',
    });
    tinymce.init({
        selector: 'textarea#fulltextf',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | bold italic underline strikethrough | numlist bullist | forecolor backcolor removeformat | charmap | fullscreen  preview |link anchor codesample | ltr rtl',
        height: 600,
        content_style: ".mce-content-body {font-size:14px}",
    });
</script>
</body>
</html> 