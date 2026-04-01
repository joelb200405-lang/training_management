/**
 * DCTC Trainer Dashboard Logic
 * Initializing Analytics Charts
 */
document.addEventListener('DOMContentLoaded', function() {
    const primaryGreen = '#004d26';
    const accentYellow = '#f8f16a';

    // Check if the canvas elements exist before trying to draw
    const barCtx = document.getElementById('traineesBarChart');
    const pieCtx = document.getElementById('statusPieChart');

    if (barCtx) {
        new Chart(barCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Dressmaking', 'Nail Care', 'Cookery', 'Welding', 'IT'],
                datasets: [{
                    label: 'No. of Trainees',
                    data: [45, 32, 25, 18, 40],
                    backgroundColor: primaryGreen,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    if (pieCtx) {
        new Chart(pieCtx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Completed', 'Ongoing'],
                datasets: [{
                    data: [65, 35],
                    backgroundColor: [primaryGreen, accentYellow],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 12 } } }
                }
            }
        });
    }
});