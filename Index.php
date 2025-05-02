<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="src/assets/css/Style.css?v=1.0">
</head>
<body>
<?php
$pageTitle = "Home";
require_once 'server/Header.php';

// Track visitor
require_once 'server/Functions.php';
// logVisitor();

// Get visitor count
$stmt = $pdo->query("SELECT COUNT(DISTINCT ip_address) as count FROM visitor_logs");
$visitorCount = $stmt->fetch()['count'];
?>

<main>
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Join the Fight Against Plastic Pollution</h2>
                <p>Every year, millions of tons of plastic end up in our oceans, harming marine life and ecosystems. Together, we can make a difference.</p>
                <button id="signUpBtn" class="btn-primary">Sign Up Now</button>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="section-header">
                <h2>About PlasticPollutions</h2>
                <p>We are a group of passionate individuals dedicated to reducing plastic waste and its impact on our environment.</p>
            </div>
            <div class="about-grid">
                <div class="about-card">
                    <i class="fas fa-recycle"></i>
                    <h3>Promote Recycling</h3>
                    <p>Only 5% of plastic is recycled. We're working to increase this number through education and initiatives.</p>
                </div>
                <div class="about-card">
                    <i class="fas fa-ban"></i>
                    <h3>Reduce Single-Use</h3>
                    <p>We campaign against non-essential single-use plastics that end up in landfills and oceans.</p>
                </div>
                <div class="about-card">
                    <i class="fas fa-hand-holding-water"></i>
                    <h3>Protect Oceans</h3>
                    <p>Our goal is to stop plastic waste from harming marine life and polluting our oceans.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="image-slider">
        <div class="container">
            <h2>Plastic Pollution in Focus</h2>
            <div class="slider">
                <div class="slide active">
                    <img src="assets/images/slide1.jpg" alt="Plastic waste on beach">
                    <div class="slide-caption">
                        <h3>Beach Pollution</h3>
                        <p>Millions of tons of plastic waste wash up on beaches worldwide each year.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="assets/images/slide2.jpg" alt="Marine animal affected by plastic">
                    <div class="slide-caption">
                        <h3>Marine Life at Risk</h3>
                        <p>Over 100,000 marine animals die each year from plastic entanglement or ingestion.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="assets/images/slide3.jpg" alt="Plastic recycling facility">
                    <div class="slide-caption">
                        <h3>Recycling Solutions</h3>
                        <p>Proper recycling can significantly reduce plastic pollution when done correctly.</p>
                    </div>
                </div>
                <div class="slider-controls">
                    <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
                    <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="twitter-feed">
        <div class="container">
            <h2>Latest from Twitter</h2>
            <a class="twitter-timeline" href="https://twitter.com/<?php echo TWITTER_USERNAME; ?>" data-tweet-limit="3" data-chrome="nofooter noborders noheader">Tweets by <?php echo TWITTER_USERNAME; ?></a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </section>

    <section class="visitor-counter">
        <div class="container">
            <p>Join our <span><?php echo $visitorCount; ?></span> visitors who care about plastic pollution</p>
        </div>
    </section>
</main>

<!-- Sign Up Modal -->
<div class="modal" id="signUpModal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2>Sign Up Now</h2>
        <form id="signupForm" action="server/pages/register.php" method="POST">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn-primary">Sign Up</button>
        </form>
    </div>
</div>

<?php require_once 'server/footer.php'; ?>
</body>
</html>