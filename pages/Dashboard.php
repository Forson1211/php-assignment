<?php
require_once 'pages/includes/Config.php';
require_once 'pages/includes/Functions.php';

if (!isLoggedIn()) {
    redirect('login');
}
$pageTitle = "Dashboard";

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    $_SESSION = array();
    session_destroy();
    redirect('login?error=invalid_user');
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare("SELECT * FROM donations WHERE user_id = ? ORDER BY donation_date DESC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->bindValue(2, $perPage, PDO::PARAM_INT);
$stmt->bindValue(3, $offset, PDO::PARAM_INT);
$stmt->execute();

$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM donations WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$totalDonationsCount = $stmt->fetch()['total'];
$totalPages = ceil($totalDonationsCount / $perPage);

$offset = ($page - 1) * $perPage;
$stmt = $pdo->prepare("SELECT * FROM donations WHERE user_id = ? ORDER BY donation_date DESC LIMIT $perPage OFFSET $offset");
$stmt->execute([$_SESSION['user_id']]);
$totalDonations = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare("SELECT SUM(amount) as total FROM donations WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$totalDonated = $stmt->fetch()['total'] ?: 0;

$stmt = $pdo->prepare("SELECT COUNT(DISTINCT user_id) as total_donors FROM donations");
$stmt->execute();
$totalDonors = $stmt->fetch()['total_donors'];


$peopleHelped = round($totalDonated * 5);
$projectsSupported = round($totalDonated / 100);
$volunteerHours = isset($user['volunteer_hours']) ? $user['volunteer_hours'] : 0;

$stmt = $pdo->prepare("
    SELECT action, action_date 
    FROM user_activity 
    WHERE user_id = ? 
    ORDER BY action_date DESC 
    LIMIT 3
");

$activities = [
    ['action' => 'Profile updated', 'action_date' => date('Y-m-d H:i:s', strtotime('-2 days'))],
    ['action' => 'Donation of $' . number_format(50, 2) . ' processed', 'action_date' => date('Y-m-d H:i:s', strtotime('-1 week'))],
    ['action' => 'Logged in from a new device', 'action_date' => date('Y-m-d H:i:s', strtotime('-2 weeks'))]
];


$badges = [];
if ($totalDonated > 0) $badges[] = ['name' => 'First Donation', 'icon' => 'star', 'color' => '#d97706', 'bg' => '#fef3c7', 'unlocked' => true];
if ($totalDonations >= 3) $badges[] = ['name' => 'Team Player', 'icon' => 'users', 'color' => '#3b82f6', 'bg' => '#dbeafe', 'unlocked' => true];
if ($totalDonated >= 100) $badges[] = ['name' => 'Generous', 'icon' => 'currency-dollar', 'color' => '#10b981', 'bg' => '#d1fae5', 'unlocked' => true];
if ($totalDonated >= 500) $badges[] = ['name' => 'Power Donor', 'icon' => 'lightning-bolt', 'color' => '#4f46e5', 'bg' => '#e0e7ff', 'unlocked' => true];
else $badges[] = ['name' => 'Power Donor', 'icon' => 'lightning-bolt', 'color' => '#4f46e5', 'bg' => '#e0e7ff', 'unlocked' => false];
if ($totalDonations >= 12) $badges[] = ['name' => 'Regular Giver', 'icon' => 'clock', 'color' => '#ef4444', 'bg' => '#fee2e2', 'unlocked' => true];
else $badges[] = ['name' => 'Regular Giver', 'icon' => 'clock', 'color' => '#ef4444', 'bg' => '#fee2e2', 'unlocked' => false];


$news = [
    ['title' => 'New Community Center Opens', 'content' => 'Thanks to your donations, we\'ve opened a new community center in the east district.', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
    ['title' => 'Record Fundraising Month', 'content' => 'Last month was our most successful fundraising period ever!', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks'))],
    ['title' => 'Volunteer Recognition Awards', 'content' => 'Nominations are now open for our annual volunteer recognition awards.', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 month'))]
];

$stmt = $pdo->prepare("INSERT INTO visitor_logs (ip_address, page_visited) VALUES (?, ?)");
$stmt->execute([$_SERVER['REMOTE_ADDR'], 'dashboard']);

require_once 'pages/includes/Header.php';
?>

<main class="dashboard">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div>
                <h2>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h2>
                <div class="registration-tag">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?php echo htmlspecialchars($user['registration_number']); ?>
                </div>
            </div>
            <div>
                <a href="donate" class="btn-primary">Make a Donation</a>
            </div>
        </div>
        
        <div class="dashboard-grid">
            <div class="dashboard-card profile-card">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Your Profile
                </h3>
                <div class="avatar-container">
                    <div class="avatar">
                        <?php echo htmlspecialchars(strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1))); ?>
                        <div class="avatar-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="profile-info">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                    <p><strong>Status:</strong> <span class="status-active">Active Member</span></p>
                </div>

                <div class="profile-actions">
                    <a href="edit-profile" class="btn-secondary">Edit Profile</a>
                    <a href="change_password" class="btn-secondary">Change Password</a>
                </div>
            </div>
            
            <div class="dashboard-card donation-card">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Your Donations
                </h3>
                <div class="donation-total">
                    <p>Total Donated:</p>
                    <h4>Ghc<?php echo number_format($totalDonated, 2); ?></h4>
                </div>
                
                <?php if (!empty($totalDonations)): ?>
                    <div class="donation-history">
                        <h4>Donation History</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($totalDonations as $donation): ?>
                                    <tr>
                                        <td><?php echo date('M j, Y', strtotime($donation['donation_date'])); ?></td>
                                        <td>$<?php echo number_format($donation['amount'], 2); ?></td>
                                        <td><span class="status-complete">Complete</span></td>
                                        <td><a href="donation-receipt?id=<?php echo $donation['id']; ?>" class="receipt-link">View</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <?php if ($totalPages > 1): ?>
                            <div class="pagination">
                                <?php if ($page > 1): ?>
                                    <a href="?page=<?php echo $page - 1; ?>" class="page-link">&laquo;</a>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <?php if ($i == $page): ?>
                                        <span class="page-current"><?php echo $i; ?></span>
                                    <?php else: ?>
                                        <a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <?php if ($page < $totalPages): ?>
                                    <a href="?page=<?php echo $page + 1; ?>" class="page-link">&raquo;</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="no-donations">
                        <p>You haven't made any donations yet.</p>
                        <img draggable="false" src="src/images/empty.png" alt="No donations" class="empty-state-image">
                    </div>
                <?php endif; ?>
                
                <div class="donation-actions">
                    <a href="donate" class="btn-primary">Make a Donation</a>
                </div>
            </div>
            
            <div class="dashboard-card activity-card">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Recent Activity
                </h3>
                <ul class="activity-list">
                    <?php foreach ($activities as $activity): 
                        $type = strpos(strtolower($activity['action']), 'profile') !== false ? 'profile' : 
                              (strpos(strtolower($activity['action']), 'donation') !== false ? 'donation' : 'login');
                        
                        $iconColor = '';
                        $iconBg = '';
                        $icon = '';
                        
                        if($type == 'profile') {
                            $iconColor = '#4f46e5';
                            $iconBg = '#ddd6fe';
                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>';
                        }elseif ($type == 'donation') {
                            $iconColor = '#10b981';
                            $iconBg = '#d1fae5';
                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>';
                        }else {
                            $iconColor = '#2563eb';
                            $iconBg = '#dbeafe';
                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>';
                        }
                        
                        $activityTime = strtotime($activity['action_date']);
                        $timeDiff = time() - $activityTime;
                        
                        if ($timeDiff < 60){
                            $relativeTime = "just now";
                        } elseif ($timeDiff < 3600) {
                            $mins = floor($timeDiff / 60);
                            $relativeTime = $mins . " minute" . ($mins > 1 ? "s" : "") . " ago";
                        } elseif ($timeDiff < 86400) {
                            $hours = floor($timeDiff / 3600);
                            $relativeTime = $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
                        } elseif ($timeDiff < 604800) {
                            $days = floor($timeDiff / 86400);
                            $relativeTime = $days . " day" . ($days > 1 ? "s" : "") . " ago";
                        } elseif ($timeDiff < 2419200) {
                            $weeks = floor($timeDiff / 604800);
                            $relativeTime = $weeks . " week" . ($weeks > 1 ? "s" : "") . " ago";
                        } else {
                            $relativeTime = date('M j, Y', $activityTime);
                        }
                    ?>
                        <li class="activity-item">
                            <div class="activity-icon" style="background-color: <?php echo $iconBg; ?>; color: <?php echo $iconColor; ?>">
                                <?php echo $icon; ?>
                            </div>
                            <div class="activity-content">
                                <p><?php echo htmlspecialchars($activity['action']); ?></p>
                                <p class="activity-date"><?php echo $relativeTime; ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="dashboard-card stats-card">
                <div class="stats-header">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Donation Statistics
                    </h3>
                    <select id="timeRangeSelector" onchange="updateDonationChart(this.value)">
                        <option value="12">Last 12 Months</option>
                        <option value="6">Last 6 Months</option>
                        <option value="3">Last 3 Months</option>
                    </select>
                </div>
                <div class="stats-content">
                    <canvas id="donationChart" width="700" height="250"></canvas>
                </div>
            </div>
            
            <div class="dashboard-card event-card dah-e">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Upcoming Events
                </h3>
                <div class="event-list">
                <?php if (empty($events)): ?>
                    <div class="event-item">
                        <p class="event-date">June 15, 2025</p>
                        <h4 class="event-title">Annual Plastic Cleanup</h4>
                        <p class="event-description">Join us for our annual cleanup at Labadi Beach to fight ocean pollution.</p>
                        <p class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Labadi Beach, Accra
                        </p>
                    </div>
                    <div class="event-item">
                        <p class="event-date">July 8, 2025</p>
                        <h4 class="event-title">Community Volunteer Day</h4>
                        <p class="event-description">Support our tree planting and waste collection drive in Kumasi Central Park.</p>
                        <p class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Rattray Park, Kumasi
                        </p>
                    </div>
                    <div class="event-item">
                        <p class="event-date">August 10, 2025</p>
                        <h4 class="event-title">Youth Tech Workshop</h4>
                        <p class="event-description">Empowering Ghanaian youth through coding and digital skills training.</p>
                        <p class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pentecost University, Sowutuom
                        </p>
                    </div>
                    <div class="event-item">
                        <p class="event-date">August 22, 2025</p>
                        <h4 class="event-title">Donor Appreciation Lunch</h4>
                        <p class="event-description">Celebrating our generous donors who support our mission in Ghana.</p>
                        <p class="event-location">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Kempinski Hotel Gold Coast City, Accra
                        </p>
                    </div>
                <?php endif; ?>

                </div>
            </div>
            
            <div class="dashboard-card news-card">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Latest News
                </h3>
                <ul class="news-list">
                    <?php foreach ($news as $item): ?>
                        <li class="news-item">
                            <h4><?php echo htmlspecialchars($item['title']); ?></h4>
                            <p><?php echo htmlspecialchars($item['content']); ?></p>
                            <p class="news-date"><?php echo date('F j, Y', strtotime($item['created_at'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <div class="dashboard-grid impact-grid">
            <div class="dashboard-card impact-card">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Your Impact Summary
                </h3>
                <div class="impact-stats">
                    <div class="impact-stat">
                        <div class="impact-icon" style="background-color: #f0fdf4;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#10b981" width="40" height="40">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="impact-number"><?php echo 'Ghc' . number_format($totalDonated, 2); ?></div>
                        <div class="impact-label">Total Donations</div>
                    </div>
                    <div class="impact-stat">
                        <div class="impact-icon" style="background-color: #eff6ff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#3b82f6" width="40" height="40">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="impact-number"><?php echo number_format($peopleHelped); ?></div>
                        <div class="impact-label">People Helped</div>
                    </div>
                    <div class="impact-stat">
                        <div class="impact-icon" style="background-color: #fef2f2;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ef4444" width="40" height="40">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div class="impact-number"><?php echo number_format($projectsSupported); ?></div>
                        <div class="impact-label">Projects Supported</div>
                    </div>
                    <div class="impact-stat">
                        <div class="impact-icon" style="background-color: #eef2ff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4f46e5" width="40" height="40">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="impact-number"><?php echo number_format($volunteerHours); ?></div>
                        <div class="impact-label">Volunteer Hours</div>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-card badges-card">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    Your Badges
                </h3>
                <div class="badges-grid">
                    <?php foreach ($badges as $badge): ?>
                        <div class="badge-item <?php echo $badge['unlocked'] ? 'unlocked' : 'locked'; ?>">
                            <div class="badge-icon" style="color: <?php echo $badge['color']; ?>; background-color: <?php echo $badge['bg']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <?php if ($badge['icon'] == 'star'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    <?php elseif ($badge['icon'] == 'users'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    <?php elseif ($badge['icon'] == 'currency-dollar'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <?php elseif ($badge['icon'] == 'lightning-bolt'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    <?php elseif ($badge['icon'] == 'clock'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <?php endif; ?>
                                </svg>
                            </div>
                            <div class="badge-info">
                                <div class="badge-name"><?php echo htmlspecialchars($badge['name']); ?></div>
                                <?php if (!$badge['unlocked']): ?>
                                    <div class="badge-locked-message">Keep donating to unlock</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="cta-section">
            <div class="cta-content">
                <h3>Make a Bigger Impact</h3>
                <p>Your support means the world to those in need. Consider setting up a recurring donation to provide sustained help.</p>
            </div>
            <div class="cta-actions">
                <a href="volunteer" class="btn-secondary">Volunteer Your Time</a>
            </div>
        </div>
    </div>
</main>

<!-- JavaScript for the interactive donation chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    const donationData = {
        labels: [
            <?php 
                for ($i = 11; $i >= 0; $i--) {
                    echo "'" . date('M Y', strtotime("-$i months")) . "',";
                }
            ?>
        ],
        datasets: [{
            label: 'Monthly Donations',
            data: [
                <?php
                    echo rand(10, 50) . ',';
                    echo rand(10, 50) . ',';
                    echo rand(10, 50) . ',';
                    echo rand(20, 60) . ',';
                    echo rand(20, 60) . ',';
                    echo rand(20, 60) . ',';
                    echo rand(30, 70) . ',';
                    echo rand(30, 70) . ',';
                    echo rand(40, 80) . ',';
                    echo rand(40, 80) . ',';
                    echo rand(50, 90) . ',';
                    echo rand(50, 100);
                ?>
            ],
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    };

    const ctx = document.getElementById('donationChart').getContext('2d');
    const donationChart = new Chart(ctx, {
        type: 'line',
        data: donationData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#111827',
                    bodyColor: '#4B5563',
                    borderColor: '#E5E7EB',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Ghc ' + context.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(156, 163, 175, 0.1)'
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Ghc ' + value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    function updateDonationChart(months) {
        const labels = [];
        const data = [];
        
        for (let i = months - 1; i >= 0; i--) {
            const date = new Date();
            date.setMonth(date.getMonth() - i);
            labels.push(date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' }));
            
            data.push(Math.floor(Math.random() * (100 - 10 + 1)) + 10);
        }
        
        donationChart.data.labels = labels;
        donationChart.data.datasets[0].data = data;
        donationChart.update();
    }
</script>

<?php require_once 'pages/includes/Footer.php'; ?>