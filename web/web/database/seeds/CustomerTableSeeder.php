<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::load('Excel/users.xls', function($reader) {
            try {
                $dataArr = $reader->toArray();
                foreach ($dataArr as $key => $value) {
                    $customer = new Customer;
                    $customer->name = $value['name'];
                    $customer->gender = $value['gender'];
                    $customer->email = $value['email'];
                    $customer->phone = $value['phone'];
                    $customer->password = bcrypt($value['password']);
                    $customer->cust_id = $value['cust_id'];
                    $customer->type = $value['type'];
                    $customer->save();
                }
            } catch (Exception $ex) {
                echo 'Exception Caught :- ' . PHP_EOL;
                var_dump("Message:- " . $ex->getMessage());
                var_dump("Line:- " . $ex->getLine());
//                Log::debug($ex);
            }
        });
    }
}
