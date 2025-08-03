<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRelasiRequest;
use App\Models\{User, Relasi, Surat};

class KirimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('id', '!=', Auth()->id())->get();
        $surat = Surat::where('user_id', Auth()->id())->orderBy('id', 'desc')->get();
        //dd($data);
        return view('target.kirim.index', compact('data', 'surat'));
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
        //dd($request);
        $role = Relasi::create($request->validated());
        $data = [
            'id_sekretaris' => $role->id_penerima,
            'id_surat' => $role->id_surat,
        ];
        //dd($data);
        app(\App\Http\Controllers\RoleController::class)->store($data);
        return redirect()->action([KirimController::class, 'index'])->with('success', 'Surat berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
