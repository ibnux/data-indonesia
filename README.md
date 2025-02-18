Data Provinsi, Kabupaten, Kecamatan, dan Kelurahan/Desa di Indonesia dalam bentuk json
------------------------------------------------------------------------

Data disini hanya untuk memudahkan membuat autocomplete di aplikasi yang saya buat, tidak cocok untuk ajax, karena ada proteksi ajax beda domain.

----------


Struktur data
-------------
> - provinsi.json
> - kabupaten/[id provinsi].json
> - kabupaten/[id kabupaten].json
> - kota/[id provinsi].json
> - kota/[id kota].json
> - kecamatan/[id kabupaten].json
> - kecamatan/[id kecamatan].json
> - kelurahan/[id kecamatan].json
> - kelurahan/[id kelurahan].json


struktur **id** Kabupaten diawali dengan **id** Provinsi.

struktur **id** Kecamatan diawali dengan **id** Provinsi dan **id** Kabupaten.

struktur **id** Kelurahan diawali dengan **id** Provinsi, **id** Kabupaten, dan **id** Kecamatan.

total ada 91.219 data.


Contoh Penggunaan
-------------
Untuk contoh cara pakai menggunakan select2 cek berkas [contoh.html](https://github.com/ibnux/data-indonesia/blob/master/contoh.html)


Demo
-------------
Untuk demo implementasi bisa dilihat disini: [Demo](https://ibnux.github.io/data-indonesia/contoh.html)

### Support iBNuX

[<img src="https://ibnux.github.io/KaryaKarsa-button/karyaKarsaButton.png" width="128">](https://karyakarsa.com/ibnux)
[<img src="https://ibnux.github.io/Trakteer-button/trakteer_button.png" width="120">](https://trakteer.id/ibnux)
