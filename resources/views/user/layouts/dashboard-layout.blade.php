<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard | Mr Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Stacks for Custom Styles -->
    @stack('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="dashboard-container">
        <!-- Mobile Header -->
        <div class="mobile-header d-lg-none" x-data="{ open: false }">
            <button class="hamburger-btn" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <div class="mobile-logo"><img src="{{ asset('images/mrsolution.jpeg') }}" alt="Mr Solution Logo"></div>
            <div class="mobile-user">
                <div class="dropdown">
                    <button
                        class="btn dropdown-toggle"
                        type="button"
                        id="mobileUserDropdown"
                        @click="open = !open"
                        :aria-expanded="open">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        x-show="open"
                        @click.outside="open = false"
                        :aria-labelledby="mobileUserDropdown">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Top Navigation Bar -->
        <div class="top-nav d-none d-lg-flex">
            <div class="top-nav-left">
                <button class="hamburger-btn d-lg-none" id="sidebarToggleTop"><i class="fas fa-bars"></i></button>
            </div>
            <div class="top-nav-center">
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="top-nav-right">
                <i class="fas fa-bell me-3"></i>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ Auth::user()->name }}</span><i class="fas fa-user-circle profile-icon"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Logout</button></form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo d-none d-lg-block">
                <img src="{{ asset('images/mrsolution.jpeg') }}" alt="Mr Solution Logo">
            </div>
            <span class="close-btn" id="close-btn">X</span>
            <h3>Mr Solution Tech</h3>
            <hr>
            <hr>
            <nav class="nav flex-column">
                <div class="sidebar-section">
                    <div class="sidebar-heading">DASHBOARD</div>
                    <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a class="nav-link" href="updates.html"><i class="bi bi-bell-fill"></i> Updates</a>
                    <a class="nav-link" href="apps.html"><i class="bi bi-google-play"></i> Free Apps</a>
                    <a class="nav-link" href="contact.html"><i class="bi bi-headset"></i> Contact Us</a>
                    <a class="nav-link" href="purchase.html"><i class="bi bi-shield-lock"></i> Purchase Key</a>
                    <a class="nav-link" href="crypter.html"><i class="bi bi-code-slash"></i> Code Crypter</a>
                    <a class="nav-link" href="https://selar.co/showlove/mrsolution" target="_blank"><i class="bi bi-gift"></i> Donate Here</a>
                    <a class="nav-link" href="auth.html" id="premium-link"><i class="bi bi-person-check-fill"></i> Premium Member</a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <p>your for swift is using card.</p>
                <button class="btn btn-omit">omit Now</button>
            </div>
        </div>

        <!-- Floating Icons -->
        <div class="floating-icons">
            <a href="https://t.me/Mr_Solution404" target="_blank" class="button telegram-btn">
                <i class="fab fa-telegram-plane"></i>
                <span>Telegram Channel</span>
            </a>
            <a href="https://chat.whatsapp.com/LZowbxiPlCiEu8d0AVDO1h" target="_blank" class="button whatsapp-btn">
                <i class="fab fa-whatsapp"></i>
                <span>WhatsApp Group</span>
            </a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Loading Spinner -->
        <div class="loading-overlay" id="loading-overlay">
            <div class="spinner"></div>
        </div>

        <!-- Popup -->
        <div class="popup" id="popup">
            <div class="popup-header" id="popup-header"></div>
            <div class="popup-message" id="popup-message"></div>
            <div class="popup-countdown" id="popup-countdown"></div>
            <button class="popup-button" id="popup-button">OK</button>
        </div>

        <!-- Activate Premium Overlay -->
        <div id="activate-premium-overlay" class="loading-overlay">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- JivoChat Container -->
    <div id="jivo-iframe-container" style="opacity: 0; visibility: hidden; width: 0px; height: 0px; overflow: hidden;">
        <iframe src="" role="presentation" allow="autoplay" title="Jivochat" name="jivo_container" id="jivo_container" frameborder="no"></iframe>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.nicescroll@3.7.6/dist/jquery.nicescroll.min.js"></script>
    <script src="//code.jivosite.com/widget/RH6UW97ddX" async></script>
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const closeBtn = document.getElementById('close-btn');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                document.body.classList.toggle('sidebar-active');
            });

            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('active');
                document.body.classList.remove('sidebar-active');
            });

            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                    document.body.classList.remove('sidebar-active');
                }
            });

            // Bootstrap Dropdown Initialization
            const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdownElementList.forEach(dropdownToggleEl => {
                new bootstrap.Dropdown(dropdownToggleEl);
            });

            // Sidebar Link Click with Loader
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const targetUrl = this.href;
                    if (targetUrl.includes('t.me') || targetUrl.includes('chat.whatsapp.com')) {
                        window.open(targetUrl, '_blank');
                        return;
                    }
                    if (!targetUrl || targetUrl === '#') return;
                    showLoader();
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 2000);
                });
            });

            // Loader Functions
            function showLoader() {
                const loader = document.getElementById('activate-premium-overlay');
                if (loader) loader.style.display = 'flex';
            }

            function hideLoader() {
                const loader = document.getElementById('activate-premium-overlay');
                if (loader) loader.style.display = 'none';
            }
        });
    </script>
</body>

</html>