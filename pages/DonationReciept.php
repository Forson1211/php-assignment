<?php
require_once 'pages/includes/Config.php';
require_once 'pages/includes/Functions.php';

if (!isLoggedIn()) {
    redirect('login');
}

$pageTitle = "Donation Receipt";

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$donorName = $user ? htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) : 'Unknown';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    redirect('dashboard');
}

$stmt = $pdo->prepare("SELECT * FROM donations WHERE id = ?");
$stmt->execute([$_GET['id']]);
$donation = $stmt->fetch();

if (!$donation) {
    redirect('dashboard');
}

$amountDonated = isset($donation['amount']) ? number_format($donation['amount'], 2) : '0.00';
$donationDate = isset($donation['donation_date']) ? date('M j, Y', strtotime($donation['donation_date'])) : 'N/A';
$paymentMethod = isset($donation['payment_method']) ? htmlspecialchars($donation['payment_method']) : 'N/A';
$status = isset($donation['status']) ? ucfirst($donation['status']) : 'Unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .receipt-container {
            width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eeeeee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .receipt-header h1 {
            font-size: 30px;
            color: #333;
            font-weight: 600;
        }

        .receipt-header img {
            height: 50px;
        }

        .receipt-details {
            margin-bottom: 20px;
        }

        .receipt-details p {
            font-size: 18px;
            margin: 12px 0;
            color: #555;
        }

        .receipt-details p strong {
            color: #333;
        }

        .status-complete {
            color: green;
            font-weight: bold;
        }

        .receipt-footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #eeeeee;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .total-amount {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        @media (max-width: 768px) {
            .receipt-container {
                width: 90%;
            }

            .receipt-header h1 {
                font-size: 24px;
            }

            .receipt-details p {
                font-size: 16px;
            }

            .total-amount {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<section class="receipt-section">
    <div class="receipt-container">

        <div class="receipt-header">
            <h1>Donation Receipt</h1>
            <img src="logo.png" alt="Logo">
        </div>

        <div class="receipt-details">
            <p><strong>Donor Name:</strong> <?php echo $donorName; ?></p>
            <p><strong>Donation Date:</strong> <?php echo $donationDate; ?></p>
            <p><strong>Payment Method:</strong> <?php echo $paymentMethod; ?></p>
            <p><strong>Status:</strong> <span class="status-complete">Complete</span></p>
            <p class="total-amount"><strong>Amount Donated:</strong> Ghc <?php echo $amountDonated; ?></p>
        </div>

        <div class="receipt-footer">
            <p>Thank you for your generous donation!</p>
            <p>If you have any questions, please feel free to contact us.</p>
        </div>

        <div class="back-link">
            <a href="dashboard">Back to Dashboard</a>
        </div>

    </div>
</section>

</body>
</html>
