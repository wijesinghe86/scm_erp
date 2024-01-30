<div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="invoice_type">Invoice Type</label>
            <select class="form-control item-select" name="invoice_type" id="invoice_type" required wire:model="invoice_type">
                <option value="">-------</option>
                <option value="Tax invoice">Tax Invoice</option>
                <option value="Non tax invoice">Non Tax Invoice</option>
                <option value="Suspended tax invoice">Suspended Tax Invoice</option>
            </select>
        </div>
    <div class="form-group col-md-4">
            <label for="invoice_option">Invoice Option</label>
            <select wire:model="invoice_option" class="form-control item-select" id="invoice_option">
                <option value="">-</option>
                <option value="Option A"  @if($invoice_type == "Non tax invoice" || $invoice_type == "Suspended tax invoice" ) disabled @endif>Option A</option>
                <option value="Option B"  @if($invoice_type == "Non tax invoice" || $invoice_type == "Suspended tax invoice" ) disabled @endif>Option B</option>
                <option value="Option C"  @if($invoice_type == "Non tax invoice" || $invoice_type == "Suspended tax invoice" ) disabled @endif>Option C</option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="invoice_category">Category</label>
{{--             <input type="text" class="form-control item-select" name="invoice_category" readonly id="invoice_category">--}}

{{--            --}}{{-- Downcodingswerecommentedtomakethecategoryfieldreadonly --}}
            <select wire:model="invoice_category" class="form-control item-select" name="invoice_category"  id="invoice_category"
                    required>
                <option value="">-</option>
                @foreach ($categories as $category)
{{--                    <option value="{{ $category->id }}"> {{ $category->billtype_code }} </option>--}}
                    <option value="{{ $category->billtype_code }}"> {{ $category->billtype_code }} </option>
                @endforeach
            </select>
        </div>

        </div>
    <button wire:click.prevent="store()" class="btn btn-success me-2">Complete Invoice Settings</button>
</div>
