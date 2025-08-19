
    <!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-mobile-alt text-2xl text-blue-500 mr-2"></i>
                <span class="text-xl font-bold text-gray-800">GALAXY PHONE ACADEMY</span>
            </div>
            
            <nav class="hidden md:flex space-x-8">
                <a href="#home" class="nav-link text-gray-700 font-medium">Home</a>
              <!-- Add this with the other nav links -->
                <a href="#courses" class="nav-link text-gray-700 font-medium">Courses</a>
                <a href="#about" class="nav-link text-gray-700 font-medium">About</a>
                <a href="#contact" class="nav-link text-gray-700 font-medium">Contact</a>
            </nav>
            
            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white py-2 px-4 shadow-lg">
            <a href="#home" class="block py-2 text-gray-700 font-medium">Home</a>
            <a href="#courses" class="block py-2 text-gray-700 font-medium">Courses</a>
            <a href="#about" class="block py-2 text-gray-700 font-medium">About</a>
            <a href="#contact" class="block py-2 text-gray-700 font-medium">Contact</a>
        </div>
    </header>