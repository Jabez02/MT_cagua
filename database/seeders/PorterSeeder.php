<?php

namespace Database\Seeders;

use App\Models\Porter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PorterSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $porters = [
            [
                'name' => 'Antonio "Tony" Ramos',
                'contact_number' => '+63 917 111 2222',
                'address' => 'Barangay San Miguel, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 25,
                'total_treks' => 38,
            ],
            [
                'name' => 'Benjamin "Ben" Castro',
                'contact_number' => '+63 918 222 3333',
                'address' => 'Barangay Centro, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 30,
                'total_treks' => 42,
            ],
            [
                'name' => 'Carlos "Charlie" Morales',
                'contact_number' => '+63 919 333 4444',
                'address' => 'Barangay Pallua Norte, Tuguegarao City, Cagayan',
                'status' => 'assigned',
                'max_weight_capacity' => 35,
                'total_treks' => 56,
            ],
            [
                'name' => 'Daniel "Danny" Rivera',
                'contact_number' => '+63 920 444 5555',
                'address' => 'Barangay Caritan Norte, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 28,
                'total_treks' => 31,
            ],
            [
                'name' => 'Emmanuel "Manny" Gonzales',
                'contact_number' => '+63 921 555 6666',
                'address' => 'Barangay Ugac Norte, Tuguegarao City, Cagayan',
                'status' => 'unavailable',
                'max_weight_capacity' => 32,
                'total_treks' => 47,
            ],
            [
                'name' => 'Fernando "Ferdie" Lopez',
                'contact_number' => '+63 922 666 7777',
                'address' => 'Barangay Atulayan Norte, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 26,
                'total_treks' => 23,
            ],
            [
                'name' => 'Gabriel "Gab" Hernandez',
                'contact_number' => '+63 923 777 8888',
                'address' => 'Barangay Carig, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 40,
                'total_treks' => 61,
            ],
            [
                'name' => 'Hector "Hecky" Perez',
                'contact_number' => '+63 924 888 9999',
                'address' => 'Barangay Pengue-Ruyu, Tuguegarao City, Cagayan',
                'status' => 'assigned',
                'max_weight_capacity' => 29,
                'total_treks' => 35,
            ],
            [
                'name' => 'Ignacio "Iggy" Valdez',
                'contact_number' => '+63 925 999 0000',
                'address' => 'Barangay Tanza, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 33,
                'total_treks' => 44,
            ],
            [
                'name' => 'Jose "Joey" Mendoza',
                'contact_number' => '+63 926 000 1111',
                'address' => 'Barangay Buntun, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 27,
                'total_treks' => 29,
            ],
            [
                'name' => 'Leonardo "Leo" Santos',
                'contact_number' => '+63 927 111 2222',
                'address' => 'Barangay Larion Alto, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 31,
                'total_treks' => 39,
            ],
            [
                'name' => 'Manuel "Manny" Cruz',
                'contact_number' => '+63 928 222 3333',
                'address' => 'Barangay Namabbalan Norte, Tuguegarao City, Cagayan',
                'status' => 'unavailable',
                'max_weight_capacity' => 24,
                'total_treks' => 18,
            ],
            [
                'name' => 'Nicolas "Nick" Reyes',
                'contact_number' => '+63 929 333 4444',
                'address' => 'Barangay Gosi Norte, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 36,
                'total_treks' => 52,
            ],
            [
                'name' => 'Oscar "Oskie" Torres',
                'contact_number' => '+63 930 444 5555',
                'address' => 'Barangay Dadda, Tuguegarao City, Cagayan',
                'status' => 'available',
                'max_weight_capacity' => 38,
                'total_treks' => 48,
            ],
            [
                'name' => 'Pedro "Pete" Flores',
                'contact_number' => '+63 931 555 6666',
                'address' => 'Barangay Cataggaman Nuevo, Tuguegarao City, Cagayan',
                'status' => 'assigned',
                'max_weight_capacity' => 34,
                'total_treks' => 41,
            ],
        ];

        foreach ($porters as $porterData) {
            Porter::create($porterData);
        }
    }
}
