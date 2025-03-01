<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Passkey;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PasskeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('settings/passkeys', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => $request->session()->get('status'),
        ]);
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
    public function show(Passkey $passkey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passkey $passkey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passkey $passkey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passkey $passkey)
    {
        //
    }
}
