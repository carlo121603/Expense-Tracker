var ctx = document.getElementById('expensePieChart').getContext('2d');
var expensePieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: categories, // PHP data
        datasets: [{
            data: totals, // PHP data
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ]
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'top', // Move legend to the right
                labels: {
                    font: {
                        size: 16, // Increase font size
                        weight: 'bold' // Make text bold
                    },
                    color: '#000' // Optional: Set text color to black
                }
            }
        }
    }
});
