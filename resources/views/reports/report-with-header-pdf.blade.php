<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lab report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #111; margin: 0; padding: 12px; }
        .lab-header { width: 100%; margin-bottom: 10px; border-bottom: 1px solid #333; padding-bottom: 8px; }
        .lab-header td { vertical-align: top; }
        .lab-name { font-size: 16px; font-weight: bold; color: #1e3a8a; }
        .footer-note { margin-top: 14px; text-align: center; font-size: 8px; }
        .address-bar { margin-top: 10px; text-align: center; font-size: 8px; background: #312e81; color: #fff; padding: 6px; }
    </style>
</head>
<body>
    <table class="lab-header">
        <tr>
            <td>
                <div class="lab-name">Mohsin</div>
                <div>Clinical Laboratory</div>
                <div style="font-size:9px;">PHC REG # R 13048</div>
            </td>
            <td style="text-align: right;">
                <div><strong>Medical Record No:</strong></div>
                <div>{{ $data->patient->created_at->format('d-m-Y') }}-{{ $data->id }}</div>
            </td>
        </tr>
    </table>

    @include('livewire.partials.report-body', ['data' => $data])

    <p class="footer-note">Electronically verified report. No signature(s) required. Not valid for Court</p>

    <div class="address-bar">
        433/12-A, Peer Colony, St # 1, Walton Road Lahore, Cell: 0320-8489685 | Ph: 042 36662345 — mohsinmedicalcomplex.com
    </div>
</body>
</html>
