function updatePreview() {
    const btn = document.querySelector('.btn-generate');
    const status = document.getElementById('recordStatus');
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    btn.disabled = true;

    setTimeout(() => {
        const count = Math.floor(Math.random() * 60) + 15;
        status.innerHTML = `Showing <strong>${count} records</strong> for the selected criteria.`;
        btn.innerHTML = 'Generate Preview';
        btn.disabled = false;
        alert("Report Preview Updated Successfully!");
    }, 1000);
}

function exportData(type) {
    if (type === 'PDF') {
        if (confirm("Generate official report with the City Mayor's Letterhead?")) {
            window.print();
        }
    } else {
        alert(`Data successfully converted to ${type} and saved to your Downloads folder.`);
    }
}

/**
 * SECTION 1: FILTER & BUTTON LOGIC (Existing Code)
 * This handles your "Generate Preview" and "Export" buttons
 */
function updatePreview() {
    const btn = document.querySelector('.btn-generate');
    const status = document.getElementById('recordStatus');
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    btn.disabled = true;

    setTimeout(() => {
        const count = Math.floor(Math.random() * 60) + 15;
        status.innerHTML = `Showing <strong>${count} records</strong> for the selected criteria.`;
        btn.innerHTML = 'Generate Preview';
        btn.disabled = false;
        alert("Report Preview Updated!");
    }, 1000);
}

function exportData(type) {
    if (type === 'PDF') {
        if (confirm("Generate official report with the City Mayor's Letterhead?")) {
            window.print();
        }
    } else {
        alert(`Data successfully converted to ${type} and saved to Downloads.`);
    }
}

/**
 * SECTION 2: CHART INITIALIZATION (New Code)
 * We wrap this in an Event Listener so it waits for the page to load
 */
document.addEventListener('DOMContentLoaded', function() {
    // Shared Theme Colors from your CSS
    const primaryGreen = '#004d26';
    const secondaryGreen = '#007d3d';
    const softGreen = '#e8f5e9';
    const accentYellow = '#f8f16a';

    // 1. PIE CHART: Course Distribution
    const ctxPie = document.getElementById('coursePieChart');
    if (ctxPie) {
        new Chart(ctxPie.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Dressmaking', 'Nail Care', 'Cookery', 'Welding'],
                datasets: [{
                    data: [40, 25, 20, 15],
                    backgroundColor: [primaryGreen, secondaryGreen, '#2e7d32', accentYellow],
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // 2. BAR CHART: Monthly Graduates
    const ctxBar = document.getElementById('gradBarChart');
    if (ctxBar) {
        new Chart(ctxBar.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Graduates',
                    data: [45, 52, 67, 48],
                    backgroundColor: primaryGreen,
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // 3. LINE GRAPH: Enrollment Growth
    const ctxLine = document.getElementById('enrollLineChart');
    if (ctxLine) {
        new Chart(ctxLine.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'New Enrollees',
                    data: [120, 150, 180, 170, 210],
                    borderColor: primaryGreen,
                    backgroundColor: 'rgba(0, 77, 38, 0.1)', // Matches softGreen with transparency
                    fill: true,
                    tension: 0.4 
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }
});