<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SawitSmart</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/refined.css') ?>" rel="stylesheet">
    <style>
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 576px) { .form-row { grid-template-columns: 1fr; } }
        .auth-form select {
            width: 100%; padding: 0.75rem 1rem;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 0.95rem; background: white;
        }
        .auth-form select:focus { border-color: #10b981; outline: none; box-shadow: 0 0 0 3px rgba(16,185,129,0.15); }
        .error-list { background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 1rem; margin-bottom: 1.25rem; }
        .error-list ul { margin: 0; padding-left: 1.25rem; }
        .error-list li { color: #b91c1c; font-size: 0.9rem; margin-bottom: 0.25rem; }
    </style>
</head>
<body>
    <div class="auth-page">
        <div class="auth-card auth-card-wide">
            <div class="auth-logo">
                <div class="brand-icon"><i class="fas fa-user-plus"></i></div>
                <h1>Buat Akun Baru</h1>
                <p>Daftar untuk mengakses platform SawitSmart</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="auth-alert auth-alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('errors')): ?>
                <div class="error-list">
                    <ul>
                        <?php foreach (session('errors') as $errors): ?>
                            <?php foreach ((array) $errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url('auth/register') ?>" class="auth-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required value="<?= old('name') ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required value="<?= old('email') ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Konfirmasi Password</label>
                        <input type="password" id="password_confirm" name="password_confirm" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">No. Telepon</label>
                        <input type="tel" id="phone" name="phone" value="<?= old('phone') ?>">
                    </div>
                    <div class="form-group">
                        <label for="organization_type">Tipe Organisasi</label>
                        <select id="organization_type" name="organization_type">
                            <option value="petani" <?= old('organization_type') === 'petani' ? 'selected' : '' ?>>Petani</option>
                            <option value="koperasi" <?= old('organization_type') === 'koperasi' ? 'selected' : '' ?>>Koperasi</option>
                            <option value="lainnya" <?= old('organization_type') === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="organization">Nama Organisasi / Kelompok</label>
                    <input type="text" id="organization" name="organization" value="<?= old('organization') ?>">
                </div>

                <button type="submit" class="auth-btn mt-2">Daftar Akun</button>
            </form>

            <div class="auth-footer">
                <p class="text-muted mb-2" style="font-size: 0.9rem;">Sudah punya akun?</p>
                <a href="<?= base_url('auth/login') ?>">Masuk Sekarang →</a>
                <p class="mt-3 mb-0">
                    <a href="<?= base_url('/') ?>" style="font-size: 0.85rem; color: #94a3b8;">← Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
