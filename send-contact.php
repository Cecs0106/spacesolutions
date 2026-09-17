<?php

declare(strict_types=1);

const RECIPIENT_EMAIL = 'cleibertc@gmail.com';
const SENDER_EMAIL = 'spacesol@spacesolutionsus.com';
const SENDER_NAME = 'Space Solutions website';

function redirect_with_status(string $status): never
{
    header('Location: index.html?contact=' . rawurlencode($status) . '#quote');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_status('invalid');
}

// This field is intentionally empty on real submissions. Bots often fill it.
if (!empty($_POST['website'] ?? '')) {
    redirect_with_status('success');
}

$firstName = trim((string) ($_POST['first_name'] ?? ''));
$lastName = trim((string) ($_POST['last_name'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if (
    $firstName === '' || strlen($firstName) > 80 ||
    $lastName === '' || strlen($lastName) > 80 ||
    $phone === '' || strlen($phone) > 40 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254 ||
    $message === '' || strlen($message) > 5000 ||
    preg_match('/[\r\n]/', $email)
) {
    redirect_with_status('invalid');
}

$subject = 'New website contact request';
$body = implode("\n", [
    'A new contact request was submitted from spacesolutionsus.com.',
    '',
    'First name: ' . $firstName,
    'Last name: ' . $lastName,
    'Phone: ' . $phone,
    'Email: ' . $email,
    '',
    'Message:',
    $message,
]);

$headers = implode("\r\n", [
    'From: ' . SENDER_NAME . ' <' . SENDER_EMAIL . '>',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
]);

$sent = mail(RECIPIENT_EMAIL, $subject, $body, $headers, '-f' . SENDER_EMAIL);
redirect_with_status($sent ? 'success' : 'error');
