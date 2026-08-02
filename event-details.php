<?php
require_once 'data/events.php';
$eventId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$selectedEvent = null;

if ($eventId !== false && $eventId !== null) {
    foreach ($events as $event) {
        if ($event['id'] === $eventId) {
            $selectedEvent = $event;
            break;
        }
    }
}

require_once 'includes/header.php';
?>
<main class="event-details">
    <?php if ($selectedEvent !== null): ?>
        <article class="event-details-card">
            <img
                src="assets/images/<?php echo htmlspecialchars($selectedEvent['image']); ?>"
                alt="<?php echo htmlspecialchars($selectedEvent['title']); ?>"
            >

            <div class="event-details-content">
                <span class="event-type">
                    <?php echo htmlspecialchars($selectedEvent['type']); ?>
                </span>

                <h1>
                    <?php echo htmlspecialchars($selectedEvent['title']); ?>
                </h1>
                <div class="event-information">
                    <p>
                        <strong>Date:</strong>
                        <?php echo htmlspecialchars($selectedEvent['date']); ?>
                    </p>

                    <p>
                        <strong>Time:</strong>
                        <?php echo htmlspecialchars($selectedEvent['time']); ?>
                    </p>

                    <p>
                        <strong>Location:</strong>
                        <?php echo htmlspecialchars($selectedEvent['location']); ?>
                    </p>

                </div>

                <h2>Event Description</h2>

                <p class="event-desc">
                    <?php echo htmlspecialchars($selectedEvent['description']); ?>
                </p>

                <div class="event-actions">

                    <a
                        class="register-button"
                        href="registration-form.php?event=<?php echo urlencode($selectedEvent['id']); ?>"
                    >
                        Register for Event
                    </a>
                    <a class="back-button" href="events.php">
                        Back to Events
                    </a>
                </div>
            </div>
        </article>

    <?php else: ?>

        <section class="not-found-message">

            <h1>Event Not Found</h1>

            <p>
                The requested event does not exist or the event ID is invalid.
            </p>

            <a class="primary-button" href="events.php">
                Return to Events
            </a>

        </section>

    <?php endif; ?>

</main>

<?php require_once 'includes/footer.php'; ?>