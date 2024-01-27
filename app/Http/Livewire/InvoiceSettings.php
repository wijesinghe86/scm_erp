<?php

namespace App\Http\Livewire;

use App\Models\BillType;
use App\Models\InvoiceSetting;
use Livewire\Component;

class InvoiceSettings  extends Component
{
    public $invoice_type;
    public $invoice_option;
    public $invoice_category;


    public function invoice_type($value){
        if ($value == '2' ||$value == '3'){
            $this->invoice_option = null;
        }

    }
    protected $rules = [
        'invoice_type'=>'required',
        'invoice_category'=>'required'
    ];
    public function render()
    {
    $categories = BillType::all();
        return view('livewire.invoice-settings',compact('categories'));
    }

    public function resetFields(){
        $this->invoice_type = '';
        $this->invoice_category = '';
        $this->invoice_option = '';
        $this->updated_by = '';
    }

    public function store(){
        $this->validate();

        try{
            InvoiceSetting::create([
                'invoice_type'=>$this->invoice_type,
                'invoice_category'=>$this->invoice_category,
                'invoice_option'=>$this->invoice_option,
//                'updated_by'=>$this->updated_by
            ]);
            $response['alert-success'] = 'Invoice Settings created successfully';
            return redirect()->route('invoicesettings.all')->with($response);
//            $this->resetFields();
        }
        catch (\Exception $e){
            $this->resetFields();
        }
    }


}
