<?php

namespace App\Http\Controllers;

use App\Models\{Relasi, User, Role, Surat};
use App\Http\Requests\StoreRelasiRequest;
use App\Http\Requests\UpdateRelasiRequest;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $terima = Relasi::where('id_penerima', Auth()->id())->get();
        $kirim = Relasi::where('id_pengirim', Auth()->id())->get();
        $surat = Surat::all();
        $user = User::all();
        return view('target.relasi.index', compact('terima', 'kirim', 'surat', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = $request->input('search');
        
        $relasi = Relasi::pluck('id_penerima');

        $user = User::when($search, function ($query, $search){
            return $query->where('nama', 'like', '%'. $search . '%');
        })->where('id', '!=', auth()->id() )->get();

        $id = $request->query('id');
        
        $role = Role::all();

        return view('target.relasi.create', compact('search', 'user', 'role', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRelasiRequest $request)
    {
        $validated = $request->validated();
        dd($validated);
        Relasi::create($validated);

        return redirect()->route('surat.index')->with('Berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Relasi $relasi)
    {
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
        $relasi->delete();
        return redirect()->route('relasi.index')->with('Berhasil di hapus');
    }
}
