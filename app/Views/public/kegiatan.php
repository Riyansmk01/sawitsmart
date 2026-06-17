<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="mb-2">Kegiatan & Event</h1>
        <p class="lead">Ikuti berbagai kegiatan dan event SawitSmart untuk meningkatkan pengetahuan Anda</p>
    </div>
</section>

<!-- Activities Grid -->
<section class="py-5">
    <div class="container">
        <?php if (!empty($activities)): ?>
        <div class="row g-4">
            <?php foreach ($activities as $activity): ?>
            <div class="col-md-6 col-lg-4">
                <article class="card border-0 shadow-sm h-100 activity-card">
                    <div class="bg-success text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <small class="badge bg-success"><?= date('d M Y', strtotime($activity['date'])) ?></small>
                        </div>
                        <h5 class="card-title fw-bold flex-grow-1"><?= htmlspecialchars($activity['title']) ?></h5>
                        <p class="card-text text-muted text-sm mb-3"><?= substr(strip_tags($activity['description']), 0, 100) ?>...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i><?= htmlspecialchars($activity['location']) ?></small>
                            <a href="<?= base_url('kegiatan/' . $activity['slug']) ?>" class="btn btn-sm btn-outline-success">
                                Detail <i class="fas fa-arrow-right ms-1"></i>
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
            Tidak ada kegiatan yang akan datang. Silakan cek kembali nanti.
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">Jenis-Jenis Kegiatan Kami</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="activity-type p-4 rounded-3 bg-white shadow-sm text-center h-100">
                    <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Workshop & Pelatihan</h5>
                    <p class="text-muted small">Pelatihan teknis dan non-teknis untuk meningkatkan skill pengguna platform.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="activity-type p-4 rounded-3 bg-white shadow-sm text-center h-100">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Webinar & Seminar</h5>
                    <p class="text-muted small">Diskusi mendalam dengan expert tentang trend industri sawit dan teknologi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="activity-type p-4 rounded-3 bg-white shadow-sm text-center h-100">
                    <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Networking Event</h5>
                    <p class="text-muted small">Bertemu dengan pengguna lain dan membangun networking yang bermanfaat.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="activity-type p-4 rounded-3 bg-white shadow-sm text-center h-100">
                    <i class="fas fa-trophy fa-3x text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Kompetisi & Lomba</h5>
                    <p class="text-muted small">Ikuti berbagai kompetisi dengan hadiah menarik dan kesempatan branding.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Jangan Lewatkan Kegiatan Kami</h3>
                    <p class="text-muted">Daftar untuk menerima notifikasi tentang kegiatan dan event terbaru SawitSmart.</p>
                </div>
                <form id="activity-form" action="<?= base_url('api/subscribe') ?>" method="POST" class="d-flex gap-2">
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                    <button type="submit" class="btn btn-success">Daftar</button>
                </form>
                <small class="text-muted d-block mt-3">Kami akan mengirimkan notifikasi kegiatan ke email Anda.</small>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
