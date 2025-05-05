<?php
$pageTitle = "How You Can Help";
require_once 'pages/includes/Header.php';
require_once 'pages/includes/Functions.php';
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>How You Can Help</h1>
            <p>Discover ways to get involved in the fight against plastic pollution</p>
        </div>
    </section>

    <section class="help-section">
        <div class="help-container">
            <div class="help-options">
                <div class="help-card">
                    <div class="help-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Donate</h3>
                    <p>Your financial support helps fund our campaigns, cleanups, and education programs.</p>
                    <a href="donate" class="btn-primary">Donate Now</a>
                </div>
                
                <div class="help-card">
                    <div class="help-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3>Volunteer</h3>

                    <p>Join our team of volunteers for cleanups, events, and awareness campaigns.</p>
                    <div>
                        <a href="contact" class="btn-primary">Volunteer</a>
                    </div>
                </div>
                
                <div class="help-card">
                    <div class="help-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Join Our Community</h3>
                    <p>Become a member to stay updated and connect with like-minded individuals.</p>
                    <?php if (isLoggedIn()): ?>
                            <a href="dashboard" class="btn-primary">Dashboard</a>
                        <?php else: ?>
                            <a href="register" class="btn-primary">Join Us</a>
                        <?php endif; ?>
                    
                </div>
            </div>
            
            <div class="lifestyle-changes">
                <h2>Lifestyle Changes to Reduce Plastic Use</h2>
                <div class="changes-grid">
                    <div class="change-card">
                        <h3>At Home</h3>
                        <ul>
                            <li>Use reusable shopping bags</li>
                            <li>Choose products with minimal packaging</li>
                            <li>Install a water filter instead of buying bottled water</li>
                            <li>Use glass or metal containers for storage</li>
                        </ul>
                    </div>
                    
                    <div class="change-card">
                        <h3>At Work</h3>
                        <ul>
                            <li>Bring your own reusable cup and utensils</li>
                            <li>Encourage plastic-free office policies</li>
                            <li>Set up recycling stations</li>
                            <li>Choose sustainable office supplies</li>
                        </ul>
                    </div>
                    
                    <div class="change-card">
                        <h3>On the Go</h3>
                        <ul>
                            <li>Carry a reusable water bottle</li>
                            <li>Say no to plastic straws and cutlery</li>
                            <li>Choose restaurants that use sustainable packaging</li>
                            <li>Bring your own takeout containers</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="advocacy-section">
                <h2>Become an Advocate</h2>
                <p>Help spread awareness and influence change in your community:</p>
                
                <div class="advocacy-steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Educate Yourself</h3>
                        <p>Learn about plastic pollution issues and solutions from reliable sources.</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Start Conversations</h3>
                        <p>Talk to friends, family, and colleagues about reducing plastic use.</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Engage Businesses</h3>
                        <p>Encourage local businesses to reduce plastic packaging and offer alternatives.</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">4</div>
                        <h3>Contact Officials</h3>
                        <p>Urge your representatives to support policies that reduce plastic pollution.</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">5</div>
                        <h3>Share on Social Media</h3>
                        <p>Amplify the message by sharing facts and tips with your network.</p>
                    </div>
                </div>
                
                <div class="social-share">
                    <h3>Share This Page</h3>
                    <div class="share-buttons">
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'pages/includes/Footer.php'; ?>