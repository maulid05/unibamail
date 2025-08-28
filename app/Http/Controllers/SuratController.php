<?php

namespace App\Http\Controllers;

use App\Http\Controllers\QrCodeController;
use App\Models\{Surat, Relasi, Role, User, Tempel, Qrcode};
use App\Http\Requests\StoreSuratRequest;
use App\Http\Requests\UpdateSuratRequest;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Surat::where('user_id', Auth()->id())->orderBy('id', 'desc')->get();
        $tujuan = User::where('id', '!=', Auth()->id())->get();
        $id_surat = $surat->pluck('id');
        return view('target.surat.index', compact('surat', 'tujuan' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $surat = Relasi::where('id_pengirim', Auth()->id())->count();
        $no_urut = str_pad($surat + 1, 3, '0', STR_PAD_LEFT) ;
        $abulan = now()->month;
        $romawi = [
            1 => "I", 2 => "II", 3 => "III", 4 => "IV", 5 => "V", 6 => "VI", 7 => "VII", 8 => "VIII", 9 => "XI", 10 => "X"
        ];
        $bulan = $romawi[$abulan] ?? '';
        $tahun = now()->year;
        return view('target.surat.create', compact('no_urut', 'bulan', 'tahun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_urut' => 'required|string|max:255',
            'kode_instansi' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'bulan' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi' => 'required|string',
            'user_id' => 'required|string',
        ]);


        $surat = Surat::create([
            'no_urut' => $validated['no_urut'],
            'kode_instansi' => $validated['kode_instansi'],
            'jenis_surat' => $validated['jenis_surat'],
            'bulan' => $validated['bulan'],
            'tahun' => $validated['tahun'],
            'perihal' => $validated['perihal'],
            'tanggal' => $validated['tanggal'],
            'isi' => $validated['isi'], 
            'user_id' => $validated['user_id'], 
        ]);

        $id_surat = Surat::where('user_id', Auth()->id())->latest()->first();

        return view('target.tempel.create', compact('id_surat'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Surat $surat, QrCodeController $Qr)
{
    $file = Tempel::all();

    $loginId = Auth()->id();
    $sekret = false;

    // cek pemilik surat
    $pemilik = User::find($surat->user_id);
    if ($pemilik && $pemilik->sekretaris == $loginId) {
        $sekret = true;
    }

    // cek penerima surat
    $relasi = Relasi::where('id_surat', $surat->id)->get();
    foreach ($relasi as $r) {
        $penerima = User::find($r->id_user);
        if ($penerima && $penerima->sekretaris == $loginId) {
            $sekret = true;
            break;
        }
    }

    // kalau dia sekretaris → atasan = semua user yg punya sekretaris dia
    if ($sekret) {
        $atasan = User::where('sekretaris', $loginId)->get();
    } else {
        $atasan = User::all();
    }

    $id = Relasi::where('id_surat', $surat->id)->first();
    $qr = $id ? Qrcode::where('id_relasi', $id->id)->get() : collect();

    $balas = User::where('id', '!=', $loginId)->get();

    return view('target.surat.show', compact('surat', 'file', 'id', 'atasan', 'sekret', 'balas', 'qr'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surat $surat)
{
    // ambil lampiran terkait surat ini
    $tempel = Tempel::where('id_surat', $surat->id)->get();

    return view('target.surat.edit', compact('surat', 'tempel'));
}

public function update(Request $request, Surat $surat)
{
    // update data utama surat
    $surat->update([
        'perihal' => $request->perihal,
        'tanggal' => $request->tanggal,
        'isi'     => $request->isi,
    ]);

    // jika ada file baru yang diupload
    if ($request->hasFile('lampiran')) {
        foreach ($request->file('lampiran') as $file) {
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('lampiran'), $namaFile);

            Tempel::create([
                'id_surat' => $surat->id,
                'file'     => 'lampiran/'.$namaFile,
            ]);
        }
    }

    return redirect()->route('surat.show', $surat->id)
                     ->with('success', 'Surat berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surat $id_surat)
    {
        $relasi = Relasi::where('id_surat', $id_surat);
        $relasi->delete();

    }
}
