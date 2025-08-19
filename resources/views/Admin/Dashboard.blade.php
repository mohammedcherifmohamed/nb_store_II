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
                                <p class="text-gray-500">Total Courses</p>
                                <h3 class="text-2xl font-bold text-gray-800">{{$courses->count()}}</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-check-circle text-green-500 text-xl"></i>
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

                <!-- Courses Management Section -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Manage Courses</h2>
                        <button id="add-course-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Add Course
                        </button>
                    </div>

                   <!-- Search and Filter -->
                  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-gray-50 p-4 rounded-lg">
                      <div class="relative mb-4 md:mb-0 w-full md:w-64">
                          <input type="text" id="search-input" placeholder="Search courses..." 
                              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                      </div>
                      <div class="flex space-x-2">
                          <select id="status-filter" name="status"
                                  class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                              <option value="">All Status</option>
                              <option value="active">Active</option>
                              <option value="inactive">Draft</option>
                          </select>
                      </div>
                  </div>

                    <!-- Courses Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="courses-table-body">
                                @forelse ($courses as $course)
                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{$course->title}}</div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <div class="text-gray-600 truncate">{{$course->description}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-600">{{$course->duration}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-600">{{$course->price}} DA</div>
                                        </td>
                                       <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $course->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $course->status }}
                                            </span>
                                        </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                
                                                 <button onclick="fetchCourse({{ $course->id }})" type="submit" class="text-blue-500 hover:text-blue-700 mr-3 edit-course-btn">edit</button>

                                        
                                                  <form action="{{ route('course.delete', $course->id) }}" 
                                                   method="POST" class="inline-block"
                                                   onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                                    </form>
                                            </td>
                                    </tr>
                                     @empty
                                     <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">
                                                No course found
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

<!-- Add Course Modal -->
<div id="course-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-xl font-bold text-gray-800">Add New Course</h3>
                <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>


            <form id="course-form" action="{{ route('course.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="course-id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Title -->
                    <div>
                        <label for="course-title" class="block text-sm font-medium text-gray-700 mb-1">Course Title*</label>
                        <input value="{{ old('title') }}" name="title" type="text" id="course-title" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="course-price" class="block text-sm font-medium text-gray-700 mb-1">Price*</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input value="{{ old('price') }}" name="price" type="number" id="course-price" required
                                class="w-full border border-gray-300 rounded-lg px-8 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="course-duration" class="block text-sm font-medium text-gray-700 mb-1">Duration*</label>
                        <input value="{{ old('duration') }}" name="duration" id="course-duration" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="course-status" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                        <select name="status" id="course-status" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start-date" class="block text-sm font-medium text-gray-700 mb-1">Start Date*</label>
                        <input value="{{ old('start_date') }}" name="start_date" type="date" id="start-date" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end-date" class="block text-sm font-medium text-gray-700 mb-1">End Date*</label>
                        <input value="{{ old('end_date') }}" name="end_date" type="date" id="end-date" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="course-image" class="block text-sm font-medium text-gray-700 mb-1">Course Image*</label>
                    <input name="image" type="file" id="course-image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Preview -->
                    <div class="mt-4">
                        <img id="image-preview" class="w-40 h-40 object-cover rounded-lg border border-gray-300 hidden" alt="Preview">
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="course-description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                    <textarea name="description" id="course-description" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-course"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit" id="save-course"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition duration-300">
                        Save Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div id="edit-course-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-xl font-bold text-gray-800">Add New Course</h3>
                <button id="close-edit-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>


            <form id="edit-course-form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Title -->
                    <div>
                        <label for="course-title" class="block text-sm font-medium text-gray-700 mb-1">Course Title*</label>
                        <input value="{{ old('title') }}" name="title" type="text" id="edit-course-title" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="course-price" class="block text-sm font-medium text-gray-700 mb-1">Price*</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input value="{{ old('price') }}" name="price" type="number" id="edit-course-price" required
                                class="w-full border border-gray-300 rounded-lg px-8 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="course-duration" class="block text-sm font-medium text-gray-700 mb-1">Duration*</label>
                        <input value="{{ old('duration') }}" name="duration" id="edit-course-duration" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="course-status" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                        <select name="status" id="edit-course-status" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start-date" class="block text-sm font-medium text-gray-700 mb-1">Start Date*</label>
                        <input value="{{ old('start_date') }}" name="start_date" type="date" id="edit-start-date" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end-date" class="block text-sm font-medium text-gray-700 mb-1">End Date*</label>
                        <input value="{{ old('end_date') }}" name="end_date" type="date" id="edit-end-date" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="course-image" class="block text-sm font-medium text-gray-700 mb-1">Course Image*</label>
                    <input name="image" type="file" id="edit-course-image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Preview -->
                    <div class="mt-4">
                        <img id="edit-image-preview" class="w-40 h-40 object-cover rounded-lg border border-gray-300 hidden" alt="Preview">
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="course-description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                    <textarea name="description" id="edit-course-description" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-edit-course"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit" id="save-course"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-600 transition duration-300">
                        update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Auto open modal if validation fails -->
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('course-modal').classList.remove('hidden');
    });
</script>
@endif





@endsection