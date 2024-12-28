<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'title' => 'Agreed',
                'slug' => 'agreed',
                'description' => 'سفارش با مالک بار توافق شده است.',
                'color' => 'success',
            ],
            [
                'title' => 'Rejected',
                'slug' => 'rejected',
                'description' => 'سفارش رد شده است.',
                'color' => 'danger',
            ],
            [
                'title' => 'No Response',
                'slug' => 'no-response',
                'description' => 'مالک بار پاسخی به سفارش نداده است.',
                'color' => 'danger',
            ],
            [
                'title' => 'Other Reasons',
                'slug' => 'other-reasons',
                'description' => 'سفارش به دلایل دیگر لغو شده است.',
                'color' => 'danger',
            ],
            [
                'title' => 'Pending Decision',
                'slug' => 'pending-decision',
                'description' => 'هنوز تصمیمی گرفته نشده است، منتظر اقدام کاربر.',
                'color' => 'warning',
            ],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
