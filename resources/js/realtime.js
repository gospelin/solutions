import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Laravel Echo
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        forceTLS: true,
        encrypted: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    });

    // Get authenticated user ID from meta tag
    const authId = document.querySelector('meta[name="auth-id"]').content;
    if (authId) {
        // Subscribe to private admin notification channel
        window.Echo.private(`admin.${authId}`)
            .listen('UserNotification', (e) => {
                const notificationList = document.getElementById('notificationList');
                const notificationCount = document.getElementById('notificationCount');
                const count = parseInt(notificationCount.textContent) || 0;

                // Add new notification
                const notificationItem = document.createElement('div');
                notificationItem.className = 'notification-item';
                notificationItem.dataset.id = e.id;
                notificationItem.innerHTML = `
                    <div class="notification-icon"><i class="bi ${e.icon}"></i></div>
                    <div class="notification-content">
                        <h5>${e.title}</h5>
                        <p>${e.description}</p>
                        <span class="notification-time">${e.time}</span>
                    </div>
                `;
                notificationList.prepend(notificationItem);

                // Update notification count
                notificationCount.textContent = count + 1;

                // Update activity feed
                const activityFeed = document.querySelector('.activity-feed');
                if (activityFeed) {
                    const activityItem = document.createElement('div');
                    activityItem.className = 'activity-item';
                    activityItem.innerHTML = `
                        <div class="activity-icon"><i class="bi ${e.icon}"></i></div>
                        <div class="activity-content">
                            <h5>${e.title}</h5>
                            <p>${e.description}</p>
                        </div>
                        <span class="activity-time">${e.time}</span>
                    `;
                    activityFeed.prepend(activityItem);
                }
            })
            .error((error) => {
                console.error('Channel Subscription Error:', error);
            });
    } else {
        console.warn('No authenticated user ID found. Skipping channel subscription.');
    }

    // Toggle notification dropdown
    const notificationToggle = document.getElementById('notificationToggle');
    const notificationDropdown = document.getElementById('notificationDropdown');
    if (notificationToggle && notificationDropdown) {
        notificationToggle.addEventListener('click', () => {
            notificationDropdown.classList.toggle('active');
        });
    }

    // Mark all notifications as read
    const markAllRead = document.getElementById('markAllRead');
    if (markAllRead) {
        markAllRead.addEventListener('click', () => {
            fetch('/admin/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('.notification-item').forEach(item => item.remove());
                        document.getElementById('notificationCount').textContent = '0';
                    }
                })
                .catch(error => console.error('Mark All Read Error:', error));
        });
    }

    // Periodic dashboard stats update
    function updateDashboardStats() {
        fetch('/admin/dashboard/stats')
            .then(response => response.json())
            .then(data => {
                document.querySelector('#totalUsers .stat-value').textContent = data.totalUsers;
                document.querySelector('#totalUsers .stat-trend').className = `stat-trend ${data.userTrendStatus}`;
                document.querySelector('#totalUsers .stat-trend span').textContent = data.userTrendValue;

                document.querySelector('#totalTools .stat-value').textContent = data.totalTools;
                document.querySelector('#totalTools .stat-trend').className = `stat-trend ${data.toolTrendStatus}`;
                document.querySelector('#totalTools .stat-trend span').textContent = data.toolTrendValue;

                document.querySelector('#totalRevenue .stat-value').textContent = data.totalRevenue;
                document.querySelector('#totalRevenue .stat-trend').className = `stat-trend ${data.revenueTrendStatus}`;
                document.querySelector('#totalRevenue .stat-trend span').textContent = data.revenueTrendValue;

                document.querySelector('#contactCount .stat-value').textContent = data.contactCount;
                document.querySelector('#contactCount .stat-trend').className = `stat-trend ${data.contactTrendStatus}`;
                document.querySelector('#contactCount .stat-trend span').textContent = data.contactTrendValue;
            })
            .catch(error => console.error('Dashboard Stats Update Error:', error));
    }

    // Update stats every 30 seconds
    setInterval(updateDashboardStats, 30000);
    updateDashboardStats(); // Initial update

    console.log('Echo Initialized:', window.Echo);
});