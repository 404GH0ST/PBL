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
        'canDownloadPdf' => false,
        'isPdf' => true,
    ])
</body>
</html>
