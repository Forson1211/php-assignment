
<?php
$pageTitle = "About Plastic";
require_once 'pages/includes/Header.php';
?>

<div class="about_page">
    <section class="page-header">
        <div class="container">
            <h1>What to Do About Plastic</h1>
            <p>Learn about the different types of plastic and how you can help reduce plastic pollution.</p>
        </div>
    </section>

    <section class="plastic-types">
        <div class="plastic-container">
            <h2>Types of Plastic</h2>
            <div class="plastic-grid">
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- PET (1) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M9.5 1L7 7H1v9h6l-2.5 6L9.5 17h5L16 22l2.5-6H23V7h-6l2.5-6z"/></svg>
                    </div>
                    <h3>PET (1)</h3>
                    <p>Polyethylene Terephthalate - Used in water bottles and food containers. Highly recyclable.</p>
                </div>
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- HDPE (2) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M9 1v4H5v15h5v4h4v-4h5V5h-4V1z"/></svg>
                    </div>
                    <h3>HDPE (2)</h3>
                    <p>High-Density Polyethylene - Used in milk jugs and detergent bottles. Easily recycled.</p>
                </div>
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- PVC (3) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M20 10l-4 4 4 4-4 4h-4l-4-4 4-4H4l4-4-4-4h4l4 4 4-4h4z"/></svg>
                    </div>
                    <h3>PVC (3)</h3>
                    <p>Polyvinyl Chloride - Used in pipes and packaging. Difficult to recycle.</p>
                </div>
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- LDPE (4) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.89 2 1.99 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 14H9v-4h6v4z"/></svg>
                    </div>
                    <h3>LDPE (4)</h3>
                    <p>Low-Density Polyethylene - Used in plastic bags and wraps. Recycled at special facilities.</p>
                </div>
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- PP (5) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M17 2h-4V1h-4v1H7c-1.1 0-1.99.9-1.99 2L5 19c0 1.1.89 2 1.99 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 16H7V6h10v12z"/></svg>
                    </div>
                    <h3>PP (5)</h3>
                    <p>Polypropylene - Used in yogurt containers and bottle caps. Recyclable in some areas.</p>
                </div>
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- PS (6) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M17 2H7c-1.1 0-1.99.9-1.99 2L5 19c0 1.1.89 2 1.99 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 16H7V6h10v12z"/></svg>
                    </div>
                    <h3>PS (6)</h3>
                    <p>Polystyrene - Used in disposable cups and packaging. Rarely recycled.</p>
                </div>
                <div class="plastic-card">
                    <div class="plastic-icon">
                        <!-- Other (7) Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40"><path d="M20 5H4c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.89 2 1.99 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm-2 14H6V9h12v10z"/></svg>
                    </div>
                    <h3>Other (7)</h3>
                    <p>Mixed plastics - Includes polycarbonate and bioplastics. Generally not recycled.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="donate-section">
        <div class="don">
            <div class="donate-content">
                <h2>Donate to End Plastic Pollution</h2>
                <p>Your donation helps us campaign against plastic pollution, educate communities, and push for policy changes.</p>
                <a href="donate" class="btn-primary">Donate Now</a>
            </div>
        </div>
    </section>

    <section class="petition-section">
        <div class="containerpet">
            <div class="petition-content">
                <h2>Sign Our Petition</h2>
                <p>Join thousands of others in calling for stricter regulations on single-use plastics.</p>
                <?php if (isLoggedIn()): ?>
                    <form id="petitionForm">
                        <div class="form-group">
                            <input type="checkbox" id="agreePetition" required>
                            <label for="agreePetition">I support the campaign to reduce single-use plastics</label>
                        </div>
                        <button type="submit" class="btn-primary">Sign Petition</button>
                    </form>
                <?php else: ?>
                    <p>Please <a href="/php-assignment/login">login</a> or <a href="/php-assignment/register">register</a> to sign our petition.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>


<?php require_once 'pages/includes/footer.php'; ?>