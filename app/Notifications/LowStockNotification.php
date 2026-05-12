<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Product;

class LowStockNotification extends Notification
{
    use Queueable;

    public $product;

    /**
     * Create a new notification instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // Menyimpan notifikasi di tabel 'notifications'
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'product_sku' => $this->product->sku,
            'current_stock' => $this->product->stock,
            'minimum_stock' => $this->product->minimum_stock,
            'message' => 'Stok ' . $this->product->name . ' menipis (' . $this->product->stock . ' tersisa).',
            'action_url' => route('products.index', ['search' => $this->product->sku]),
            'icon' => 'warning',
            'color' => 'text-red-500'
        ];
    }
}
