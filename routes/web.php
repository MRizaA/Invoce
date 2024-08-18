<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoceController;

use App\Models\invoce;

Route::resource('invoce', InvoceController::class);

Route::get('/', function () {
    return view('dashbord');
});                         
                                        
Route::get('/invoce', function () {
    invoce::all();
    // $invoice = [
    //     ['nomor' => 'PA0005-24', 'nama' => 'Agus Tutisno', 'tanggal' => '03 Maret 2024', 'harga' => 100000]
    // ];
    $invoice=invoce::all();;
    return view('invoce', ['invoce'=> $invoice]);
});

Route::get('/detail/{nomor}', function ($nomor) {
    $invoice = Invoce::where('nomor', $nomor)->firstOrFail();
    return view('isi', ['invoce' => $invoice]);
});

Route::get('/edit/{nomor}', function ($nomor) {
    // dd($nomor);
    $invoice = Invoce::where('nomor', $nomor)->firstOrFail();
    return view('edit', ['invoce'=> $invoice]);
});

Route::get('/create', function () {
    return view('create');
});

Route::put('/update/{nomor}', [InvoceController::class, 'update']);
Route::delete('/delete/{nomor}', [InvoceController::class, 'destroy']);
