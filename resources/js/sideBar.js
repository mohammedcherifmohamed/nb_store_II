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
            
        });