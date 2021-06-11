<?php
require_once "dbconfig.php";
date_default_timezone_set('Europe/Istanbul');

echo "<html>
<head>
    <meta charset='utf-8'>
    <title>SİSTEM PROGRAMLAMA DERSİ - DHTxx PROJESİ</title>

    <link rel='stylesheet' type='text/css' href='assets/datatables.min.css'/>
    <script type='text/javascript' src='assets/datatables.min.js'></script>
    <link rel='stylesheet' type='text/css' href='ekstra.css'/>
    <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
</head>";

echo "<body>
<div class='container' style='margin-top: 20px'>

<div class='alert alert-primary' role='alert'>
  <h2>SİSTEM PROGRAMLAMA DERSİ - DHTxx PROJESİ</h2>
</div>";


echo "<div class='card'>
  <div class='card-body'>
   
<form action='' method='POST'>
   <div class='row align-items-end'>
      <div class='col'>  
   Veri Aralığı:  <select name='FiltreDeger' class='form-control'>
   <option value='1'>Bugünün verileri</option>
   <option value='2'>Son 1 Hafta</option>
   <option value='3'>Son 2 Hafta</option>
   <option value='4'>Son 1 Ay</option>
   </select>
      </div>
      <div class='col'> Veri Sayısı: 
      <select name='sayi' class='form-control'>
   <option value='30'>30</option>
   <option value='60'>60</option>
   <option value='100'>100</option>
   <option value='200'>200</option>
   </select>
      </div>
   <div class='col'> 
   <button type='submit' class='btn btn-success'>Filtrele</button>
   </div>
  </div>
</form>

   
   
  </div>
</div>";

if($_POST)
{
$filtre = $_POST['FiltreDeger'];
$limit = $_POST['sayi'];
$bugun = date("Y-m-d");

if($filtre==1)
{
  $tarih_filtre = $bugun;
} else if($filtre==2) {
  $tarih_filtre = date('Y-m-d', strtotime('-1 weeks'));
} else if($filtre==3) 
{
  $tarih_filtre = date('Y-m-d', strtotime('-2 weeks'));
} else if($filtre==4)
{
  $tarih_filtre = date('Y-m-d', strtotime('-1 month'));
} else 
{

  $tarih_filtre = $bugun;
}

echo "<div class='card' style='margin-top: 5px'>
  <div class='card-header'>";
echo "UYGULANAN FİLTRELER<br>Filtre tarih: ".$tarih_filtre." , Satır Sayısı: $limit";
echo "</div></div>";

 echo "<div class='card' style='margin-top: 5px'>
  <div class='card-header'>
    <strong>VERİLER</strong>
  </div>
  <div class='card-body'>";

$isi_data = "[";
$nem_data = "[";

$stmt = $db_con->prepare("select * from veriler WHERE tarih >='$tarih_filtre' ORDER BY ID DESC LIMIT $limit");
$stmt->execute();
$count = $stmt->rowCount();
if($count > 0)
{

    echo "<table id='example' class='table table-striped table-bordered nowrap' style='width:100%'>
        <thead>
            <tr>
                <th>Kayıt ID</th>
                <th>ISI Değeri</th>
                <th>Nem Değeri</th>
                <th>Tarih</th>
                <th>Tarih Tam</th>
            </tr>
        </thead>
        <tbody>";

        
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
        $isi_data .= $row['isi'].",";
        $nem_data .= $row['nem'].",";
          echo "<tr>
                <td>".$row['ID']."</td>
                <td>".$row['isi']."</td>
                <td>".$row['nem']."</td>
                <td>".$row['tarih']."</td>
                <td>".$row['tarih_tam']."</td>
            </tr>";
        }
        $isi_data = substr($isi_data, 0, -1)."]"; //son virgülü siliyorum.
        $nem_data = substr($nem_data, 0, -1)."]"; //son virgülü siliyorum.
        
        //echo $isi_data."-".$nem_data;
        echo "</tbody></table>";
        }
        
        echo "</div>";
        
echo "<div>
  <canvas id='myChart'></canvas>
</div>";
echo "</div>";
}
echo "<div class='card' style='margin-top: 5px'>
  <div class='card-header'>";
