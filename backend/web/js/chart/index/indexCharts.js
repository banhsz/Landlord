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
                color: 'white'
            }
        }
    });

    const invoiceChart = document.getElementById('invoiceChart');
    const invoiceChartPaid = invoiceChart.getAttribute('data-paid');
    const invoiceChartUnpaid = invoiceChart.getAttribute('data-unpaid');
    new Chart(invoiceChart, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Unpaid'],
            datasets: [{
                label: 'Invoices',
                data: [invoiceChartPaid, invoiceChartUnpaid],
                borderWidth: 1,
                backgroundColor: ['rgba(51, 204, 51)', 'rgba(255, 51, 0)'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Invoices',
                    position: 'top',
                    font: {
                        size: 20
                    }
                }
            },
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
                backgroundColor: ['rgba(0, 153, 255)', 'rgba(51, 204, 51)'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Apartments',
                    position: 'top', // You can set the position (top, left, right, bottom, or center)
                    font: {
                        size: 20
                    }
                },
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
                borderWidth: 1,
                backgroundColor: ['rgba(0, 153, 255)', 'rgba(255, 153, 51)', 'rgba(140, 140, 140)'],

            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Rentals',
                    position: 'top',
                    font: {
                        size: 20
                    }
                }
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
                borderWidth: 1,
                backgroundColor: ['rgba(0, 153, 255)'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Tenants',
                    position: 'top',
                    font: {
                        size: 20
                    }
                }
            },
        }
    });

    const paymentChart = document.getElementById('paymentChart');
    new Chart(paymentChart, {
        type: 'line',
        data: {
            labels: ['2023 September', '2023 October', '2023 November', '2023 December', '2024 January'],
            datasets: [
                {
                    label: 'Ft',
                    data: [100000, 200000, 1300000, 400000, 500000],
                    pointStyle: 'circle',
                    pointRadius: 10,
                    pointHoverRadius: 15
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Payments (mock data)',
                    position: 'top',
                    font: {
                        size: 20
                    }
                },
                datalabels: {
                    anchor: 'end',
                    align: '190',
                    clamp: true,
                    font: {
                        size: 15,
                    },
                    labels: {
                        value: {
                            color: 'black',
                            backgroundColor: 'white',
                            borderRadius: 10
                        }
                    },
                }
            },
        }
    });
});