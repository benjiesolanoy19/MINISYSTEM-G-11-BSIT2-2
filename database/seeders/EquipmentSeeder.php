<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EquipmentSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        $equipmentTemplates = [
            [
                'name' => 'Loaner Laptop',
                'category' => 'Laptops',
                'brand' => 'HP',
                'model' => 'ProBook 450 G8',
                'image_path' => 'images/equipment/laptop.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Portable loaner laptop for student assignments and presentations.',
                'count' => 8,
            ],
            [
                'name' => 'Chromebook',
                'category' => 'Laptops',
                'brand' => 'ASUS',
                'model' => 'Chromebook C423',
                'image_path' => 'images/equipment/laptop.svg',
                'location' => 'Computer Laboratory',
                'quantity' => 1,
                'description' => 'Lightweight Chromebook for in-class research and web-based learning.',
                'count' => 6,
            ],
            [
                'name' => 'Student Tablet',
                'category' => 'Tablets',
                'brand' => 'Apple',
                'model' => 'iPad 10.2',
                'image_path' => 'images/equipment/tablet.svg',
                'location' => 'Multimedia Room',
                'quantity' => 1,
                'description' => 'Loaner tablet for digital note-taking, research and classroom apps.',
                'count' => 5,
            ],
            [
                'name' => 'Student Laptop Kit',
                'category' => 'Laptops',
                'brand' => 'Lenovo',
                'model' => 'ThinkPad E14 Kit',
                'image_path' => 'images/equipment/laptop.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Laptop kit prepared for student loan with charger and bag.',
                'count' => 4,
            ],
            [
                'name' => 'Webcam',
                'category' => 'Webcams',
                'brand' => 'Logitech',
                'model' => 'C920 HD Pro',
                'image_path' => 'images/equipment/webcam.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Webcam for online meetings, remote classes and recorded presentations.',
                'count' => 5,
            ],
            [
                'name' => 'USB Headset',
                'category' => 'Headsets',
                'brand' => 'Logitech',
                'model' => 'H390 USB',
                'image_path' => 'images/equipment/headset.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Noise-cancelling USB headset for online lessons and recording sessions.',
                'count' => 5,
            ],
            [
                'name' => 'USB Microphone',
                'category' => 'Microphones',
                'brand' => 'Blue',
                'model' => 'Yeti Nano',
                'image_path' => 'images/equipment/microphone.svg',
                'location' => 'Recording Studio',
                'quantity' => 1,
                'description' => 'Plug-and-play USB microphone for podcasts and presentation recording.',
                'count' => 3,
            ],
            [
                'name' => 'Wireless Microphone',
                'category' => 'Microphones',
                'brand' => 'Shure',
                'model' => 'BLX14',
                'image_path' => 'images/equipment/microphone.svg',
                'location' => 'Auditorium',
                'quantity' => 1,
                'description' => 'Wireless mic set for student presentations and events.',
                'count' => 2,
            ],
            [
                'name' => 'Portable Speaker',
                'category' => 'Speakers',
                'brand' => 'JBL',
                'model' => 'Flip 5',
                'image_path' => 'images/equipment/speakers.svg',
                'location' => 'Multimedia Room',
                'quantity' => 1,
                'description' => 'Portable speaker for group presentations and classroom audio.',
                'count' => 3,
            ],
            [
                'name' => 'Bluetooth Speaker',
                'category' => 'Speakers',
                'brand' => 'Bose',
                'model' => 'SoundLink Color',
                'image_path' => 'images/equipment/speakers.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Bluetooth speaker for project demos and audio playback.',
                'count' => 2,
            ],
            [
                'name' => 'Digital Camera',
                'category' => 'Digital Cameras',
                'brand' => 'Canon',
                'model' => 'EOS M50',
                'image_path' => 'images/equipment/camera.svg',
                'location' => 'Multimedia Room',
                'quantity' => 1,
                'description' => 'Mirrorless camera for student media projects and reporting.',
                'count' => 2,
            ],
            [
                'name' => 'Video Camera',
                'category' => 'Video Cameras',
                'brand' => 'Sony',
                'model' => 'Handycam FDR-AX43',
                'image_path' => 'images/equipment/camera.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Compact video camera for student event recordings and film projects.',
                'count' => 2,
            ],
            [
                'name' => 'LCD Projector',
                'category' => 'LCD Projectors',
                'brand' => 'Epson',
                'model' => 'EX3240',
                'image_path' => 'images/equipment/projector.svg',
                'location' => 'Lecture Hall',
                'quantity' => 1,
                'description' => 'Classroom projector for lectures, seminars and large group presentations.',
                'count' => 2,
            ],
            [
                'name' => 'Portable Projector',
                'category' => 'Portable Projectors',
                'brand' => 'Anker',
                'model' => 'Nebula Capsule',
                'image_path' => 'images/equipment/projector.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Compact projector for student group presentations outside regular classrooms.',
                'count' => 2,
            ],
            [
                'name' => 'Projector Remote',
                'category' => 'Presentation Equipment',
                'brand' => 'Logitech',
                'model' => 'R800',
                'image_path' => 'images/equipment/projector_remote.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Wireless remote for controlling projector slides and presentations.',
                'count' => 2,
            ],
            [
                'name' => 'Presentation Clicker',
                'category' => 'Presentation Equipment',
                'brand' => 'Logitech',
                'model' => 'Spotlight',
                'image_path' => 'images/equipment/presentation_clicker.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Clicker for smooth slide navigation and presenter control.',
                'count' => 2,
            ],
            [
                'name' => 'Laser Pointer',
                'category' => 'Presentation Equipment',
                'brand' => 'Kensington',
                'model' => 'Expert Wireless',
                'image_path' => 'images/equipment/laser_pointer.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Laser pointer for clear highlighting during presentations.',
                'count' => 2,
            ],
            [
                'name' => 'USB Flash Drive 16GB',
                'category' => 'USB Flash Drives',
                'brand' => 'Kingston',
                'model' => 'DataTraveler 16GB',
                'image_path' => 'images/equipment/usb.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Secure USB stick for transferring documents and project files.',
                'count' => 2,
            ],
            [
                'name' => 'USB Flash Drive 32GB',
                'category' => 'USB Flash Drives',
                'brand' => 'SanDisk',
                'model' => 'Cruzer 32GB',
                'image_path' => 'images/equipment/usb.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'High-capacity USB drive for multimedia assignments.',
                'count' => 2,
            ],
            [
                'name' => 'USB Flash Drive 64GB',
                'category' => 'USB Flash Drives',
                'brand' => 'PNY',
                'model' => 'Attache 64GB',
                'image_path' => 'images/equipment/usb.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Large USB drive for storing project backups.',
                'count' => 2,
            ],
            [
                'name' => 'USB Flash Drive 128GB',
                'category' => 'USB Flash Drives',
                'brand' => 'Samsung',
                'model' => 'Bar Plus 128GB',
                'image_path' => 'images/equipment/usb.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'High-capacity flash drive for coursework and presentations.',
                'count' => 2,
            ],
            [
                'name' => 'External Hard Drive 4TB',
                'category' => 'External Hard Drives',
                'brand' => 'Seagate',
                'model' => 'Backup Plus 4TB',
                'image_path' => 'images/equipment/hdd.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'High-capacity external storage for large multimedia projects.',
                'count' => 2,
            ],
            [
                'name' => 'SSD External Storage 1TB',
                'category' => 'External Hard Drives',
                'brand' => 'Samsung',
                'model' => 'T7 Shield 1TB',
                'image_path' => 'images/equipment/hdd.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Portable SSD for fast storage and group work.',
                'count' => 2,
            ],
            [
                'name' => 'Memory Card 128GB',
                'category' => 'Memory Cards',
                'brand' => 'SanDisk',
                'model' => 'Extreme 128GB',
                'image_path' => 'images/equipment/memorycard.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Memory card for cameras and portable recorders.',
                'count' => 2,
            ],
            [
                'name' => 'Card Reader',
                'category' => 'Card Readers',
                'brand' => 'Anker',
                'model' => 'USB 3.0 Multi-Card Reader',
                'image_path' => 'images/equipment/cardreader.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Multi-format card reader for cameras and tablets.',
                'count' => 2,
            ],
            [
                'name' => 'Portable Wi-Fi Router',
                'category' => 'Networking Equipment',
                'brand' => 'TP-Link',
                'model' => 'M7350',
                'image_path' => 'images/equipment/wifi.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Portable router for secure internet access during remote work.',
                'count' => 2,
            ],
            [
                'name' => 'Pocket Wi-Fi Device',
                'category' => 'Networking Equipment',
                'brand' => 'Huawei',
                'model' => 'E5577',
                'image_path' => 'images/equipment/wifi.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Pocket Wi-Fi for mobile connectivity and field research.',
                'count' => 2,
            ],
            [
                'name' => 'Network Cable Kit',
                'category' => 'Networking Equipment',
                'brand' => 'StarTech',
                'model' => 'Cat6 Patch Cable Kit',
                'image_path' => 'images/equipment/network_kit.svg',
                'location' => 'Computer Laboratory',
                'quantity' => 1,
                'description' => 'Network cable kit for lab setups and troubleshooting.',
                'count' => 2,
            ],
            [
                'name' => 'USB Wi-Fi Adapter',
                'category' => 'Networking Equipment',
                'brand' => 'TP-Link',
                'model' => 'TL-WN725N',
                'image_path' => 'images/equipment/wifi.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'USB adapter to add wireless connectivity to desktop stations.',
                'count' => 2,
            ],
            [
                'name' => 'Keyboard',
                'category' => 'Computer Accessories',
                'brand' => 'Dell',
                'model' => 'KB216',
                'image_path' => 'images/equipment/keyboard.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Wired keyboard for student desks and shared stations.',
                'count' => 2,
            ],
            [
                'name' => 'Wireless Keyboard',
                'category' => 'Computer Accessories',
                'brand' => 'Logitech',
                'model' => 'K380',
                'image_path' => 'images/equipment/keyboard.svg',
                'location' => 'Computer Laboratory',
                'quantity' => 1,
                'description' => 'Compact wireless keyboard for flexible workstations.',
                'count' => 2,
            ],
            [
                'name' => 'Mouse',
                'category' => 'Computer Accessories',
                'brand' => 'HP',
                'model' => 'X3000',
                'image_path' => 'images/equipment/mouse.svg',
                'location' => 'Computer Laboratory',
                'quantity' => 1,
                'description' => 'Comfortable optical mouse for everyday student use.',
                'count' => 2,
            ],
            [
                'name' => 'Wireless Mouse',
                'category' => 'Computer Accessories',
                'brand' => 'Logitech',
                'model' => 'M185',
                'image_path' => 'images/equipment/mouse.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Wireless mouse for notebook and tablet-compatible work.',
                'count' => 2,
            ],
            [
                'name' => 'Drawing Tablet',
                'category' => 'Drawing Tablets',
                'brand' => 'Wacom',
                'model' => 'Intuos S',
                'image_path' => 'images/equipment/tablet.svg',
                'location' => 'Art Room',
                'quantity' => 1,
                'description' => 'Drawing tablet for digital art, design, and multimedia projects.',
                'count' => 2,
            ],
            [
                'name' => 'Graphics Tablet',
                'category' => 'Drawing Tablets',
                'brand' => 'Huion',
                'model' => 'Inspiroy H640P',
                'image_path' => 'images/equipment/tablet.svg',
                'location' => 'Art Room',
                'quantity' => 1,
                'description' => 'Graphics tablet for sketching and production work.',
                'count' => 2,
            ],
            [
                'name' => 'USB Hub',
                'category' => 'Computer Accessories',
                'brand' => 'Anker',
                'model' => '7-Port USB Hub',
                'image_path' => 'images/equipment/usb_hub.svg',
                'location' => 'Computer Laboratory',
                'quantity' => 1,
                'description' => 'USB hub for connecting multiple peripherals to a single workstation.',
                'count' => 2,
            ],
            [
                'name' => 'Laptop Charger',
                'category' => 'Computer Accessories',
                'brand' => 'Dell',
                'model' => '65W USB-C Adapter',
                'image_path' => 'images/equipment/charger.svg',
                'location' => 'ICT Office',
                'quantity' => 1,
                'description' => 'Replacement laptop charger for student loan laptops.',
                'count' => 2,
            ],
            [
                'name' => 'Extension Cord',
                'category' => 'Computer Accessories',
                'brand' => 'AmazonBasics',
                'model' => '5m Extension Cable',
                'image_path' => 'images/equipment/extension_cord.svg',
                'location' => 'Computer Laboratory',
                'quantity' => 1,
                'description' => 'Power extension cord for flexible equipment placement.',
                'count' => 2,
            ],
            [
                'name' => 'Power Bank',
                'category' => 'Computer Accessories',
                'brand' => 'Anker',
                'model' => 'PowerCore 20000',
                'image_path' => 'images/equipment/powerbank.svg',
                'location' => 'Library Loan Desk',
                'quantity' => 1,
                'description' => 'Power bank for mobile devices and loaner tablets.',
                'count' => 2,
            ],
            [
                'name' => 'Ring Light',
                'category' => 'Multimedia Equipment',
                'brand' => 'Neewer',
                'model' => '18-inch LED',
                'image_path' => 'images/equipment/ringlight.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Ring light for video projects, streaming and content creation.',
                'count' => 2,
            ],
            [
                'name' => 'Studio Light',
                'category' => 'Multimedia Equipment',
                'brand' => 'Godox',
                'model' => 'SL-60W',
                'image_path' => 'images/equipment/studio_light.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Studio light for photography and video shoots.',
                'count' => 2,
            ],
            [
                'name' => 'Tripod Stand',
                'category' => 'Multimedia Equipment',
                'brand' => 'Manfrotto',
                'model' => 'Compact Action',
                'image_path' => 'images/equipment/tripod.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Tripod stand for cameras, projectors and lighting.',
                'count' => 2,
            ],
            [
                'name' => 'Green Screen Kit',
                'category' => 'Multimedia Equipment',
                'brand' => 'Elgato',
                'model' => 'Green Screen MT',
                'image_path' => 'images/equipment/greenscreen.svg',
                'location' => 'Media Room',
                'quantity' => 1,
                'description' => 'Green screen kit for video production and virtual backdrops.',
                'count' => 2,
            ],
            [
                'name' => 'Document Camera',
                'category' => 'Multimedia Equipment',
                'brand' => 'IPEVO',
                'model' => 'V4K',
                'image_path' => 'images/equipment/document_camera.svg',
                'location' => 'Classroom 101',
                'quantity' => 1,
                'description' => 'Document camera for live demonstrations and remote lessons.',
                'count' => 2,
            ],
        ];

        $items = [];
        $assetId = 1001;
        foreach ($equipmentTemplates as $template) {
            for ($i = 1; $i <= $template['count']; $i++) {
                $status = $this->chooseStatus($assetId);
                $quantity = $template['quantity'];
                $availableQuantity = $this->calculateAvailableQuantity($status, $quantity);
                $purchaseDate = $this->randomPurchaseDate();
                $items[] = [
                    'asset_tag' => sprintf('ICT-%04d', $assetId),
                    'name' => $template['name'],
                    'category' => $template['category'],
                    'brand' => $template['brand'],
                    'model' => $template['model'] . ($template['count'] > 1 ? " #{$i}" : ''),
                    'serial_number' => strtoupper(substr($template['brand'], 0, 2)) . '-' . strtoupper(substr($template['model'], 0, 2)) . '-' . str_pad($assetId, 4, '0', STR_PAD_LEFT),
                    'location' => $template['location'],
                    'assigned_to' => null,
                    'purchase_date' => $purchaseDate,
                    'warranty_expiration' => $this->warrantyExpiration($purchaseDate),
                    'condition' => $this->conditionForStatus($status),
                    'quantity' => $quantity,
                    'available_quantity' => $availableQuantity,
                    'status' => $status,
                    'status_label' => $this->statusLabel($status),
                    'description' => $template['description'],
                    'image_path' => $template['image_path'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                $assetId++;
            }
        }

        DB::table('equipment')->insert($items);
    }

    private function randomPurchaseDate(): string
    {
        $start = Carbon::createFromDate(2019, 1, 1);
        $end = Carbon::createFromDate(2024, 12, 31);
        return Carbon::createFromTimestamp(rand($start->timestamp, $end->timestamp))->format('Y-m-d');
    }

    private function warrantyExpiration(string $purchaseDate): string
    {
        return Carbon::parse($purchaseDate)->addYears(3)->format('Y-m-d');
    }

    private function chooseStatus(int $assetId): string
    {
        if ($assetId % 23 === 0) {
            return 'lost';
        }
        if ($assetId % 17 === 0) {
            return 'maintenance';
        }
        if ($assetId % 11 === 0) {
            return 'reserved';
        }
        if ($assetId % 7 === 0) {
            return 'borrowed';
        }
        return 'available';
    }

    private function calculateAvailableQuantity(string $status, int $quantity): int
    {
        switch ($status) {
            case 'available':
                return $quantity;
            case 'reserved':
            case 'borrowed':
            case 'maintenance':
            case 'lost':
                return max(0, $quantity - 1);
            default:
                return $quantity;
        }
    }

    private function conditionForStatus(string $status): string
    {
        switch ($status) {
            case 'lost':
                return 'Poor';
            case 'maintenance':
                return 'Fair';
            case 'borrowed':
                return in_array(rand(0, 1), [0, 1]) ? 'Good' : 'Fair';
            default:
                return 'Good';
        }
    }

    private function statusLabel(string $status): string
    {
        $labels = [
            'available' => 'Available',
            'borrowed' => 'Borrowed',
            'reserved' => 'Reserved',
            'maintenance' => 'Under Maintenance',
            'lost' => 'Lost',
        ];

        return $labels[$status] ?? ucfirst($status);
    }
}
