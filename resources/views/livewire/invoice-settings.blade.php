<div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="invoice_type">Invoice Type</label>
            <select class="form-control item-select" name="invoice_type" id="invoice_type" required
                    wire:model="invoice_type">
                <option value="">-------</option>
                @foreach($types as $type)

                    <option value="{{$type->id}}">{{ $type->name }}</option>

                @endforeach


            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="invoice_option">Invoice Option</label>
            <select wire:model="invoice_option" class="form-control item-select" id="invoice_option">
               
                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                        {{--                            @if($invoice_type == 1 || $invoice_type == 3 ) disabled @endif--}}
                    >
                        {{ $option->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="invoice_category">Category</label>
            {{--             <input type="text" class="form-control item-select" name="invoice_category" readonly id="invoice_category">--}}

            {{--            --}}{{----}}{{-- Downcodingswerecommentedtomakethecategoryfieldreadonly --}}
            <select wire:model="invoice_category" class="form-control item-select" name="invoice_category"
                    id="invoice_category"
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
