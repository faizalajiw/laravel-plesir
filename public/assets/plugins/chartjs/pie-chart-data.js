var senin = parseInt(document.getElementById('senin').innerText);
var selasa = parseInt(document.getElementById('selasa').innerText);
var rabu = parseInt(document.getElementById('rabu').innerText);
var kamis = parseInt(document.getElementById('kamis').innerText);
var jumat = parseInt(document.getElementById('jumat').innerText);
var sabtu = parseInt(document.getElementById('sabtu').innerText);
var minggu = parseInt(document.getElementById('minggu').innerText);
// Data jumlah pengunjung harian
var data = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
    datasets: [{
        data: [senin, selasa, rabu, kamis, jumat, sabtu, minggu],
        backgroundColor: [
            'rgba(2, 103, 193)',
            'rgba(239, 160, 11)',
            'rgba(214, 81, 8)',
            'rgba(89, 31, 10)',
            'rgba(193, 18, 31)',
            'rgba(105, 48, 195)',
            'rgba(0, 121, 140)'
        ]
    }]
};

// Konfigurasi pie chart
var config = {
    type: 'pie',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: false,
                text: 'Grafik Jumlah Pengunjung Harian'
            }
        }
    }
};

// Membuat pie chart
var myChart = new Chart(
    document.getElementById('myPieChart'),
    config
);