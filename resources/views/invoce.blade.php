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
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        
                    <header class="pt-3 md:pt-10 md:pb-2 flex justify-end">
                        <button class="bg-transparent text-blue-500 border border-blue-500 rounded-full px-6 py-1 mr-8 hover:bg-blue-500 hover:text-white" onclick=" window.location='{{ url('/create')}}'">Tambah</button>
                    </header>

                    <x-navbar />
                    
                    <div class="p-4 md:ml-64 ml-32 h-auto">
                          
                        <div class=" bg-gray-200 pt-4">
                         <main class="">
                             <div class=" bg-white rounded-md mx-4 mb-4 p-0 md:p-4 flex flex-col items-center justify-center text-xs sm:text-sm md:text-md lg:text-lg">


                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="px-0 sm:px-2 md:px-6 py-2 text-blue-500">No. Invoice</th>
                                            <th class="px-0 sm:px-2 md:px-6 py-2 text-blue-500">Penerima</th>
                                            <th class="px-0 sm:px-2 md:px-6 py-2 text-blue-500">Tanggal</th>
                                            <th class="px-0 sm:px-2 md:px-6 py-2 text-blue-500">Harga</th>
                                            <th class="px-0 sm:px-2 md:px-6 py-2 text-blue-500">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            
                                        @foreach ($invoce as $invoice)
                                            <tr class="whitespace-nowrap hover:text-blue-600" onclick="window.location='{{ url('/detail/'.$invoice['nomor']) }}'">
                                                <td class="px-0 sm:px-2 md:px-6  py-4 text-center" >#
                                                    {{-- <a href="{{ url('/detail/'.$invoice['nomor']) }}" class="text-blue-600 hover:underline"> --}}
                                                        {{ $invoice['nomor'] }}
                                                    {{-- </a> --}}
                                                </td>
                                                <td class="px-0 sm:px-2 md:px-6  py-4 text-center">{{ $invoice['nama'] }}</td>
                                                <td class="px-0 sm:px-2 md:px-6  py-4 text-center">{{ $invoice['tanggal'] }}</td>
                                                <td class="px-0 sm:px-2 md:px-6  py-4 text-center">Rp {{ number_format($invoice['harga'], 0, ',', '.') }}</td>
                                                <td class="px-0 sm:px-2 md:px-6  py-4 text-center flex justify-center space-x-2">
                                                    <button class="bg-transparent text-blue-500 border border-blue-500 rounded-full px-0 sm:px-2 md:px-6  py-1 hover:bg-blue-500 hover:text-white" onclick="event.stopPropagation(); window.location='{{ url('/edit/'.$invoice['nomor']) }}'">Edit</button>
                                                    <button class="bg-transparent text-blue-500 border border-blue-500 rounded-full px-0 sm:px-2 md:px-6 py-1 hover:bg-blue-500 hover:text-white" onclick="event.stopPropagation(); document.getElementById('delete-form-{{ $invoice['nomor'] }}').submit();">
        Hapus
    </button>

    <form id="delete-form-{{ $invoice['nomor'] }}" action="{{ url('/delete/'.$invoice['nomor']) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
                                                </td>                                        
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            

                             
                             </div>
                         </main>
 
                         <footer class="py-10 text-center bg-white text-sm text-black dark:text-white/70">
                           Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                         </footer>
                        </div>
                       </div>
               
    </body>
</html>
