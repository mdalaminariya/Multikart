@extends('layouts.backendmaster.master')

@section('content')

<div class="page-body">

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Reports
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>

                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Reports
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="container-fluid">

        <div class="row">

            {{-- Sales Summary --}}
            <div class="col-xl-8 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Sales Summary</h5>
                    </div>

                    <div class="card-body sell-graph">
                        <canvas id="myGraph" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- Employee Satisfaction --}}
            <div class="col-xl-4 col-md-6">
                <div class="card report-employee">
                    <div class="card-header">
                        <h2>{{ $employeeSatisfaction ?? 0 }}%</h2>
                        <h6 class="mb-0">Employees Satisfied</h6>
                    </div>

                    <div class="card-body">
                        <canvas id="employeeChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Transfer Report Table --}}
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">
                        <h5>Transfer Report</h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive table-desi">

                            <table class="table report-table all-package table-category">

                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Transfer Id</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($reports as $report)

                                    <tr>
                                        <td>{{ $report->name ?? 'N/A' }}</td>
                                        <td>{{ $report->transfer_id ?? '0' }}</td>
                                        <td>
                                            {{ $report->created_at ? $report->created_at->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td>${{ $report->total ?? 0 }}</td>
                                    </tr>

                                    @empty

                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No Reports Found
                                        </td>
                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Expenses --}}
            <div class="col-lg-6">

                <div class="card">

                    <div class="card-header">
                        <h5>Expenses</h5>
                    </div>

                    <div class="card-body expense-chart">
                        <canvas id="expenseChart"></canvas>
                    </div>

                </div>

            </div>

            {{-- Sales Purchase --}}
            <div class="col-lg-6">

                <div class="card">

                    <div class="card-header">
                        <h5>Sales / Purchase</h5>
                    </div>

                    <div class="card-body">
                        <canvas id="salesPurchaseChart"></canvas>
                    </div>

                </div>

            </div>

            {{-- Return Chart --}}
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">
                        <h5>Sales / Purchase Return</h5>
                    </div>

                    <div class="card-body sell-graph">
                        <canvas id="myLineCharts" height="100"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@section('scripts')

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // Sales Summary Chart
    // =========================

    const salesCtx = document.getElementById('myGraph');

    new Chart(salesCtx, {
        type: 'bar',

        data: {
            labels: {!! json_encode($months ?? ['Jan','Feb','Mar','Apr','May','Jun']) !!},

            datasets: [{
                label: 'Sales',

                data: {!! json_encode($salesData ?? [0,0,0,0,0,0]) !!},

                borderWidth: 1
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // =========================
    // Employee Satisfaction
    // =========================

    const employeeCtx = document.getElementById('employeeChart');

    new Chart(employeeCtx, {
        type: 'doughnut',

        data: {
            labels: ['Satisfied', 'Unsatisfied'],

            datasets: [{
                data: [
                    {{ $employeeSatisfaction ?? 0 }},
                    {{ 100 - ($employeeSatisfaction ?? 0) }}
                ]
            }]
        },

        options: {
            responsive: true
        }
    });


    // =========================
    // Expense Chart
    // =========================

    const expenseCtx = document.getElementById('expenseChart');

    new Chart(expenseCtx, {

        type: 'line',

        data: {
            labels: {!! json_encode($months ?? ['Jan','Feb','Mar','Apr','May','Jun']) !!},

            datasets: [{
                label: 'Expenses',

                data: {!! json_encode($expenseData ?? [0,0,0,0,0,0]) !!},

                fill: false,
                tension: 0.4
            }]
        },

        options: {
            responsive: true,

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    // =========================
    // Sales Purchase Chart
    // =========================

    const spCtx = document.getElementById('salesPurchaseChart');

    new Chart(spCtx, {

        type: 'pie',

        data: {
            labels: ['Sales', 'Purchase'],

            datasets: [{
                data: [
                    {{ $totalSales ?? 0 }},
                    {{ $totalPurchase ?? 0 }}
                ]
            }]
        },

        options: {
            responsive: true
        }
    });


    // =========================
    // Return Chart
    // =========================

    const returnCtx = document.getElementById('myLineCharts');

    new Chart(returnCtx, {

        type: 'line',

        data: {

            labels: {!! json_encode($months ?? ['Jan','Feb','Mar','Apr','May','Jun']) !!},

            datasets: [
                {
                    label: 'Sales Return',

                    data: {!! json_encode($salesReturnData ?? [0,0,0,0,0,0]) !!},

                    tension: 0.4
                },

                {
                    label: 'Purchase Return',

                    data: {!! json_encode($purchaseReturnData ?? [0,0,0,0,0,0]) !!},

                    tension: 0.4
                }
            ]
        },

        options: {
            responsive: true,

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});

</script>

@endsection
