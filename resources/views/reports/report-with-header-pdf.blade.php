<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lab report</title>
    <style>
        /* A4 content box; bottom margin reserved so fixed footer never overlaps results */
        @page {
            margin: 14px 18px 128px 18px;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
            margin: 0;
            padding: 0;
        }

        .pdf-main {
            width: 100%;
        }

        /* Pin footer to bottom of every page (matches letterpad min-h + footer) */
        .pdf-footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -118px;
            width: 100%;
            height: 118px;
        }

        .pdf-footer-note {
            margin: 0 0 4px 0;
            text-align: center;
            font-size: 9px;
            font-family: DejaVu Serif, serif;
        }

        .pdf-signatures {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid #000;
            margin: 0 0 4px 0;
        }

        .pdf-signatures td {
            width: 25%;
            vertical-align: top;
            text-align: center;
            padding: 6px 6px 6px 6px;
        }

        .pdf-signatures h3 {
            font-family: DejaVu Serif, serif;
            font-size: 10px;
            font-weight: bold;
            margin: 0 0 2px 0;
        }

        .pdf-signatures p {
            font-family: DejaVu Serif, serif;
            font-size: 8px;
            margin: 0;
            line-height: 1.25;
        }

        .pdf-address-bar {
            text-align: center;
            font-size: 10px;
            background: #312e81;
            color: #fff;
            padding: 8px 8px;
            font-family: DejaVu Serif, serif;
        }

        .pdf-address-bar p {
            margin: 0;
            line-height: 1.35;
        }

        .pdf-address-bar .pdf-address-line2 {
            font-size: 9px;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="pdf-main">
        @include('reports.partials.letterpad-header-pdf', ['data' => $data])

        @include('livewire.partials.report-body-pdf', ['data' => $data])
    </div>

    <div class="pdf-footer">
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
    </div>
</body>
</html>
