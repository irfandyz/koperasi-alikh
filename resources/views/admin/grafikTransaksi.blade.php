<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Demo Grafik Lingkaran (Doughnut)</title>
    <script src="http://keuangan.almaarif-school.online/assets/js/Chart.js"></script>
    <style type="text/css">
        .container {
            width: 40%;
            margin: 15px auto;
        }

    </style>
</head>

<body>

    <div class="container">
        <canvas id="piechart" width="100" height="100"></canvas>
    </div>

</body>

</html>

<script type="text/javascript">
    var nom = <?= json_encode($arrayNom) ?>;
    var ctx = document.getElementById("piechart").getContext("2d");
    var data = {
        labels: ["Pengeluaran", "Pemasukan"],
        datasets: [{
            label: "Penjualan Barang",
            data: nom,
            backgroundColor: [
                'rgb(194, 0, 0)',
                'rgb(0, 194, 58)',
            ]
        }]
    };

    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true
        }
    });
</script>
