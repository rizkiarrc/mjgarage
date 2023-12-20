<?php $site = $this->konfigurasi_model->get_all();
?>
<!-- content page -->
<section class="bgwhite p-t-66 p-b-38">
    <div class="container">
        <div class="row">
            <div class="col-md-8 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    Tentang Kami
                </h3>

                <p class="p-b-28">
                    <?= $site->tentang ?>    
                </p>
            </div>
        </div>
    </div>
</section>