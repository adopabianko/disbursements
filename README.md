<p align="center">
<a href="https://laravel.com"><img src="https://img.shields.io/badge/made%20with-Laravel-red"></a>
<img src="https://img.shields.io/badge/version-1.0.0-blueviolet" alt="Version 1.0.0">
</p>

# Instalasi
Project ini dijalankan menggunakan <a href="https://laravel.com/docs/8.x/sail">Laravel Sail</a> yang berbasis docker container.

### Proses Instalasi

Jalankan perintah berikut di command line:

```bash
$ ./vendor/bin/sail up -d
```

```bash
$ ./vendor/bin/sail artisan migrate
```

```bash
$ ./vendor/bin/sail artisan db:seed
```

Akses Url http://localhost:8383 dan masukkan user account berikut:

```bash
email : admin@admin.com
password : secret
```

# Testing
Jalankan perintah berikut untuk menjalankan skenario test:

```bash
./vendor/bin/sail artisan test
```

## Skenario Test
<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Scenario Test</th>
      <th>Expected</th>
      <th>Received</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Access page form disbursement</td>
      <td>200</td>
      <td>200</td>
      <td style="color:green">Passed</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Access list data disbursement</td>
      <td>200</td>
      <td>200</td>
      <td style="color:green">Passed</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Create new disbursement</td>
      <td>200</td>
      <td>200</td>
      <td style="color:green">Passed</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Create new disbursement with validation</td>
      <td>422</td>
      <td>422</td>
      <td style="color:green">Passed</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Check status disbursement</td>
      <td>200</td>
      <td>200</td>
      <td style="color:green">Passed</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Check status disbursement with validation</td>
      <td>422</td>
      <td>422</td>
      <td style="color:green">Passed</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Check status disbursement not found</td>
      <td>404</td>
      <td>404</td>
      <td style="color:green">Passed</td>
    </tr>
  </tbody>
</table>


<p align="center">
  <a href="#"><img alt="disbursements" src="https://user-images.githubusercontent.com/8348927/102565746-a9dc4780-4110-11eb-92b9-282cfd1c638b.png" width="500"/></a>
</p>

# Alur Kerja

<p align="center">
  <a href="#"><img alt="disbursements" src="https://user-images.githubusercontent.com/8348927/102457213-ef4b3700-4074-11eb-82eb-448db68f54bc.png" width="500"/></a>
</p>

1. Login untuk masuk ke dalam aplikasi.
2. Akses menu Disbursement -> Create untuk membuat disbursement baru.
3. Akses menu Disbursement -> List untuk melihat data disbursement yang sudah dibuat.
4. Akses menu Disbursement -> Check Status untuk melihat status disbursement yang sudah dibuat.