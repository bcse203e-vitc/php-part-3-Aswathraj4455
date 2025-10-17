<?php

$to = "recipient@example.com";
$from = "sender@example.com";
$subject = "Email with Attachment from PHP";
$message = "Please find the attached document.";
$file = "document.pdf";

$mime_boundary = "----PHP-MIME-Boundary-" . md5(time());

$file_size = filesize($file);
$handle = fopen($file, "r");
$content = fread($handle, $file_size);
fclose($handle);
$encoded_content = chunk_split(base64_encode($content));
$file_name = basename($file);

$header = "From: " . $from . "\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"" . $mime_boundary . "\"\r\n\r\n";

$body = "--" . $mime_boundary . "\r\n";
$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $message . "\r\n\r\n";

$body .= "--" . $mime_boundary . "\r\n";
$body .= "Content-Type: application/octet-stream; name=\"" . $file_name . "\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\r\n\r\n";
$body .= $encoded_content . "\r\n\r\n";

$body .= "--" . $mime_boundary . "--\r\n";

if (@mail($to, $subject, $body, $header)) {
    echo "Email sent successfully with attachment.";
} else {
    echo "Email sending failed.";
}
?>
