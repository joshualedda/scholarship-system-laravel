@extends('layouts.includes.index')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>


<div class="row">
    <livewire:dashboard>
</div>


<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="height:30rem">
                    <form id="filterForm" class="row g-3">
                        <div class="col-md-5">
                            @if (Auth::user()->role === 1 || Auth::user()->role === 0)
                            <label for="selectedSources" class="form-label">Recipient</label>
                            <select id="selectedSources" name="selectedSources" class="form-select form-select-sm">
                                <option value="all">All</option>
                                @foreach ($fundSources as $source)
                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                @endforeach
                            </select>
                            @else
                            <label for="selectedType" class="form-label">Scholarship Type</label>
                            <select id="selectedType" name="selectedType" class="form-select form-select-sm">
                                <option value="0">Government</option>
                                <option value="1">Private</option>
                            </select>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <label for="selectedYear" class="form-label">Select Year</label>
                            <select id="selectedYear" name="selectedYear" class="form-select form-select-sm">
                                <option value="all">All</option>
                                @foreach ($years as $year)
                                <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-sm btn-primary">Generate</button>
                        </div>
                    </form>
                    <!-- Moved the chart container inside the card body -->
                    <div class="col-md-12 mt-2">
                        <div style="position: relative; height:350px; width: 700px;">
                            <canvas id="myChart" style="width: 100%; height: 100%;" class="m-0 p-0"></canvas>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (Auth::user()->role === 1 || Auth::user()->role === 0)
<script>
    $(document).ready(function() {
        $('#filterForm').submit(function(event) {
            event.preventDefault();
            updateChart();
        });

        function updateChart() {
            var selectedSourcesId = $('#selectedSources').val() || "all";
            var selectedYear = $('#selectedYear').val();
            var selectedSourcesName = $('#selectedSources option:selected').text(); // Get the selected source name

            $.ajax({
                url: '/filter-data', // Correct URL for backend route
                type: 'GET',
                data: {
                    selectedSources: selectedSourcesId,
                    selectedYear: selectedYear
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Received data:', response);
                    var allLabels = response.labels;
                    var data = response.data ? response.data : [];

                    // Update chart data
                    myChart.data.labels = allLabels;
                    myChart.data.datasets[0].data = data;

                    // Update chart label based on selected options
                    var label = selectedSourcesName + ' / ' + selectedYear; // Customize this based on your requirement
                    myChart.config.options.plugins.title.text = label;

                    // Update chart
                    myChart.update();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error in Ajax request:', textStatus, errorThrown);
                }
            });
        }

        // Initialize the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Student Data',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        // ... (more colors if needed)
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        // ... (more colors if needed)
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Student Data' // Initial label
                    }
                },
                scales: {
                    responsive: true,
                    y: {
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Update chart on page load
        updateChart();
    });
</script>
@else
<script>
    $(document).ready(function() {
        $('#filterForm').submit(function(event) {
            event.preventDefault();
            updateChart();
        });

        function generateRandomColor() {
            // Generate random RGB values
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);

            // Construct RGBA string
            return 'rgba(' + r + ',' + g + ',' + b + ',0.2)';
        }

        function updateChart() {
            var selectedScholarshipType = $('#selectedType').val();
            var selectedYear = $('#selectedYear').val();

            $.ajax({
                url: '/grantees', // Correct URL for backend route
                type: 'GET',
                data: {
                    selectedScholarshipType: selectedScholarshipType,
                    selectedYear: selectedYear
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Received data:', response);
                    var allLabels = [];
                    var data = [];

                    // Populate labels and data from response
                    response.forEach(function(item) {
                        allLabels.push(item.label);
                        data.push(item.data);
                    });

                    // Generate at least 50 background and border colors
                    var backgroundColors = [];
                    var borderColors = [];
                    for (var i = 0; i < 50; i++) {
                        backgroundColors.push(generateRandomColor());
                        borderColors.push('rgb(255, 255, 255)'); // You can customize border colors as needed
                    }

                    // Update chart data
                    myChart.data.labels = allLabels;
                    myChart.data.datasets[0].data = data;
                    myChart.data.datasets[0].backgroundColor = backgroundColors;
                    myChart.data.datasets[0].borderColor = borderColors;

                    // Update chart
                    myChart.update();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error in Ajax request:', textStatus, errorThrown);
                }
            });
        }

        // Initialize the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // Initialize to empty array
                datasets: [{
                    label: 'Scholarship Data',
                    data: [], // Initialize to empty array
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Scholarship Data' // Initial label
                    }
                },
                scales: {
                    responsive: true,
                    y: {
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Update chart on page load
        updateChart();
    });
</script>
@endif




@endsection
