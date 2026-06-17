<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SawitSmart</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/refined.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-logo">
                <div class="brand-icon"><i class="fas fa-leaf"></i></div>
                <h1>Selamat Datang</h1>
                <p>Masuk ke akun SawitSmart Anda</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="auth-alert auth-alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url('auth/login') ?>" class="auth-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?= old('email') ?>" placeholder="nama@email.com">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>

                <button type="submit" class="auth-btn mt-2">Masuk</button>
            </form>

            <div class="auth-footer">
                <p class="text-muted mb-2" style="font-size: 0.9rem;">Belum punya akun?</p>
                <a href="<?= base_url('auth/register') ?>">Daftar Sekarang →</a>
                <p class="mt-3 mb-0">
                    <a href="<?= base_url('/') ?>" style="font-size: 0.85rem; color: #94a3b8;">← Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
