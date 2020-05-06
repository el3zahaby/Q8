<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $design = \App\Design::first()->toArray();
        \App\Order::create([
            'orderstatus_id' => 1,
            'order_infos' => '{
                "user_id": "1",
                "design_id": "1",
                "tsize_id": "1",
                "tshirt_id": "1",
                "print_price": "1",
                "designer_price": "1",
                "total": "2",
                "tshirt": {
                    "id": "1",
                    "size": "xl",
                    "color": {
                        "id": "1",
                        "name": "red"
                    }
                },
                "design": '.json_encode($design,JSON_PRETTY_PRINT).',
                "print": {
                    "front": {
                        "size_id": "1",
                        "size": "5 x 5",
                        "print_price": "10"
                    },
                    "back": {
                        "size_id": "2",
                        "size": "5 x 10",
                        "print_price": "3"
                    }
                },
                "shipping_info": {
                    "user_id": "1",
                    "email": "flsdaj@lfdj",
                    "name": "admin",
                    "address": "adressl fdsaf",
                    "phone": "4938573",
                    "IBAN_Bank": "band iban 03495",
                    "Bank_Name": "al ahly",
                    "name_on_BankCard": "admin bank name"
                }
            }',
        ]);
    }
}
