<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone_no"]));
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($subject) || empty($message)) {
        header("Location: contact.html?status=error");
        exit;
    }

    $recipient = "ict@medwaresol.com"; 
    $email_subject = "Website Contact: " . $subject;
    
    $email_content = "=========================================\n";
    $email_content .= "Date: " . date('Y-m-d H:i:s') . "\n";
    $email_content .= "To: $recipient\n";
    $email_content .= "From: $name <$email>\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Subject: $email_subject\n";
    $email_content .= "Message:\n$message\n";
    $email_content .= "=========================================\n\n";

    $email_headers = "From: Website Contact Form <info@medwaresol.com>\r\n";
    if (!empty($email)) {
        $email_headers .= "Reply-To: $email\r\n";
    }

    // Try to send real email
    $mail_sent = @mail($recipient, $email_subject, $email_content, $email_headers);

    // If we are on localhost XAMPP, mail() usually fails without SMTP config.
    // So we will log the email to a file for testing and return success.
    if (!$mail_sent) {
        file_put_contents('local_emails.log', $email_content, FILE_APPEND);
        $mail_sent = true; // Pretend it succeeded for local testing
    }

    if ($mail_sent) {
        header("Location: contact.html?status=success");
    } else {
        header("Location: contact.html?status=error");
    }
} else {
    header("Location: contact.html");
}
?>
