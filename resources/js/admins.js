        // Toggle sidebar on mobile
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
            document.querySelector('.main-content').classList.toggle('lg:ml-64');
        });

        // Close sidebar on mobile
        document.getElementById('close-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('hidden');
            document.querySelector('.main-content').classList.remove('lg:ml-64');
        });

        // Admin modal functionality
        document.getElementById('add-admin-btn').addEventListener('click', function() {
            document.getElementById('admin-modal').classList.remove('hidden');
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('admin-modal').classList.add('hidden');
        });

        document.getElementById('cancel-admin').addEventListener('click', function() {
            document.getElementById('admin-modal').classList.add('hidden');
        });

        // Edit admin modal functionality
        const editButtons = document.querySelectorAll('.edit-admin-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit-admin-modal').classList.remove('hidden');
            });
        });

        document.getElementById('close-edit-modal').addEventListener('click', function() {
            document.getElementById('edit-admin-modal').classList.add('hidden');
        });

        document.getElementById('cancel-edit-admin').addEventListener('click', function() {
            document.getElementById('edit-admin-modal').classList.add('hidden');
        });

        // Form submission handlers
        document.getElementById('admin-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Admin added successfully!');
            document.getElementById('admin-modal').classList.add('hidden');
        });

        document.getElementById('edit-admin-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Admin updated successfully!');
            document.getElementById('edit-admin-modal').classList.add('hidden');
        });