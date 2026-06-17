<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="container">
        <h1 class="mb-2"><?= esc($page['title']) ?></h1>
        <?php if (!empty($page['meta_description'])): ?>
        <p class="lead mb-0"><?= esc($page['meta_description']) ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 content-body">
                <?= $page['content'] ?? '' ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
