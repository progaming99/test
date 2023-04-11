<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Edit Profile</h2>
                            <?= form_open_multipart('User/edit_profile'); ?>
                            <div class="picture-container">
                                <div class="picture">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="picture-src" id="wizardPicturePreview">
                                    <input type="file" id="wizard-picture" name="image" class="">
                                </div>
                                <h6>Upload photos</h6>
                                <small>Maximum size is 2MB in PNG/JPG format</small>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label">Your Name</label>
                                <input type="text" id="full_name" class="form-control form-control-lg" name="full_name" value="<?= $user['full_name']; ?>" />
                                <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label">Your Email</label>
                                <input type="email" id="email" class="form-control form-control-lg" name="email" value="<?= $user['email']; ?>" readonly />
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>