@extends('Layout.Main')
    
@section('title', 'Admin Dashboard')

@section('content')

    <!-- Dashboard Layout -->
    <div class="flex h-screen overflow-hidden">
                @include('Admin.includes.sidebar')

        
        <!-- Main Content -->
        <div class="main-content flex-1 overflow-auto lg:ml-64 xl:ml-72">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
                @include('Admin.includes.nav')
                <h1 class="text-2xl px-10 font-bold text-gray-800">Dashboard</h1>
                <a href="{{route('home')}}" class="text-2xl nav-link text-gray-700 font-bold mx-20">Home</a>

            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="dashboard-card bg-white rounded-xl shadow-md p-6 transition duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500">Total Admins</p>
                                <h3 class="text-2xl font-bold text-gray-800">{{$admins->count()}}</h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-user-shield text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
         
                </div>
 @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <x-alert type="error" >{{ $error }}</x-alert>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <x-alert type="success" >{{ session('success') }}</x-alert>
                @endif
                @if(session('eror'))
                    <x-alert type="error">{{ session('error') }}</x-alert>
                @endif
                <!-- Admin Management Section -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Manage Admins</h2>
                        <button id="add-admin-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Add Admin
                        </button>
                    </div>

                   <!-- Search and Filter -->
                  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gray-50 p-4 rounded-lg">
                      <div class="relative mb-4 md:mb-0 w-full md:w-64">
                          <input type="text" id="admin-search-input" placeholder="Search admins..." 
                              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                      </div>
              
                  </div>

                    <!-- Admins Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="admins-table-body">
                                @forelse($admins as $admin)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                                        <span class="font-bold">JD</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{$admin->name}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-600">{{$admin->email}}</div>
                                        </td>
                                        
                                    
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                           
                                            <button onclick="editAdmin({{$admin->id}})" class="text-blue-500 hover:text-blue-700 mr-3 edit-admin-btn">Edit</button>
                                            
                                            @if($admin->id != auth()->id())
                                                <form  action="{{route('admin.delete', $admin->id)}}" method="POST"  onclick="return confirm('Are you sure you want to delete this admin?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-500 hover:text-red-700">Delete</button>
                                                </form>
                                            @endif


                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-gray-500">
                                                No admin found
                                        </td>
                                    
                                    </tr>
                                    @endforelse
                                
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div id="admin-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modal-title" class="text-xl font-bold text-gray-800">Add New Admin</h3>
                    <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form action="{{route('admin.post')}}" method="POST" id="admin-form">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Name -->
                        <div>
                            <label for="admin-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                            <input value="{{old('name')}}" name="name" type="text" id="admin-name" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="admin-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                            <input value="{{old('email')}}" name="email" type="email" id="admin-email" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="admin-password" class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                            <input name="password" type="password" id="admin-password" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="admin-password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password*</label>
                            <input name="password_confirmation" type="password" id="admin-password-confirm" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                    
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancel-admin"
                            class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-300">
                            Cancel
                        </button>
                        <button type="submit" id="save-admin"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition duration-300">
                            Save Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div id="edit-admin-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Edit Admin</h3>
                    <button id="close-edit-modal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form  method="POST" id="edit-admin-form">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Name -->
                        <div>
                            <label for="edit-admin-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                            <input name="name" type="text" id="edit-admin-name"  required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="edit-admin-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                            <input name="email" type="email" id="edit-admin-email" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="edit-admin-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input name="password" type="password" id="edit-admin-password" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Leave blank to keep current password</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="edit-admin-password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input name="password_confirmation" type="password" id="edit-admin-password-confirm" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                      
                    </div>

                  

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancel-edit-admin"
                            class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition duration-300">
                            Update Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts') 
    @vite('resources/js/admins.js') 
@endsection
<script>
    const searchAdminsUrl = "{{ route('admins.search') }}";
    const CURRENT_USER_ID = {{ auth()->id() }};
    const CSRF_TOKEN = "{{ csrf_token() }}";
    const deleteAdminUrl = "{{ route('admin.delete', ':id') }}";

</script>