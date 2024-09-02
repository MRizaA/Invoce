<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoceController;

use App\Models\invoce;

Route::resource('invoce', InvoceController::class);

Route::get('/', function () {
    return view('dashbord');
});                         
                                        
Route::get('/invoce', function () {
    
    // $invoice = [
    //     ['nomor' => 'PA0005-24', 'nama' => 'Agus Tutisno', 'tanggal' => '03 Maret 2024', 'harga' => 100000]
    // ];

    // invoce::all();
    // $invoice=invoce::all();;


    //pencarian
    $query = Invoce::query();
    $search = request('search');

    if ($search) {
        // Pisahkan berdasarkan spasi untuk memisahkan kata-kata, tapi pertimbangkan kutipan dan garis bawah
        preg_match_all('/"([^"]+)"|([^"\s]+)/', $search, $matches);
        $terms = array_map(function($term) {
            return str_replace('_', ' ', $term);
        }, array_filter(array_merge($matches[1], $matches[2])));

        // Pertama, proses kategori dengan '='
        foreach ($terms as $key => $term) {
            if (strpos($term, '=') !== false) {
                list($field, $value) = explode('=', $term, 2);
                $value = trim($value, '"');
                $query->where($field, $value);
                unset($terms[$key]);
            }
        }

        // Kedua, proses kata-kata yang diawali dengan '&'
        foreach ($terms as $key => $term) {
            if (substr($term, 0, 1) == '&') {
                $query->where(function($q) use ($term) {
                    $q->where('nama', 'like', '%' . substr($term, 1) . '%')
                      ->orWhere('nomor', 'like', '%' . substr($term, 1) . '%')
                      ->orWhere('item', 'like', '%' . substr($term, 1) . '%');
                });
                unset($terms[$key]);
            }
        }

        // Ketiga, proses kata-kata yang diawali dengan '-'
        foreach ($terms as $key => $term) {
            if (substr($term, 0, 1) == '-') {
                $query->where(function($q) use ($term) {
                    $q->where('nama', 'not like', '%' . substr($term, 1) . '%')
                      ->orWhere('nomor', 'not like', '%' . substr($term, 1) . '%')
                      ->orWhere('item', 'not like', '%' . substr($term, 1) . '%');
                });
                unset($terms[$key]);
            }
        }

        // Terakhir, proses kata-kata biasa (OR antara kata-kata)
        if (!empty($terms)) {
            $query->where(function($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->orWhere('nama', 'like', '%' . $term . '%')
                      ->orWhere('nomor', 'like', '%' . $term . '%')
                      ->orWhere('item', 'like', '%' . $term . '%')
                      ->orWhere('harga', 'like', '%' . $term . '%')
                      ->orWhereDate('tanggal', 'like', '%' . $term . '%');
                }
            });
        }
    }

    

    // Paginasi hasil pencarian
    $invoice = $query->latest()->paginate(4)->withQueryString();




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
