<?php

namespace App\Http\Controllers;

use App\Models\Invoce;
use Illuminate\Http\Request;

class InvoceController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel invoces
        $invoce = Invoce::all();
        return view('invoce', compact('invoce'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'harga' => 'required|integer',
            'keperluan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'item' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Invoce::create($validatedData);

        return redirect()->to('/invoce')->with('success', 'Invoce berhasil ditambahkan');
    }

    public function show($nomor)
    {
        $invoce = Invoce::where('nomor', $nomor)->firstOrFail();
        return view('isi', compact('invoce'));
    }

    public function edit($nomor)
{
    // Fetch the invoice based on the nomor
    $invoce = Invoce::where('nomor', $nomor)->firstOrFail();
    // Return the edit view with the invoice data
    return view('edit', compact('invoce'));
}

public function update(Request $request, $nomor)
{
    // Validate the request data
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'harga' => 'required|integer',
        'keperluan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'item' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ]);

    // Find the invoice and update it with validated data
    $invoce = Invoce::where('nomor', $nomor)->firstOrFail();
    $invoce->update($validatedData);

    // Redirect back to the invoice list with a success message
    return redirect()->to('/invoce')->with('success', 'Invoce berhasil diubah');
}



public function destroy($nomor)
{
    $invoce = Invoce::where('nomor', $nomor)->firstOrFail();
    $invoce->delete();

    return redirect()->to('/invoce')->with('success', 'Invoce berhasil dihapus');
}

}

