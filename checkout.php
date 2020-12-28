<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h3>Cart</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>x</td>
                    <td>x</td>
                    <td>x</td>
                    <td>x</td>
                </tr>
            </tbody>
        </table>

        <h3>Address</h3>
        <form action="" method="POST">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Provinsi</label>
                        <select class="form-control" name="nama-provinsi" id="">

                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Distrik</label>
                        <select class="form-control" name="nama-distrik" id="">

                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Ekspedisi</label>
                        <select class="form-control" name="nama-ekspedisi" id="">

                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Total Berat</label>
                        <input type="number" class="form-control" name="total-berat" id="" value="1500" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Paket Pengiriman</label>
                        <select class="form-control" name="nama-paket" id="">

                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <script src="js/bootstrap.min.js" type="javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'dataprovinsi.php',
                success: function(hasil_provinsi) {
                    $("select[name=nama-provinsi]").html(hasil_provinsi);
                }
            });

            $("select[name=nama-provinsi]").on("change", function() {
                // ambil id_prpvinsi dari attribute id_provinsi
                var id_provinsi_terpilih = $('option:selected', this).attr("id_provinsi");
                $.ajax({
                    type: 'post',
                    url: 'datadistrik.php',
                    data: 'id_provinsi=' + id_provinsi_terpilih,
                    success: function(hasil_distrik) {
                        $("select[name=nama-distrik]").html(hasil_distrik);
                    }
                });
            });

            $.ajax({
                type: 'post',
                url: 'dataekspedisi.php',
                success: function(hasil_ekspedisi) {
                    $("select[name=nama-ekspedisi]").html(hasil_ekspedisi);
                }
            });

            $("select[name=nama-ekspedisi]").on("change", function() {
                // 3 Syarat Mendapatkan Biaya Ongkir
                // mendapatkan ekspedisi yg dipilih
                var ekspedisi = $("select[name=nama-ekspedisi]").val();

                // mendapatkan id_distrik yg dipilih pengguna
                var distrik = $("option:selected", "select[name=nama-distrik]").attr("id_distrik");

                // mendapatkan total berat
                var berat = $("input[name=total-berat]").val();

                $.ajax({
                    type: 'post',
                    url: 'dataongkir.php',
                    data: 'ekspedisi=' + ekspedisi + '&distrik=' + distrik + '&berat=' + berat,
                    success: function(hasil_ongkir) {
                        $("select[name=nama-paket]").html(hasil_ongkir);
                    }
                })

            })

        });
    </script>
</body>

</html>