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
require_once 'config.php';
require_once 'functions.php';

if (!isLoggedIn()) {
    $_SESSION['redirect_url'] = 'donate.php';
    redirect('login.php');
}

$pageTitle = "Make a Donation";
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $paymentMethod = sanitize($_POST['payment_method']);
    
    // Validate amount
    if (!is_numeric($amount) || $amount <= 0) {
        $error = 'Please enter a valid donation amount.';
    } else {
        // Process donation (in a real app, this would connect to a payment processor)
        $stmt = $pdo->prepare("INSERT INTO donations (user_id, amount) VALUES (?, ?)");
        $result = $stmt->execute([$_SESSION['user_id'], $amount]);
        
        if ($result) {
            $success = true;
            
            // Send confirmation email (simulated)
            $to = $_SESSION['user_email'];
            $subject = 'Thank you for your donation';
            $message = "Dear " . $_SESSION['user_name'] . ",\n\nThank you for your generous donation of GHS " . number_format($amount, 2) . " to PlasticPollutions.\n\nYour support helps us continue our work to reduce plastic pollution.\n\nSincerely,\nThe PlasticPollutions Team";
            $headers = 'From: no-reply@plasticpollutions.com';
            
            // In a real application, you would use mail() or a mailing library
            // mail($to, $subject, $message, $headers);
        } else {
            $error = 'There was an error processing your donation. Please try again.';
        }
    }
}

require_once 'includes/header.php';
?>

<main>
    <section class="page-header">
        <div class="container">
            <h1>Make a Donation</h1>
            <p>Your support helps us fight plastic pollution</p>
        </div>
    </section>

    <section class="donation-section">
        <div class="container">
            <?php if ($success): ?>
                <div class="donation-success">
                    <h2>Thank You for Your Donation!</h2>
                    <p>Your generous contribution of GHS <?php echo number_format($amount, 2); ?> will help us continue our important work against plastic pollution.</p>
                    <p>A receipt has been sent to your email address.</p>
                    <a href="dashboard.php" class="btn-primary">View Your Donation History</a>
                </div>
            <?php else: ?>
                <div class="donation-form-container">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-error"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="donate.php" method="POST" class="donation-form">
                        <div class="form-group">
                            <label for="amount">Donation Amount (GHS)</label>
                            <input type="number" id="amount" name="amount" min="1" step="0.01" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Payment Method</label>
                            <div class="payment-methods">
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="mobile_money" checked>
                                    <div class="payment-content">
                                        <i class="fas fa-mobile-alt"></i>
                                        <span>Mobile Money</span>
                                    </div>
                                </label>
                                
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="credit_card">
                                    <div class="payment-content">
                                        <i class="far fa-credit-card"></i>
                                        <span>Credit Card</span>
                                    </div>
                                </label>
                                
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="bank_transfer">
                                    <div class="payment-content">
                                        <i class="fas fa-university"></i>
                                        <span>Bank Transfer</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="donation-options">
                            <h3>Suggested Donation Amounts</h3>
                            <div class="amount-options">
                                <button type="button" class="amount-option" data-amount="20">GHS 20</button>
                                <button type="button" class="amount-option" data-amount="50">GHS 50</button>
                                <button type="button" class="amount-option" data-amount="100">GHS 100</button>
                                <button type="button" class="amount-option" data-amount="200">GHS 200</button>
                                <button type="button" class="amount-option" data-amount="500">GHS 500</button>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-primary">Complete Donation</button>
                    </form>
                    
                    <div class="donation-info">
                        <h3>How Your Donation Helps</h3>
                        <ul>
                            <li><strong>GHS 20</strong> - Provides educational materials for 5 students</li>
                            <li><strong>GHS 50</strong> - Supports a beach cleanup for 10 volunteers</li>
                            <li><strong>GHS 100</strong> - Funds an awareness campaign in a local community</li>
                            <li><strong>GHS 200</strong> - Helps lobby for policy changes at the municipal level</li>
                            <li><strong>GHS 500+</strong> - Contributes to large-scale research and initiatives</li>
                        </ul>
                        
                        <div class="trust-badges">
                            <div class="trust-badge">
                                <i class="fas fa-lock"></i>
                                <span>Secure Payments</span>
                            </div>
                            <div class="trust-badge">
                                <i class="fas fa-receipt"></i>
                                <span>Tax-Deductible</span>
                            </div>
                            <div class="trust-badge">
                                <i class="fas fa-shield-alt"></i>
                                <span>Verified Nonprofit</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set amount when clicking suggested amounts
    const amountOptions = document.querySelectorAll('.amount-option');
    const amountInput = document.getElementById('amount');
    
    amountOptions.forEach(option => {
        option.addEventListener('click', function() {
            const amount = this.getAttribute('data-amount');
            amountInput.value = amount;
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>