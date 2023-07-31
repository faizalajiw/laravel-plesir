<!DOCTYPE html>
<html>
<head>
    <title>Status Akun Diperbarui</title>
</head>
<body>
    <h3>Halo {{ $users->name }},</h3>

    <h4>Status akun Anda telah diperbarui. Berikut adalah informasi terkini mengenai akun Anda:</h4>
    <p>Nama: {{ $users->name }}</p>
    <p>Username: {{ $users->username }}</p>
    <p>Email: {{ $users->email }}</p>
    <p>Hak Akses: {{ $users->role_name }}</p>
    <p>Status: <strong>{{ $statusText }}</strong></p>

    <p>Terima kasih telah menggunakan layanan kami.. </p>
</body>
</html>
