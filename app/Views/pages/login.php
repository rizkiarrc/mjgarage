<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<!-- content page -->
<?php $validation = \Config\Services::validation(); ?>
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-b-30 centered">
                <form class="leave-comment" action="<?= base_url('member'); ?>" method="post">
                    <h4 class="m-text26 p-b-15">
                        Login
                    </h4>
                    <?= session()->setFlashdata('message'); ?>
                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" type="text" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </small>

                    </div>

                    <div class="bo4 size15 m-b-25">
                        <input class="sizefull s-text7 p-l-22 p-r-22 <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" type="password" id="password" name="password" placeholder="Password">

                        <small class="text-danger pl-3 invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </small>

                    </div>

                    <div class="w-size25">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit" value="submit" class="btn submit_btn">Login
                        </button>
                    </div>
                    <div class="text-center m-b-7 m-t-25">
                        <div class="text-center mb-5">
                            <a class="small" href="<?= base_url('member/register'); ?>">Belum punya akun? Daftar disini!</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection('content'); ?>