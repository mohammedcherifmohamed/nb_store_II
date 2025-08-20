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
                                <h3 class="text-2xl font-bold text-gray-800">5</h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-user-shield text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card bg-white rounded-xl shadow-md p-6 transition duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500">Super Admins</p>
                                <h3 class="text-2xl font-bold text-gray-800">2</h3>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-crown text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card bg-white rounded-xl shadow-md p-6 transition duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500">Active Sessions</p>
                                <h3 class="text-2xl font-bold text-gray-800">3</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Active</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="admins-table-body">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                                    <span class="font-bold">JD</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">John Doe</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-600">john.doe@example.com</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                            Super Admin
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-600">2 hours ago</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3 edit-admin-btn">Edit</button>
                                        <button class="text-red-500 hover:text-red-700">Delete</button>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                                                    <span class="font-bold">AS</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">Alice Smith</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-600">alice.smith@example.com</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            Admin
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-600">5 hours ago</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3 edit-admin-btn">Edit</button>
                                        <button class="text-red-500 hover:text-red-700">Delete</button>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-yellow-500 text-white flex items-center justify-center">
                                                    <span class="font-bold">BJ</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">Bob Johnson</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-600">bob.johnson@example.com</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            Admin
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                            Away
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-600">1 day ago</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3 edit-admin-btn">Edit</button>
                                        <button class="text-red-500 hover:text-red-700">Delete</button>
                                    </td>
                                </tr>
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

                <form id="admin-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Name -->
                        <div>
                            <label for="admin-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                            <input type="text" id="admin-name" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="admin-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                            <input type="email" id="admin-email" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="admin-password" class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                            <input type="password" id="admin-password" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="admin-password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password*</label>
                            <input type="password" id="admin-password-confirm" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="admin-role" class="block text-sm font-medium text-gray-700 mb-1">Role*</label>
                            <select id="admin-role" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="permission-courses" class="rounded text-blue-500 focus:ring-blue-500">
                                <label for="permission-courses" class="ml-2 text-sm text-gray-700">Manage Courses</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="permission-users" class="rounded text-blue-500 focus:ring-blue-500">
                                <label for="permission-users" class="ml-2 text-sm text-gray-700">Manage Users</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="permission-content" class="rounded text-blue-500 focus:ring-blue-500">
                                <label for="permission-content" class="ml-2 text-sm text-gray-700">Manage Content</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="permission-settings" class="rounded text-blue-500 focus:ring-blue-500">
                                <label for="permission-settings" class="ml-2 text-sm text-gray-700">System Settings</label>
                            </div>
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

                <form id="edit-admin-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Name -->
                        <div>
                            <label for="edit-admin-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                            <input type="text" id="edit-admin-name" value="John Doe" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="edit-admin-email" class="block text-sm font-medium text-gray-700 mb-1">Email Address*</label>
                            <input type="email" id="edit-admin-email" value="john.doe@example.com" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="edit-admin-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" id="edit-admin-password" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Leave blank to keep current password</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="edit-admin-password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" id="edit-admin-password-confirm" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="edit-admin-role" class="block text-sm font-medium text-gray-700 mb-1">Role*</label>
                            <select id="edit-admin-role" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="admin">Admin</option>
                                <option value="super_admin" selected>Super Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="edit-permission-courses" class="rounded text-blue-500 focus:ring-blue-500" checked>
                                <label for="edit-permission-courses" class="ml-2 text-sm text-gray-700">Manage Courses</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="edit-permission-users" class="rounded text-blue-500 focus:ring-blue-500" checked>
                                <label for="edit-permission-users" class="ml-2 text-sm text-gray-700">Manage Users</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="edit-permission-content" class="rounded text-blue-500 focus:ring-blue-500" checked>
                                <label for="edit-permission-content" class="ml-2 text-sm text-gray-700">Manage Content</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="edit-permission-settings" class="rounded text-blue-500 focus:ring-blue-500" checked>
                                <label for="edit-permission-settings" class="ml-2 text-sm text-gray-700">System Settings</label>
                            </div>
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