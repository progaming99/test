<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                            <form method="post" action="<?= base_url('Auth/register'); ?>" enctype="multipart/form-data">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="<?= base_url('assets/img/profile/default.png'); ?>" class="picture-src" id="wizardPicturePreview">
                                        <input type="file" id="wizard-picture" name="image" class="">
                                    </div>
                                    <h6>Upload photos</h6>
                                    <small>Maximum size is 2MB in PNG/JPG format</small>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" id="full_name" class="form-control form-control-lg" name="full_name" value="<?= set_value('full_name'); ?>" />
                                    <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Your Email</label>
                                    <input type="email" id="email" class="form-control form-control-lg" name="email" value="<?= set_value('email'); ?>" />
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" id="password1" name="password1" class="form-control form-control-lg" />
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Repeat your password</label>
                                    <input type="password" id="password2" name="password2" class="form-control form-control-lg" />
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>
                                <p class="text-center text-muted mt-3 mb-0"><a href="<?= base_url('Auth/forgot_password'); ?>" class="text-body"><u>Forgot password</u></a></p>
                                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="<?= base_url('Auth'); ?>" class="fw-bold text-body"><u>Login here</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>