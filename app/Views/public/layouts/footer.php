    </div>
</main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <div class="widget">
                <h4>Tentang SawitSmart</h4>
                <p>SawitSmart — Platform digital terintegrasi untuk manajemen kebun sawit.</p>
            </div>
            <div class="widget">
                <h4>Kontak</h4>
                <p>Universitas Jambi<br>0852-6804-1096<br>admin@sawitsmart.id</p>
            </div>
            <div class="widget">
                <h4>Newsletter</h4>
                <form id="newsletter-form" method="post" action="<?= site_url('api/subscribe') ?>">
                    <input type="email" name="email" placeholder="Email Anda" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> SawitSmart. All rights reserved.</p>
        </div>
    </div>
</footer>
<script src="/assets/js/header.js"></script>
<script>
document.getElementById('newsletter-form')?.addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    const res = await fetch(form.action, { method: 'POST', body: data });
    const json = await res.json();
    alert(json.message || 'Terima kasih, permintaan Anda telah diterima.');
});
</script>
</body>
</html>
