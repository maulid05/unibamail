<?php

namespace App\Http\Controllers;

use App\Http\Controllers\{QrCodeController, SuratController};
use App\Models\{Relasi, User, Role, Surat};
use App\Http\Requests\StoreRelasiRequest;
use App\Http\Requests\UpdateRelasiRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode  as QRgenerator;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $terima = Relasi::where('id_penerima', Auth()->id())->where('posisi', 0)->orderBy('id', 'desc')->get();
        $acc = Relasi::where('id_pengirim', Auth()->id())->where('posisi', 1)->orderBy('id', 'desc')->get();
        $revisi = Relasi::where('id_pengirim', Auth()->id())->where('posisi', 2)->orderBy('id', 'desc')->get();
        $kirim = Relasi::where('id_pengirim', Auth()->id())->where('posisi', 0)->orderBy('id', 'desc')->get();
        $surat = Surat::all();
        $user = User::all();
        //dd($surat);
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
    public function store(StoreRelasiRequest $request )
    {
        //dd($request);
        //dd($validated);
        Relasi::where('id_pengirim', $request->id_pengirim)
        ->where('id_surat', $request->id_surat)
        ->delete();
        
        Relasi::where('id_penerima', $request->id_penerima)
        ->where('id_surat', $request->id_surat)
        ->delete();
        
        Relasi::create($request->validated());
        
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
    public function update(UpdateRelasiRequest $request, Relasi $relasi, QrCodeController $Qr, SuratController $delete)
    {
        //  dd($request);
        $relasi->update([
            'posisi' => $request->posisi
        ]);

        //$id = Relasi::where('id_penerima', Auth()->id())->where('id_surat', $relasi->id_surat);
        //dd($relasi, $id);
        
        //RelasiController::destroy();
        
        //$qrData = "Relasi ID: {$relasi->id}, Penerima ID: {$relasi->id_penerima}";
        $qrData = 'https://9df0bf145b7f.ngrok-free.app/surat/show?id_relasi=' . $relasi->id;
        $Qr->store($relasi->id, $relasi->id_penerima, $qrData);
        
        //dd($qrData);
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
