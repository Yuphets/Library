<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Currently Borrowed Books</title>
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
    <h3>Currently Borrowed Books Report</h3>
    <p>Generated on: {{ now()->format('F j, Y') }}</p>
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
                        Overdue
                    @else
                        On Time
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
</body>
</html>