document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const statusFilter = document.getElementById("status-filter");
    const tableBody = document.getElementById("courses-table-body");

    function filterCourses() {
        const search = searchInput.value;
        const status = statusFilter.value;

        fetch('/admin/courses/filter', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ search, status })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                tableBody.innerHTML = "";

                if (data.courses.length > 0) {
                    data.courses.forEach(course => {
                        const row = `
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">${course.title}</div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="text-gray-600 truncate">${course.description ?? ''}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">${course.duration ?? ''}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">${course.price} DA</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        ${course.status === 'active' 
                                            ? 'bg-green-100 text-green-800' 
                                            : 'bg-yellow-100 text-yellow-800'}">
                                        ${course.status}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button onclick="fetchCourse(${course.id})" 
                                        class="text-blue-500 hover:text-blue-700 mr-3 edit-course-btn">
                                        Edit
                                    </button>
                                    <form action="/admin/courses/${course.id}" 
                                        method="POST" 
                                        class="inline-block" 
                                        onsubmit="return confirm('Are you sure you want to delete this course?');">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute("content")}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                        tableBody.insertAdjacentHTML("beforeend", row);
                    });
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                No course found
                            </td>
                        </tr>
                    `;
                }
            }
        })
        .catch(err => console.error("Error:", err));
    }

    searchInput.addEventListener("input", filterCourses);
    statusFilter.addEventListener("change", filterCourses);
});
