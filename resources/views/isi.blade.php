<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            
        </style>

@vite('resources/css/app.css')

    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-black dark:text-white/50">
        
                    <header class="grid grid-cols-2 gap-2 py-2 items-center space-y-10">

                        <div class=" p-8 flex ">
                            <div><img src="../img/image.png" alt="" class=" w-20"></div>
                            <div class="m-4"><h1 class=" text-orange-400 text-2xl ">Panda, Inc</h1>
                                <p class=" text-gray-500 ">www.panhub.com</p>
                                <p class=" text-gray-500 ">pandaeye@gmail.com</p>
                                <p class=" text-gray-500 ">-62 283 030 69</p>
                            </div>
                        </div>

                        <div class=" text-end m-8">
                            <p class=" text-gray-500 ">{{$invoce->alamat}}, ID-{{$invoce->id}}</p>
                        </div>
                    </header>

                    <main class=" rounded-md bg-white mx-8 p-4 ">
                        <div class="grid grid-cols-3 gap-2 p-4 text-center">
                            
                            <div class=" text-start">
                                <p class=" text-gray-500 ">Penerima</p>
                                <h1>{{$invoce->nama}}</h1>
                                <p class=" text-gray-500 ">{{$invoce->alamat}}, ID-{{$invoce->id}}</p>
                            </div>
                            <div>
                                <p class=" text-gray-500 ">Nomor Invoice</p>
                                <h1>#{{$invoce->nomor}}</h1>
                            </div>
                            <div class=" text-end">
                                <p class=" text-gray-500 ">Total</p>
                                @php
                                    $pajak= $invoce->harga * 11 / 100;
                                    $total= $invoce->harga + $pajak;
                                @endphp
                                <h1 class=" text-orange-400 text-2xl ">Rp {{ number_format($total, 0, ',', '.') }}</h1>
                            </div>
                            
                        </div>
                        <div class="grid grid-cols-3 gap-2 p-4 text-center mt-16">
                            
                           
                            <div class=" text-start">
                                <p class=" text-gray-500 ">Keperluan</p>
                                <h1>{{$invoce->keperluan}}</h1>
                            </div>

                            @php
                            use Carbon\Carbon;                        
                            $Tanggal = Carbon::parse($invoce->tanggal);                           
                            @endphp                       
                            <div>
                            <p class="text-gray-500">Tanggal Invoice</p>
                            <h1>{{ $Tanggal->translatedFormat('d F Y') }}</h1>
                            </div>

                            @php
                            $tenggatPembayaran = $Tanggal->copy()->addDays(15);
                            @endphp
                            <div class="text-end">
                            <p class="text-gray-500">Tenggat Pembayaran</p>
                            <h1>{{ $tenggatPembayaran->translatedFormat('d F Y') }}</h1>
                            </div>
                        </div>
                        <div class=" border-y border-gray-300 py-1 my-2 mx-4">
                            <p class=" text-gray-500 ">Item detail</p>
                        </div>
                        <div class="my-2 border-b border-gray-300 pb-10 mx-4">
                            <h1>Pembayaran Tagihan</h1>
                            <p class=" text-gray-500 ">Pembayaran tagihan {{ $invoce->item }}, {{ $invoce->deskripsi }}</p>
                        </div>
                        
                        <div class="  grid grid-cols-2 gap-4 mx-4">
                            <div></div>
                            <div>
                                <div class="grid grid-cols-2"><p>Subtotal</p><p class=" text-end">Rp {{ number_format($invoce->harga, 0, ',', '.') }}</p></div>
                                <div class="grid grid-cols-2"><p>Pajak</p><p class=" text-end">Rp {{ number_format($pajak, 0, ',', '.') }}</p></div>
                                <div class="border-t border-gray-300 grid grid-cols-2"><h1>Total</h1><h1 class=" text-end">Rp {{ number_format($total, 0, ',', '.') }}</h1></div>
                            </div>
                        </div>
                        <p class="mx-4 mt-32 mb-4">Terimakasih atas kepercayaan Anda</p>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        <div class=" mx-16 text-gray-500 text-start"><h1>Term & Condition</h1>
                        <h1>Harap lakukan pembayaran dalam 15 hari sejak tanggal invoice dibuat</h1>
                        </div>
                        
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
               
    </body>
</html>
