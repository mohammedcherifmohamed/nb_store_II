@extends('layout.Main')

@section('title', 'Home')
@section('content')

    @include('includes.nav')

    <!-- Hero Section -->
    <section id="home" class="py-20 bg-gradient-to-r from-blue-50 to-cyan-50">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6"> {{ __('messages.hero_title') }} <span class="text-blue-500"> {{ __('messages.hero_highlight') }}</span></h1>
                <p class="text-lg text-gray-600 mb-8">{{ __('messages.hero_subtitle') }}</p>
                <button class="btn-primary text-white px-8 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition duration-300">{{ __('messages.hero_button') }}</button>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Phone Repair" class="rounded-lg shadow-xl max-w-full h-auto">
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4"> {{ __('messages.our_courses') }}</h2>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mb-12">{{ __('messages.courses_description') }}</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <!-- Course 1 -->
                @forelse($courses as $course)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img src="{{asset('courses/'.$course->image)}}" alt="Basic Phone Repair" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{$course->title}}</h3>
                          <p class="text-gray-600 mb-4">
                                {!! nl2br(e(Str::limit($course->description, 150))) !!}
                            </p>


                            <!-- Extra details -->
                            <ul class="text-gray-700 text-sm space-y-2 mb-4">
                                <li><span class="font-semibold">{{ __('messages.duration') }}: </span>{{$course->duration}}</li>
                                <li><span class="font-semibold">{{ __('messages.price') }}: </span> {{$course->price}} DA</li>
                                <li><span class="font-semibold">{{ __('messages.start_date') }}: </span> {{$course->start_date}}</li>
                                <li><span class="font-semibold">{{ __('messages.end_date') }}: </span> {{$course->end_date}}</li>
                            </ul>
                            <!-- Enroll Now Button -->
                            <button 
                               data-id="{{$course->id}}"
                                class="enrollBtn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300" 
                            >
                                {{ __('messages.enroll_now') }}
                            </button>
                            <!-- <button class="text-blue-500 font-medium hover:text-blue-700 transition duration-300">Learn More →</button> -->
                        </div>
                    </div>
                    @empty
                    <div class="text-center mt-12">
                        <p>{{ __('messages.no_courses') }}</p>
                    </div>
                @endforelse


         
            </div>
            
        </div>
        <!-- Enroll Modal -->
    <div id="enroll-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="enroll-modal-title" class="text-xl font-bold text-gray-800">
                    {{ __('messages.enroll_in_course') }}
                </h3>
                <button class="cancelButton text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Course Info -->
            <div id="enroll-course-info" class="mb-6"></div>

            <!-- Personal Info Form -->
            <form id="enroll-form" method="POST" action="{{ route('enroll.post') }}">
                @csrf
                <input type="hidden" name="title" id="enroll-course-title">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('messages.name') }}*
                        </label>
                        <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('messages.family_name') }}*
                        </label>
                        <input type="text" name="family_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('messages.age') }}*
                        </label>
                        <input type="number" name="age" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('messages.wilaya') }}*
                        </label>
                        <input type="text" name="wilaya" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('messages.phone') }}*
                        </label>
                        <input type="number" name="phone" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('messages.notes') }}
                        </label>
                        <input type="text" name="notes" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <input type="hidden" name="course_id" id="enroll-course-id">

                <div class="flex justify-end space-x-3 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <button type="button" class="cancelButton border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition duration-300">
                        {{ __('messages.cancel') }}
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        {{ __('messages.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    </section>

    <!-- Why Choose Us Section -->
<section id="about" class="py-16 bg-gray-50"> 
    <div class="container mx-auto px-4"> 
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">
            {{ __('messages.about_title') }}
        </h2> 

        <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mb-12">
            {{ __('messages.about_subtitle') }}
        </p> 
            
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Column - Experience Information -->
            <div class="lg:w-1/2 bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-md">
                <div class="flex items-start mb-6">
                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                        <i class="fas fa-history text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">
                            {{ __('messages.about_experience_title') }}
                        </h3>
                        <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
                            <p class="text-gray-700 text-lg italic border-l-4 border-blue-500 pl-4">
                                {{ __('messages.about_experience_text') }}
                            </p>
                        </div>
                    </div>
                </div>
                    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-5 rounded-xl shadow-sm">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <i class="fas fa-microchip text-blue-600"></i>
                            </div>
                            <h4 class="font-bold text-gray-800">
                                {{ __('messages.about_hardware_title') }}
                            </h4>
                        </div>
                        <p class="text-gray-600 text-sm">
                            {{ __('messages.about_hardware_text') }}
                        </p>
                    </div>
                        
                    <div class="bg-white p-5 rounded-xl shadow-sm">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <i class="fas fa-code text-blue-600"></i>
                            </div>
                            <h4 class="font-bold text-gray-800">
                                {{ __('messages.about_software_title') }}
                            </h4>
                        </div>
                        <p class="text-gray-600 text-sm">
                            {{ __('messages.about_software_text') }}
                        </p>
                    </div>
                </div>
            </div>
                
            <!-- Right Column - Features -->
            <div class="lg:w-1/2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8"> 
                    <div class="bg-white p-6 rounded-xl shadow-md text-center transition-transform duration-300 hover:translate-y-2"> 
                        <div class="text-blue-500 text-4xl mb-4"> 
                            <i class="fas fa-dollar-sign"></i> 
                        </div> 
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ __('messages.about_feature1_title') }}
                        </h3> 
                        <p class="text-gray-600">
                            {{ __('messages.about_feature1_text') }}
                        </p> 
                    </div> 
                         
                    <div class="bg-white p-6 rounded-xl shadow-md text-center transition-transform duration-300 hover:translate-y-2"> 
                        <div class="text-blue-500 text-4xl mb-4"> 
                            <i class="fas fa-laptop-code"></i> 
                        </div> 
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ __('messages.about_feature2_title') }}
                        </h3> 
                        <p class="text-gray-600">
                            {{ __('messages.about_feature2_text') }}
                        </p> 
                    </div> 
                         
                    <div class="bg-white p-6 rounded-xl shadow-md text-center transition-transform duration-300 hover:translate-y-2"> 
                        <div class="text-blue-500 text-4xl mb-4"> 
                            <i class="fas fa-chalkboard-teacher"></i> 
                        </div> 
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ __('messages.about_feature3_title') }}
                        </h3> 
                        <p class="text-gray-600">
                            {{ __('messages.about_feature3_text') }}
                        </p> 
                    </div> 
                         
                    <div class="bg-white p-6 rounded-xl shadow-md text-center transition-transform duration-300 hover:translate-y-2"> 
                        <div class="text-blue-500 text-4xl mb-4"> 
                            <i class="fas fa-certificate"></i> 
                        </div> 
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ __('messages.about_feature4_title') }}
                        </h3> 
                        <p class="text-gray-600">
                            {{ __('messages.about_feature4_text') }}
                        </p> 
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</section>




