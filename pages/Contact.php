<?php
$pageTitle = "Contact Us";
require_once 'pages/includes/Header.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $success = true;
        
    }
}
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have questions or suggestions? Get in touch with our team.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Our Information</h2>
                    <p><i class="fas fa-map-marker-alt"></i> Pentecost University, Accra, Ghana</p>
                    <p><i class="fas fa-phone"></i> +233 24 463 7060</p>
                    <p><i class="fas fa-envelope"></i> info@plasticpollutions.com</p>
                    
                    <div class="social-links">
                        <h3>Follow Us</h3>
                        <a href="https://x.com/iam_Gorden" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/gordenarcher/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="contact-form">
                    <?php if ($success): ?>
                        <div class="alert alert-success enhanced-success">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Success Icon" class="success-icon">
                            <div class="success-text">
                                <h3>Message Sent Successfully!</h3>
                                <p>Thanks for getting in touch with us. We&apos;ve received your message and will respond shortly. In the meantime, feel free to explore more on our site!</p>
                            </div>
                        </div>

                    <?php else: ?>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-error"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <h2>Send Us a Message</h2>
                        <form action="contact" method="POST">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Send Message</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'pages/includes/Footer.php'; ?>