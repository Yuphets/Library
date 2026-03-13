<?php

namespace App\Providers;

use App\Models\Loan;
use App\Observers\LoanObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Loan::observe(LoanObserver::class);
    }
}