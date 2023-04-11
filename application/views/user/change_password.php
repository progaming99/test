<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Change password</h2>
                            <form class="user" action="<?= base_url('User/change_password') ?>" method="POST">
                                <div class="form-outline mb-4">
                                    <label class="form-label">Old password</label>
                                    <input type="password" class="form-control form-control-lg" name="old_password" />
                                    <?= form_error('old_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">New password</label>
                                    <input type="password" class="form-control form-control-lg" name="new_password1" />
                                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Confirm password</label>
                                    <input type="password" class="form-control form-control-lg" name="new_password2" />
                                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($this->session->flashdata('flash1')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('flash1')) ?>;
        Swal.fire({
            text: "<?= $this->session->flashdata('flash1') ?>",
            icon: "warning",
            button: false,
            timer: 5000,
        });
    <?php } ?>
</script>

<script>
    <?php if ($this->session->flashdata('flash2')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('flash2')) ?>;
        Swal.fire({
            text: "<?= $this->session->flashdata('flash2') ?>",
            icon: "warning",
            button: false,
            timer: 5000,
        });
    <?php } ?>
</script>