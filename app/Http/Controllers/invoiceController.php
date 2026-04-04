<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class invoiceController extends Controller
{
    //
    public function __invoke($invoiceId){
        $total=0;
        $data=Patient::with('tests')->find($invoiceId);
        foreach ($data->tests as $test) {
            # code...
            $total+=($test->price);
        }
       return view('invoices.show',[
        'patient'=> $data,
        'total' => $total
       ]);
    //    Browsershot::html($html)->save('test.pdf');
    //    return 'done';
    }
}
