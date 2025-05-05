<?php
$pageTitle = "Home | PlasticPollution Awareness";
require_once 'pages/includes/Header.php';
require_once 'pages/includes/Functions.php';

$stmt = $pdo->query("SELECT COUNT(DISTINCT ip_address) as count FROM visitor_logs");
$visitorCount = number_format($stmt->fetch()['count']);

$articles = [
    [
        'title' => "New Study Reveals Microplastics in Human Blood",
        'summary' => "Groundbreaking research shows microplastics have entered the human bloodstream, with unknown health effects.",
    ],
    [
        'title' => "Global Plastic Treaty Negotiations Begin",
        'summary' => "UN member states gather to draft a legally binding agreement on plastic pollution by 2024.",
    ],
    [
        'title' => "Innovative Enzyme Breaks Down Plastic in Hours",
        'summary' => "Scientists discover enzyme variant that can decompose PET plastic in just 24 hours.",
    ]
];

$events = [
    [
        'event_name' => "Beach Cleanup Day",
        'event_date' => "2025-06-08",
        'location' => "Labadi Beach, Gh"
    ],
    [
        'event_name' => "Plastic-Free Living Workshop",
        'event_date' => "2025-06-15",
        'location' => "Online"
    ],
    [
        'event_name' => "Sustainable Packaging Expo",
        'event_date' => "2025-07-22",
        'location' => "Takoradi, Gh"
    ]
];
?>

