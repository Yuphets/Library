<!DOCTYPE html>
<html>
<head>
    <title>Overdue Book Notice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { background-color: #003A6B; color: white; padding: 10px; text-align: center; }
        .content { padding: 20px; }
        .fine { font-weight: bold; color: #c00; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Mater Dei College Library</h2>
    </div>
    <div class="content">
        <p>Dear {{ $member->name }},</p>
        <p>This is a reminder that you have overdue books. Please return them as soon as possible to avoid additional fines.</p>
        <p>Total fine as of {{ now()->format('F j, Y') }}: <span class="fine">₱{{ number_format($totalFine, 2) }}</span></p>
        <p>Please see the attached PDF for details of your overdue books.</p>
        <p>Thank you,<br>Library Staff</p>
    </div>
</body>
</html>