<!DOCTYPE html>
<html>
<head>
    <title>Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333; /* Adjust this to match your website's text color */
            line-height: 1.6;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4; /* Adjust to match your website's background color */
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff; /* White background for the email container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ff6f00; /* Primary color from your website */
        }
        p {
            color: #333; /* Adjust this to match your website's text color */
        }
        .response-data {
            background-color: #f0f0f0; /* Light grey background for response data */
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            white-space: pre-wrap; /* Ensures proper formatting */
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888; /* Footer text color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Purchase!</h1>
        <p>Dear {{ $customerName }},</p>
        <p>Thank you for shopping with us. Here are the details of your purchase:</p>

        <h2>Receipt Summary</h2>
        <p><strong>Product Name:</strong> {{ $productName }}</p>
        <p><strong>Product Key:</strong> {{ $productKey }}</p>
        <p><strong>Price:</strong> KES {{ number_format($amount, 2) }}</p>
        <p><strong>Transaction Date:</strong> {{ $transactionDate }}</p>
        
        <p><strong>To install the product, click the download link below</strong></p>
        <p><a href="https://www.bitdefender.com/en-bz/consumer/thank-you" style="display: inline-block; padding: 10px 20px; background-color: #ff6f00; color: #ffffff; text-decoration: none; border-radius: 4px;">Download Link</a></p>

        <p>Thank you for choosing Cybill Software. If you have any questions, feel free to contact us.</p>

        <div class="footer">
            <p>Best Regards,<br>Cybill Software Team</p>
            <p>Contact Us: 0731548574 | <a href="https://www.cybillsoftware.com">www.cybillsoftware.com</a></p>
        </div>
    </div>
</body>
</html>