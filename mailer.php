<?php
// Contact form handler for contact.html. Sends the enquiry by email and redirects
// back with ?status=success or ?status=error (contact.html shows the message).
// NOTE: this file must be saved WITHOUT a byte-order mark and with nothing before
// "<?php" — any output before header() stops the redirects from working.

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.html");
    exit;
}

// Single-line fields end up in mail headers, so line breaks are removed from them
// (prevents a visitor injecting extra headers such as Bcc).
function single_line($value) {
    return trim(preg_replace('/[\r\n]+/', ' ', strip_tags((string) $value)));
}

$name    = single_line($_POST["name"] ?? '');
$phone   = single_line($_POST["phone_no"] ?? '');
$subject = single_line($_POST["subject"] ?? '');
$message = trim((string) ($_POST["message"] ?? ''));
$email   = filter_var(trim((string) ($_POST["email"] ?? '')), FILTER_VALIDATE_EMAIL) ?: '';

if ($name === '' || $subject === '' || $message === '') {
    header("Location: contact.html?status=error");
    exit;
}

$recipient = "ict@medwaresol.com";
$email_subject = "Website Contact: " . $subject;

$email_content  = "Date: " . date('Y-m-d H:i:s') . "\n";
$email_content .= "From: $name" . ($email !== '' ? " <$email>" : '') . "\n";
$email_content .= "Phone: $phone\n";
$email_content .= "Subject: $subject\n\n";
$email_content .= "Message:\n$message\n";

$email_headers = "From: Website Contact Form <info@medwaresol.com>\r\n";
if ($email !== '') {
    $email_headers .= "Reply-To: $email\r\n";
}

// If sending fails, the visitor is told so they can call or email instead.
// (On a local XAMPP install mail() fails unless SMTP is configured — that is expected.)
$mail_sent = @mail($recipient, $email_subject, $email_content, $email_headers);

header("Location: contact.html?status=" . ($mail_sent ? "success" : "error"));
exit;
