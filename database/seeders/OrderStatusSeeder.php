<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Agreed',
                'slug' => 'agreed',
                'description' => 'سفارش با مالک بار توافق شده است.',
                'color' => 'success',
            ],
            [
                'name' => 'Rejected',
                'slug' => 'rejected',
                'description' => 'سفارش رد شده است.',
                'color' => 'danger',
            ],
            [
                'name' => 'No Response',
                'slug' => 'no-response',
                'description' => 'مالک بار پاسخی به سفارش نداده است.',
                'color' => 'danger',
            ],
            [
                'name' => 'Other Reasons',
                'slug' => 'other-reasons',
                'description' => 'سفارش به دلایل دیگر لغو شده است.',
                'color' => 'danger',
            ],
            [
                'name' => 'Pending Decision',
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
