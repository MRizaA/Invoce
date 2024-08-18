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
        
                    {{-- <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                       
                    </header> --}}

                    
                        <x-navbar />
    
                        <div class="p-4 md:ml-64 ml-32 h-auto">
                          
                         <div class=" bg-gray-200 pt-4">
                          <main class="">
                              <div class=" bg-white rounded-md mx-4 mb-4 p-4 flex flex-col items-center justify-center">
                              <img src="img/image.png" alt="" class=" w-5/12">
                              <div class=""><h1 class=" text-orange-400 pt-4 text-2xl md:text-3xl lg:text-4xl xl:text-5xl text-center">Panda, Inc</h1></div>
                              </div>
                          </main>
                          
  
                          <footer class="py-10 text-center bg-white text-sm text-black dark:text-white/70">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                          </footer>
                         </div>
                        </div>          
    </body>
</html>
