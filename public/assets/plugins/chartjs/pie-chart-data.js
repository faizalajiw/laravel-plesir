// Data jumlah pengunjung harian
var data = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
    datasets: [{
        data: [20, 20, 20, 20, 20, 30, 50],
        backgroundColor: [
            'rgba(0, 52, 89)',
            'rgba(0, 126, 167)',
            'rgba(0, 168, 232)',
            'rgba(0, 52, 89)',
            'rgba(0, 126, 167)',
            'rgba(0, 168, 232)',
            'rgba(0, 126, 167)'
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