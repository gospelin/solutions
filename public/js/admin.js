document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.getElementById('loadingScreen');
    const hideLoadingScreen = () => {
        loadingScreen.style.opacity = '0';
        setTimeout(() => loadingScreen.style.display = 'none', 500);
    };

    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(hideLoadingScreen, 100);
    } else {
        window.addEventListener('load', hideLoadingScreen);
    }

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const userMenu = document.getElementById('userMenu');

    function toggleSidebar() {
        sidebar.classList.toggle('active');
        menuToggle.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    menuToggle.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    document.querySelectorAll('.nav-link, .nav-item button').forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 1024 && sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        });
    });

    userMenu.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && userMenu.classList.contains('active')) {
            userMenu.classList.remove('active');
        }
    });

    const themeToggle = document.getElementById('themeToggle');
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('light');
        themeToggle.innerHTML = document.body.classList.contains('light') ?
            '<i class="bi bi-sun"></i>' :
            '<i class="bi bi-moon-stars"></i>';
    });

    // User Management Search
    const userSearch = document.getElementById('userSearch');
    const userTableBody = document.getElementById('userTableBody');
    if (userSearch && userTableBody) {
        userSearch.addEventListener('input', () => {
            const searchTerm = userSearch.value.toLowerCase();
            Array.from(userTableBody.children).forEach(row => {
                const name = row.children[0].textContent.toLowerCase();
                const email = row.children[1].textContent.toLowerCase();
                row.style.display = name.includes(searchTerm) || email.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    // Tool Moderation Search
    const toolSearch = document.getElementById('toolSearch');
    const toolTableBody = document.getElementById('toolTableBody');
    if (toolSearch && toolTableBody) {
        toolSearch.addEventListener('input', () => {
            const searchTerm = toolSearch.value.toLowerCase();
            Array.from(toolTableBody.children).forEach(row => {
                const name = row.children[0].textContent.toLowerCase();
                const category = row.children[1].textContent.toLowerCase();
                row.style.display = name.includes(searchTerm) || category.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    // Form Submission for Profile (allow default PHP submission)
    const profileForm = document.querySelector('form[action*="/admin/profile"]');
    if (profileForm) {
        profileForm.addEventListener('submit', (e) => {
            console.log('Profile form submitting via default HTTP request');
            const submitButton = profileForm.querySelector('button[type="submit"]');
            submitButton.disabled = true; // Prevent multiple submissions
        });
    }

    // Other .modal-form submissions (temporary placeholder, update as needed)
    //document.querySelectorAll('.modal-form:not([action*="/admin/profile"])').forEach(form => {
    //    form.addEventListener('submit', (e) => {
    //        e.preventDefault();
    //        const formData = new FormData(form);
    //        console.log('Other form submitted:', Object.fromEntries(formData));
    //        alert('Settings saved successfully!');
    //        form.reset();
    //    });
    //});
});