<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #ff6f00;
        }
        p {
            color: #333;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verify Your Email Address</h1>
        <p>Dear {{ $notifiable->name }},</p>
        <p>Please click the button below to verify your email address:</p>
        <p><a href="{{ $verificationUrl }}" style="display: inline-block; padding: 10px 20px; background-color: #ff6f00; color: #ffffff; text-decoration: none; border-radius: 4px;">Verify Email Address</a></p>
        <p>If you did not create an account, no further action is required.</p>
        <div class="footer">
            <p>Best Regards,<br>Cybill Software Team</p>
            <p>Contact Us: 0731548574 | <a href="https://www.cybillsoftware.com">www.cybillsoftware.com</a></p>
        </div>
    </div>
</body>
</html>