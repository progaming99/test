<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h3 class="text-uppercase text-center">Change your password for</h3>
                            <h5 class="mb-5 text-center"><?= $this->session->userdata('reset_email'); ?></h5>

                            <form method="post" action="<?= base_url('Auth/changePassword'); ?>">
                                <div class="form-outline mb-4">
                                    <label class="form-label">Enter new password</label>
                                    <input type="password" id="password1" class="form-control form-control-lg" name="password1" />
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Repeat password</label>
                                    <input type="password" id="password2" class="form-control form-control-lg" name="password2" />
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Change password</button>
                                </div>
                            </form>
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
    <?php if ($this->session->flashdata('forgot1')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('forgot1')) ?>;
        Swal.fire({
            title: "Warning!",
            text: "<?= $this->session->flashdata('forgot1') ?>",
            icon: "error",
            showConfirmButton: false,
            timer: 1500,
        });
    <?php
        unset($_SESSION['forgot1']);
    } ?>
</script>