<main>
    <section class="hero">
        <div class="hero-video">
            <video autoplay muted loop>
                <source src="src/images/videos/bgVid.mp4" type="video/mp4">
            </video>
            <div class="video-overlay"></div>
        </div>

        <div class="hero-container">
            <div class="hero-content">
                <h1 id="typewriter"></h1>
                <p class="lead">Every minute, the equivalent of a garbage truck full of plastic enters our oceans. By 2050, there could be more plastic than fish in the sea. Your actions matter.</p>
                <div class="hero-cta">
                    <button id="signUpBtn" class="btn-primary">Join Our Movement</button>
                    <a href="#take-action" class="btn-primary">Take Action Now</a>
                </div>
                <div class="impact-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo $visitorCount; ?></span>
                        <span class="stat-label">Supporters Worldwide</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">8M+</span>
                        <span class="stat-label">Tons of Plastic in Oceans</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">700+</span>
                        <span class="stat-label">Marine Species Affected</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-facts">
        <div class="facts-container">
            <h2 class="section-title">The Plastic Problem in Numbers</h2>
            <div class="facts-grid">
                <div class="fact-card">
                    <div class="fact-icon">♻️</div>
                    <div class="fact-content">
                        <h3>Recycling Reality</h3>
                        <p>Only <strong>9%</strong> of all plastic ever produced has been recycled.</p>
                    </div>
                </div>
                <div class="fact-card">
                    <div class="fact-icon">⏳</div>
                    <div class="fact-content">
                        <h3>Longevity</h3>
                        <p>A plastic bottle takes <strong>450 years</strong> to decompose in the ocean.</p>
                    </div>
                </div>
                <div class="fact-card">
                    <div class="fact-icon">🛒</div>
                    <div class="fact-content">
                        <h3>Daily Consumption</h3>
                        <p>Humans ingest about <strong>5 grams</strong> of microplastics weekly.</p>
                    </div>
                </div>
                <div class="fact-card">
                    <div class="fact-icon">💰</div>
                    <div class="fact-content">
                        <h3>Economic Impact</h3>
                        <p>Plastic pollution costs <strong>$13 billion</strong> in marine ecosystem damage annually.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-container">
            <div class="section-header">
                <h2 class="section-title">Our Mission at PlasticPollutions</h2>
                <p class="section-subtitle">We're a global network of scientists, activists, and concerned citizens working to eliminate plastic pollution through education, innovation, and policy change.</p>
            </div>
            <div class="about-grid">
                <div class="about-card">
                    <div class="card-icon"><i class="fas fa-recycle"></i></div>
                    <h3>Circular Economy</h3>
                    <p>We develop and promote closed-loop systems where plastic never becomes waste.</p>
                    <a href="/recycling" class="learn-more">Learn more →</a>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fas fa-ban"></i></div>
                    <h3>Policy Advocacy</h3>
                    <p>We lobby governments and corporations to phase out unnecessary single-use plastics.</p>
                    <a href="/policy" class="learn-more">Learn more →</a>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fas fa-flask"></i></div>
                    <h3>Innovation Hub</h3>
                    <p>We fund research into biodegradable alternatives and advanced recycling technologies.</p>
                    <a href="/innovation" class="learn-more">Learn more →</a>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fas fa-users"></i></div>
                    <h3>Community Action</h3>
                    <p>We organize cleanups and educational programs in over 50 countries worldwide.</p>
                    <a href="/community" class="learn-more">Learn more →</a>
                </div>
            </div>
        </div>
    </section>

    <section class="pollution-map">
        <div class="pollution-container">
            <h2 class="section-title">Global Plastic Pollution Hotspots</h2>
            <div class="map-container">
                <div id="worldMap" class="world-map">
                    <img src="src/images/world.webp" alt="World Map" usemap="#worldMap">
                    <map name="worldMap">
                        <area shape="circle" coords="750,180,30" href="#" data-region="pacific" alt="Great Pacific Garbage Patch">
                        <area shape="circle" coords="450,220,20" href="#" data-region="mediterranean" alt="Mediterranean Sea">
                        <area shape="circle" coords="850,300,25" href="#" data-region="indonesia" alt="Indonesian Archipelago">
                    </map>
                    
                </div>
                <div class="map-info">
                    <h3 id="mapRegion">Select a region</h3>
                    <p id="mapDescription">Click on highlighted areas to learn about plastic pollution in different regions.</p>
                    <div class="map-stats" id="mapStats">
                        <div class="stat">
                            <span class="stat-value" id="plasticDensity">-</span>
                            <span class="stat-label">Pieces/km²</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value" id="cleanupEfforts">-</span>
                            <span class="stat-label">Cleanup Projects</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="image-slider">
        <div class="image-container">
            <h2 class="section-title">Plastic Pollution in Focus</h2>
            <div class="slider-container">
                <div class="slider">
                    <div class="slide active" data-slide="1">
                        <img src="src/images/slider1.jpg" alt="Plastic waste on beach">
                        <div class="slide-caption">
                            <h3>Beach Pollution Crisis</h3>
                            <p>Over 73% of beach litter worldwide is plastic. Our volunteers have removed 2.4 million kg from coastlines last year.</p>
                            <a href="contact" class="btn-slide">Join a Cleanup</a>
                        </div>
                    </div>
                    <div class="slide" data-slide="2">
                        <img src="src/images/slider2.jpg" alt="Marine animal affected by plastic">
                        <div class="slide-caption">
                            <h3>Marine Life in Peril</h3>
                            <p>90% of seabirds have plastic in their stomachs. Our research team is tracking the impact on 120 endangered species.</p>
                            <a href="donate" class="btn-slide">Support Research</a>
                        </div>
                    </div>
                    <div class="slide" data-slide="3">
                        <img src="src/images/slider3.jpg" alt="Plastic recycling facility">
                        <div class="slide-caption">
                            <h3>Innovative Solutions</h3>
                            <p>Our newest recycling facility can process previously unrecyclable plastics into durable building materials.</p>
                            <a href="/recycling-tech" class="btn-slide">Learn About Tech</a>
                        </div>
                    </div>
                    <div class="slide" data-slide="4">
                        <img src="assets/images/slide4.jpg" alt="Community education program">
                        <div class="slide-caption">
                            <h3>Education Programs</h3>
                            <p>We've educated over 500,000 students worldwide about sustainable alternatives to single-use plastics.</p>
                            <a href="/education" class="btn-slide">Bring to Your School</a>
                        </div>
                    </div>
                </div>
                <div class="slider-controls">
                    <button id="prev-slide"><i class="fas fa-chevron-left"></i></button>
                    <div class="slide-indicators"></div>
                    <button id="next-slide"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="take-action" id="take-action">
        <div class="takeAction-container">
            <h2 class="section-title">How You Can Make a Difference</h2>
            <div class="action-tabs">
                <div class="tab-buttons">
                    <button class="tab-button active" data-tab="individual">Individuals</button>
                    <button class="tab-button" data-tab="business">Businesses</button>
                    <button class="tab-button" data-tab="educator">Educators</button>
                </div>
                <div class="tab-content active" data-tab="individual">
                    <div class="action-card">
                        <h3><i class="fas fa-home"></i> At Home</h3>
                        <ul>
                            <li>Switch to reusable containers and bottles</li>
                            <li>Choose products with minimal packaging</li>
                            <li>Properly sort your recycling</li>
                        </ul>
                    </div>
                    <div class="action-card">
                        <h3><i class="fas fa-shopping-bag"></i> Shopping</h3>
                        <ul>
                            <li>Bring your own bags and containers</li>
                            <li>Support plastic-free brands</li>
                            <li>Choose natural fiber clothing</li>
                        </ul>
                    </div>
                    <div class="action-card">
                        <h3><i class="fas fa-hands-helping"></i> Community</h3>
                        <ul>
                            <li>Join local cleanup events</li>
                            <li>Advocate for plastic reduction policies</li>
                            <li>Educate friends and family</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" data-tab="business">
                </div>
                <div class="tab-content" data-tab="educator">
                </div>
            </div>
        </div>
    </section>

    <section class="news-events">
        <div class="news-container">
            <div class="news-section">
                <h2 class="section-title">Latest News</h2>
                <div class="news-grid">
                    <?php foreach ($articles as $article): ?>
                    <article class="news-card ec">
                        <div class="news-content">
                            <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                            <p><?php echo htmlspecialchars($article['summary']); ?></p>
                            <a href="latest" class="read-more">Read More</a>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                <a href="news" class="view-all">View All News →</a>
            </div>
            
            <div class="events-section">
                <h2 class="section-title">Upcoming Events</h2>
                <div class="events-list">
                    <?php foreach ($events as $event): ?>
                    <div class="event-card ec">
                        <div class="event-date">
                            <span class="event-day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                            <span class="event-month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                        </div>
                        <div class="event-details">
                            <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                           
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="social-feed">
        <div class="social-container">
            <h2 class="section-title">Join the Conversation</h2>
            <div class="social-grid">
                <div class="twitter-feed">
                    <h3><i class="fab fa-twitter"></i> Twitter Updates</h3>
                    <div class="twitter-container">
                        <blockquote class="twitter-tweet">
                            <p lang="en" dir="ltr">Breaking: Major corporation pledges to eliminate single-use plastics by 2025 following our campaign! <a href="https://t.co/example">pic.twitter.com/example</a></p>&mdash; PlasticPollutions (@PlasticPollution) <a href="https://twitter.com/PlasticPollution/status/123456789">May 5, 2025</a>
                        </blockquote>
                    </div>
                </div>
                <div class="instagram-feed">
                    <h3><i class="fab fa-instagram"></i> Instagram</h3>
                    <div class="instagram-posts">
                        <div class="insta-placeholder">
                            <p>Follow us @PlasticPollutions for more updates</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="dashboard-header newsletter">
        <div class="newsletter-container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2>Stay Informed</h2>
                    <p>Subscribe to our newsletter for monthly updates, action alerts, and tips to reduce your plastic footprint.</p>
                </div>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit" class="btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
