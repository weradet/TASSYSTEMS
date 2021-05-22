<!-- 
    javascript
    @author Natsuda Kuhasak 62160085
    @update Date 2564-04-21 -->

<!-- Argon Scripts -->
<!-- Core -->
<script src="<?php echo base_url() . 'assets/templete/argon-dashboard-master' ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() . 'assets/templete/argon-dashboard-master' ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() . 'assets/templete/argon-dashboard-master' ?>/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?php echo base_url() . 'assets/templete/argon-dashboard-master' ?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo base_url() . 'assets/templete/argon-dashboard-master' ?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="<?php echo base_url() . 'assets/templete/argon-dashboard-master' ?>/assets/js/argon.js?v=1.2.0"></script>

<!-- 
    ajax and datatable
    @author Weradet Nopsombun 62160110
    @update Date 2564-04-22 -->

<!-- ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- datatable -->
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugin' ?>/DataTables/datatables.min.js"></script>
<!-- Sweet alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js" integrity="sha512-t89+ZHqiI+cJO2EZ1zy846TMzc7K0VH22insNeb32hMoVymAMd0aYeLzmNF4WuRLDUXPVo6dzbZ1zI7MBWlqlQ==" crossorigin="anonymous"></script>
<script>
        function convert_datatable(id_table, check) {
                if (check == true) {
                        var datable = $('#' + id_table).DataTable({
                                "pagingType": "full_numbers",
                                "lengthMenu": [
                                        [10, 25, 50, -1],
                                        [10, 25, 50, "All"]
                                ],
                                deferRender: true,
                                scrollY: '20rem',
                                scrollX: true,
                                scrollCollapse: true,
                                scroller: true,
                                keys: true
                        });
                } else {
                        var datable = $('#' + id_table).DataTable({
                                "pagingType": "full_numbers",
                                "lengthMenu": [
                                        [10, 25, 50, -1],
                                        [10, 25, 50, "All"]
                                ],
                                deferRender: true,
                                scrollY: '20rem',
                                scrollX: false,
                                scrollCollapse: true,
                                scroller: true,
                                keys: true
                        });
                }
        }
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>