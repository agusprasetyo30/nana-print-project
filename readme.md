# Nana Print & ATK

## Library
- Upload Photo<br>
  ``$ intervention/image``<br>

- Authentification<br>
  ``$ spatie/laravel-permission``<br>

## Cara Penggunaan

1. Mendownload file/clone file
2. Masuk ke **Terminal** file yang sudah di download kemudian melakukan update composer `$ composer update`, atau bisa melakukan install composer `$ composer install`
> Dapat memilih dari salah satu perintah, bisa update atau install terserah

3. Sesudah berhasil maka selanjutnya mengcopy file `.env.example` pada file, setelah itu merubah nama file menjadi `.env`
4. Setelah itu masuk terminal dan melakukan perintah `php artisan key:generate`
> hal itu digunakan untuk mengenerate key yang awalnya kosong yang berada di `.env`

5. Membuat database dengan nama **nana-print** di phpMyAdmin, setelah itu mengisi username, password, dan nama databasenya yang berada di file `.env`
6. Setelah itu melakukan migration/membuat tabel databasenya dengan cara `php artisan migrate`
> dengan syarat database sudah dibuat dan sudah diinputkan di `.env`

7. Setelah migration selesai maka langkah selanjutya melakukan seeder dengan cara `php artisan db:seed`
> hal ini digunakan untuk mengisi data pada tabel, dalam hal ini mengisi data user/pengguna

8. Setelah selesai maka hal selanjutnya yaitu menjalankan web dengan cara `php artisan serve`

## Data dummy pengguna/user
- Admin
Username : **admin@gmail.com**
Password : **admin**

<!-- markdownlint-disable MD000 -->
- Customer/Pelanggan
Username : **customer@gmail.com**
Password : customer
