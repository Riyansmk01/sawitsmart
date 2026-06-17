<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Berita & Kegiatan</h1>
        <p class="lead">Update terbaru tentang SawitSmart dan industri pertanian sawit</p>
    </div>
</section>

<!-- News & Activities Grid -->
<section class="py-5">
    <div class="container">
        <?php if (!empty($news_items)): ?>
        <div class="row g-4">
            <?php foreach ($news_items as $item): ?>
            <div class="col-md-6 col-lg-4">
                <article class="card border-0 shadow-sm h-100 news-card">
                    <?php if (!empty($item['featured_image'])): ?>
                    <img src="<?= base_url('uploads/' . $item['featured_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>" height="200" style="object-fit: cover;">
                    <?php else: ?>
                    <div class="bg-success text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-newspaper fa-3x"></i>
                    </div>
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <small class="badge bg-success"><?= htmlspecialchars($item['category']) ?></small>
                        </div>
                        <h5 class="card-title fw-bold flex-grow-1"><?= htmlspecialchars($item['title']) ?></h5>
                        <p class="card-text text-muted text-sm mb-3"><?= substr(strip_tags($item['content']), 0, 120) ?>...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= date('d M Y', strtotime($item['created_at'])) ?></small>
                            <a href="<?= base_url('berita/' . $item['slug']) ?>" class="btn btn-sm btn-outline-success">
                                Baca <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            Belum ada berita atau kegiatan yang dipublikasikan. Silakan cek kembali nanti.
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Dapatkan Update Terbaru</h3>
                    <p class="text-muted">Berlangganan newsletter kami untuk mendapatkan informasi terbaru tentang SawitSmart dan tips pertanian sawit.</p>
                </div>
                <form id="newsletter-form" action="<?= base_url('api/subscribe') ?>" method="POST" class="d-flex gap-2">
                    <?= csrf_field() ?>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                    <button type="submit" class="btn btn-success">Berlangganan</button>
                </form>
                <small class="text-muted d-block mt-3">Kami menghormati privasi Anda. Unsubscribe kapan saja.</small>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
