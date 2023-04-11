<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Login</h2>

                            <form method="post" action="<?= base_url('Auth'); ?>" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label class="form-label">Your Email</label>
                                    <input type="email" id="email" class="form-control form-control-lg" name="email" value="<?= set_value('email'); ?>" />
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                                </div>

                                <p class="text-center text-muted mt-3 mb-0"><a href="<?= base_url('Auth/forgot_password'); ?>" class="text-body"><u>Forgot password</u></a></p>
                                <p class="text-center text-muted mb-0">Don't have an account yet? <a href="<?= base_url('Auth/register'); ?>" class="fw-bold text-body"><u>Register here</u></a></p>
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
    <?php if ($this->session->flashdata('register')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('register')) ?>;
        Swal.fire({
            title: "Congratulations!",
            text: "<?= $this->session->flashdata('register') ?>",
            icon: "info",
        });
    <?php
        unset($_SESSION['register']);
    } ?>

    <?php if ($this->session->flashdata('error1')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('error1')) ?>;
        Swal.fire({
            title: "Error!",
            text: "<?= $this->session->flashdata('error1') ?>",
            icon: "error",
            button: false,
            timer: 5000,
        });
    <?php
        unset($_SESSION['error1']);
    } ?>

    <?php if ($this->session->flashdata('error2')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('error2')) ?>;
        Swal.fire({
            title: "Error!",
            text: "<?= $this->session->flashdata('error2') ?>",
            icon: "error",
            button: false,
            timer: 5000,
        });
    <?php
        unset($_SESSION['error2']);
    } ?>

    <?php if ($this->session->flashdata('error3')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('error3')) ?>;
        Swal.fire({
            title: "Error!",
            text: "<?= $this->session->flashdata('error3') ?>",
            icon: "error",
            button: false,
            timer: 5000,
        });
    <?php
        unset($_SESSION['error3']);
    } ?>

    <?php if ($this->session->flashdata('logout')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('logout')) ?>;
        Swal.fire({
            title: "Congratulations!",
            text: "<?= $this->session->flashdata('logout') ?>",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
        });
    <?php
        unset($_SESSION['logout']);
    } ?>

    <?php if ($this->session->flashdata('message')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('message')) ?>;
        Swal.fire({
            title: "Congratulations!",
            text: "<?= $this->session->flashdata('message') ?>",
            icon: "success",
            button: false,
            timer: 5000,
        });
    <?php
        unset($_SESSION['message']);
    } ?>
</script>