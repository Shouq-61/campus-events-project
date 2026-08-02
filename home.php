
<?php
require_once 'includes/header.php';
require_once 'data/events.php';

$featuredEvents = array_slice($events, 0, 3);
?>

<main class="home-section">
    <section class="home-intro">
        <h1>Welcome to our main Campus Events Center</h1>
        <p>
        This is the homepage for our project, and it will enable students to 
        learn more about the center and access university events as they happen.
    </p>
    </section>
    <section class="featured-section">
        <h2>Featured Campus Events</h2>
        <div class="events-divs">
            <?php foreach ($featuredEvents as $event): ?>

               <article class="event-container">
                    <img
                        src="assets/images/<?php echo htmlspecialchars($event['image']); ?>"
                        alt="<?php echo htmlspecialchars($event['title']); ?>"
                    >

                    <div class="event-content">
                        <span class="event-type">
                            <?php echo htmlspecialchars($event['type']); ?>
                        </span>

                        <h3>
                            <?php echo htmlspecialchars($event['title']); ?>
                        </h3>

                        <p>
                            <strong>Date:</strong>
                            <?php echo htmlspecialchars($event['date']); ?>
                        </p>

                        <p>
                            <strong>Location:</strong>
                            <?php echo htmlspecialchars($event['location']); ?>
                        </p>

                        <a
                            class="details-button"
                            href="event-details.php?id=<?php echo $event['id']; ?>"
                        >
                            View Details
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <a class="events-link" href="events.php">
            Browse All Events
        </a>
    </section>
</main>
<?php require_once 'includes/footer.php'; ?>