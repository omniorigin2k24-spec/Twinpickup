<?php<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pickup = htmlspecialchars(strip_tags($_POST['pickup']));
    $dropoff = htmlspecialchars(strip_tags($_POST['dropoff']));
    $load_details = htmlspecialchars(strip_tags($_POST['load_details']));
    $request_type = htmlspecialchars(strip_tags($_POST['request_type']));

    // Target inbox where you want to receive dispatch alerts
    $to = "your-business-email@domain.com"; 
    $subject = "New Hot Shot " . strtoupper($request_type) . " Request from " . $name;

    // Build the email body structure
    $body = "You have received a new lead for your hot shot disposal business.\n\n";
    $body .= "Client Name: $name\n";
    $body .= "Client Email: $email\n";
    $body .= "Pickup Location: $pickup\n";
    $body .= "Drop-off Location: $dropoff\n\n";
    $body .= "Load/Inquiry Details:\n$load_details\n";

    $headers = "From: webmaster@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email and redirect to a confirmation message
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Your request has been successfully submitted! We will contact you shortly with a quote.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again or call us directly.'); window.history.back();</script>";
    }
} else {
    header("Location: index.html");
    exit();
}
?>
