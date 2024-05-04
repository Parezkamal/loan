@extends('admin.dashboard')


@section('content')

    <style>
        .analytic-boxes {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .analytic-box {
            width: 25%; /* Adjusted width for four boxes */
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .analytic-box i {
            font-size: 3em;
            color: #0d6efd; /* Primary color */
            margin-bottom: 15px;
        }

        .analytic-box .content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .analytic-box .title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .analytic-box .description {
            color: #666;
        }


    </style>


    <div class="row">
        <div class="analytic-boxes">
            <div class="analytic-box">
                <i class="fas fa-users"></i>
                <div class="content">
                    <h3 class="title">{{$totalUsers?? ''}}</h3>
                    <p class="description">Total Users</p>
                </div>
            </div>
            <div class="analytic-box">
                <i class="fas fa-chart-line"></i>
                <div class="content">
                    <h3 class="title">{{$loanApplications?? ''}}</h3>
                    <p class="description">Total Application </p>
                </div>
            </div>
            <div class="analytic-box">
                <i class="fas fa-file"></i>
                <div class="content">
                    <h3 class="title">{{$approvedLoans}}</h3>
                    <p class="description">Total Approved Application</p>
                </div>
            </div>
            <div class="analytic-box">
                <i class="fas fa-file"></i>
                <div class="content">
                    <h3 class="title">{{$pendingLoans}}</h3>
                    <p class="description">Total Pending Application</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <canvas id="loanChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data from controller
            fetch('{{ route("dashboard.data") }}')
                .then(response => response.json())
                .then(data => {
                    // Prepare chart data
                    const ctx = document.getElementById('loanChart').getContext('2d');
                    const loanChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Total Users', 'Loan Applications', 'Approved Loans', 'Pending Loans'],
                            datasets: [{
                                label: 'Statistics',
                                data: [data.totalUsers, data.loanApplications, data.approvedLoans, data.pendingLoans],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(255, 206, 86, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Application Statistics'
                                }
                            }
                        }
                    });
                });
        });
    </script>


@endsection
