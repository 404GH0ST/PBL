<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductAddon;
use App\Models\User;

class OrderInvoiceController extends Controller
{
    public function show(Order $order)
    {
        $this->authorizeInvoiceAccess();

        $order->load('product');

        return view('admin.orders.invoice', [
            'order' => $order,
            'invoice' => $this->buildInvoiceData($order),
        ]);
    }

    public function showForTracking(string $trackingId)
    {
        $order = $this->findOrderByTrackingId($trackingId);

        return view('admin.orders.invoice', [
            'order' => $order,
            'invoice' => $this->buildInvoiceData($order),
        ]);
    }

    private function findOrderByTrackingId(string $trackingId): Order
    {
        return Order::query()
            ->with('product')
            ->where('tracking_id', $trackingId)
            ->firstOrFail();
    }

    private function authorizeInvoiceAccess(): void
    {
        $user = auth()->user();

        abort_unless($user instanceof User && $user->isAdminPanelUser(), 403);
    }

    private function buildInvoiceData(Order $order): array
    {
        $totalPrice = (int) $order->total_price;
        $isDirectPaid = $order->payment_type === 'paid';
        $paidAmount = $isDirectPaid ? $totalPrice : (int) $order->paid_amount;
        $remainingPayment = $isDirectPaid ? 0 : max($totalPrice - $paidAmount, 0);
        $settlementAmount = $isDirectPaid ? 0 : max($totalPrice - (int) $order->dp_amount, 0);
        $paymentStatus = $isDirectPaid || $order->payment_status === 'paid' ? 'Lunas' : 'Belum Lunas';

        return [
            'number' => 'INV-'.$order->tracking_id,
            'product_name' => $order->custom_product_name ?: $order->product?->name ?: '-',
            'addon_groups' => $this->buildAddonGroups($order),
            'payment_type' => $isDirectPaid ? 'Lunas Langsung' : 'DP',
            'dp_amount' => $isDirectPaid ? 0 : (int) $order->dp_amount,
            'settlement_amount' => $settlementAmount,
            'paid_amount' => $paidAmount,
            'remaining_payment' => $remainingPayment,
            'payment_status' => $paymentStatus,
            'order_status' => $this->formatStatus($order->status),
        ];
    }

    private function buildAddonGroups(Order $order): array
    {
        $selectedAddons = collect($order->selected_addons ?? []);
        $addonIds = $selectedAddons
            ->pluck('addons')
            ->flatten()
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        if ($selectedAddons->isEmpty() || $addonIds->isEmpty()) {
            return [];
        }

        $addons = ProductAddon::query()
            ->whereIn('id', $addonIds)
            ->get()
            ->keyBy('id');

        return $selectedAddons
            ->map(function (array $group) use ($addons): array {
                $names = collect($group['addons'] ?? [])
                    ->map(fn ($id) => $addons->get((int) $id)?->name)
                    ->filter()
                    ->values()
                    ->all();

                return [
                    'quantity' => (int) ($group['quantity'] ?? 0),
                    'names' => $names,
                ];
            })
            ->filter(fn (array $group): bool => $group['quantity'] > 0 || ! empty($group['names']))
            ->values()
            ->all();
    }

    private function formatStatus(?string $status): string
    {
        return match ($status) {
            'pending' => 'Pending',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => '-',
        };
    }
}
