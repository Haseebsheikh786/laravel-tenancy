<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Illuminate\Support\Facades\Log;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('Tenant.index', [
            "tenants" => $tenants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'domain_name' => 'required|string|max:255|unique:domains,domain',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            // Create the tenant
            $tenant = Tenant::create($validatedData);

            // Create the domain for the tenant
            $tenant->domains()->create([
                'domain' => $validatedData['domain_name'] . '.' . config('app.domain')
            ]);

            return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create tenant.', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to create tenant: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
