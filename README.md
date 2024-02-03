# Cara Install

1. Pertama clone project

```
git clone https://github.com/SamudraIT/rubik.git
```

2. Kedua jalankan

```
composer install
```

3. Ketiga, buat user admin

```
php artisan make:filament-user
```

4. Keempat, buat roles super admin

```
php artisan shield:install
```

5. Kelima, seed database

```
php artisan db:seed
```

# Step setelah install

1. Hapus repo git

## linux / max / minGW(Windows)

```
rm -rf .git
```

## windows

```
rmdir /s .git
```
