document.addEventListener('DOMContentLoaded', () => {
    // Loading Screen
    const loadingScreen = document.getElementById('loadingScreen');
    const hideLoadingScreen = () => {
        if (loadingScreen) {
            loadingScreen.style.opacity = '0';
            setTimeout(() => loadingScreen.style.display = 'none', 500);
        }
    };
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(hideLoadingScreen, 500); // Increased delay
    } else {
        window.addEventListener('load', hideLoadingScreen);
    }

    // Sidebar Toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if (menuToggle && sidebar && overlay) {
        const toggleSidebar = () => {
            sidebar.classList.toggle('active');
            menuToggle.classList.toggle('active');
            overlay.classList.toggle('active');
        };
        menuToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
        document.querySelectorAll('.nav-link, .nav-item button').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth <= 1024 && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });
        });
    } else {
        console.warn('Sidebar elements (#menuToggle, #sidebar, #overlay) not found.');
    }

    // User Menu Dropdown
    const userMenu = document.getElementById('userMenu');
    if (userMenu) {
        userMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('active');
        });
        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target) && userMenu.classList.contains('active')) {
                userMenu.classList.remove('active');
            }
        });
    } else {
        console.warn('User menu (#userMenu) not found.');
    }

    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.add('light');
            themeToggle.innerHTML = '<i class="bi bi-sun"></i>';
        } else {
            themeToggle.innerHTML = '<i class="bi bi-moon-stars"></i>';
        }
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('light');
            const isLight = document.body.classList.contains('light');
            themeToggle.innerHTML = isLight ?
                '<i class="bi bi-sun"></i>' :
                '<i class="bi bi-moon-stars"></i>';
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        });
    } else {
        console.warn('Theme toggle (#themeToggle) not found.');
    }

    // User Management Search
    const userSearch = document.getElementById('userSearch');
    const userTableBody = document.getElementById('userTableBody');
    if (userSearch && userTableBody) {
        let debounceTimer;
        userSearch.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const searchTerm = userSearch.value.toLowerCase().trim();
                Array.from(userTableBody.children).forEach(row => {
                    const name = row.children[1]?.textContent.toLowerCase() || '';
                    const email = row.children[2]?.textContent.toLowerCase() || '';
                    const status = row.children[3]?.textContent.toLowerCase() || '';
                    row.style.display = name.includes(searchTerm) || email.includes(searchTerm) || status.includes(searchTerm) ? '' : 'none';
                });
            }, 300);
        });
    } else {
        console.warn('User search elements (#userSearch, #userTableBody) not found.');
    }

    // Tool Moderation Search
    const toolSearch = document.getElementById('toolSearch');
    const toolTableBody = document.getElementById('toolTableBody');
    if (toolSearch && toolTableBody) {
        let debounceTimer;
        toolSearch.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const searchTerm = toolSearch.value.toLowerCase();
                Array.from(toolTableBody.children).forEach(row => {
                    const name = row.children[0].textContent.toLowerCase();
                    const category = row.children[1].textContent.toLowerCase();
                    row.style.display = name.includes(searchTerm) || category.includes(searchTerm) ? '' : 'none';
                });
            }, 300);
        });
    } else {
        console.warn('Tool search elements (#toolSearch, #toolTableBody) not found.');
    }

    // Profile Form Submission
    const profileForm = document.querySelector('form[action*="/admin/profile"]');
    if (profileForm) {
        profileForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const submitButton = profileForm.querySelector('button[type="submit"]');
            if (submitButton) submitButton.disabled = true;
            try {
                const formData = new FormData(profileForm);
                const response = await fetch(profileForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });
                const result = await response.json();
                alert(result.message || 'Profile updated successfully!');
            } catch (error) {
                console.error('Form submission error:', error);
                alert('Error updating profile. Please try again.');
            } finally {
                if (submitButton) submitButton.disabled = false;
            }
        });
    }
});
