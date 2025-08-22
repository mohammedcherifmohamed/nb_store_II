document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle

    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    if(mobileMenuButton && mobileMenu){

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close mobile menu if open
            mobileMenu.classList.add('hidden');
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

     // Add event listener for each button with class 'enrollBtn'
    document.querySelectorAll('.enrollBtn').forEach(button => {
        button.addEventListener('click', function() {
            const courseId = this.dataset.id; // assuming you have data-id attribute on buttons
            console.log(courseId);

            fetch(`/home/courses/${courseId}/json`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                 .then(data => {
                    if (!data.success) throw new Error('Course not found');
                    const course = data.course; // access course inside the JSON

                    // Show modal
                    const modal = document.getElementById('enroll-modal');
                    const enroll_form = document.getElementById('enroll-form');
                    modal.classList.remove('hidden');
                    document.getElementById('enroll-course-title').value = course.title;
                    // Fill course info
                    const infoContainer = document.getElementById('enroll-course-info');
                    infoContainer.innerHTML = `
                        <h4 class="text-lg font-semibold mb-2">${course.title}</h4>
                        <p class="text-gray-600 mb-2">${course.description}</p>
                       <ul class="text-gray-700 text-sm space-y-2 mt-3">
                            <li class="flex items-center gap-2">
                                ⏳ <span class="font-semibold">Duration:</span>
                                <span class="text-black">${course.duration}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                💰 <span class="font-semibold">Price:</span>
                                <span class="text-green-600 font-medium">${course.price} DA</span>
                            </li>
                            <li class="flex items-center gap-2">
                                📅 <span class="font-semibold">Start Date:</span>
                                <span class="text-blue-600">${course.start_date}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                📅 <span class="font-semibold">End Date:</span>
                                <span class="text-red-600">${course.end_date}</span>
                            </li>
                        </ul>
                    `;

                    // Set hidden input
                    document.getElementById('enroll-course-id').value = course.id;
                })
                .catch(error => {
                    alert('Failed to load course data.');
                });
        });
    });

     document.querySelectorAll('.cancelButton').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('enroll-modal').classList.add('hidden');
        });
    });
    


});
    
    // Add shadow to header on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (window.scrollY > 10) {
            header.classList.add('shadow-lg');
        } else {
            header.classList.remove('shadow-lg');
        }
    });

   

function closeEnrollModal() {
    document.getElementById('enroll-modal').classList.add('hidden');
}
