<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Overdue Notice for {{ $member->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { color: #003A6B; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Mater Dei College Library</h2>
    <h3>Overdue Notice for {{ $member->name }}</h3>
    <p>Generated on: {{ now()->format('F j, Y') }}</p>
    <p>Email: {{ $member->email }}</p>
    <p>Phone: {{ $member->phone ?? 'N/A' }}</p>
    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Borrowed Date</th>
                <th>Due Date</th>
                <th>Days Overdue</th>
                <th>Fine (₱{{ config('app.overdue_fine_per_day') }}/day)</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($overdueLoans as $loan)
            @php 
                $daysOverdue = floor(now()->diffInDays($loan->due_at));
                $fine = $daysOverdue * config('app.overdue_fine_per_day');
                $total += $fine;
            @endphp
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->borrowed_at->format('Y-m-d') }}</td>
                <td>{{ $loan->due_at->format('Y-m-d') }}</td>
                <td>{{ $daysOverdue }}</td>
                <td>₱{{ number_format($fine, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;">Total Fine:</th>
                <th>₱{{ number_format($total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    <p><em>Please return these books immediately to prevent further fines.</em></p>
</body>
</html>