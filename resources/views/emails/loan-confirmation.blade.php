<!DOCTYPE html>
<html>
<head>
    <title>Loan Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-top: 5px solid #003A6B;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #003A6B;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .header h1 {
            color: #003A6B;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        .content h2 {
            color: #003A6B;
            font-size: 20px;
            margin-top: 0;
        }
        .details {
            background-color: #f9f9f9;
            border-left: 4px solid #003A6B;
            padding: 15px;
            margin: 20px 0;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details td {
            padding: 8px 0;
            border-bottom: 1px dotted #ddd;
        }
        .details td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #003A6B;
            padding-top: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Mater Dei College Logo">
            <h1>Mater Dei College Library</h1>
            <p>Official Loan Confirmation</p>
        </div>

        <div class="content">
            <h2>Dear {{ $loan->member->name }},</h2>
            <p>Thank you for using the Mater Dei College Library. This is to confirm that you have successfully borrowed the following book:</p>

            <div class="details">
                <table>
                    <tr>
                        <td>Book Title:</td>
                        <td>{{ $loan->book->title }}</td>
                    </tr>
                    <tr>
                        <td>Author:</td>
                        <td>{{ $loan->book->author }}</td>
                    </tr>
                    <tr>
                        <td>ISBN:</td>
                        <td>{{ $loan->book->isbn }}</td>
                    </tr>
                    <tr>
                        <td>Borrowed Date:</td>
                        <td>{{ $loan->borrowed_at->format('F j, Y') }}</td>
                    </tr>
                    <tr>
                        <td>Due Date:</td>
                        <td>{{ $loan->due_at->format('F j, Y') }}</td>
                    </tr>
                </table>
            </div>

            <p>Please ensure the book is returned by the due date to avoid fines. You may view your loan history by logging into your account.</p>
            <p>If you have any questions, please contact the library at <a href="mailto:library@materdei.edu">library@materdei.edu</a>.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Mater Dei College. All rights reserved.<br>
            This is an automated message. Please do not reply directly to this email.
        </div>
    </div>
</body>
</html>