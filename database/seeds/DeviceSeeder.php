<?php

use App\Device;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->delete();

        Device::create(
            [
                'device_name' => 'device Android',
                'label_name' => 'LB1',
                'description' => 'This is description of device',
                'firmware_version' => 'X Platform',
                'sn_imei' => 'xx11',
                'device_status' => 'Good',
                'available' => true,
                'note' => 'Nothing',
                'category_id' => 1
            ],
        );
        Device::create(
            [
                'device_name' => 'device iOS',
                'label_name' => 'LB2',
                'description' => 'This is description of device',
                'firmware_version' => 'X Platform',
                'sn_imei' => 'xx11',
                'device_status' => 'Good',
                'available' => true,
                'note' => 'Nothing',
                'category_id' => 2
            ],
        );
        Device::create(
            [
                'device_name' => 'device Laptop',
                'label_name' => 'LB3',
                'description' => 'This is description of device',
                'firmware_version' => 'X Platform',
                'sn_imei' => 'xx11',
                'device_status' => 'Good',
                'available' => true,
                'note' => 'Nothing',
                'category_id' => 3
            ],
        );
        Device::create(
            [
                'device_name' => 'device PC',
                'label_name' => 'LB4',
                'description' => 'This is description of device',
                'firmware_version' => 'X Platform',
                'sn_imei' => 'xx11',
                'device_status' => 'Good',
                'available' => true,
                'note' => 'Nothing',
                'category_id' => 4
            ],
        );
    }
}