<!-- قسم الاتصال -->
<section id="contact" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">
            {{ __('messages.contact_title') }}
        </h2>
        <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mb-12">
            {{ __('messages.contact_subtitle') }}
        </p>
        
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- نموذج الاتصال -->
            <div class="lg:w-1/2">
                <form action="{{ route('contact.post') }}" method="GET" id="contact-form" class="bg-white p-8 rounded-xl shadow-md">
                    <h1 class="text-xl font-bold text-blue-500 mb-6">
                        {{ __('messages.contact_form_title') }}
                    </h1>
                    
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-medium mb-2">
                            {{ __('messages.contact_name') }}
                        </label>
                        <input name="full_name" type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="name-error" class="text-red-500 text-sm mt-1 hidden">
                            {{ __('messages.contact_name_error') }}
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">
                            {{ __('messages.contact_email') }}
                        </label>
                        <input name="email" type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="email-error" class="text-red-500 text-sm mt-1 hidden">
                            {{ __('messages.contact_email_error') }}
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-medium mb-2">
                            {{ __('messages.contact_message') }}
                        </label>
                        <textarea name="message" id="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <p id="message-error" class="text-red-500 text-sm mt-1 hidden">
                            {{ __('messages.contact_message_error') }}
                        </p>
                    </div>
                    
                    <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-medium w-full hover:bg-blue-600 transition duration-300">
                        {{ __('messages.contact_button') }}
                    </button>
                </form>
            </div>
            
            <!-- معلومات الاتصال -->
            <div class="lg:w-1/2">
                <div class="bg-white p-8 rounded-xl shadow-md h-full">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        {{ __('messages.contact_location_title') }}
                    </h3>
                    
                    <div class="mb-6">
                        <div class="flex items-start mb-4">
                            <i class="fas fa-map-marker-alt text-blue-500 mt-1 mr-3"></i>
                            <p class="text-gray-700">{{ __('messages.contact_address') }}</p>
                        </div>
                        
                        <div class="flex items-start mb-4">
                            <i class="fas fa-phone-alt text-blue-500 mt-1 mr-3"></i>
                            <p class="text-gray-700">+213 0561395040</p>
                        </div>
                        <div class="flex items-start mb-4">
                            <i class="fas fa-phone-alt text-blue-500 mt-1 mr-3"></i>
                            <p class="text-gray-700">+213 0770446196</p>
                        </div>
                        
                        <div class="flex items-start mb-4">
                            <i class="fas fa-envelope text-blue-500 mt-1 mr-3"></i>
                            <p class="text-gray-700">Boudjegsm@yahoo.fr</p>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-clock text-blue-500 mt-1 mr-3"></i>
                            <p class="text-gray-700">{{ __('messages.contact_hours') }}</p>
                        </div>
                    </div>
                    
                    <div class="rounded-xl overflow-hidden h-64">
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3198.2170102128234!2d3.0267933758345427!3d36.71734907227088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzbCsDQzJzAyLjUiTiAzwrAwMSc0NS43IkU!5e0!3m2!1sen!2sdz!4v1755872137061!5m2!1sen!2sdz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>


     @include("includes.footer")
    


@section('scripts') 
    @vite('resources/js/home.js') 
@endsection


@endsection