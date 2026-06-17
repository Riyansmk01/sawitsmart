<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="container">
        <div class="mb-2">
            <a href="<?= base_url('kegiatan') ?>" class="text-white text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Kegiatan
            </a>
        </div>
        <h1 class="mb-2"><?= esc($post['title']) ?></h1>
        <p class="lead mb-0"><?= date('d M Y', strtotime($post['created_at'])) ?></p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (!empty($post['featured_image'])): ?>
                <img src="<?= base_url('uploads/' . $post['featured_image']) ?>" class="img-fluid rounded shadow-sm mb-4" alt="<?= esc($post['title']) ?>">
                <?php endif; ?>
                <article class="content-body">
                    <?= $post['content'] ?>
                </article>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
