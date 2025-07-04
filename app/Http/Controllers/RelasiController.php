<?php

namespace App\Http\Controllers;

use App\Models\{Relasi, User};
use App\Http\Requests\StoreRelasiRequest;
use App\Http\Requests\UpdateRelasiRequest;

class RelasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $relasi = Relasi::when($search, function ($query, $search){
            return $query->where('nama', 'like', '%{$search}%');
        })->get();

        return view('relasi.index', compact('relasi', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRelasiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Relasi $relasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relasi $relasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelasiRequest $request, Relasi $relasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relasi $relasi)
    {
        //
    }
}
