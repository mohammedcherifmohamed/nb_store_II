
document.addEventListener('DOMContentLoaded', function() {
    console.log('test')
});


window.fetchCourse = function (courseId) {
    fetch(`courses/${courseId}/json`)
        .then(response => response.json())
        .then(data => {
            const course = data.course;

            // Fill form fields
            document.getElementById('edit-course-title').value = course.title;
            document.getElementById('edit-course-price').value = course.price;
            document.getElementById('edit-course-duration').value = course.duration;
            document.getElementById('edit-course-status').value = course.status;
            document.getElementById('edit-start-date').value = course.start_date;
            document.getElementById('edit-end-date').value = course.end_date;
            document.getElementById('edit-course-description').value = course.description;

            // Preview image if available
            const preview = document.getElementById('image-preview');
            if (course.image) {
                preview.src = `/storage/courses/${course.image}`;
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }

            // Update form action dynamically
            document.getElementById('edit-course-form').action = `/admin/course/${course.id}`;

            // Update modal title
            document.getElementById('modal-title').innerText = "Edit Course";

            // Show modal
            document.getElementById('edit-course-modal').classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching course:', error));
}

// Close modal
document.getElementById('close-edit-modal').addEventListener('click', () => {
    document.getElementById('edit-course-modal').classList.add('hidden');
});
document.getElementById('cancel-edit-course').addEventListener('click', () => {
    document.getElementById('edit-course-modal').classList.add('hidden');
});

