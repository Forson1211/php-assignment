<?php
$pageTitle = "Our Campaigns";
require_once 'pages/includes/Header.php';
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Our Campaigns</h1>
            <p>Learn about our ongoing efforts to influence policy and reduce plastic pollution</p>
        </div>
    </section>

    <section class="campaigns-section">
        <div class="campaign-container">
            <div class="campaign-tabs">
                <button class="tab-btn active" data-tab="national">National</button>
                <button class="tab-btn" data-tab="local">Local</button>
                <button class="tab-btn" data-tab="education">Education</button>
            </div>

            <div class="campaign-content">
                <div class="tab-pane active" id="national">
                    <h2>National Campaigns</h2>
                    <div class="campaign-card">
                        <h3>Ban on Single-Use Plastics</h3>
                        <p>We're lobbying the government to implement a nationwide ban on non-essential single-use plastics like straws, cutlery, and styrofoam containers.</p>
                        <div class="campaign-progress">
                            <div class="progress-bar" style="width: 65%"></div>
                            <span>65% of goal reached</span>
                        </div>
                        <div>
                            <a href="donate" class="btn-primary">Support This Campaign</a>
                        </div>
                    </div>
                    
                    <div class="campaign-card">
                        <h3>Extended Producer Responsibility</h3>
                        <p>Advocating for legislation that makes manufacturers responsible for the entire lifecycle of their plastic products, including recycling and disposal.</p>
                        <div class="campaign-progress">
                            <div class="progress-bar" style="width: 40%"></div>
                            <span>40% of goal reached</span>
                        </div>
                        <div>
                                <a href="donate" class="btn-secondary">Support This Campaign</a>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="local">
                    <h2>Local Community Campaigns</h2>
                    <div class="campaign-card">
                        <h3>Beach Cleanup Initiative</h3>
                        <p>Monthly beach cleanups in coastal communities to remove plastic waste and educate locals about proper waste disposal.</p>
                        <div class="campaign-stats">
                            <p><strong>Last cleanup:</strong> Removed 1.2 tons of plastic waste</p>
                            <p><strong>Next event:</strong> May 15, 2025 at Labadi Beach</p>
                        </div>
                        <div>
                            <a href="help" class="btn-secondary">Join Next Cleanup</a>
                        </div>
                    </div>
                    
                    <div class="campaign-card">
                        <h3>Recycling Awareness</h3>
                        <p>Working with local schools and community centers to teach proper recycling techniques and establish collection points.</p>
                        <div class="campaign-stats">
                            <p><strong>Schools reached:</strong> 24</p>
                            <p><strong>Recycling bins installed:</strong> 58</p>
                        </div>
                        <div>
                            <a href="donate" class="btn-secondary">Volunteer</a>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="education">
                    <h2>Education and Awareness</h2>
                    <div class="campaign-card">
                        <h3>School Education Program</h3>
                        <p>Developing curriculum materials and workshops to teach children about the impacts of plastic pollution and sustainable alternatives.</p>
                        <div class="campaign-stats">
                            <p><strong>Schools participating:</strong> 15</p>
                            <p><strong>Students reached:</strong> 3,200+</p>
                        </div>
                        <div>
                            <a href="contact" class="btn-secondary">Request a Workshop</a>
                        </div>
                    </div>
                    
                    <div class="campaign-card">
                        <h3>Public Awareness Campaign</h3>
                        <p>Media campaigns including TV, radio, and social media to educate the public about reducing plastic use and proper disposal.</p>
                        <div class="campaign-stats">
                            <p><strong>Social media reach:</strong> 250,000+</p>
                            <p><strong>TV spots aired:</strong> 45</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
});
</script>

<?php require_once 'pages/includes/Footer.php'; ?>