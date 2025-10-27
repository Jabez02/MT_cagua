<?php

namespace Database\Seeders;

use App\Models\Guide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuideSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guides = [
            [
                'name' => 'Juan Carlos Mendoza',
                'contact_number' => '+63 917 123 4567',
                'address' => 'Barangay San Miguel, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Mountain Climbing', 'Wildlife Spotting', 'Photography Tours']),
                'total_hikes' => 45,
            ],
            [
                'name' => 'Maria Elena Santos',
                'contact_number' => '+63 918 234 5678',
                'address' => 'Barangay Centro, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Bird Watching', 'Nature Photography', 'Botanical Tours']),
                'total_hikes' => 32,
            ],
            [
                'name' => 'Roberto "Bobby" Cruz',
                'contact_number' => '+63 919 345 6789',
                'address' => 'Barangay Pallua Norte, Tuguegarao City, Cagayan',
                'status' => 'assigned',
                'specializations' => json_encode(['Rock Climbing', 'Adventure Tours', 'Survival Training']),
                'total_hikes' => 67,
            ],
            [
                'name' => 'Ana Marie Reyes',
                'contact_number' => '+63 920 456 7890',
                'address' => 'Barangay Caritan Norte, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Eco-Tourism', 'Cultural Tours', 'Educational Hikes']),
                'total_hikes' => 28,
            ],
            [
                'name' => 'Miguel Angelo Torres',
                'contact_number' => '+63 921 567 8901',
                'address' => 'Barangay Ugac Norte, Tuguegarao City, Cagayan',
                'status' => 'unavailable',
                'specializations' => json_encode(['Night Hiking', 'Camping', 'Wilderness Survival']),
                'total_hikes' => 53,
            ],
            [
                'name' => 'Carmen Isabella Flores',
                'contact_number' => '+63 922 678 9012',
                'address' => 'Barangay Atulayan Norte, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Family Tours', 'Beginner Hiking', 'Safety Training']),
                'total_hikes' => 19,
            ],
            [
                'name' => 'Eduardo "Eddie" Villanueva',
                'contact_number' => '+63 923 789 0123',
                'address' => 'Barangay Carig, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Advanced Climbing', 'Technical Routes', 'Equipment Training']),
                'total_hikes' => 78,
            ],
            [
                'name' => 'Rosario "Rose" Garcia',
                'contact_number' => '+63 924 890 1234',
                'address' => 'Barangay Pengue-Ruyu, Tuguegarao City, Cagayan',
                'status' => 'assigned',
                'specializations' => json_encode(['Medicinal Plants', 'Herbal Tours', 'Traditional Knowledge']),
                'total_hikes' => 41,
            ],
            [
                'name' => 'Francisco "Frank" Dela Cruz',
                'contact_number' => '+63 925 901 2345',
                'address' => 'Barangay Tanza, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Historical Tours', 'Cultural Heritage', 'Storytelling']),
                'total_hikes' => 36,
            ],
            [
                'name' => 'Luz Marina Aquino',
                'contact_number' => '+63 926 012 3456',
                'address' => 'Barangay Buntun, Tuguegarao City, Cagayan',
                'status' => 'available',
                'specializations' => json_encode(['Sunrise Tours', 'Meditation Hikes', 'Wellness Activities']),
                'total_hikes' => 24,
            ],
        ];

        foreach ($guides as $guideData) {
            Guide::create($guideData);
        }
    }
}