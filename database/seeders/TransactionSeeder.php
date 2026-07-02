<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\TransactionTypeAttachment;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Transaction Types ──────────────────────────────────────────────
        $types = [
            [
                'description' => 'Travel Expenses — Local',
                'expense_type' => 'MOOE',
                'uacs_code' => '5-02-01-010',
                'attachments' => [
                    'Disbursement Voucher',
                    'Approved Travel Order',
                    'Approved Itinerary of Travel - Appendix 45',
                    'Certificate of Travel Completed',
                    'Certificate of Appearance/Attendance/Participation',
                    'Terminal Fees',
                    'OR - RER for expenses amounting to more than 300 but not exceeding 1000',
                ],
            ],
            [
                'description' => 'Travel Expenses — Air',
                'expense_type' => 'MOOE',
                'uacs_code' => '5-02-01-010',
                'attachments' => [
                    'Disbursement Voucher',
                    'Approved Travel Order',
                    'Approved Itinerary of Travel - Appendix 45',
                    'Certificate of Travel Completed',
                    'Certificate of Appearance/Attendance/Participation',
                    'Flight Ticket',
                    'Boarding Pass',
                    'Terminal Fees',
                ],
            ],
            [
                'description' => 'Office Supplies and Materials',
                'expense_type' => 'MOOE',
                'uacs_code' => '5-02-03-010',
                'attachments' => [
                    'Disbursement Voucher',
                    'Scanned Check/s',
                    'Memorandum',
                    'OR - RER for expenses amounting to more than 300 but not exceeding 1000',
                    'Documentation/Pictures',
                ],
            ],
            [
                'description' => 'Salaries and Wages — Regular',
                'expense_type' => 'PS',
                'uacs_code' => '5-01-01-010',
                'attachments' => [
                    'Disbursement Voucher',
                    'Scanned Check/s',
                ],
            ],
            [
                'description' => 'ICT Equipment Procurement',
                'expense_type' => 'CO',
                'uacs_code' => '1-07-05-020',
                'attachments' => [
                    'Disbursement Voucher',
                    'Scanned Check/s',
                    'Documentation/Pictures',
                    'CENRR',
                ],
            ],
            [
                'description' => 'Printing and Binding',
                'expense_type' => 'MOOE',
                'uacs_code' => '5-02-03-020',
                'attachments' => [
                    'Disbursement Voucher',
                    'Scanned Check/s',
                    'Memorandum',
                    'Documentation/Pictures',
                ],
            ],
            [
                'description' => 'Training / Seminar Expenses',
                'expense_type' => 'MOOE',
                'uacs_code' => '5-02-02-010',
                'attachments' => [
                    'Disbursement Voucher',
                    'Approved Travel Order',
                    'Certificate of Appearance/Attendance/Participation',
                    'OR - RER for expenses amounting to more than 300 but not exceeding 1000',
                    'Documentation/Pictures',
                ],
            ],
        ];

        foreach ($types as $typeData) {
            $attachments = $typeData['attachments'];
            unset($typeData['attachments']);

            $type = TransactionType::create($typeData);

            foreach ($attachments as $doc) {
                TransactionTypeAttachment::create([
                    'transaction_type_id' => $type->id,
                    'document_name' => $doc,
                ]);
            }
        }

        // ── Sample Transactions ────────────────────────────────────────────
        $travel    = TransactionType::where('description', 'Travel Expenses — Local')->first();
        $supplies  = TransactionType::where('description', 'Office Supplies and Materials')->first();
        $salaries  = TransactionType::where('description', 'Salaries and Wages — Regular')->first();
        $ict       = TransactionType::where('description', 'ICT Equipment Procurement')->first();
        $printing  = TransactionType::where('description', 'Printing and Binding')->first();
        $training  = TransactionType::where('description', 'Training / Seminar Expenses')->first();

        $transactions = [
            [
                'transaction_type_id' => $travel->id,
                'reference_no'        => 'DV-2025-001',
                'payee'               => 'Ma. Socorro T. Albano',
                'particulars'         => 'Travel expenses to Legazpi City for Regional Supervisors Meeting, June 5-6, 2025.',
                'amount'              => 3850.00,
                'transaction_date'    => '2025-06-08',
                'status'              => 'paid',
            ],
            [
                'transaction_type_id' => $supplies->id,
                'reference_no'        => 'DV-2025-002',
                'payee'               => 'National Book Store — Ligao Branch',
                'particulars'         => 'Purchase of bond paper (10 reams), folders, and ballpen sets for Division Office use.',
                'amount'              => 4200.00,
                'transaction_date'    => '2025-06-10',
                'status'              => 'paid',
            ],
            [
                'transaction_type_id' => $salaries->id,
                'reference_no'        => 'DV-2025-003',
                'payee'               => 'SDO Ligao City Permanent Employees',
                'particulars'         => 'Regular salaries and wages for the month of June 2025.',
                'amount'              => 1850000.00,
                'transaction_date'    => '2025-06-15',
                'status'              => 'paid',
            ],
            [
                'transaction_type_id' => $ict->id,
                'reference_no'        => 'DV-2025-004',
                'payee'               => 'TechPro Solutions Inc.',
                'particulars'         => 'Supply and delivery of 5 units laptop computers for Division Office (per PO No. 2025-ICT-01).',
                'amount'              => 275000.00,
                'transaction_date'    => '2025-06-18',
                'status'              => 'approved',
            ],
            [
                'transaction_type_id' => $printing->id,
                'reference_no'        => 'DV-2025-005',
                'payee'               => 'Albay Print & Copy Center',
                'particulars'         => 'Printing and binding of Annual Procurement Plan (APP) for FY 2025 — 50 copies.',
                'amount'              => 7500.00,
                'transaction_date'    => '2025-06-20',
                'status'              => 'for-review',
            ],
            [
                'transaction_type_id' => $training->id,
                'reference_no'        => 'DV-2025-006',
                'payee'               => 'Camarines Sur National High School',
                'particulars'         => 'Registration fees and meals for Naga City participation — Regional LAC Session on K-12 Curriculum, June 25-27, 2025.',
                'amount'              => 12600.00,
                'transaction_date'    => '2025-06-25',
                'status'              => 'for-review',
            ],
            [
                'transaction_type_id' => $supplies->id,
                'reference_no'        => 'DV-2025-007',
                'payee'               => 'JM Office Supply',
                'particulars'         => 'Toner cartridges (3 units) and printer ink sets for the Finance and Budget Office.',
                'amount'              => 8900.00,
                'transaction_date'    => '2025-06-28',
                'status'              => 'draft',
            ],
        ];

        foreach ($transactions as $data) {
            Transaction::create($data);
        }
    }
}
