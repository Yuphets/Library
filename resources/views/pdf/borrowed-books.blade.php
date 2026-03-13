<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Currently Borrowed Books</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #003A6B;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            height: 80px;
            margin-bottom: 5px;
        }
        .header h1 {
            color: #003A6B;
            font-size: 24px;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .header h2 {
            color: #333;
            font-size: 18px;
            margin: 0;
            font-weight: normal;
        }
        .report-title {
            text-align: center;
            margin: 20px 0;
        }
        .report-title h3 {
            color: #003A6B;
            font-size: 20px;
            text-decoration: underline;
        }
        .info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }
        th {
            background-color: #003A6B;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #003A6B;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Mater Dei College Logo">
        <h1>Mater Dei College</h1>
        <h2>Library System – Currently Borrowed Books</h2>
    </div>

    <div class="info">
        <p><strong>Generated on:</strong> {{ now()->format('F j, Y, g:i a') }}</p>
        <p><strong>Prepared by:</strong> Library Staff</p>
    </div>

    <div class="report-title">
        <h3>List of Borrowed Books (Not Yet Returned)</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Member</th>
                <th>Borrowed Date</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowedBooks as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->member->name }}</td>
                <td>{{ $loan->borrowed_at->format('Y-m-d') }}</td>
                <td>{{ $loan->due_at->format('Y-m-d') }}</td>
                <td>
                    @if($loan->due_at < now())
                        <span style="color: #c00;">Overdue</span>
                    @else
                        <span style="color: #0a0;">On Time</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No books currently borrowed.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Mater Dei College Library – Official Document
    </div>
</body>
</html>