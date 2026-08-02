<?php
$registrations = [];
$csvFile = __DIR__ . '/data/registrations.csv';
if (file_exists($csvFile)) {
    $fileHandle = fopen($csvFile, 'r');
    if ($fileHandle !== false) {
        $header = fgetcsv($fileHandle);
        while (($row = fgetcsv($fileHandle)) !== false) {
            if (count($row) >= 6) {
                $registrations[] = [
                    'full_name' => $row[0],
                    'student_id' => $row[1],
                    'email' => $row[2],
                    'event_id' => $row[3],
                    'event_title' => $row[4],
                    'registration_date' => $row[5]
                ];
            }
        }

        fclose($fileHandle);
    }
}

require_once 'includes/header.php';
?>

<main class="register-list">
    <section class="registration-info">
        <h1>Registration List</h1>
        <p>
            This page displays the students who have registered for campus
            events.
        </p>
    </section>

    <?php if (!empty($registrations)): ?>
        <div class="table-container">
            <table class="registrations-table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Event</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($registrations as $registration): ?>
                        <tr>
                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $registration['full_name']
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $registration['student_id']
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $registration['email']
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $registration['event_title']
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $registration['registration_date']
                                );
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>

        <div class="no-register-message">

            <h2>No Registrations Yet</h2>

            <p>
                No students have registered for an event yet.
            </p>

            <a class="register-button" href="registration-form.php">
                Register Now
            </a>
        </div>
    <?php endif; ?>
</main>
<?php require_once 'includes/footer.php'; ?>