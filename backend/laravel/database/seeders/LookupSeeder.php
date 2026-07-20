<?php

namespace Database\Seeders;

use App\Models\ClientType;
use App\Models\EquipmentCategory;
use App\Models\EquipmentStatus;
use App\Models\InvoiceStatus;
use App\Models\JobOrderStatus;
use App\Models\MaintenanceType;
use App\Models\PaymentMethod;
use App\Models\ProjectStatus;
use App\Models\RentalStatus;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class LookupSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedClientTypes();
        $this->seedEquipmentCategories();
        $this->seedEquipmentStatuses();
        $this->seedMaintenanceTypes();
        $this->seedProjectStatuses();
        $this->seedTaskStatuses();
        $this->seedJobOrderStatuses();
        $this->seedRentalStatuses();
        $this->seedInvoiceStatuses();
        $this->seedPaymentMethods();
    }

    protected function seedClientTypes(): void
    {
        $types = [
            ['code' => 'customer', 'label' => 'Customer'],
            ['code' => 'vendor', 'label' => 'Vendor'],
            ['code' => 'partner', 'label' => 'Partner'],
            ['code' => 'prospect', 'label' => 'Prospect'],
        ];

        foreach ($types as $attributes) {
            ClientType::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedEquipmentCategories(): void
    {
        $categories = [
            ['name' => 'Heavy Machinery', 'description' => 'Large equipment for construction and industrial use.'],
            ['name' => 'Tools', 'description' => 'Handheld and power tools used across projects.'],
            ['name' => 'Vehicles', 'description' => 'Trucks, vans, and transport assets.'],
            ['name' => 'Electronics', 'description' => 'Sensors, communication devices, and electronics.'],
        ];

        foreach ($categories as $attributes) {
            EquipmentCategory::updateOrCreate(['name' => $attributes['name']], $attributes);
        }
    }

    protected function seedEquipmentStatuses(): void
    {
        $statuses = [
            ['code' => 'available', 'label' => 'Available'],
            ['code' => 'in_use', 'label' => 'In Use'],
            ['code' => 'under_maintenance', 'label' => 'Under Maintenance'],
            ['code' => 'retired', 'label' => 'Retired'],
        ];

        foreach ($statuses as $attributes) {
            EquipmentStatus::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedMaintenanceTypes(): void
    {
        $types = [
            ['code' => 'preventive', 'label' => 'Preventive'],
            ['code' => 'corrective', 'label' => 'Corrective'],
            ['code' => 'emergency', 'label' => 'Emergency'],
        ];

        foreach ($types as $attributes) {
            MaintenanceType::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedProjectStatuses(): void
    {
        $statuses = [
            ['code' => 'planned', 'label' => 'Planned'],
            ['code' => 'active', 'label' => 'Active'],
            ['code' => 'completed', 'label' => 'Completed'],
            ['code' => 'on_hold', 'label' => 'On Hold'],
            ['code' => 'cancelled', 'label' => 'Cancelled'],
        ];

        foreach ($statuses as $attributes) {
            ProjectStatus::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedTaskStatuses(): void
    {
        $statuses = [
            ['code' => 'todo', 'label' => 'To Do'],
            ['code' => 'in_progress', 'label' => 'In Progress'],
            ['code' => 'completed', 'label' => 'Completed'],
            ['code' => 'blocked', 'label' => 'Blocked'],
        ];

        foreach ($statuses as $attributes) {
            TaskStatus::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedJobOrderStatuses(): void
    {
        $statuses = [
            ['code' => 'pending', 'label' => 'Pending'],
            ['code' => 'approved', 'label' => 'Approved'],
            ['code' => 'scheduled', 'label' => 'Scheduled'],
            ['code' => 'in_progress', 'label' => 'In Progress'],
            ['code' => 'completed', 'label' => 'Completed'],
            ['code' => 'cancelled', 'label' => 'Cancelled'],
        ];

        foreach ($statuses as $attributes) {
            JobOrderStatus::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedRentalStatuses(): void
    {
        $statuses = [
            ['code' => 'reserved', 'label' => 'Reserved'],
            ['code' => 'active', 'label' => 'Active'],
            ['code' => 'returned', 'label' => 'Returned'],
            ['code' => 'overdue', 'label' => 'Overdue'],
            ['code' => 'cancelled', 'label' => 'Cancelled'],
        ];

        foreach ($statuses as $attributes) {
            RentalStatus::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedInvoiceStatuses(): void
    {
        $statuses = [
            ['code' => 'draft', 'label' => 'Draft'],
            ['code' => 'sent', 'label' => 'Sent'],
            ['code' => 'paid', 'label' => 'Paid'],
            ['code' => 'overdue', 'label' => 'Overdue'],
            ['code' => 'cancelled', 'label' => 'Cancelled'],
        ];

        foreach ($statuses as $attributes) {
            InvoiceStatus::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }

    protected function seedPaymentMethods(): void
    {
        $methods = [
            ['code' => 'cash', 'label' => 'Cash'],
            ['code' => 'credit_card', 'label' => 'Credit Card'],
            ['code' => 'bank_transfer', 'label' => 'Bank Transfer'],
            ['code' => 'check', 'label' => 'Check'],
            ['code' => 'mobile_payment', 'label' => 'Mobile Payment'],
        ];

        foreach ($methods as $attributes) {
            PaymentMethod::updateOrCreate(['code' => $attributes['code']], $attributes);
        }
    }
}
