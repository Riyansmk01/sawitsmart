<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="container">
        <div class="mb-2">
            <a href="<?= base_url('panduan') ?>" class="text-white text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Panduan
            </a>
        </div>
        <h1 class="mb-2"><?= esc($title ?? 'Panduan') ?></h1>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 content-body">
                <?= $content ?? '' ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
