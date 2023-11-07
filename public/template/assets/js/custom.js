/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// custom menu active
var path = location.pathname.split('/')
var url = location.origin + '/' + path[1]
$('ul.sidebar-menu li a').each(function() {
    if($(this).attr('href').indexOf(url) !== -1) {
        $(this).parent().addClass('active').parent().parent('li').addClass('active')
    }
})
// console.log(url)

// datatables
// $(document).ready( function () {
//     $('#myTable').DataTable({
//         dom: 'Bfrtip', // Menambahkan tombol pada elemen DOM
//         buttons: [
//             {
//                 extend: 'print',
//                 text: 'Cetak',
//                 title: 'Data Tabel',
//                 exportOptions: {
//                     columns: [0, 1, 2, 3,4,5,6], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
//                 },
//                 customize: function (win) {
//                     $(win.document.body).find('table').css('font-size', '12px');
//                 }
//             }
//         ]
//     });
// });
$(document).ready(function() {
    $('#downtime').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Log Downtime Jaringan & CCTV',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#aset').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Aset ICT',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6,7,8,9], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#bak').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Berita Acara Kerusakan',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#barang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Barang Permohonan Fasilitas ICT',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#email').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Permohonan Email',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#perbaikan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Perbaikan ICT',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6,7], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#permintaan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Permohonan Fasilitas ICT',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6,7,9], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
$(document).ready(function() {
    $('#project').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Report Form Project',
                exportOptions: {
                    columns: [0, 1, 2, 3,4], // Kolom yang akan dicetak, sesuaikan sesuai kebutuhan
                },
                customize: function (win) {
                    $(win.document.body).find('table').css('font-size', '12px');
                }
            }
        ]
    });
});
// modal confirmation
function submitDel(id) {
    $('#del-'+id).submit()
}

function returnLogout() {
    var link = $('#logout').attr('href')
    $(location).attr('href', link)
}

const rupiahInput = document.getElementById('rupiah-input');

    rupiahInput.addEventListener('input', function(e) {
        // Mengambil nilai input
        let nilai = this.value.replace(/\./g, ''); // Hapus tanda titik jika ada
        nilai = nilai.toString().split('').reverse().join(''); // Balik string
        nilai = nilai.match(/\d{1,3}/g).join('.').split('').reverse().join(''); // Tambahkan titik setiap 3 digit
        this.value = 'Rp ' + nilai;
    });