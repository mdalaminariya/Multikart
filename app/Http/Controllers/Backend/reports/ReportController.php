<?php

namespace App\Http\Controllers\Backend\reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        $reports = Report::latest()->get();

        /*
        |--------------------------------------------------------------------------
        | MONTHS
        |--------------------------------------------------------------------------
        */

        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('M');
        });

        /*
        |--------------------------------------------------------------------------
        | SALES DATA
        |--------------------------------------------------------------------------
        | if month has no data => show 0
        */

        $salesData = [];

        foreach (range(1, 12) as $month) {

            $total = Report::whereMonth('created_at', $month)
                ->sum('total');

            $salesData[] = (float) $total;
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN DATA
        |--------------------------------------------------------------------------
        */

        $returnData = [];

        foreach (range(1, 12) as $month) {

            $total = Report::whereMonth('created_at', $month)
                ->count();

            $returnData[] = (int) $total;
        }

        /*
        |--------------------------------------------------------------------------
        | EXPENSES DATA
        |--------------------------------------------------------------------------
        */

        $expenseData = [];

        foreach (range(1, 12) as $month) {

            $expense = Report::whereMonth('created_at', $month)
                ->sum('total');

            $expenseData[] = (float) ($expense * 0.30);
        }

        /*
        |--------------------------------------------------------------------------
        | SALES PURCHASE DATA
        |--------------------------------------------------------------------------
        */

        $totalSales = Report::sum('total');

        $totalPurchase = $totalSales * 0.40;

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE %
        |--------------------------------------------------------------------------
        */

        $employeeSatisfaction = 75;

        return view('backend.reports.index', compact(
            'reports',
            'months',
            'salesData',
            'returnData',
            'expenseData',
            'totalSales',
            'totalPurchase',
            'employeeSatisfaction'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
