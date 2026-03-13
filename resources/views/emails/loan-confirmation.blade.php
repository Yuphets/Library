<!DOCTYPE html>
<html>
<head>
    <title>Loan Confirmation</title>
</head>
<body>
    <h1>Hello {{ $loan->member->name }},</h1>
    <p>You have successfully borrowed the book: <strong>{{ $loan->book->title }}</strong>.</p>
    <p>Borrowed on: {{ $loan->borrowed_at->format('d-m-Y') }}</p>
    <p>Due date: {{ $loan->due_at->format('d-m-Y') }}</p>
    <p>Thank you for using our library!</p>
</body>
</html>