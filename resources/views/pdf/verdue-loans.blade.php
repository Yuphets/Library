<!DOCTYPE html>
<html>
<head>
    <title>Overdue Loans Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Overdue Loans as of {{ now()->format('d-m-Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Member</th>
                <th>Borrowed Date</th>
                <th>Due Date</th>
                <th>Days Overdue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overdueLoans as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->member->name }}</td>
                <td>{{ $loan->borrowed_at->format('d-m-Y') }}</td>
                <td>{{ $loan->due_at->format('d-m-Y') }}</td>
                <td>{{ now()->diffInDays($loan->due_at) }} days</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>