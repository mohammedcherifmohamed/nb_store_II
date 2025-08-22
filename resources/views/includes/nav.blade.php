
    <!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-mobile-alt text-2xl text-blue-500 mr-2"></i>
                <span class="text-xl font-bold text-gray-800">GALAXY PHONE ACADEMY</span>
            </div>
            
            <nav class="hidden flex items-center md:flex space-x-8">
                <a href="#home" class="nav-link text-gray-700 font-medium">{{ __('messages.home') }}</a>
              <!-- Add this with the other nav links -->
                <a href="#courses" class="nav-link text-gray-700 font-medium">@lang('messages.courses')</a>
                <a href="#about" class="nav-link text-gray-700 font-medium">@lang('messages.about')</a>
                <a href="#contact" class="nav-link text-gray-700 font-medium">@lang('messages.contact')</a>
                 <!-- Language Dropdown -->
                <details class="relative">
                    <summary class="cursor-pointer list-none px-3 py-2 border rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 font-small">
                        🌐Language
                    </summary>
                       
                    <ul class="absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-md">
                        <li>
                            <a href="{{ url('lang/en') }}" class="block px-4 py-2 hover:bg-gray-100">English</a>
                        </li>
                        <li>
                            <a href="{{ url('lang/ar') }}" class="block px-4 py-2 hover:bg-gray-100">العربية</a>
                        </li>
                    </ul>
                </details>
            </nav>
            
            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white py-2 px-4 shadow-lg">
            <a href="#home" class="block py-2 text-gray-700 font-medium">{{ __('messages.home') }}</a>
            <a href="#courses" class="block py-2 text-gray-700 font-medium">@lang('messages.courses')</a>
            <a href="#about" class="block py-2 text-gray-700 font-medium">@lang('messages.about')</a>
            <a href="#contact" class="block py-2 text-gray-700 font-medium">@lang('messages.contact')</a>
            <details class="relative">
                    <summary class="cursor-pointer list-none px-3 py-2 border rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 font-small">
                        🌐Language
                    </summary>
                       
                    <ul class="absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-md">
                        <li>
                            <a href="{{ url('lang/en') }}" class="block px-4 py-2 hover:bg-gray-100">English</a>
                        </li>
                        <li>
                            <a href="{{ url('lang/ar') }}" class="block px-4 py-2 hover:bg-gray-100">العربية</a>
                        </li>
                    </ul>
                </details>
        </div>
    </header>