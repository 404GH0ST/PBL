<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invoice['number'] }} - Invoice</title>
</head>
<body>
    @include('admin.orders.partials.invoice-document', [
        'order' => $order,
        'invoice' => $invoice,
        'isPdf' => false,
    ])
</body>
</html>
