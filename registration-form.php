<?php
require_once 'data/events.php';
$fullName = "";
$studentId = "";
$email = "";
$selectedEventId = "";
$errors = [];
$successMessage = "";

if (isset($_GET['event'])) {
    $selectedEventId = trim($_GET['event']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $studentId = trim($_POST['student_id'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $selectedEventId = trim($_POST['event_id'] ?? '');

    if ($fullName === '') {
        $errors[] = 'Full name is required.';
    } elseif (strlen($fullName) < 3) {
        $errors[] = 'Full name must contain at least 3 characters.';
    }

    if ($studentId === '') {
        $errors[] = 'Student ID is required.';
    } elseif (!preg_match('/^[A-Za-z0-9-]{4,20}$/', $studentId)) {
        $errors[] = 'Please enter a valid student ID.';
    }

    if ($email === '') {
        $errors[] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    $selectedEvent = null;

    foreach ($events as $event) {
        if ((string) $event['id'] === $selectedEventId) {
            $selectedEvent = $event;
            break;
        }
    }

    if ($selectedEvent === null) {
        $errors[] = 'Please select the event.';
    }

    if (empty($errors)) {

        $csvFile = __DIR__ . '/data/registrations.csv';
        $fileHandle = fopen($csvFile, 'a');

        if ($fileHandle !== false) {

            if (flock($fileHandle, LOCK_EX)) {

                fputcsv($fileHandle, [
                    $fullName,
                    $studentId,
                    $email,
                    $selectedEvent['id'],
                    $selectedEvent['title'],
                    date('Y-m-d H:i:s')
                ]);

                flock($fileHandle, LOCK_UN);

                $successMessage =
                    'Your registration for "' .
                    $selectedEvent['title'] .
                    '" was completed without any problems';

                $fullName = "";
                $studentId = "";
                $email = "";
                $selectedEventId = "";

            } else {
                $errors[] = 'The registration file couldnt be locked.';
            }

            fclose($fileHandle);

        } else {
            $errors[] = 'The registration couldnt be saved.';
        }
    }
}

require_once 'includes/header.php';
?>

<main class="registration-main-form">

    <section class="registration-info">
        <h1>Event Registration</h1>
        <p>
            Complete the following form to register for one of the available
            campus events.
        </p>
    </section>

    <?php if (!empty($errors)): ?>

        <div class="main-message error-msg">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>
                        <?php echo htmlspecialchars($error); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    <?php endif; ?>

    <?php if ($successMessage !== ''): ?>

        <div class="main-message success-msg">
            <?php echo htmlspecialchars($successMessage); ?>
        </div>

    <?php endif; ?>

    <form
        class="registration-form"
        action="registration-form.php"
        method="post"
    >

        <div class="form-register-group">
            <label for="full-name">Full Name</label>

            <input
                type="text"
                id="full-name"
                name="full_name"
                value="<?php echo htmlspecialchars($fullName); ?>"
                placeholder="Enter your full name"
            >
        </div>

        <div class="form-register-group">
            <label for="student-id">Student ID</label>

            <input
                type="text"
                id="student-id"
                name="student_id"
                value="<?php echo htmlspecialchars($studentId); ?>"
                placeholder="Enter your student ID"
            >
        </div>

        <div class="form-register-group">
            <label for="email">Email Address</label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
                placeholder="Enter your email address"
            >
        </div>

        <div class="form-register-group">
            <label for="event-id">Select Event</label>

            <select id="event-id" name="event_id">

                <option value="">Choose an event</option>

                <?php foreach ($events as $event): ?>

                    <option
                        value="<?php echo htmlspecialchars($event['id']); ?>"
                        <?php
                        echo (string) $event['id'] === $selectedEventId
                            ? 'selected'
                            : '';
                        ?>
                    >
                        <?php
                        echo htmlspecialchars(
                            $event['title'] . ' - ' . $event['date']
                        );
                        ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>

        <button type="submit" class="send-button">
            Submit Registration
        </button>
    </form>
</main>

<?php require_once 'includes/footer.php'; ?>