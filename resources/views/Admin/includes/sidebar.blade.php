

<!-- Sidebar -->
        <div class="sidebar bg-white w-64 md:w-72 shadow-lg h-full fixed">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-mobile-alt text-2xl text-blue-500 mr-2"></i>
                    <span class="text-xl font-bold text-gray-800">GALAXY PHONE ACADEMY</span>
                </div>
                <button id="close-sidebar" class="lg:hidden text-gray-500">
                    <i id="close-sidebar" class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="p-4">
                <div class="flex items-center mb-6">
                    <i class="fa-solid fa-user text-2xl text-blue-500 mr-2"></i>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-800">{{ auth()->user()->name }}</h4>
                    </div>
                </div>
                
                <nav class="mt-8">
                    <a href="#" class="flex items-center py-3 px-4 active-link rounded-lg mb-2">
                        <i class="fas fa-book-open mr-3 text-blue-500"></i>
                        <span>My Courses</span>
                    </a>
                    <a href="{{route('logout')}}" class="flex items-center py-3 px-4 text-gray-600 hover:bg-red-600 rounded-lg mb-2">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
        </div>