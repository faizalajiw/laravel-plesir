const chartDataElement = document.getElementById('chart-data');
const labelsLast7Days = JSON.parse(chartDataElement.getAttribute('data-labels-last7'));
const quantitiesLast7Days = JSON.parse(chartDataElement.getAttribute('data-quantities-last7'));
const labelsMonthly = JSON.parse(chartDataElement.getAttribute('data-labels-monthly'));
const quantitiesMonthly = JSON.parse(chartDataElement.getAttribute('data-quantities-monthly'));

// Batasi data hanya untuk 7 hari terakhir
const last7DaysLabels = labelsLast7Days.slice(-7);
const last7DaysQuantities = quantitiesLast7Days.slice(-7);

const ctxLast7Days = document.getElementById('chartLast7Days').getContext('2d');
new Chart(ctxLast7Days, {
    type: 'bar',
    data: {
        labels: last7DaysLabels, //Tanggal
        datasets: [{
            label: 'Tiket Terjual',
            data: last7DaysQuantities, //Total Penjualan Tiket
            backgroundColor: 'rgba(3, 4, 94, 1)',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Tiket Terjual',
                color: 'black',
                font: {
                    size: 16
                }
            },
        },
        scales: {
            x: {
                title: {
                    display: false,
                    text: 'Tanggal',
                    color: 'black',
                    font: {
                        size: 16
                    }
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Jumlah Tiket',
                    color: 'black',
                    font: {
                        size: 16
                    }
                }
            }
        }
    }
});

const ctxMonthly = document.getElementById('chartMonthly').getContext('2d');
new Chart(ctxMonthly, {
    type: 'bar',
    data: {
        labels: labelsMonthly,
        datasets: [{
            label: 'Jumlah Pengunjung (Bulanan)',
            data: quantitiesMonthly,
            backgroundColor: 'rgba(3, 4, 94, 1)',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Jumlah Pengunjung (Bulanan)',
                color: 'black',
                font: {
                    size: 16
                }
            },
        },
        scales: {
            x: {
                type: 'category', // Menggunakan skala kategori
                title: {
                    display: false,
                    text: 'Bulan',
                    color: 'black',
                    font: {
                        size: 16
                    }
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Jumlah Pengunjung',
                    color: 'black',
                    font: {
                        size: 16
                    }
                }
            }
        }
    }
});