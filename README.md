Data Propinsi, Kabupaten, Kecamatan, dan Kelurahan/Desa di Indonesia dalam bentuk json
------------------------------------------------------------------------

Data disini hanya untuk memudahkan membuat autocomplete di aplikasi yang saya buat, tidak cocok untuk ajax, karena ada proteksi ajax beda domain.

----------


Struktur data
-------------
> - propinsi.json
> - kabupaten/[id propinsi].json
> - kecamatan/[id kabupaten].json
> - kelurahan/[id kecamatan].json


struktur **id** Kabupaten diawali dengan **id** Propinsi.

struktur **id** Kecamatan diawali dengan **id** Propinsi dan **id** Kabupaten.

struktur **id** Kelurahan diawali dengan **id** Propinsi, **id** Kabupaten, dan **id** Kecamatan.

total ada 89463 data.