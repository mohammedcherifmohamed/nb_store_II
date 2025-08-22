// document.addEventListener('DOMContentLoaded', function() {
  

//     // DOM Elements
//     const coursesTableBody = document.getElementById('courses-table-body');
//     const addCourseBtn = document.getElementById('add-course-btn');
//     const courseModal = document.getElementById('course-modal');
//     const closeModalBtn = document.getElementById('close-modal');
//     const cancelCourseBtn = document.getElementById('cancel-course');
//     const courseForm = document.getElementById('course-form');
//     const modalTitle = document.getElementById('modal-title');
    
//     // Form fields
//     const courseIdField = document.getElementById('course-id');
//     const courseTitleField = document.getElementById('course-title');
//     const courseDescriptionField = document.getElementById('course-description');
//     const courseDurationField = document.getElementById('course-duration');
//     const coursePriceField = document.getElementById('course-price');
//     const courseStatusField = document.getElementById('course-status');
//     const startDateField = document.getElementById('start-date');
//     const endDateField = document.getElementById('end-date');

   
//     // Format date as MM/DD/YYYY
//     function formatDate(dateString) {
//         const date = new Date(dateString);
//         return date.toLocaleDateString('en-US');
//     }

//     // Open modal for adding new course
//     function openAddCourseModal() {
//         modalTitle.textContent = 'Add New Course';
//         courseForm.reset();
//         courseIdField.value = '';
//         courseModal.classList.remove('hidden');
//         document.body.style.overflow = 'hidden';
//     }



//     // Close modal
//     function closeCourseModal() {
//         courseModal.classList.add('hidden');
//         document.body.style.overflow = 'auto';
//     }

//     // Event listeners
//     addCourseBtn.addEventListener('click', openAddCourseModal);
//     closeModalBtn.addEventListener('click', closeCourseModal);
//     cancelCourseBtn.addEventListener('click', closeCourseModal);
    
//     // Close modal when clicking outside
//     courseModal.addEventListener('click', (e) => {
//         if (e.target === courseModal) {
//             closeCourseModal();
//         }
//     });
    
//     // Close modal with Escape key
//     document.addEventListener('keydown', (e) => {
//         if (e.key === 'Escape' && !courseModal.classList.contains('hidden')) {
//             closeCourseModal();
//         }
//     });

//     // Initialize the table
    
//     // Mobile sidebar toggle (same as before)
//     const mobileMenuButton = document.createElement('button');
//     mobileMenuButton.innerHTML = '<i class="fas fa-bars text-xl"></i>';
//     mobileMenuButton.className = 'md:hidden fixed bottom-6 right-6 bg-blue-500 text-white p-4 rounded-full shadow-lg z-50';
//     document.body.appendChild(mobileMenuButton);
    
//     const sidebar = document.querySelector('.sidebar');
    
//     mobileMenuButton.addEventListener('click', function() {
//         sidebar.classList.toggle('-translate-x-full');
//     });
    
//     // Responsive sidebar behavior
//     function handleSidebar() {
//         if (window.innerWidth < 768) {
//             sidebar.classList.add('-translate-x-full');
//         } else {
//             sidebar.classList.remove('-translate-x-full');
//         }
//     }
    
//     // Initial check
//     handleSidebar();
    
//     // Listen for window resize
//     window.addEventListener('resize', handleSidebar);
// });