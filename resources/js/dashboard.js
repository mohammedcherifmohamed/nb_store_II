
        // Mobile sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('admin-mobile-menu-button');
            const closeSidebarButton = document.getElementById('close-sidebar');
            const sidebar = document.querySelector('.sidebar');
            
            // Toggle sidebar on mobile
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
            
            // Close sidebar on mobile
            closeSidebarButton.addEventListener('click', function() {
                sidebar.classList.remove('open');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMenuButton = mobileMenuButton.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnMenuButton && window.innerWidth < 1024) {
                    sidebar.classList.remove('open');
                }
            });
            
            // Sample course data and table population
   
            
            const tableBody = document.getElementById('courses-table-body');
            
            
            // Modal functionality
            const addCourseBtn = document.getElementById('add-course-btn');
            const courseModal = document.getElementById('course-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelbtn = document.getElementById('cancel-course');
            
            addCourseBtn.addEventListener('click', () => {
                courseModal.classList.remove('hidden');
            });
            
            closeModalBtn.addEventListener('click', () => {
                courseModal.classList.add('hidden');
            });
            cancelbtn.addEventListener('click', () => {
                courseModal.classList.add('hidden');
            });
        });

            document.getElementById("course-image").addEventListener("change", function (event) {
        const preview = document.getElementById("image-preview");
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove("hidden");
        } else {
            preview.src = "";
            preview.classList.add("hidden");
        }
    });