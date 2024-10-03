
<!-- Sidebar navbar -->

@props(['currentUrl'])
                    
<aside
class="fixed top-0 left-0 z-40 md:w-64 h-screen pt-14 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
aria-label="Sidenav"
id="drawer-navigation"
>
<div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
  
  <ul class="space-y-2">
    <li>
        <a href="/dashboard" class="{{ Request::is('/dashboard') ? 'bg-gray-100' : '' }} text-black hover:text-blue-500 hover:underline px-4 flex items-center p-2 text-base font-medium rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Dashboard</a>
     
    </li>
    <li>
       <a href="/invoce" class="{{ request()->is('invoce') ? 'bg-gray-100' : '' }} text-black hover:text-blue-500 hover:underline px-4 flex items-center p-2 text-base font-medium rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Invoce</a>
     
    </li>
    
  </ul>
  
</div>

</aside>