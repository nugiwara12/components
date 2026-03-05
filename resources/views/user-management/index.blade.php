<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="w-full p-4">
            <x-user-management.table />
            <x-all-modal />
        </div>
    </div>
</x-app-layout>

<!-- dynamic components -->
<x-toast />
<x-action-button />
<x-pagination />

<script>
    // Handle user search input with debounce
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;

    // Modal Functions
    window.openModal = function (id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.remove('hidden');
    };

    // Closed modal with reset the all content when it closed
    function closeModal(id) {
        const modal = document.getElementById(id);
        if (!modal) return;
        modal.classList.add('hidden');
        modal.removeAttribute('data-userid');

        // Clear validation errors first
        window.clearValidationErrors(modal);
    }

    // Clear validation errors
    window.clearValidationErrors = function(modal) {
        if (!modal) return;

        // Remove all error messages
        modal.querySelectorAll('.error-text').forEach(el => el.remove());

        // Remove input error classes
        modal.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
    };

    // Enable real-time validation removal on input/change
    window.attachValidationClear = function(modal) {
        if (!modal) return;

        const inputs = modal.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            // Remove error on typing (input event) or selection change
            input.addEventListener('input', () => removeError(input));
            input.addEventListener('change', () => removeError(input));
        });

        function removeError(input) {
            // Remove red border
            input.classList.remove('input-error');

            // Remove associated error message (if any)
            const next = input.nextElementSibling;
            if (next && next.classList.contains('error-text')) {
                next.remove();
            }
        }
    };

    // Load Roles 
    window.loadRoles = async function() {
        try {
            // Fetch roles from Laravel route
            const response = await axios.get("{{ route('getRoles') }}");
            const roles = response.data;
            
            const select = document.getElementById('role');
            if (!select) return;
            
            // Reset select with placeholder
            select.innerHTML = '<option value="">-- Select Role --</option>';
            
            if (!roles || roles.length === 0) {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'No roles available';
                select.appendChild(option);
                return;
            }
            
            roles.forEach(role => {
                const option = document.createElement('option');
                option.value = role.value; // DB id
                option.textContent = role.label; // DB name
                select.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching roles:', error);
            const select = document.getElementById('role');
            if (select) {
                select.innerHTML = '<option value="">Failed to load roles</option>';
            }
        }
    };

    // get the employee ID
    window.setEmployeeId = function(employeeId = '') {
        const input = document.getElementById('employee_id');
        if (input) {
            input.value = employeeId; // Set the employee ID
        }
    };

    // Get Users
    window.loadUsers = async function (page = 1, perPage = 10, search = '') {
        try {
            const response = await axios.get('/userDetails', {
                params: { page, per_page: perPage, search } // pass search term to backend
            });

            const { users, pagination } = response.data;
            const tbody = document.getElementById('userTableBody');
            tbody.innerHTML = ''; // Clear previous rows

            if (!users || users.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td colspan="9" class="text-center py-4 text-gray-500">
                        No data available
                    </td>
                `;
                tbody.appendChild(row);
                document.getElementById('pagination').innerHTML = '';
                return;
            }

            users.forEach(user => {
                const isDeleted = user.status === 0;
                const row = document.createElement('tr');

                row.classList.add('whitespace-nowrap', 'border-b');
                if (isDeleted) {
                    row.classList.add('bg-red-100', 'text-red-700');
                }

                row.innerHTML = `
                    <td class="px-6 py-6">${user.employee_id}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-4">
                            <img src="${user.avatar_image ? '/' + user.avatar_image : '/avatar/default.png'}" 
                                alt="Avatar" 
                                class="w-10 h-10 rounded-full object-cover">
                            <span class="font-medium text-wrap text-gray-800">${user.name}</span>
                        </div>
                    </td>                    
                    <td class="px-6 py-6">${user.email}</td>
                    <td class="px-6 py-6 capitalize">${user.role_name || '-'}</td>
                    <td class="px-6 py-6">${user.mobile_number}</td>
                    <td class="px-6 py-6">${user.join_date}</td>
                    <td class="px-6 py-6">
                        <span class="${
                            user.status === 1
                                ? 'bg-green-400 text-white border border-green-500'
                                : 'bg-red-400 text-white border border-gray-400'
                        } px-3 py-1 rounded-md text-sm font-medium">
                            ${user.status === 1 ? 'Active' : 'Inactive'}
                        </span>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <div class="flex justify-center items-center gap-2">
                            ${
                                isDeleted
                                    ? actionButton(
                                        `restoreUser(${user.id})`,
                                        'Restore',
                                        'bi bi-arrow-clockwise',
                                        'text-green-500 hover:border-green-500'
                                    )
                                    : actionButton(
                                        `editUser(${JSON.stringify(user).replace(/"/g, '&quot;')})`,
                                        'Edit',
                                        'bi bi-pencil-square',
                                        'text-blue-500 hover:border-blue-500'
                                    ) +
                                    actionButton(
                                        `deleteUser(${user.id})`,
                                        'Delete',
                                        'bi bi-trash-fill',
                                        'text-red-500 hover:border-red-500'
                                    )
                            }
                        </div>
                    </td>
                `;

                tbody.appendChild(row);
            });

            // Render pagination
            renderPagination({
                current_page: pagination.current_page,
                last_page: pagination.last_page,
                per_page: pagination.per_page,
                total: pagination.total,
                onPageChange: (p) => loadUsers(p, perPage, search) // keep search term on pagination
            });

        } catch (error) {
            console.error('Error fetching users:', error);
            showToast('Failed to load users.', 'error');
        }
    };

    // Call it on page load
    window.addEventListener('DOMContentLoaded', window.loadUsers);

    // Open Add User Modal
    window.openAddUser = async function (modalId = 'addUserModal') {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        // Clear any previous errors
        window.clearValidationErrors(modal);

        // Clear any previous form data (real time clear validations)
        window.attachValidationClear(modal);

        // Set modal title and action button
        const title = modal.querySelector('#modalTitle');
        const actionBtn = modal.querySelector('#modalActionBtn');
        if (title) title.textContent = 'Add New User';
        if (actionBtn) actionBtn.textContent = 'Add User';

        // Clear all input/select/textarea fields inside the modal
        const fields = modal.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            if (field.type === 'checkbox' || field.type === 'radio') {
                field.checked = false;
            } else {
                field.value = '';
            }
        });

        // Reset avatar preview for add user
        const avatarPreview = modal.querySelector('#avatarPreview');
        const avatarPlaceholder = modal.querySelector('#avatarPlaceholder');
        const avatarInput = modal.querySelector('#avatar_image');

        if (avatarPreview && avatarPlaceholder) {
            avatarPreview.src = '';
            avatarPreview.classList.add('hidden');
            avatarPlaceholder.classList.remove('hidden');
        }
        if (avatarInput) avatarInput.value = ''; // clear file input

        // Remove any data attributes (like editing user ID)
        modal.removeAttribute('data-userid');

        // Open the modal
        openModal(modalId);

        // Load roles dynamically inside the modal
        const roleSelect = modal.querySelector('select[name="role"]');
        if (roleSelect) window.loadRoles(roleSelect);

        // Fetch the next available employee ID from Laravel route
        try {
            const res = await fetch("{{ route('getEmployeeId') }}");
            const data = await res.json();
            const nextId = data.employee_id || ''; // e.g., 'EMP002'
            window.setEmployeeId(nextId);
        } catch (err) {
            console.error('Could not fetch employee ID', err);
            window.setEmployeeId(); // fallback empty
        }
    };

    // Edit user function
    window.editUser = async function(user) {
        const modal = document.getElementById('addUserModal');

        // Fill text fields
        ['name','email','mobile_number','join_date','employee_id'].forEach(id => {
            const input = document.getElementById(id);
            if(input) input.value = user[id] || '';
        });

        // Clear password fields
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';

        // Handle avatar preview
        const avatarPreview = document.getElementById('avatarPreview');
        const avatarPlaceholder = document.getElementById('avatarPlaceholder');
        const avatarInput = document.getElementById('avatar_image');
                
        if(user.avatar_image) {
            avatarPreview.src = user.avatar_image.startsWith('/') 
                ? user.avatar_image 
                : '/' + user.avatar_image;
            avatarPreview.classList.remove('hidden');
            avatarPlaceholder.classList.add('hidden');
        } else {
            avatarPreview.src = '';
            avatarPreview.classList.add('hidden');
            avatarPlaceholder.classList.remove('hidden');
        }

        // Load roles dynamically and select user role
        const roleSelect = document.getElementById('role');
        if(roleSelect) {
            await window.loadRoles(); // wait until roles are loaded

            // Use role_id instead of role
            roleSelect.value = user.role_id || '';

            // Optional fallback if role not in options
            if(!Array.from(roleSelect.options).some(opt => opt.value == user.role_id)) {
                const option = document.createElement('option');
                option.value = user.role_id;
                option.textContent = user.role_name || 'Unknown Role';
                option.selected = true;
                roleSelect.appendChild(option);
            }
        }

        // Set modal to edit mode
        modal.dataset.userid = user.id;
        document.getElementById('modalTitle').textContent = 'Edit User';
        document.getElementById('modalActionBtn').textContent = 'Update User';

        // Open modal
        openModal('addUserModal');
    };

    // Add user && Edit Users
    window.submitAddUser = async function () {
        const modal = document.getElementById('addUserModal');
        const submitBtn = modal.querySelector('#modalActionBtn'); // get the submit button
        const userId = modal.dataset.userid;
        const inputs = modal.querySelectorAll('input, select');
        const formData = new FormData(); // Use FormData for file uploads

        // Disable button to prevent multiple clicks
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

        // Clear old errors
        modal.querySelectorAll('.error-text').forEach(el => el.remove());
        inputs.forEach(input => input.classList.remove('input-error'));

        // Build payload
        inputs.forEach(input => {
            if (!input.name) return;

            if (input.type === 'checkbox' || input.type === 'radio') {
                if (input.checked) formData.append(input.name, input.value);
            } else if (input.type === 'file') {
                if (input.files.length > 0) {
                    formData.append(input.name, input.files[0]); // append file
                }
            } else {
                formData.append(input.name, input.value.trim());
            }
        });

        let url = userId ? `/updateUser/${userId}` : '/addUser';
        let method = 'post';
        if (userId) formData.append('_method', 'PUT');

        try {
            const response = await axios({
                method: method,
                url: url,
                data: formData,
                headers: { 'Accept': 'application/json', 'Content-Type': 'multipart/form-data' },
            });

            if (response.data.status) {
                showToast(response.data.message, 'success');

                modal.removeAttribute('data-userid');
                modal.querySelector('#modalTitle').textContent = 'Add New User';
                modal.querySelector('#modalActionBtn').textContent = 'Add User';

                window.loadUsers();
                closeModal('addUserModal');
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                showToast('Please fix the required field.', 'error');

                // SHOW ONLY FIRST ERROR
                for (const input of inputs) {
                    const field = input.name;
                    if (errors[field]) {
                        input.classList.add('input-error');

                        const errorText = document.createElement('p');
                        errorText.className = 'error-text text-red-500 text-xs mt-1';
                        errorText.innerText = errors[field][0];
                        input.insertAdjacentElement('afterend', errorText);
                        input.focus();
                        break; // stop after first error
                    }
                }
            } else {
                showToast('Something went wrong.', 'error');
                console.error(error);
            }
        } finally {
            // Re-enable the button
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    };

    // Open Delete Modal with dynamic user info
    window.deleteUser = function(userId) {
        const modal = document.getElementById('deleteModal');
        const title = document.getElementById('deleteModalTitle');
        const message = document.getElementById('deleteModalMessage');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        if (!modal || !title || !message || !confirmBtn) return;

        title.textContent = 'Confirm Delete';
        message.textContent = 'Are you sure you want to delete?';

        modal.classList.remove('hidden');

        confirmBtn.onclick = async () => {
            // Disable button to prevent multiple clicks
            confirmBtn.disabled = true;
            confirmBtn.classList.add('opacity-50', 'cursor-not-allowed');

            try {
                const res = await fetch(`/deleteUser/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });

                const data = res.ok ? await res.json().catch(() => ({})) : {};
                showToast(res.ok ? data.message || 'Deleted successfully' : 'Failed to delete');
            } catch (error) {
                console.error(error);
                showToast('Something went wrong');
            } finally {
                // Re-enable button
                confirmBtn.disabled = false;
                confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');

                closeModal('deleteModal');
                window.loadUsers();
            }
        };
    };

    // Open Restore Modal with dynamic user info
    window.restoreUser = function(userId) {
        const modal = document.getElementById('restore');
        const title = document.getElementById('restoreTitle');
        const message = document.getElementById('restoreMessage');
        const confirmBtn = modal.querySelector('button.bg-green-600'); // Approve button

        if (!modal || !title || !message || !confirmBtn) return;

        title.textContent = 'Confirm Restore';
        message.textContent = 'Are you sure you want to restore this user?';

        modal.classList.remove('hidden');

        confirmBtn.onclick = async () => {
            // Disable button to prevent multiple clicks
            confirmBtn.disabled = true;
            confirmBtn.classList.add('opacity-50', 'cursor-not-allowed');

            try {
                const res = await fetch(`/restoreUser/${userId}`, {
                    method: 'POST', // or PUT depending on your route
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });

                const data = res.ok ? await res.json().catch(() => ({})) : {};
                showToast(res.ok ? data.message || 'User restored successfully' : 'Failed to restore');
            } catch (error) {
                console.error(error);
                showToast('Something went wrong');
            } finally {
                // Re-enable button
                confirmBtn.disabled = false;
                confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');

                closeModal('restore');
                window.loadUsers(); // reload users or update table
            }
        };
    };
    
    // Search Function
    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // Load page 1 whenever the search term changes
            window.loadUsers(1, 10, this.value.trim());
        }, 300); // 300ms debounce
    });

    // Preview Avatar
    window.previewAvatarImage = function(event) {
        const preview = document.getElementById('avatarPreview');
        const placeholder = document.getElementById('avatarPlaceholder');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    };
</script>