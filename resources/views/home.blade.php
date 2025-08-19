@extends('layout.Main')

@section('title', 'Home')
@section('content')

    @include('includes.nav')

    <!-- Hero Section -->
    <section id="home" class="py-20 bg-gradient-to-r from-blue-50 to-cyan-50">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Master the Art of <span class="text-blue-500">Phone Repair</span></h1>
                <p class="text-lg text-gray-600 mb-8">Learn professional phone repair skills from industry experts. Our hands-on courses will prepare you for a rewarding career in the growing mobile repair industry.</p>
                <button class="btn-primary text-white px-8 py-3 rounded-lg font-medium shadow-lg hover:shadow-xl transition duration-300">Start Learning</button>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Phone Repair" class="rounded-lg shadow-xl max-w-full h-auto">
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Our Courses</h2>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mb-12">Comprehensive training programs designed to take you from beginner to professional phone technician.</p>
            
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
                                <li><span class="font-semibold">⏳ Duration:</span>{{$course->duration}}</li>
                                <li><span class="font-semibold">💰 Price:</span> {{$course->price}} DA</li>
                                <li><span class="font-semibold">📅 Start Date:</span> {{$course->start_date}}</li>
                                <li><span class="font-semibold">📅 End Date:</span> {{$course->end_date}}</li>
                            </ul>
                            <!-- Enroll Now Button -->
                            <button 
                               data-id="{{$course->id}}"
                                class="enrollBtn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300" 
                            >
                                Enroll Now
                            </button>
                            <!-- <button class="text-blue-500 font-medium hover:text-blue-700 transition duration-300">Learn More →</button> -->
                        </div>
                    </div>
                    @empty
                    <div class="text-center mt-12">
                        <p>no course found</p>
                    </div>
                @endforelse


         
            </div>
            
            {{-- <div class="text-center mt-12">
                <button class="border-2 border-blue-500 text-blue-500 px-8 py-3 rounded-lg font-medium hover:bg-blue-500 hover:text-white transition duration-300">View All Courses</button>
            </div> --}}
        </div>
        <!-- Enroll Modal -->
<div id="enroll-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center ">
    <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 id="enroll-modal-title" class="text-xl font-bold text-gray-800">Enroll in Course</h3>
            <button  class="cancelButton text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Course Info -->
        <div id="enroll-course-info" class="mb-6">
            <!-- Filled dynamically by JS -->
        </div>

        <!-- Personal Info Form -->
        <form id="enroll-form" method="POST" action="{{ route('enroll.post') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name*</label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Familly Name*</label>
                    <input type="text" name="Familly_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Age*</label>
                    <input type="number" name="age" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Wilaya*</label>
                    <input type="text" name="wilaya" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number*</label>
                    <input type="number" name="phone" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                    <input type="text" name="notes" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <input type="hidden" name="course_id" id="enroll-course-id">

            <div class="flex justify-end space-x-3">
                <button type="button" class="cancelButton border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition duration-300">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Submit</button>
            </div>
        </form>
    </div>
</div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Why Choose Our Academy</h2>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mb-12">We're committed to providing the best phone repair education with practical, real-world training.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md text-center">
                    <div class="text-blue-500 text-4xl mb-4">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Affordable Pricing</h3>
                    <p class="text-gray-600">Quality education at competitive prices with flexible payment options.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md text-center">
                    <div class="text-blue-500 text-4xl mb-4">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Hands-on Training</h3>
                    <p class="text-gray-600">Learn by doing with real devices and tools in our modern lab.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md text-center">
                    <div class="text-blue-500 text-4xl mb-4">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from industry professionals with years of repair experience.</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-white p-6 rounded-xl shadow-md text-center">
                    <div class="text-blue-500 text-4xl mb-4">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Certification</h3>
                    <p class="text-gray-600">Earn a recognized certificate upon course completion.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Contact Us</h2>
            <p class="text-lg text-gray-600 text-center max-w-2xl mx-auto mb-12">Have questions? Get in touch with our team for more information about our courses.</p>
            
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/2">
                    <form  action="{{ route('contact.post') }}" method="GET" id="contact-form" class="bg-white p-8 rounded-xl shadow-md">
                        <h1 class="text-xl font-bold text-blue-500 mb-6" >You Have Any  Question Ask Here </h1>
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input name="full_name" type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p id="name-error" class="text-red-500 text-sm mt-1 hidden">Please enter your name</p>
                        </div>
                        
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input name="email" type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p id="email-error" class="text-red-500 text-sm mt-1 hidden">Please enter a valid email</p>
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea name="message" id="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            <p id="message-error" class="text-red-500 text-sm mt-1 hidden">Please enter your message</p>
                        </div>
                        
                        <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-medium w-full hover:bg-blue-600 transition duration-300">Send Message</button>
                    </form>
                </div>
                
                <div class="lg:w-1/2">
                    <div class="bg-white p-8 rounded-xl shadow-md h-full">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Our Location</h3>
                        
                        <div class="mb-6">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-map-marker-alt text-blue-500 mt-1 mr-3"></i>
                                <p class="text-gray-700">Adresse 47 rue megnouche Birkhadem Alger<br></p>
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
                                <p class="text-gray-700">info@phonerepairacademy.com</p>
                            </div>
                            
                            <div class="flex items-start">
                                <i class="fas fa-clock text-blue-500 mt-1 mr-3"></i>
                                <p class="text-gray-700">Monday - Friday: 9am - 6pm<br>Saturday: 10am - 4pm<br>Sunday: Closed</p>
                            </div>
                        </div>
                        
                        <div class="rounded-xl overflow-hidden h-64">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3198.2170102128234!2d3.0267933758345427!3d36.71734907227088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzbCsDQzJzAyLjUiTiAzwrAwMSc0NS43IkU!5e0!3m2!1sen!2sdz!4v1755614222726!5m2!1sen!2sdz" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     @include("includes.footer")
    





@endsection