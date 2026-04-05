<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lab report</title>
    <style>
        @page { margin: 14px 18px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .pdf-footer-note {
            margin-top: 16px;
            margin-bottom: 8px;
            text-align: center;
            font-size: 8px;
            font-family: DejaVu Serif, serif;
        }

        .pdf-signatures {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid #000;
            margin-top: 4px;
            margin-bottom: 4px;
        }

        .pdf-signatures td {
            width: 25%;
            vertical-align: top;
            text-align: center;
            padding: 8px 6px 10px 6px;
        }

        .pdf-signatures h3 {
            font-family: DejaVu Serif, serif;
            font-size: 9px;
            font-weight: bold;
            margin: 0 0 2px 0;
        }

        .pdf-signatures p {
            font-family: DejaVu Serif, serif;
            font-size: 7px;
            margin: 0;
            line-height: 1.25;
        }

        .pdf-address-bar {
            text-align: center;
            font-size: 9px;
            background: #312e81;
            color: #fff;
            padding: 10px 8px;
            font-family: DejaVu Serif, serif;
        }

        .pdf-address-bar p {
            margin: 0;
            line-height: 1.35;
        }

        .pdf-address-bar .pdf-address-line2 {
            font-size: 8px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    @include('reports.partials.letterpad-header-pdf', ['data' => $data])

    @include('livewire.partials.report-body-pdf', ['data' => $data])

    <p class="pdf-footer-note">Electronically verified report. No signature(s) required. Not valid for Court</p>

    <table class="pdf-signatures" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <h3>Dr. Tariq Saeed</h3>
                <p>M.B.B.S. M.C.P.S, F.C.P.S</p>
                <p>Asst prof. surgery Shalimar</p>
            </td>
            <td>
                <h3>Dr. Muhammad Sohail</h3>
                <p>M.B.B.S, MS (UROLOGY)</p>
                <p>Consultant Urologist</p>
            </td>
            <td>
                <h3>Muhammad Asghar</h3>
                <p>Sr. Lab Technician</p>
            </td>
            <td>
                <h3>Muhammad Zia Ul Haq</h3>
                <p>Biochemist &amp; Molecular Biologist</p>
            </td>
        </tr>
    </table>

    <div class="pdf-address-bar">
        <p>
            <span style="font-family: DejaVu Sans, sans-serif;">433/12</span>-A, Peer Colony, St <span style="font-family: DejaVu Sans, sans-serif;"># 1</span>, Walton Road
            Lahore, <span style="font-family: DejaVu Sans, sans-serif;">Cell: 0320-8489685 | Ph: 042 36662345</span>
        </p>
        <p class="pdf-address-line2">Website: mohsinmedicalcomplex.com</p>
    </div>
</body>
</html>
