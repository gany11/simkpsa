<footer class="main-footer">
    <strong>Copyright &copy; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script> PT Perta Sakti Abadi.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/jszip/jszip.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $('textarea').summernote();
        
        setTimeout(function() {
            <?php
            $session = session();
            ?>
            <?php if ($session->getFlashdata('sukses')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $session->getFlashdata('sukses'); ?>',
                    confirmButtonText: 'OK'
                });
            <?php elseif ($session->getFlashdata('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo $session->getFlashdata('error'); ?>',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>
        }, 500); // Delay to ensure Summernote is initialized
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach event listener to all elements with the 'delete-link' class
        document.querySelectorAll('.delete-link').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link action

                const url = this.href; // Get the URL from the link

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the URL if confirmed
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach event listener to all elements with the 'delete-link' class
        document.querySelectorAll('.logout').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link action

                const url = this.href; // Get the URL from the link

                Swal.fire({
                    title: 'Apakah Anda yakin ingin keluar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the URL if confirmed
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "autoWidth": false, 
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>