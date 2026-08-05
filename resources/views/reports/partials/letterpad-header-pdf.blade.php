@php
    $barcodePublic = public_path('images/download (1).png');
    $barcodeSrc = file_exists($barcodePublic)
        ? 'data:image/png;base64,'.base64_encode(file_get_contents($barcodePublic))
        : null;
@endphp
<table class="pdf-letterpad-header" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 10px;">
    <tr>
        <td style="vertical-align: top; width: 62%;">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td style="vertical-align: top; padding-right: 4px;">
                        <div style="font-size: 30px; font-weight: 600; color: #1e3a8a; font-family: DejaVu Serif, serif; line-height: 1.1;">
                            Mohsin
                        </div>
                        <div style="font-size: 11px; font-family: DejaVu Serif, serif; margin-top: 2px;">
                            PHC REG # R <span style="font-family: DejaVu Sans, sans-serif;">13048</span>
                        </div>
                    </td>
                    <td style="vertical-align: bottom; padding-bottom: 2px;">
                        <div style="font-size: 14px; font-weight: 600; color: #1e3a8a; font-family: DejaVu Serif, serif; line-height: 1.15;">
                            &nbsp;Clinical
                        </div>
                        <div style="font-size: 14px; font-weight: 600; color: #1e3a8a; font-family: DejaVu Serif, serif; line-height: 1.15;">
                            &nbsp;Laboratory
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td style="vertical-align: top; text-align: right; width: 38%;">
            <div style="font-family: DejaVu Serif, serif; font-size: 13px;">Medical Record No:</div>
            @if ($barcodeSrc)
                <div style="margin-top: 2px;">
                    <img src="{{ $barcodeSrc }}" height="32" alt="" style="display: inline-block;"/>
                </div>
            @endif
            <div style="font-size: 13px; text-align: center; margin-top: 2px;">
                {{ now()->format('d-m-Y') }}-{{ $data->id }}
            </div>
        </td>
    </tr>
</table>
