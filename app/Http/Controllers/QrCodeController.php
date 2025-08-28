<?php

namespace App\Http\Controllers;

use App\Models\{Qrcode, Surat, User};
use App\Http\Requests\StoreQrCodeRequest;
use App\Http\Requests\UpdateQrCodeRequest;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode  as QRgenerator;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

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
    public function store($id_relasi, $id_user, $data)
    {
        $file = "qr/relasi_{$id_relasi}_user_{$id_user}.svg";

        Storage::disk('public')->put(
            $file,
            QRgenerator::format('svg')->size(300)->generate($data)
        );

        //dd($this->all());
        Qrcode::create([
            'qrcode' => $file,
            'id_relasi' => $id_relasi,
            'id_user' => $id_user,
        ]);

        return $file;
    }

    /**
     * Display the specified resource.
     */
    public function show($surat, $id)
    {
        $isi = Surat::where('id', $surat)->first();
        $acc = User::where('id', $id)->first();

        return view('target.qr.show', compact('isi', 'acc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QrCode $qrCode)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQrCodeRequest $request, QrCode $qrCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QrCode $qrCode)
    {
        //
    }
}
