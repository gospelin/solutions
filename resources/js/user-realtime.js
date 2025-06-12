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

    // Get authenticated user ID
    const authId = document.querySelector('meta[name="auth-id"]').content;
    if (authId) {
        // Subscribe to user notification channel
        window.Echo.private(`user.${authId}`)
            .listen('UserNotification', (e) => {
                console.log('Notification received:', e); // Debug
                // Update notification dropdown
                const notificationList = document.querySelector('#notificationList');
                const notificationCount = document.querySelector('#notificationCount');
                if (notificationList && notificationCount) {
                    const count = parseInt(notificationCount.textContent) || 0;
                    const notificationItem = document.createElement('div');
                    notificationItem.className = 'notification-item';
                    notificationItem.dataset.id = e.id;
                    notificationItem.innerHTML = `
                        <div class="notification-icon"><i class="bi ${e.icon}"></i></div>
                        <div class="notification-content">
                            <h5>${e.title}</h5>
                            <p>${e.description}</p>
                        </div>
                        <span class="notification-time">${e.time}</span>
                    `;
                    notificationList.prepend(notificationItem);
                    notificationCount.textContent = count + 1;
                }

                // Update notification table (if on notifications page)
                const notificationTable = document.querySelector('#notificationTable');
                if (notificationTable) {
                    const row = document.createElement('tr');
                    row.className = 'unread';
                    row.dataset.id = e.id;
                    row.innerHTML = `
                        <td>${e.id}</td>
                        <td>${e.title}</td>
                        <td>${e.description}</td>
                        <td>${new Date().toLocaleString()}</td>
                        <td>Unread</td>
                        <td>
                            <div class="action-group">
                                <form action="/notifications/${e.id}/read" method="POST">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                    <input type="hidden" name="_method" value="POST">
                                    <button type="submit" class="action-btn success">
                                        <i class="bi bi-check-circle"></i> Mark as Read
                                    </button>
                                </form>
                            </div>
                        </td>
                    `;
                    notificationTable.querySelector('tbody').prepend(row);
                }

                // Update activity feed
                const activityFeed = document.querySelector('#activityFeed');
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
        console.warn('No authenticated user ID found.');
    }

    // Periodic stats update
    function updateDashboardStats() {
        fetch('/user/dashboard/stats')
            .then(response => response.json())
            .then(data => {
                document.querySelector('#toolsUsed').textContent = data.toolsUsed;
                if (window.toolUsageChart) {
                    window.toolUsageChart.data.datasets[0].data = [
                        data.toolsUsed * 0.4,
                        data.toolsUsed * 0.3,
                        data.toolsUsed * 0.2,
                        data.toolsUsed * 0.1,
                        data.toolsUsed * 0.05
                    ];
                    window.toolUsageChart.update();
                }
            })
            .catch(error => console.error('Stats Update Error:', error));
    }

    setInterval(updateDashboardStats, 30000);
    updateDashboardStats();

    console.log('Echo Initialized:', window.Echo);
});