echo "<h3>Kullanılan Yöntemler</h3>
<ul style='list-style-type:circle'>
<li>Php</li>
<li>Css</li>
<li>Bootstrap 4</li>
<li>Jquery</li>
<li>Datatables</li>
<li>Ajax</li>
<li>Chart JS</li>
</ul>";
echo "</div></div>";
echo "</div>";


?>

<script>
       $(document).ready(function() {
    $('#example').DataTable( {
    
    order: [[0, 'desc']],
        rowGroup: {
           
            startRender: function ( rows, group ) {
                return group +' ('+rows.count()+' kayıt var.)';
            },
            endRender: null,
            dataSrc: 3
        },
    
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'print'
    ],
    
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "bAutoWidth": true,
    
       "language": {
           /* "sDecimal":        ",",
            "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoThousands":  ".",
            "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing":     "İşleniyor...",
            "sSearch":         "Ara:",
            "sZeroRecords":    "Eşleşen kayıt bulunamadı",
            "oPaginate": {
            "sFirst":    "İlk",
            "sLast":     "Son",
            "sNext":     "Sonraki",
            "sPrevious": "Önceki"
            },
            "oAria": {
            "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
            "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
            },
            "select": {
            "rows": {
            "_": "%d kayıt seçildi",
            "1": "1 kayıt seçildi"
        }
      }*/
      
      "emptyTable": "Tabloda herhangi bir veri mevcut değil",
    "info": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
    "infoEmpty": "Kayıt yok",
    "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
    "infoThousands": ".",
    "lengthMenu": "Sayfada _MENU_ kayıt göster",
    "loadingRecords": "Yükleniyor...",
    "processing": "İşleniyor...",
    "search": "Ara:",
    "zeroRecords": "Eşleşen kayıt bulunamadı",
    "paginate": {
        "first": "İlk",
        "last": "Son",
        "next": "Sonraki",
        "previous": "Önceki"
    },
    "aria": {
        "sortAscending": ": artan sütun sıralamasını aktifleştir",
        "sortDescending": ": azalan sütun sıralamasını aktifleştir"
    },
    "select": {
        "rows": {
            "_": "%d kayıt seçildi",
            "1": "1 kayıt seçildi",
            "0": "-"
        },
        "0": "-",
        "1": "%d satır seçildi",
        "2": "-",
        "_": "%d satır seçildi",
        "cells": {
            "1": "1 hücre seçildi",
            "_": "%d hücre seçildi"
        },
        "columns": {
            "1": "1 sütun seçildi",
            "_": "%d sütun seçildi"
        }
    },
    "autoFill": {
        "cancel": "İptal",
        "fillHorizontal": "Hücreleri yatay olarak doldur",
        "fillVertical": "Hücreleri dikey olarak doldur",
        "info": "-",
        "fill": "Bütün hücreleri <i>%d<\/i> ile doldur"
    },
    "buttons": {
        "collection": "Koleksiyon <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
        "colvis": "Sütun görünürlüğü",
        "colvisRestore": "Görünürlüğü eski haline getir",
        "copySuccess": {
            "1": "1 satır panoya kopyalandı",
            "_": "%ds satır panoya kopyalandı"
        },
        "copyTitle": "Panoya kopyala",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Bütün satırları göster",
            "1": "-",
            "_": "%d satır göster"
        },
        "pdf": "PDF",
        "print": "Yazdır",
        "copy": "Kopyala",
        "copyKeys": "Tablodaki veriyi kopyalamak için CTRL veya u2318 + C tuşlarına basınız. İptal etmek için bu mesaja tıklayın veya escape tuşuna basın."
    },
    "infoPostFix": "-",
    "searchBuilder": {
        "add": "Koşul Ekle",
        "button": {
            "0": "Arama Oluşturucu",
            "_": "Arama Oluşturucu (%d)"
        },
        "condition": "Koşul",
        "conditions": {
            "date": {
                "after": "Sonra",
                "before": "Önce",
                "between": "Arasında",
                "empty": "Boş",
                "equals": "Eşittir",
                "not": "Değildir",
                "notBetween": "Dışında",
                "notEmpty": "Dolu"
            },
            "number": {
                "between": "Arasında",
                "empty": "Boş",
                "equals": "Eşittir",
                "gt": "Büyüktür",
                "gte": "Büyük eşittir",
                "lt": "Küçüktür",
                "lte": "Küçük eşittir",
                "not": "Değildir",
                "notBetween": "Dışında",
                "notEmpty": "Dolu"
            },
            "string": {
                "contains": "İçerir",
                "empty": "Boş",
                "endsWith": "İle biter",
                "equals": "Eşittir",
                "not": "Değildir",
                "notEmpty": "Dolu",
                "startsWith": "İle başlar"
            },
            "array": {
                "contains": "İçerir",
                "empty": "Boş",
                "equals": "Eşittir",
                "not": "Değildir",
                "notEmpty": "Dolu",
                "without": "Hariç"
            }
        },
        "data": "Veri",
        "deleteTitle": "Filtreleme kuralını silin",
        "leftTitle": "Kriteri dışarı çıkart",
        "logicAnd": "ve",
        "logicOr": "veya",
        "rightTitle": "Kriteri içeri al",
        "title": {
            "0": "Arama Oluşturucu",
            "_": "Arama Oluşturucu (%d)"
        },
        "value": "Değer",
        "clearAll": "Filtreleri Temizle"
    },
    "searchPanes": {
        "clearMessage": "Hepsini Temizle",
        "collapse": {
            "0": "Arama Bölmesi",
            "_": "Arama Bölmesi (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown}\/{total}",
        "emptyPanes": "Arama Bölmesi yok",
        "loadMessage": "Arama Bölmeleri yükleniyor ...",
        "title": "Etkin filtreler - %d"
    },
    "searchPlaceholder": "Ara",
    "thousands": ".",
    "datetime": {
        "amPm": [
            "öö",
            "ös"
        ],
        "hours": "Saat",
        "minutes": "Dakika",
        "next": "Sonraki",
        "previous": "Önceki",
        "seconds": "Saniye",
        "unknown": "Bilinmeyen"
    },
    "decimal": ",",
    "editor": {
        "close": "Kapat",
        "create": {
            "button": "Yeni",
            "submit": "Kaydet",
            "title": "Yeni kayıt oluştur"
        },
        "edit": {
            "button": "Düzenle",
            "submit": "Güncelle",
            "title": "Kaydı düzenle"
        },
        "error": {
            "system": "Bir sistem hatası oluştu (Ayrıntılı bilgi)"
        },
        "multi": {
            "info": "Seçili kayıtlar bu alanda farklı değerler içeriyor. Seçili kayıtların hepsinde bu alana aynı değeri atamak için buraya tıklayın; aksi halde her kayıt bu alanda kendi değerini koruyacak.",
            "noMulti": "Bu alan bir grup olarak değil ancak tekil olarak düzenlenebilir.",
            "restore": "Değişiklikleri geri al",
            "title": "Çoklu değer"
        },
        "remove": {
            "button": "Sil",
            "confirm": {
                "_": "%d adet kaydı silmek istediğinize emin misiniz?",
                "1": "Bu kaydı silmek istediğinizden emin misiniz?"
            },
            "submit": "Sil",
            "title": "Kayıtları sil"
        }
    }
    },
        responsive: true
    } );
} );
</script>

<script>

var isi_deger = <?php echo $isi_data; ?>;
var isi_deger=isi_deger.reverse(); 
var nem_deger = <?php echo $nem_data; ?>;
var nem_deger=nem_deger.reverse(); 
const data = {
  labels: isi_deger,
  datasets: [
  
  {
    label: 'ISI Değeri',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: isi_deger,
  },
  
  {
    label: 'NEM Değeri',
    backgroundColor: 'rgb(15, 99, 132)',
    borderColor: 'rgb(15, 99, 132)',
    data: nem_deger
  }
  
  ]
};

let opt = {
        scales: {
            x: {
                ticks: {
                    display: false,
                }
            }
        },
        plugins: {
            
            legend: {
                display: true,
                
            }
        }
}

const config = {
  type: 'line',
  data,
  options: opt
};

      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, config);
      
</script>


</body>
</html>
