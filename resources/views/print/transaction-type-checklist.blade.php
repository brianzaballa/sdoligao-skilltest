<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist — {{ $transactionType->description }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturMaguntia&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            color: #000;
            background: #fff;
            padding: 0;
        }

        .page {
            width: 8.5in;
            min-height: 11in;
            margin: 0 auto;
            padding: 0.75in 1in;
        }

        /* ── Header ──────────────────────────────────────── */
        .header {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 3px double #000;
            margin-bottom: 18px;
        }

        .header img {
            width: 88px;
            height: 88px;
            object-fit: contain;
            display: block;
            margin: 0 auto 8px;
        }

        .old-english {
            font-family: 'Old English Text MT', 'UnifrakturMaguntia', 'Palatino Linotype', serif;
            font-size: 15pt;
            line-height: 1.35;
            color: #000;
        }

        .header-region {
            font-size: 10.5pt;
            margin-top: 3px;
            line-height: 1.4;
        }

        .header-division {
            font-size: 11.5pt;
            font-weight: bold;
            letter-spacing: 0.05em;
            margin-top: 3px;
            text-transform: uppercase;
        }

        /* ── Document info ──────────────────────────────── */
        .doc-meta {
            margin-bottom: 20px;
            font-size: 9pt;
            color: #444;
            text-align: right;
        }

        /* ── Checklist title ────────────────────────────── */
        .checklist-title {
            text-align: center;
            margin-bottom: 4px;
        }

        .checklist-title h1 {
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 2px;
        }

        .checklist-subtitle {
            text-align: center;
            font-size: 10pt;
            color: #555;
            margin-bottom: 6px;
        }

        .type-label {
            text-align: center;
            margin-bottom: 4px;
        }

        .type-label .type-name {
            font-size: 11.5pt;
            font-weight: bold;
        }

        .type-label .type-meta {
            font-size: 9.5pt;
            color: #444;
        }

        /* ── Documents list ─────────────────────────────── */
        .documents-section {
            margin: 18px 0 10px;
            border: 1px solid #bbb;
            border-radius: 3px;
            overflow: hidden;
        }

        .documents-section-header {
            background: #f0f0f0;
            border-bottom: 1px solid #bbb;
            padding: 5px 12px;
            font-size: 9pt;
            font-weight: bold;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #333;
        }

        .document-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 7px 12px;
            border-bottom: 1px solid #e8e8e8;
            font-size: 11pt;
        }

        .document-item:last-child {
            border-bottom: none;
        }

        .document-item .checkbox {
            flex-shrink: 0;
            width: 60px;
            font-family: 'Courier New', monospace;
            font-size: 11pt;
            padding-top: 1px;
            letter-spacing: 2px;
            color: #555;
        }

        .document-item .doc-name {
            flex: 1;
            line-height: 1.4;
        }

        .document-item .item-no {
            flex-shrink: 0;
            width: 22px;
            font-size: 9pt;
            color: #999;
            padding-top: 2px;
        }

        /* ── Status ─────────────────────────────────────── */
        .status-section {
            margin: 18px 0;
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .status-label {
            font-size: 10.5pt;
            font-weight: bold;
            margin-right: 4px;
        }

        .status-option {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11pt;
        }

        .status-option .checkbox {
            font-family: 'Courier New', monospace;
            font-size: 11pt;
            letter-spacing: 2px;
            color: #555;
        }

        /* ── Signature block ────────────────────────────── */
        .signature-section {
            margin-top: 28px;
            display: flex;
            gap: 40px;
        }

        .signature-block {
            flex: 1;
        }

        .signature-block .sig-label {
            font-size: 10pt;
            margin-bottom: 28px;
        }

        .signature-block .sig-line {
            border-top: 1px solid #000;
            padding-top: 3px;
            font-size: 9pt;
            color: #555;
        }

        /* ── Footer ─────────────────────────────────────── */
        .print-footer {
            margin-top: 32px;
            padding-top: 8px;
            border-top: 1px solid #ccc;
            font-size: 8pt;
            color: #888;
            text-align: center;
        }

        /* ── No-print toolbar ───────────────────────────── */
        .toolbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #1e3a8a;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-family: Arial, sans-serif;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .toolbar .toolbar-title {
            font-weight: 600;
        }

        .toolbar .btn-print {
            background: #fff;
            color: #1e3a8a;
            border: none;
            padding: 6px 18px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .toolbar .btn-print:hover {
            background: #dbeafe;
        }

        .toolbar .btn-back {
            color: #93c5fd;
            text-decoration: none;
            font-size: 11px;
        }

        .toolbar .btn-back:hover { color: #fff; }

        @media print {
            .toolbar { display: none !important; }
            body { padding: 0; }
            .page { margin: 0; padding: 0.5in 0.75in; width: 100%; }
        }

        /* Add top margin on screen to clear fixed toolbar */
        @media screen {
            body { padding-top: 48px; background: #e5e7eb; }
            .page { background: #fff; box-shadow: 0 4px 24px rgba(0,0,0,0.12); }
        }
    </style>
</head>
<body>

    {{-- Toolbar (hidden on print) --}}
    <div class="toolbar">
        <a href="{{ url()->previous(url('/admin')) }}" class="btn-back">&#8592; Back</a>
        <span class="toolbar-title">Checklist Preview — {{ $transactionType->description }}</span>
        <button class="btn-print" onclick="window.print()">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Print
        </button>
    </div>

    <div class="page">

        {{-- DepEd Header --}}
        <div class="header">
            <img src="{{ asset('images/deped.png') }}" alt="Department of Education">
            <div class="old-english">Republic of the Philippines</div>
            <div class="old-english">Department of Education</div>
            <div class="header-region">Region V - Bicol</div>
            <div class="header-division">Schools Division Office of Ligao</div>
        </div>

        {{-- Document meta --}}
        <div class="doc-meta">
            Date: _________________________ &nbsp;&nbsp; Control No.: _________________
        </div>

        {{-- Checklist title --}}
        <div class="checklist-title">
            <h1>Checklist</h1>
        </div>
        <div class="checklist-subtitle">Required Supporting Documents</div>

        {{-- Transaction type label --}}
        <div class="type-label">
            <div class="type-name">{{ $transactionType->description }}</div>
            <div class="type-meta">
                Expense Type: {{ $transactionType->expense_type }} &nbsp;&bull;&nbsp; UACS Code: {{ $transactionType->uacs_code }}
            </div>
        </div>

        {{-- Documents list --}}
        @php $attachments = $transactionType->attachments; @endphp
        <div class="documents-section">
            <div class="documents-section-header">Documentary Requirements ({{ $attachments->count() }} document{{ $attachments->count() === 1 ? '' : 's' }})</div>
            @forelse ($attachments as $i => $attachment)
                <div class="document-item">
                    <span class="item-no">{{ $i + 1 }}.</span>
                    <span class="checkbox">____</span>
                    <span class="doc-name">{{ $attachment->document_name }}</span>
                </div>
            @empty
                <div class="document-item" style="color:#888; font-style:italic;">
                    <span class="doc-name">No required documents defined for this transaction type.</span>
                </div>
            @endforelse
        </div>

        {{-- Status --}}
        <div class="status-section">
            <span class="status-label">Status:</span>
            <div class="status-option">
                <span class="checkbox">____</span>
                <span>Complete</span>
            </div>
            <div class="status-option">
                <span class="checkbox">____</span>
                <span>Incomplete</span>
            </div>
        </div>

        {{-- Signature block --}}
        <div class="signature-section">
            <div class="signature-block">
                <div class="sig-label">Reviewed by:</div>
                <div class="sig-line">Signature over Printed Name</div>
            </div>
            <div class="signature-block">
                <div class="sig-label">Position / Designation:</div>
                <div class="sig-line"></div>
            </div>
            <div class="signature-block">
                <div class="sig-label">Date:</div>
                <div class="sig-line"></div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="print-footer">
            DepEd SDO Ligao City &bull; Finance Management Portal &bull; Printed: {{ now()->format('F d, Y') }}
        </div>

    </div>

</body>
</html>
