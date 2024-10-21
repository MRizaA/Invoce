<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoceController;
use App\Models\Invoce;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashbord');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Invoice routes
    Route::get('/invoce', function () {
        $query = Invoce::query();
        $search = request('search');

        // Existing search logic
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
                      ->orWhere('item', 'like', '%' . substr($term, 1) . '%')
                      ->orWhere('harga', 'like', '%' . substr($term, 1) . '%')
                      ->orWhereDate('tanggal', 'like', '%' . substr($term, 1) . '%');
                });
                unset($terms[$key]);
            }
        }

        // Ketiga, proses kata-kata yang diawali dengan '-'
        foreach ($terms as $key => $term) {
            if (substr($term, 0, 1) == '-') {
                $query->where(function($q) use ($term) {
                    $q->where('nama', 'not like', '%' . substr($term, 1) . '%')
                      ->Where('nomor', 'not like', '%' . substr($term, 1) . '%')
                      ->Where('item', 'not like', '%' . substr($term, 1) . '%')
                      ->Where('harga', 'not like', '%' . substr($term, 1) . '%')
                      ->WhereDate('tanggal', 'not like', '%' . substr($term, 1) . '%');
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


        $invoice = $query->latest()->paginate(4)->withQueryString();

        return view('invoce', ['invoce' => $invoice]);
    })->name('invoce.index');

    Route::get('/detail/{nomor}', function ($nomor) {
        $invoice = Invoce::where('nomor', $nomor)->firstOrFail();
        return view('isi', ['invoce' => $invoice]);
    })->name('invoce.show');

    // Routes that require 'create invoices' permission
    Route::middleware(['can:create invoices'])->group(function () {
        Route::get('/create', function () {
            return view('create');
        })->name('invoce.create');

        Route::post('/invoce', [InvoceController::class, 'store'])->name('invoce.store');
    });

    // Routes that require 'update invoices' permission
    Route::middleware(['can:update invoices'])->group(function () {
        Route::get('/edit/{nomor}', function ($nomor) {
            $invoice = Invoce::where('nomor', $nomor)->firstOrFail();
            return view('edit', ['invoce' => $invoice]);
        })->name('invoce.edit');

        Route::put('/update/{nomor}', [InvoceController::class, 'update'])->name('invoce.update');
    });

    // Route that requires 'delete invoices' permission
    Route::delete('/delete/{nomor}', [InvoceController::class, 'destroy'])
        ->middleware('can:delete invoices')
        ->name('invoce.destroy');
});

require __DIR__.'/auth.php';