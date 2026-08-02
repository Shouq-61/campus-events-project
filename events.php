<?php
require_once 'includes/header.php';
require_once 'data/events.php';
?>

<main class="events-mainpage">
    <section class="events-heading">
        <h1>Events Page</h1>
    <p>
        On this page, you will find all types of events, including current events and upcoming ones.
         After selecting an event, you will be taken to the event details page.
    </p>
    </section>

    <section class="events-div">
        <?php foreach ($events as $event): ?>
            <article class="event-div">
                <img
                    src="assets/images/<?php echo htmlspecialchars($event['image']); ?>"
                    alt="<?php echo htmlspecialchars($event['title']); ?>"
                >

                <div class="event-div-content">
                    <span class="event-type">
                        <?php echo htmlspecialchars($event['type']); ?>
                    </span>
                    <h2>
                        <?php echo htmlspecialchars($event['title']); ?>
                    </h2>
                    <p>
                        <strong>Date:</strong>
                        <?php echo htmlspecialchars($event['date']); ?>
                    </p>
                    <p>
                        <strong>Time:</strong>
                        <?php echo htmlspecialchars($event['time']); ?>
                    </p>
                    <p>
                        <strong>Location:</strong>
                        <?php echo htmlspecialchars($event['location']); ?>
                    </p>
                    <a
                        class="viewdetails-button"
                        href="event-details.php?id=<?php echo urlencode($event['id']); ?>"
                    >
                        View Details
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>