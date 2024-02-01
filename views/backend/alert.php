<script src="<?= base_url('assets/plugins/toastr/'); ?>toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/toastr/'); ?>toastr.min.css">


<script type="text/javascript">
// $(function() {
//     toastr.options = [
//         timeOut: 2000,
//         extendedTimeOut: 0,
//         fadeOut: 0,
//         fadeIn: 0,
//         // position: topCenter,
//         topCenter: 'toast-top-center',
//         showDuration: 0,
//         hideDuration: 0
//     ];
// })
<?php if ($this->session->flashdata('success')) {?>
toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php } else if ($this->session->flashdata('error')) {?>
toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } else if ($this->session->flashdata('warning')) {?>
toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php } else if ($this->session->flashdata('info')) {?>
toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php }?>
</script>
