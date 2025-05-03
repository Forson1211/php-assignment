<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Style.css?v=1.0">
<link rel="stylesheet" href="assets/css/mobile.css" media="screen and (max-width: 768px)">
</head>
<body>
    <?php
    echo "<p>This paragraph is styled with external CSS.</p>";
    ?>
</body>
</html>
<?php
$pageTitle = "Contact Us";
require_once 'header.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // In a real application, you would send an email here
        // For this example, we'll just simulate success
        $success = true;
        
        // You could also store the message in a database
        // $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        // $stmt->execute([$name, $email, $subject, $message]);
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
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Our Information</h2>
                    <p><i class="fas fa-map-marker-alt"></i> Pentecost University, Accra, Ghana</p>
                    <p><i class="fas fa-phone"></i> +233 24 463 7060</p>
                    <p><i class="fas fa-envelope"></i> info@plasticpollutions.com</p>
                    
                    <div class="social-links">
                        <h3>Follow Us</h3>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="contact-form">
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            Thank you for your message! We'll get back to you soon.
                        </div>
                    <?php else: ?>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-error"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <h2>Send Us a Message</h2>
                        <form action="contact.php" method="POST">
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

<?php require_once 'footer.php'; ?>