</main>

<div class="modal" id="signUpModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-header">
            <h2>Join Our Movement</h2>
            <p>Create your free account to access resources, track your impact, and connect with others.</p>
        </div>
        <div class="modal-body">
            <form id="signupForm" action="register" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required minlength="8">
                    <div class="password-strength">
                        <span class="strength-bar"></span>
                        <span class="strength-text">Password strength</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="form-group">
                    <label for="userType">I want to join as:</label>
                    <select id="userType" name="userType">
                        <option value="supporter">Supporter</option>
                        <option value="volunteer">Volunteer</option>
                        <option value="educator">Educator</option>
                        <option value="business">Business Representative</option>
                    </select>
                </div>
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="newsletterOptIn" name="newsletterOptIn" checked>
                    <label for="newsletterOptIn">Receive monthly newsletter and updates</label>
                </div>
                <button type="submit" class="btn-primary">Create Account</button>
                <div class="social-signup">
                    <p>Or sign up with:</p>
                    <div class="social-buttons">
                        <button type="button" class="btn-social google"><i class="fab fa-google"></i> Google</button>
                        <button type="button" class="btn-social facebook"><i class="fab fa-facebook-f"></i> Facebook</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <p>Already have an account? <a href="login">Log in</a></p>
        </div>
    </div>
</div>

<div class="impact-counter">
    <div class="counter-container">
        <div class="counter-item">
            <span class="counter" data-target="12457">0</span>
            <span class="counter-label">Plastic-Free Pledges</span>
        </div>
        <div class="counter-item">
            <span class="counter" data-target="3821">0</span>
            <span class="counter-label">Cleanups Organized</span>
        </div>
        <div class="counter-item">
            <span class="counter" data-target="568900">0</span>
            <span class="counter-label">Pounds of Waste Collected</span>
        </div>
        <div class="counter-item">
            <span class="counter" data-target="<?php echo $visitorCount; ?>"></span>
            <span class="counter-label">Active Supporters</span>
        </div>
    </div>
</div>

<?php require_once 'pages/includes/footer.php'; ?>

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / speed;
        
        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCounter, 1);
        } else {
            counter.innerText = target;
        }
        
        function updateCounter() {
            const count = +counter.innerText;
            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCounter, 1);
            } else {
                counter.innerText = target;
            }
        }
    });
});
</script>
</body>
</html>