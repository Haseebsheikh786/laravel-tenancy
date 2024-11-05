<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SeedTenantJob implements ShouldQueue
{
    use Queueable;

    
    protected $tenant;
    public function __construct(Tenant $tenant)
    { 
        $this->tenant = $tenant;
    }
 
    public function handle(): void
    {
        $this->tenant->run(function(){
            User::create([
                "name"=> $this->tenant->name, 
                "email"=> $this->tenant->email, 
                "password"=> $this->tenant->password, 
            ]);
        }) ;
    }
}
