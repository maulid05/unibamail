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
        $terima = Relasi::where('id_penerima', Auth()->id())->orderBy('id', 'desc')->where('posisi', '0')->get();
        $acc = Relasi::where('id_pengirim', Auth()->id())->orderBy('id', 'desc')->where('posisi', '1')->get();
        $revisi = Relasi::where('id_pengirim', Auth()->id())->orderBy('id', 'desc')->where('posisi', '2')->get();
        $kirim = Relasi::where('id_pengirim', Auth()->id())->orderBy('id', 'desc')->where('posisi', '0')->get();
        $surat = Surat::all();
        $user = User::all();
        return view('target.relasi.index', compact('terima', 'kirim', 'surat', 'user', 'revisi', 'acc'));
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
    public function store(StoreRelasiRequest $request)
    {
        $validated = $request->validated();
        dd($validated);
        Relasi::create($validated);
        
        return redirect()->route('surat.index')->with('Berhasil di tambahkan');
    }
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
        $relasi->posisi =  $request->posisi;
        $relasi->save();
        return redirect()->back()->with('successs','Dikonfirmasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relasi $relasi)
    {
        $relasi->delete();
        return redirect()->route('relasi.index')->with('success','Berhasil di hapus');
    }
}
