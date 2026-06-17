<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p class="lead">Kami siap membantu Anda dengan pertanyaan atau permintaan apapun</p>
    </div>
</section>

<section class="ss-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <h3 class="mb-4">Kirimkan Pesan Anda</h3>

                <?php if (session()->has('success')): ?>
                <div class="ss-alert-success">
                    <i class="fas fa-check-circle me-2"></i><?= esc(session('success')) ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('kontak/submit') ?>" method="POST" class="ss-form">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= esc(old('name')) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="<?= esc(old('email')) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Nomor Telepon</label>
                        <input type="tel" name="phone" class="form-control" value="<?= esc(old('phone')) ?>">
                    </div>

                    <div class="mb-3">
                        <label>Subjek <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" value="<?= esc(old('subject')) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Kategori Pertanyaan</label>
                        <select name="category" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <option value="informasi_produk" <?= old('category') === 'informasi_produk' ? 'selected' : '' ?>>Informasi Produk</option>
                            <option value="demo" <?= old('category') === 'demo' ? 'selected' : '' ?>>Demo Aplikasi</option>
                            <option value="pertanyaan_teknis" <?= old('category') === 'pertanyaan_teknis' ? 'selected' : '' ?>>Pertanyaan Teknis</option>
                            <option value="kerjasama" <?= old('category') === 'kerjasama' ? 'selected' : '' ?>>Kerjasama</option>
                            <option value="lainnya" <?= old('category') === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Pesan <span class="text-danger">*</span></label>
                        <textarea name="message" rows="6" class="form-control" required><?= esc(old('message')) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                    </button>
                </form>
            </div>

            <div class="col-lg-5">
                <h3 class="mb-4">Informasi Kontak</h3>

                <div class="ss-contact-info">
                    <h6><i class="fas fa-map-marker-alt"></i>Lokasi</h6>
                    <p class="mb-0">Universitas Jambi<br>Kampus Pinang Masak<br>Jambi, Indonesia</p>
                </div>

                <div class="ss-contact-info">
                    <h6><i class="fas fa-phone"></i>Telepon</h6>
                    <p class="mb-0"><a href="tel:085268041096" class="text-decoration-none text-dark">0852-6804-1096</a></p>
                </div>

                <div class="ss-contact-info">
                    <h6><i class="fas fa-envelope"></i>Email</h6>
                    <p class="mb-0"><a href="mailto:admin@sawitsmart.com" class="text-decoration-none text-dark">admin@sawitsmart.com</a></p>
                </div>

                <div class="ss-contact-info">
                    <h6><i class="fas fa-clock"></i>Jam Layanan</h6>
                    <p class="mb-0">Senin – Jumat: 08.00 – 17.00<br>Sabtu – Minggu: Libur</p>
                </div>

                <div class="mt-4">
                    <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="ss-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="ss-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="ss-social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="ss-social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
