Ganapatih - Web
===============

Source code untuk manajemen:

1. Web
2. API

Untuk perbedaan antara web & api akan dibedakan berdasarkan routing (grouping).

### Composer & Autoload

```
composer update
```

Jika ada error, silahkan coba:

```
composer dump-autoload
```

atau

```
php artisan dump-autoload
```

atau keduanya

### Custom Package

1.  "jenssegers/mongodb": "*"
2.  "fzaninotto/faker": "1.4.*@dev"

### Versioning

Format version akan menggunakan [Semver](http://semver.org)

### Gearman

[Install PHP Gearman Client - PECL](http://gearman.org/getting-started/)

### Mongo

```
sudo pecl install mongo
```

### TODO

- [x] Api: mobile -> api -> python -> nodejs (async)
- [ ] Web: user register & login
- [ ] Unit Test
- [ ] Verifikasi report dengan user terdekat
- [ ] Mengambil data suatu wilayah + data usernya