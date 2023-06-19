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
        label: 'Jumlah Pengunjung',
        data: [senin, selasa, rabu, kamis, jumat, sabtu, minggu],
        backgroundColor: [
            'rgba(0, 52, 89)',
            'rgba(0, 126, 167)',
            'rgba(0, 168, 232)',
            'rgba(0, 52, 89)',
            'rgba(0, 126, 167)',
            'rgba(0, 168, 232)',
            'rgba(0, 52, 89)'
        ],
    }]
};

// Konfigurasi bar chart
var config = {
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 160,
                title: {
                    display: true,
                    text: 'Jumlah Pengunjung'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Hari'
                }
            }
        }
    }
};

// Membuat bar chart
var myChart = new Chart(
    document.getElementById('myBarChart'),
    config
);