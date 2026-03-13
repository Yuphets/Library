<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\Drivers\DompdfDriver;
use App\Models\Loan;
use App\Observers\LoanObserver; // if you have this

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Set the default PDF driver to Dompdf
        // Register observer (if you have one)
        // Loan::observe(LoanObserver::class);
    }
}