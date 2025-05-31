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
                        <!-- Profile Edit Link for Breeze -->
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Logout Form -->
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
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
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
                <!--<div class="sidebar-section">
                    <div class="sidebar-heading">MANAGE CONTENT</div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="fixed-deposit">
                            <span>Fixed Deposit</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="fixed-deposit">
                            <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar"></i> New Fixed Deposit</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> My Fixed Deposits</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="deposit">
                            <span>Deposit</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="deposit">
                            <a class="nav-link" href="#"><i class="fas fa-hand-holding-usd"></i> Deposit Now</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Deposit List</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="send-money">
                            <span>Send Money</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="send-money">
                            <a class="nav-link" href="#"><i class="fas fa-paper-plane"></i> Send Money</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Transfer List</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="request-money">
                            <span>Request Money</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="request-money">
                            <a class="nav-link" href="#"><i class="fas fa-hand-holding-heart"></i> New Request</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> All Request</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="exchange">
                            <span>Exchange</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="exchange">
                            <a class="nav-link" href="#"><i class="fas fa-exchange-alt"></i> Exchange</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> All Exchange</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="redeem">
                            <span>Redeem</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="redeem">
                            <a class="nav-link" href="#"><i class="fas fa-key"></i> Insert Redeem Code</a>
                            <a class="nav-link" href="#"><i class="fas fa-gem"></i> Escrow</a>
                            <a class="nav-link" href="#"><i class="fas fa-plus-circle"></i> Create a request</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Escrow List</a>
                            <a class="nav-link" href="#"><i class="fas fa-exclamation-triangle"></i> Dispute</a>
                            <a class="nav-link" href="#"><i class="fas fa-qrcode"></i> QR Payment</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="qfs-card">
                            <span>QFS Card</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="qfs-card">
                            <a class="nav-link" href="#"><i class="fas fa-credit-card"></i> QFS Card</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="voucher">
                            <span>Voucher</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="voucher">
                            <a class="nav-link" href="#"><i class="fas fa-gift"></i> Voucher</a>
                            <a class="nav-link" href="#"><i class="fas fa-plus-circle"></i> Create voucher</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Voucher List</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="invoice">
                            <span>Invoice</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="invoice">
                            <a class="nav-link" href="#"><i class="fas fa-file-invoice"></i> Create Invoice</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Invoice List</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="bill">
                            <span>Bill</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="bill">
                            <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar"></i> Pay Bill</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Pay List</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="payout">
                            <span>Payout</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="payout">
                            <a class="nav-link" href="#"><i class="fas fa-money-bill-wave"></i> Request Payout</a>
                            <a class="nav-link" href="#"><i class="fas fa-list"></i> Payout List</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-header" data-target="more">
                            <span>More</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                        <div class="submenu" id="more">
                            <a class="nav-link" href="#"><i class="fas fa-exchange-alt"></i> Transactions</a>
                            <a class="nav-link" href="#"><i class="fas fa-ticket-alt"></i> Tickets</a>
                            <a class="nav-link" href="#"><i class="fas fa-shield-alt"></i> 2FA Security</a>
                            <a class="nav-link" href="#"><i class="fas fa-lock"></i> Security PIN</a>
                            <a class="nav-link" href="#"><i class="fas fa-cog"></i> Manage PIN uses</a>
                            <a class="nav-link" href="#"><i class="fas fa-percentage"></i> Commission List</a>
                            <a class="nav-link" href="#"><i class="fas fa-check-circle"></i> Verification Center</a>
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i> Push Notify Setting</a>
                            <a class="nav-link" href="#"><i class="fas fa-cog"></i> Setting</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="sidebar-footer">
                <p>your for swift is using card.</p>
                <button class="btn btn-omit">omit Now</button>
            </div>-->
        </div>

        <!-- Welcome Section -->
        <div class="welcome-section">
            <h3>Welcome {{ Auth::user()->name }}! <i class="fas fa-star" style="color: #ffd700;"></i></h3>
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
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <h1>Dashboard</h1>
            </div>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Logo Container -->
                <div class="logo-container">
                    <div class="logo-wrapper">
                        <img src="{{ asset('images/mrsolution.jpeg') }}" alt="Company Logo" class="logo">
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="additional-nav">
                    <ul>
                        <li><a href="news.html" onclick="showLoader(event)">News</a></li>
                        <li><a href="#" onclick="showLoader(event)">Mail</a></li>
                        <li><a href="about.html" onclick="showLoader(event)">About</a></li>
                        <li><a href="privacy.html" onclick="showLoader(event)">Privacy</a></li>
                    </ul>
                </nav>

                <!-- Video Section -->
                <div class="video-container">
                    <video autoplay muted loop class="background-video">
                        <source src="{{ asset('images/main.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <marquee behavior="scroll" direction="left" class="welcome-text">Welcome to the home of tools, We're 24hrs Active...</marquee>
                </div>

                <!-- Additional Links -->
                <section class="additional-links">
                    <ul>
                        <li><a href="#" onclick="showLoader(event)" id="activate-premium-link"><i class="bi bi-star-fill"></i> Activate Premium</a></li>
                        <li><a href="developer.html" onclick="showLoader(event)"><i class="bi bi-people-fill"></i> Developer Team</a></li>
                        <li><a href="usage.html" onclick="showLoader(event)"><i class="bi bi-camera-reels-fill"></i> How To Use?</a></li>
                    </ul>
                </section>

                <!-- Footer -->
                <div class="dashboard-footer">
                    <p>Copyright © 2025 ● All rights reserved by Mr Solution Tech</p>
                </div>
            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Existing Sidebar Toggle
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

            // Existing Submenu Toggle
            const menuHeaders = document.querySelectorAll('.menu-header');
            menuHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const submenu = document.getElementById(targetId);
                    const icon = this.querySelector('.toggle-icon');

                    document.querySelectorAll('.submenu').forEach(sm => {
                        if (sm !== submenu && sm.classList.contains('show')) {
                            sm.classList.remove('show');
                            sm.previousElementSibling.querySelector('.toggle-icon').classList.remove('open');
                            sm.style.maxHeight = null;
                        }
                    });

                    submenu.classList.toggle('show');
                    icon.classList.toggle('open');

                    if (submenu.classList.contains('show')) {
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    } else {
                        submenu.style.maxHeight = null;
                    }
                });
            });

            document.querySelectorAll('.submenu').forEach(submenu => {
                submenu.style.maxHeight = null;
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

            // Additional Navigation and Section Links with Loader
            document.querySelectorAll('.additional-nav a, .additional-links a').forEach(link => {
                link.addEventListener('click', function(event) {
                    const targetUrl = this.href;
                    if (targetUrl.includes('t.me') || targetUrl.includes('chat.whatsapp.com')) {
                        event.preventDefault();
                        window.open(targetUrl, '_blank');
                        return;
                    }
                    if (!targetUrl || targetUrl === '#') return;
                    event.preventDefault();
                    showLoader();
                    setTimeout(() => {
                        hideLoader();
                        window.location.href = targetUrl;
                    }, 2000);
                });
            });

            // Stop Loader on Back Button
            window.addEventListener('popstate', () => {
                hideLoader();
            });

            // Premium Link Logic
            const premiumLink = document.getElementById('premium-link');
            const activatePremiumLink = document.getElementById('activate-premium-link');
            const activationKey = localStorage.getItem('activationKey');
            const expirationDate = new Date(localStorage.getItem('activationExpiry'));

            if (activationKey && expirationDate > new Date()) {
                premiumLink.href = 'activated.html';
            } else {
                localStorage.removeItem('activationKey');
                localStorage.removeItem('activationExpiry');
                premiumLink.href = 'auth.html';
            }

            // Activate Premium Link Logic
            activatePremiumLink.addEventListener('click', function(event) {
                event.preventDefault();
                const activationExpiry = localStorage.getItem('activationExpiry');
                if (activationExpiry) {
                    const expiryDate = new Date(activationExpiry);
                    const currentDate = new Date();
                    if (expiryDate > currentDate) {
                        const daysLeft = Math.ceil((expiryDate - currentDate) / (1000 * 60 * 60 * 24));
                        showLoader();
                        setTimeout(() => {
                            hideLoader();
                            startCountdown(expiryDate, daysLeft);
                        }, 2000);
                        return;
                    } else {
                        localStorage.removeItem('activationExpiry');
                    }
                }
                showLoader();
                setTimeout(() => {
                    hideLoader();
                    window.location.href = 'auth.html';
                }, 2000);
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

            // Countdown and Popup
            function startCountdown(expiryDate, daysLeft) {
                const popup = document.getElementById('popup');
                const popupMessage = document.getElementById('popup-message');
                const popupHeader = document.getElementById('popup-header');
                popupHeader.textContent = 'Premium Active';

                const interval = setInterval(() => {
                    const currentDate = new Date();
                    const remainingTime = expiryDate - currentDate;
                    if (remainingTime <= 0) {
                        clearInterval(interval);
                        popupMessage.textContent = 'Your subscription has expired.';
                        return;
                    }
                    const hours = String(Math.floor((remainingTime / (1000 * 60 * 60)) % 24)).padStart(2, '0');
                    const minutes = String(Math.floor((remainingTime / (1000 * 60)) % 60)).padStart(2, '0');
                    const seconds = String(Math.floor((remainingTime / 1000) % 60)).padStart(2, '0');
                    const timeRemaining = `[${hours}:${minutes}:${seconds}]`;
                    popupMessage.textContent = `Your subscription is active and will expire on ${expiryDate.toDateString()} (${daysLeft} days remaining). Time left: ${timeRemaining}`;
                }, 1000);

                popup.style.display = 'block';
                document.getElementById('popup-button').addEventListener('click', () => {
                    popup.style.display = 'none';
                    clearInterval(interval);
                });
            }
        });
    </script>
</body>

</html>