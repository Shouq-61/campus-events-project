<?php
$name = "";
$email = "";
$message = "";

$errors = [];
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "") {
        $errors[] = "Name is required.";
    }

    if ($email === "") {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($message === "") {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        $successMessage = "Your message has been send successfully.";

        $name = "";
        $email = "";
        $message = "";
    }
}

require_once 'includes/header.php';
?>

<main class="abcont-page">

    <section class="aboutus-section">
        <h1>About Us & Contact Us</h1>

    <p>
        This page provides basic information about our website. 
        Additionally, students can contact us if they need assistance or have questions answered
         by providing their contact details.
    </p>

    </section>
    <section class="team-info">
        <h2>Team Members</h2>

        <ul class="team-list">
            <li><strong>Team Leader</strong>: Shouq Almaghrabi</li>
            <li>Layan al fuziae</li>
            <li>Rola Alfawzan</li>
            <li>Hala Albakri</li>
        </ul>
    </section>

    <section class="contactus-section">
        <h2>Contact Us</h2>

        <?php if (!empty($errors)): ?>
            <div class="main-message error-msg">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; ?>

        <?php if ($successMessage !== ""): ?>
            <div class="main-message success-msg">
                <?php echo htmlspecialchars($successMessage); ?>
            </div>

        <?php endif; ?>

        <form method="post" action="about-contact.php" class="contact-form">
            <div class="form-contact">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo htmlspecialchars($name); ?>"
                >
            </div>

            <div class="form-contact">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo htmlspecialchars($email); ?>"
                >
            </div>

            <div class="form-contact">
                <label for="message">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="6"
                ><?php echo htmlspecialchars($message); ?></textarea>
            </div>

            <button type="submit" class="send-button">
                Send Message
            </button>
        </form>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>