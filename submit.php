<?php
// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $country = htmlspecialchars(trim($_POST['country']));

    // Validate required fields
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($country)) {
        $errors[] = "Country is required.";
    }

    // If there are errors, display them and redirect back to the form
    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "'); window.location.href = 'index.html';</script>";
        exit();
    }

    // If no errors, process the data (e.g., send email or save to database)
    $to = "admin@universityinsights.com"; // Replace with your email
    $subject = "New MBBS Application";
    $message = "Name: $name\nEmail: $email\nPhone: $phone\nCountry: $country";
    $headers = "From: no-reply@universityinsights.com";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Application submitted successfully!'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Submission failed. Please try again.'); window.location.href = 'index.html';</script>";
    }
} else {
    // If accessed directly, redirect to the form
    header("Location: index.html");
    exit();
}
?>