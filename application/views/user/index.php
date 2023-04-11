<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Wellcome</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= base_url('Auth/logout'); ?> " class="btn btn-primary" type="button">Logout</a>
                            </div>
                            <div class="picture-container">
                                <div class="picture">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="picture-src">
                                </div>
                            </div>
                            <p class="card-text">
                                <small class="text-muted">Member since <?= date('d F Y', $user['created_at']); ?></small>
                            </p>
                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" value="<?= $user['full_name']; ?>" disabled readonly />
                            </div>

                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" value="<?= $user['email']; ?>" disabled readonly />
                            </div>

                            <a href="<?= base_url('User/edit_profile'); ?>" class="btn btn-success">Edit Profile</a>
                            <a href="<?= base_url('User/change_password'); ?>" class="btn btn-warning">Change Password</a>
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
    <?php if ($this->session->flashdata('profile')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('profile')) ?>;
        Swal.fire({
            title: "Congratulations",
            text: "<?= $this->session->flashdata('profile') ?>",
            icon: "success",
            button: false,
            timer: 5000,
        });
    <?php } ?>

    <?php if ($this->session->flashdata('flash')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('flash')) ?>;
        Swal.fire({
            title: "Congratulations",
            text: "<?= $this->session->flashdata('flash') ?>",
            icon: "success",
            button: false,
            timer: 5000,
        });
    <?php } ?>
</script>