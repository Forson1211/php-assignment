<?php
require_once 'pages/includes/Config.php';
require_once 'pages/includes/Functions.php';

$pageTitle = "Latest News";

$news = [
    ['title' => 'New Community Center Opens', 'content' => 'Thanks to your donations, we\'ve opened a new community center in the east district.', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
    ['title' => 'Record Fundraising Month', 'content' => 'Last month was our most successful fundraising period ever!', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks'))],
    ['title' => 'Volunteer Recognition Awards', 'content' => 'Nominations are now open for our annual volunteer recognition awards.', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 month'))],
    ['title' => 'New Environmental Partnership', 'content' => 'We are proud to announce a new partnership with local environmental organizations to promote sustainable living.', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
    ['title' => 'Plastic-Free Campaign Launch', 'content' => 'Join us in our new initiative to eliminate single-use plastic in local communities starting this summer.', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 week'))],
    ['title' => 'Charity Run for Clean Oceans', 'content' => 'We are hosting a charity run to raise funds for ocean clean-up projects. Register now to participate!', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
    ['title' => 'New Recycling Facilities Opened', 'content' => 'With the help of your donations, we have opened two new recycling centers in the northern region.', 'created_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
    ['title' => 'Sustainable Schools Initiative', 'content' => 'We are launching a new program to educate school children about sustainability and the importance of protecting the environment.', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks'))],
    ['title' => 'Beach Cleanup Event Success', 'content' => 'Our recent beach cleanup event was a huge success, with hundreds of volunteers removing thousands of pounds of plastic waste from our shores.', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 month'))]
];

usort($news, function($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

require_once 'pages/includes/Header.php';
?>

<main>
    <section class="news-header">
        <div class="news-container">
            <h1>Latest News</h1>
            <p>Stay updated with the latest happenings and events at PlasticPollutions.</p>
        </div>
    </section>

    <section class="latest-news">
            <?php foreach ($news as $newsItem): ?>
                <div class="news-item">
                    <h2><?php echo htmlspecialchars($newsItem['title']); ?></h2>
                    <p class="news-date"><?php echo date('F j, Y', strtotime($newsItem['created_at'])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($newsItem['content'])); ?></p>
                </div>
            <?php endforeach; ?>
    </section>
</main>

<?php require_once 'pages/includes/footer.php'; ?>
