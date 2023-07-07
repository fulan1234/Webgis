# WebGIS PTPN

## Deskripsi Projek
WebGIS PTPN merupakan sebuah sistem informasi geografis berbasis Website ( WebGIS ) yang digunakan untuk menyimpan serta menampilkan informasi denah geografis setiap kebun kelapa sawit yang terhubung langsung dengan aplikasi QGIS melalui database PostgreSql.

Tujuan utamanya adalah untuk meningkatkan kinerja perusahaan dengan menampilkan perkembangan data kebun setiap harinya yang terhubung dengan aplikasi QGIS yang dipakai bagian pertanahan. Dengan sistem ini tugas bagian pertanahan dalam menganalisis serta mendapatkan informasi dari data kebun akan lebih lebih effisien dari biasanya. Manfaat tambahan dari WebGIS ini adalah bahwa selama bagian pertanahan melakukan pemetaan dengan aplikasi QGIS, WebGIS akan terus mengupdate berbagai informasi seperti luas kebun, banyak pohon dan lain sebagainya yang terhubung ke database. Selain itu minimnya informasi secara visual yang tidak dapat dilihat tanpa melalui aplikasi QGIS juga ditambal dengan adanya sistem WebGIS yang dapat membantu berbagai bagian yang ingin melihat perkembangan kebun melalui Web saja.

## Tujuan
WebGIS ini dikembangkan sebagai tugas PKL ( Praktik Kerja Lapangan ) yang dilakukan di perusahaan PT Perkebunan Nusantara VII selama 40 hari. Selain mengkodekan modul kami sendiri, pada akhirnya saya diberi tanggung jawab untuk bertemu dengan bagian pertanahan guna mendiskusikan dan menyelesaikan masalah yang mereka hadapi dengan mengembangkan Website agar dapat mengakses informasi langsung dari bagian pertanahan guna untuk mempermudah seluruh bagian yang terlibat dalam mengetahui berbagai informasi terbaru. tugas PKL ini dapat membuat saya mempunyai pengalaman akan hal pembuatan real project dalam dunia kerja seperti membuat basis data dengan mengikuti skema basis data yang diperlukan, pengembangan fitur dan lain-lain.

## User dan Karateristik
Terdaapat 2 tipe user dalam projek ini, yaitu:

### 1. Pengguna Web
Pengguna web dapat melihat perkembangna informasi melalui kebun melalui WebGIS yang dikembangkan seperti Luas kebun jumlah pohon, tahun tanam, serta letak posisi kebun yang tampil di dalam map.

### 2. Bagian Pertanahan
Bagian pertanahan tidak berinteraksi dengan sistem. Mereka hanya perlu mengerjakan tugas pemetaan melalui aplikasi QGIS sehingga data yang dia kerjakan akan langsung terhubung ke database untuk di update.

## Screenshoot dari beberapa UI

### 1. Fitur Map
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/490367d6-b2b1-4293-9fa7-4aa2aa222420)

Deskripsi :
merupakan fitur yang digunakan untuk mengecek data per lahan yang akan keluar data tersebut jika di hover.

### 2. Fitur Legend
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/490367d6-b2b1-4293-9fa7-4aa2aa222420)

Deskripsi : 
Fitur Legend Data merupakan fitur untuk mengetahui skala data pada masing-masing kolom data. fitur legend dapat dilihat pada pojok kiri bawah gambar

### 3. Fitur Pembagian Data
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/02d27551-0692-4ecc-863a-7f9acb67dee0)

Deskripsi :
Fitur Pembagian data ini merupakan fitur untuk memfilter seluruh data kebun menjadi data yang dipilih

### 4. Fitur GroupLayer
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/9ed2ab20-a2ad-459c-b60c-5d601a3aa32a)

Deskripsi :
Fitur Group Layer terdiri dari beberapa grup yang berguna untuk memperjelas informasi kebun berdasarkan suatu gambar, mulai dari data/tempat kebun, Marker, sampai HGU.

#### 4.1. Fitur Marker
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/7ceb42be-ad36-468b-bc1f-080eb25ad4c4)

Deskripsi : 
Fitur Marker merupakan fitur yang berguna untuk membagi masing-masing daerah kebun sesuai dengan cluster yang dibuat oleh marker agar terbagi rata

### 4.2. Fitur map
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/81e44caf-a879-41fc-b783-edd19a1a7b51)

Deskripsi : 
Fitur Jenis Map merupakan fitur yang berguna untuk mengubah jenis map sesuai dengan yang dibutuhkan oleh pengguna

### 4.3 Fitur HGU
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/9010d801-fbdd-4255-a4db-3e7e64e580fa)

Deskripsi :
merupakan fitur untuk menampilkan HGU

### 4.4 Fitur Jenis Map
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/47f7ad50-fdd9-4dde-9c4c-987313fed8a7)

Deskripsi :
Fitur Jenis Map merupakan fitur yang berguna untuk mengubah jenis map yang ditampilkan pada Webgis tersebut.

## 5. Fitur Data Cabang
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/9fcb1033-1c34-49ba-9a50-30f918806b7d)

Deskripsi :
untuk menampilkan data setiap cabang

## 6. Fitur Data
![image](https://github.com/fulan1234/webgis_ptpn/assets/116423371/0388740e-15cc-4cc8-86b6-51cc7cedc861)

Deskripsi :
Untuk menampilkan isi dari setiap data cabang dan dapat mencetak secara word,excel, dll serta mengambil file geojson.
