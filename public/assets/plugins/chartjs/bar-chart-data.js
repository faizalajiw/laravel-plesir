// Data jumlah pengunjung harian
var data = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
    datasets: [{
        label: 'Jumlah Pengunjung',
        data: [20, 20, 20, 20, 20, 30, 50],
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
                max: 100,
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