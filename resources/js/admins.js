document.addEventListener('DOMContentLoaded', function() {

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

        

    });

   window.editAdmin = function(id){
    console.log('edit admin ' + id);

    fetch(`/admin/admins/edit/${id}`)
        .then(response => response.json())
        .then(data => {
            if(data.success){
                document.getElementById('edit-admin-name').value = data.admin.name;
                document.getElementById('edit-admin-email').value = data.admin.email;
                document.getElementById('edit-admin-password').value = "";
                document.getElementById('edit-admin-password-confirm').value = "";

                // ✅ Update form action dynamically
                document.getElementById('edit-admin-form').action = `admins/update/${id}`;

                document.getElementById('edit-admin-modal').classList.remove('hidden');
            } else {
                console.error("Error fetching admin data:", data.message);
            }
        })
        .catch(error => {
            console.error("Error fetching admin data:", error);
        });
};

// document.getElementById('admin-search-input').addEventListener('keyup', function() {
//     let query = this.value;

//     fetch(`${searchAdminsUrl}?query=${query}`)
//         .then(response => response.json())
//         .then(data => {
//             let tbody = document.getElementById('admins-table-body');
//             tbody.innerHTML = '';

//             if (data.admins.length > 0) {
//                 data.admins.forEach(admin => {
//                    tbody.innerHTML += `
//     <tr class="hover:bg-gray-50">
//         <td class="px-6 py-4 whitespace-nowrap">
//             <div class="flex items-center">
//                 <div class="flex-shrink-0 h-10 w-10">
//                     <div class="h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
//                         <span class="font-bold">${admin.name.charAt(0).toUpperCase()}${admin.name.split(' ')[1] ? admin.name.split(' ')[1].charAt(0).toUpperCase() : ''}</span>
//                     </div>
//                 </div>
//                 <div class="ml-4">
//                     <div class="font-medium text-gray-900">${admin.name}</div>
//                 </div>
//             </div>
//         </td>
//         <td class="px-6 py-4 whitespace-nowrap">
//             <div class="text-gray-600">${admin.email}</div>
//         </td>
//         <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
//             <button onclick="editAdmin(${admin.id})" class="text-blue-500 hover:text-blue-700 mr-3 edit-admin-btn">Edit</button>

//             ${admin.id != currentUserId ? `
//                 <form action="/admin/${admin.id}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?')" style="display:inline;">
//                     <input type="hidden" name="_token" value="${csrfToken}">
//                     <input type="hidden" name="_method" value="DELETE">
//                     <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
//                 </form>
//             ` : ''}
//         </td>
//     </tr>
// `;

//                 });
//             } else {
//                 tbody.innerHTML = `
//                     <tr>
//                         <td colspan="2" class="text-center py-2">No admins found</td>
//                     </tr>
//                 `;
//             }
//         });
// });

const searchInput = document.getElementById('admin-search-input');
if(searchInput){
    searchInput.addEventListener('input', function () {
        const query = searchInput.value.trim();
        fetch(`/admin/admins/search?query=${encodeURIComponent(query)}`,{
            method:"GET",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const searchResultsList =  document.getElementById('admins-table-body');
                searchResultsList.innerHTML = ''; 
                
                data.admins.forEach(admin => {
                        const searchResultsList = document.getElementById('admins-table-body');

                        // Generate initials for avatar
                        const initials = admin.name.split(' ').map(n => n[0]).join('').toUpperCase();

                        let row = `
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                                <span class="font-bold">${initials}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">${admin.name}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-600">${admin.email}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button onclick="editAdmin(${admin.id})" class="text-blue-500 hover:text-blue-700 mr-3 edit-admin-btn">
                                        Edit
                                    </button>
                        `;

                        if (admin.id !== CURRENT_USER_ID) {
                            row += `
                                <form action="${deleteAdminUrl.replace(':id', admin.id)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            `;
                        }

                        row += `</td></tr>`;
                        searchResultsList.innerHTML += row;
                    });

            }else{
                alert(data.message || 'Something went wrong');

            }
           })
           .catch(error => {
            alert('An error occurred while Searching for admins');

           });
    });
    
}
    
    
