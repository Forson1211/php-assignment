<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    echo "<p>This paragraph is styled with external CSS.</p>";
    ?>
</body>
</html>
<?php
$pageTitle = "About Plastic";
require_once 'header.php';
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>What to Do About Plastic</h1>
            <p>Learn about the different types of plastic and how you can help reduce plastic pollution.</p>
        </div>
    </section>

    <section class="plastic-types">
        <div class="container">
            <h2>Types of Plastic</h2>
            <div class="plastic-grid">
                <div class="plastic-card">
                    <h3>PET (1)</h3>
                    <p>Polyethylene Terephthalate - Used in water bottles and food containers. Highly recyclable.</p>
                </div>
                <div class="plastic-card">
                    <h3>HDPE (2)</h3>
                    <p>High-Density Polyethylene - Used in milk jugs and detergent bottles. Easily recycled.</p>
                </div>
                <div class="plastic-card">
                    <h3>PVC (3)</h3>
                    <p>Polyvinyl Chloride - Used in pipes and packaging. Difficult to recycle.</p>
                </div>
                <div class="plastic-card">
                    <h3>LDPE (4)</h3>
                    <p>Low-Density Polyethylene - Used in plastic bags and wraps. Recycled at special facilities.</p>
                </div>
                <div class="plastic-card">
                    <h3>PP (5)</h3>
                    <p>Polypropylene - Used in yogurt containers and bottle caps. Recyclable in some areas.</p>
                </div>
                <div class="plastic-card">
                    <h3>PS (6)</h3>
                    <p>Polystyrene - Used in disposable cups and packaging. Rarely recycled.</p>
                </div>
                <div class="plastic-card">
                    <h3>Other (7)</h3>
                    <p>Mixed plastics - Includes polycarbonate and bioplastics. Generally not recycled.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="donate-section">
        <div class="container">
            <div class="donate-content">
                <h2>Donate to End Plastic Pollution</h2>
                <p>Your donation helps us campaign against plastic pollution, educate communities, and push for policy changes.</p>
                <a href="donate.php" class="btn-primary">Donate Now</a>
            </div>
        </div>
    </section>

    <section class="petition-section">
        <div class="container">
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
                    <p>Please <a href="/server/pages/login.php">login</a> or <a href="register.php">register</a> to sign our petition.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<style>
    .page-header {
        background: linear-gradient(to right, #56ccf2, #2f80ed);
        color: white;
        padding: 60px 0;
        text-align: center;
        border-radius: 0 0 40px 40px;
    }

    .plastic-types {
        padding: 60px 20px;
        background-color: #f7f9fc;
    }

    .plastic-types h2 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 40px;
        color: #2c3e50;
    }

    .plastic-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .plastic-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .plastic-card:hover {
        transform: translateY(-5px);
    }

    .plastic-card h3 {
        font-size: 1.2rem;
        color: #2f80ed;
        margin-bottom: 10px;
    }

    .plastic-card p {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .donate-section,
    .petition-section {
        padding: 60px 20px;
        text-align: center;
    }

    .donate-section {
        background: #2f80ed;
        color: white;
    }

    .donate-content h2,
    .petition-content h2 {
        font-size: 2rem;
        margin-bottom: 20px;
    }

    .donate-content p,
    .petition-content p {
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .btn-primary {
        display: inline-block;
        background-color: #56ccf2;
        color: white;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2f80ed;
    }

    .petition-section {
        background-color: #f0f4f8;
    }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    #agreePetition {
        transform: scale(1.2);
    }

    .petition-content a {
        color: #2f80ed;
        text-decoration: underline;
    }

    .petition-content a:hover {
        color: #1a5edb;
    }
</style>


<?php require_once 'footer.php'; ?>