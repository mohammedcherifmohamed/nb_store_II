document.addEventListener('DOMContentLoaded', function() {   
    const courseSearch = document.getElementById('search-input');  
    const coursesContainer = document.getElementById('courses-table-body');  

    function filterCourses() {  
        fetch(`/admin/courses/filter?search=${encodeURIComponent(courseSearch.value)}`, {  
            method: 'GET',  
            headers: {  
                'X-Requested-With': 'XMLHttpRequest'  
            }  
        })  
        .then(response => response.json())  
        .then(data => {   
            coursesContainer.innerHTML = '';  

            if (!data.success || data.courses.length === 0) {  
                coursesContainer.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No course found</td>
                    </tr>`;
                return;
            }

            data.courses.forEach(course => {   
                coursesContainer.innerHTML += `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">${course.title}</td>
                        <td class="px-6 py-4 max-w-xs">${course.description ?? ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${course.duration ?? ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${course.price} DA</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full ${course.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${course.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="fetchCourse(${course.id})" type="button" class="text-blue-500 hover:text-blue-700 mr-3 edit-course-btn">Edit</button>
                            <form action="/admin/course/${course.id}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>`;
            });
        })  
        .catch(error => console.error('Error fetching filtered courses:', error));  
    }  

    // Event listener
    courseSearch.addEventListener('input', filterCourses);  
});
