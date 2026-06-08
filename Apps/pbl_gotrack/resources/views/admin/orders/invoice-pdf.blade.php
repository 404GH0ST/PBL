<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ $invoice['number'] }} - Invoice</title>
</head>
<body>
    @include('admin.orders.partials.invoice-document', [
        'order' => $order,
        'invoice' => $invoice,
        'isPdf' => true,
    ])
</body>
</html>
