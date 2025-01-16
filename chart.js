var ctx = document.getElementById('expensePieChart').getContext('2d');
var expensePieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: categories, 
        datasets: [{
            data: totals, 
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
                position: 'top', 
                labels: {
                    font: {
                        size: 16, 
                        weight: 'bold' 
                    },
                    color: '#000' 
                }
            }
        }
    }
});
