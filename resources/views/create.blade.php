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
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                       
                    </header>

                    <main class="mt-6">
                        <form method="POST" action="{{ route('invoce.store') }}" class="space-y-6">
                            @csrf
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Penerima</label>
                                <input type="text" name="nama" id="nama" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" name="alamat" id="alamat" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                                <input type="number" name="harga" id="harga" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        
                            <div>
                                <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                                <input type="text" name="keperluan" id="keperluan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        
                            <div>
                                <label for="item" class="block text-sm font-medium text-gray-700">Item</label>
                                <input type="text" name="item" id="item" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>
                        
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white rounded-full px-6 py-2 hover:bg-blue-600">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
               
    </body>
</html>
