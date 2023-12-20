<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<!-- content page -->
<?php $validation = \Config\Services::validation(); ?>
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30 centered">
                <form class="leave-comment" action="<?= base_url('member/register'); ?>" method="post">
                    <h4 class="m-text26 p-b-15">
                        Registrasi Form
                    </h4>
                    <?= session()->setFlashdata('message'); ?>
                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" type="text" id="nama" name="nama" placeholder="Nama Lengkap" value="<?php echo set_value('nama'); ?>">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </small>

                    </div>

                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" type="text" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </small>

                    </div>

                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('password1')) ? 'is-invalid' : ''; ?>" type="password" id="password1" name="password1" placeholder="Password">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('password1'); ?>
                        </small>

                    </div>

                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" type="password" id="password2" name="password2" placeholder="Ulangi Password">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('password2'); ?>
                        </small>

                    </div>

                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" type="text" id="alamat" name="alamat" placeholder="Alamat" value="<?php echo set_value('alamat'); ?>">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </small>

                    </div>

                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" type="text" id="telepon" name="telepon" placeholder="Telepon" value="<?php echo set_value('telepon'); ?>">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('telepon'); ?>
                        </small>

                    </div>

                    <div class="w-size25">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit" value="submit" class="btn submit_btn">Register
                        </button>
                    </div>
                    <div class="text-center m-b-7 m-t-25">
                        <a class="small center_nav" href="<?= base_url('member'); ?>">Already have an account? Login!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection('content'); ?>