<?php

declare(strict_types=1);

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Passkey;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PasskeyController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $passkeys = $request->user()->passkeys;
        // Transform the collection to make the 'created_at' field human-readable
        $humanReadablePasskeys = $passkeys->map(function ($item) {
            // Create a new array with the transformed 'created_at' field
            $transformedItem = $item->toArray(); // Convert the model to an array
            $transformedItem['created_at'] = $item->created_at ? $item->created_at->diffForHumans() : 'N/A';

            return $transformedItem;
        });

        return Inertia::render('settings/passkeys', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => $request->session()->get('status'),
            'passkeys' => $humanReadablePasskeys, // Add this line to pass the passkeys

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
     * @throws AuthorizationException
     */
    public function destroy(Passkey $passkey)
    {

        // Authorization check
        $this->authorize('delete', $passkey);

        $passkey->delete();

        return back();
    }
}
