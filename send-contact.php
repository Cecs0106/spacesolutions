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

$subject = 'Nueva solicitud de contacto - ' . $firstName . ' ' . $lastName;

$firstNameHtml = htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8');
$lastNameHtml = htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8');
$phoneHtml = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$emailHtml = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$messageHtml = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
$replyEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phoneHref = preg_replace('/\D+/', '', $phone);
if ($phoneHref !== '') {
    $phoneHref = '+' . ltrim($phoneHref, '+');
}

$body = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva solicitud de contacto</title>
</head>
<body style="margin: 0; padding: 0; background: linear-gradient(180deg, #edf6ff 0%, #f7fafc 100%); font-family: 'Segoe UI', Arial, sans-serif; color: #10233d;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(180deg, #edf6ff 0%, #f7fafc 100%); padding: 32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 640px; background-color: #ffffff; border: 1px solid #dfeaf6; border-radius: 18px; overflow: hidden; box-shadow: 0 10px 30px rgba(11,30,61,0.08);">
          <tr>
            <td style="background: linear-gradient(135deg, #0b1e3d 0%, #112f5f 100%); padding: 28px 30px 22px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td align="left" style="font-size: 0;">
                    <div style="display: inline-block; background-color: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); border-radius: 12px; padding: 10px 14px;">
                      <span style="font-size: 12px; letter-spacing: 2px; color: #9ad7ff; text-transform: uppercase; font-weight: 700;">Space Solutions</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 18px;">
                    <h1 style="margin: 0; color: #ffffff; font-size: 29px; line-height: 1.2; font-weight: 700; letter-spacing: -0.4px;">Nueva solicitud de contacto</h1>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top: 10px;">
                    <p style="margin: 0; color: #cfe8ff; font-size: 14px; line-height: 1.6;">
                      Un cliente acaba de completar el formulario desde <strong style="color: #ffffff;">spacesolutionsus.com</strong>.
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="padding: 28px 30px 8px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fbff; border: 1px solid #e1edf9; border-radius: 14px;">
                <tr>
                  <td style="padding: 22px 20px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="padding: 0 0 14px; border-bottom: 1px solid #e8f0f7;">
                          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td style="width: 120px; color: #6a7f99; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 10px 0 0;">Nombre</td>
                              <td style="color: #0b1e3d; font-size: 15px; font-weight: 600;">{$firstNameHtml}</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 14px 0; border-bottom: 1px solid #e8f0f7;">
                          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td style="width: 120px; color: #6a7f99; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 10px 0 0;">Apellido</td>
                              <td style="color: #0b1e3d; font-size: 15px; font-weight: 600;">{$lastNameHtml}</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 14px 0; border-bottom: 1px solid #e8f0f7;">
                          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td style="width: 120px; color: #6a7f99; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 10px 0 0;">Teléfono</td>
                              <td style="color: #0b1e3d; font-size: 15px; font-weight: 600;">
                                <a href="tel:{$phoneHref}" style="color: #0a87d4; text-decoration: none;">{$phoneHtml}</a>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 14px 0;">
                          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                              <td style="width: 120px; color: #6a7f99; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 0 10px 0 0;">Correo</td>
                              <td style="color: #0b1e3d; font-size: 15px; font-weight: 600;">
                                <a href="mailto:{$replyEmail}" style="color: #0a87d4; text-decoration: none;">{$emailHtml}</a>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="padding: 18px 30px 0;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(180deg, #edf7ff 0%, #f6fbff 100%); border: 1px solid #dfeefb; border-radius: 14px;">
                <tr>
                  <td style="padding: 18px 20px;">
                    <p style="margin: 0 0 8px; color: #6a7f99; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Mensaje</p>
                    <div style="color: #1b2e45; font-size: 15px; line-height: 1.7;">{$messageHtml}</div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="padding: 26px 30px 30px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td align="center">
                    <a href="mailto:{$replyEmail}" style="display: inline-block; background: linear-gradient(135deg, #0b1e3d 0%, #123a75 100%); color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 999px; font-size: 14px; font-weight: 700; letter-spacing: 0.2px;">
                      Responder a {$firstNameHtml}
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="background-color: #f7fafc; border-top: 1px solid #e4edf7; padding: 18px 30px; text-align: center; color: #6f87a1; font-size: 12px; line-height: 1.5;">
              Notificación automática generada por <strong style="color: #10233d;">Space Solutions</strong><br>
              spacesolutionsus.com
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

$headers = implode("\r\n", [
    'From: ' . SENDER_NAME . ' <' . SENDER_EMAIL . '>',
    'Reply-To: ' . $email,
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
]);

$sent = mail(RECIPIENT_EMAIL, $subject, $body, $headers, '-f' . SENDER_EMAIL);
redirect_with_status($sent ? 'success' : 'error');
