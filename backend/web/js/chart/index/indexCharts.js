$(document).ready(function() {
    Chart.register(ChartDataLabels);
    Chart.defaults.set('plugins.datalabels', {
        anchor: 'end',
        align: 'start',
        font: {
            size: 30,
        },
        labels: {
            value: {
                color: 'black'
            }
        }
    });

    const apartmentChart = document.getElementById('apartmentChart');
    const apartmentChartOccupied = apartmentChart.getAttribute('data-ocucupied');
    const apartmentChartFree = apartmentChart.getAttribute('data-free');
    new Chart(apartmentChart, {
        type: 'doughnut',
        data: {
            labels: ['Occupied/Pre-booked', 'Free'],
            datasets: [{
                label: 'Apartments',
                data: [apartmentChartOccupied, apartmentChartFree],
                borderWidth: 1,
                datalabels: {
                    color: '#FFCE56'
                }
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Apartments',
                    position: 'top', // You can set the position (top, left, right, bottom, or center)
                },
            },
        }
    });

    const tenantChart = document.getElementById('tenantChart');
    const tenantChartTenant = tenantChart.getAttribute('data-tenant');
    new Chart(tenantChart, {
        type: 'doughnut',
        data: {
            labels: ['Tenants'],
            datasets: [{
                label: 'Tenants',
                data: [tenantChartTenant],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Tenants',
                    position: 'top', // You can set the position (top, left, right, bottom, or center)
                }
            },
        }
    });

    const rentalChart = document.getElementById('rentalChart');
    const rentalChartActive = rentalChart.getAttribute('data-active');
    const rentalChartFuture = rentalChart.getAttribute('data-future');
    const rentalChartExpired = rentalChart.getAttribute('data-expired');
    new Chart(rentalChart, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Future', 'Expired'],
            datasets: [{
                label: 'Rentals',
                data: [rentalChartActive, rentalChartFuture, rentalChartExpired],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Rentals',
                    position: 'top', // You can set the position (top, left, right, bottom, or center)
                }
            },
        }
    });
});