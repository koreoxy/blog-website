

<h2>Login</h2>
<?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p class="register-text">Belum punya akun? 
    <a href="/auth/register">Daftar di sini</a>
</p>

<p class="register-text">Kembali ke
    <a href="/home">Beranda</a>
</p>


