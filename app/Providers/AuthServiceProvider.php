<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Medication;
use App\Policies\MedicationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Medication::class => MedicationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            return $user->hasAllAccess() ? true : null;
        });
    }
}
