<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Orders;
use App\Models\OrderDetails;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(0, 31) as $i) {

            $order = new Orders();
            $order->order_date = $faker->dateTimeBetween('-28 Days', 'now');
            $order->customer_id = 6;
            $order->type = $faker->randomElement(['wa', 'web']);
            $order->total_price = $faker->randomNumber(2);
            $order->payment_status = 'paid';
            $order->agent_id = 6;
            $order->save();

            foreach (range(0, 5) as $j) {
                $qty = $faker->randomDigitNotNull;
                $productUnitPrice = $faker->randomNumber(2);

                $orderDetails = new OrderDetails();
                $orderDetails->product_name = 'Product_Faker_0';
                $orderDetails->product_unit_price = $productUnitPrice;
                $orderDetails->product_price = $productUnitPrice * $qty;
                $orderDetails->qty = $qty;
                $orderDetails->order_id = $order->id;
                $orderDetails->save();
            }
        }
    }
}
