import{P as r,E as l}from"./pusher-LyJa47xg.js";window.Pusher=r;document.addEventListener("DOMContentLoaded",()=>{window.Echo=new l({broadcaster:"pusher",key:"49e7f52d423a9c1d49e7f52d423a9c1de18d",cluster:"mt1",forceTLS:!0,encrypted:!0,authEndpoint:"/broadcasting/auth",auth:{headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content}}});const i=document.querySelector('meta[name="auth-id"]').content;i?window.Echo.private(`user.${i}`).listen("UserNotification",t=>{console.log("Notification received:",t);const a=document.querySelector("#notificationList"),n=document.querySelector("#notificationCount");if(a&&n){const e=parseInt(n.textContent)||0,o=document.createElement("div");o.className="notification-item",o.dataset.id=t.id,o.innerHTML=`
                        <div class="notification-icon"><i class="bi ${t.icon}"></i></div>
                        <div class="notification-content">
                            <h5>${t.title}</h5>
                            <p>${t.description}</p>
                        </div>
                        <span class="notification-time">${t.time}</span>
                    `,a.prepend(o),n.textContent=e+1}const s=document.querySelector("#notificationTable");if(s){const e=document.createElement("tr");e.className="unread",e.dataset.id=t.id,e.innerHTML=`
                        <td>${t.id}</td>
                        <td>${t.title}</td>
                        <td>${t.description}</td>
                        <td>${new Date().toLocaleString()}</td>
                        <td>Unread</td>
                        <td>
                            <div class="action-group">
                                <form action="/notifications/${t.id}/read" method="POST">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                                    <input type="hidden" name="_method" value="POST">
                                    <button type="submit" class="action-btn success">
                                        <i class="bi bi-check-circle"></i> Mark as Read
                                    </button>
                                </form>
                            </div>
                        </td>
                    `,s.querySelector("tbody").prepend(e)}const d=document.querySelector("#activityFeed");if(d){const e=document.createElement("div");e.className="activity-item",e.innerHTML=`
                        <div class="activity-icon"><i class="bi ${t.icon}"></i></div>
                        <div class="activity-content">
                            <h5>${t.title}</h5>
                            <p>${t.description}</p>
                        </div>
                        <span class="activity-time">${t.time}</span>
                    `,d.prepend(e)}}).error(t=>{console.error("Channel Subscription Error:",t)}):console.warn("No authenticated user ID found.");function c(){fetch("/user/dashboard/stats").then(t=>t.json()).then(t=>{document.querySelector("#toolsUsed").textContent=t.toolsUsed,window.toolUsageChart&&(window.toolUsageChart.data.datasets[0].data=[t.toolsUsed*.4,t.toolsUsed*.3,t.toolsUsed*.2,t.toolsUsed*.1,t.toolsUsed*.05],window.toolUsageChart.update())}).catch(t=>console.error("Stats Update Error:",t))}setInterval(c,3e4),c(),console.log("Echo Initialized:",window.Echo)});
