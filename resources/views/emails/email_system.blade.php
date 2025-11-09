<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }

        .content p {
            margin: 10px 0;
        }

        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>New Email Notification</h1>
        </div>
        
        <div class="content">
            <p><strong>From:</strong> {{ $email_from }}</p>
            <p><strong>Message:</strong></p>
            <p>{!! $data['message'] !!}</p>
        </div>

        <div class="footer">
            <p>&copy; 2025 Mail Maestro All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>

