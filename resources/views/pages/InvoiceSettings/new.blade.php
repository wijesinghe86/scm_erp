{{-- @extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Invoice
                            Settings</h4>
                        <br>
                        <form class="forms-sample" method="POST" action="{{ route('invoicesettings.update') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Invoice Type</label>
                                    <select class="form-control item-select" name="invoice_type" id="invoice_type" required>
                                        <option value="1"
                                            {{ $setting ? ($setting->invoice_type == 1 ? 'selected' : '') : '' }}>
                                            Non Tax Invoice
                                        </option>
                                        <option value="2"
                                            {{ $setting ? ($setting->invoice_type == 2 ? 'selected' : '') : '' }}>
                                            Tax Invoice
                                        </option>
                                        <option value="3"
                                            {{ $setting ? ($setting->invoice_type == 3 ? 'selected' : '') : '' }}>
                                            Suspended Tax Invoice
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Category</label>
                                    {{-- <input type="text" class="form-control item-select" name="invoice_category" readonly id="invoice_category"> --}}
                                    
                                    {{-- Downcodingswerecommentedtomakethecategoryfieldreadonly --}}
                                  {{-- <select class="form-control item-select" name="invoice_category" readonly id="invoice_category" 
                                        required>
                                        <option value="">-</option> 
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $setting ? ($setting->invoice_category == $category->id ? 'selected' : '') : '' }}>
                                                {{ $category->billtype_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Option</label>
                                    <select class="form-control item-select" name="invoice_option" id="invoice_option"
                                        required>
                                        <option value="">-</option>
                                        <option value="0"
                                            {{ $setting ? ($setting->invoice_option == 0 ? 'selected' : '') : '' }}>None
                                        </option>
                                        <option value="1"
                                            {{ $setting ? ($setting->invoice_option == 1 ? 'selected' : '') : '' }}>Option A
                                        </option>
                                        <option value="2"
                                            {{ $setting ? ($setting->invoice_option == 2 ? 'selected' : '') : '' }}>Option
                                            B
                                        </option>
                                        <option value="3"
                                            {{ $setting ? ($setting->invoice_option == 3 ? 'selected' : '') : '' }}>Option
                                            C
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Complete Invoice Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const invoiceCategories = <?php echo json_encode($categories); ?>;
            $(document).ready(function() {
                let invoiceType = $('#invoice_type').val();
                setinvoiceOption(invoiceType, "load");
            })
            $('#invoice_type').on('change', function() {
                let invoiceType = $(this).val();
                setinvoiceOption(invoiceType, "other");
            })

            function setinvoiceOption(invoiceType, runType) {
                if (invoiceType == 1) {
                    $('#invoice_option').val(0)
                    $("#invoice_option").find(':not(:selected)').prop('disabled', true);
                    const invoiceCategory = invoiceCategories?.find(row => row?.billtype_code == "GIN")
                    if (invoiceCategory) {
                        $('#invoice_category').val(invoiceCategory?.id)
                    }
                    return
                }
                if (invoiceType == 2) {
                    $("#invoice_option").find(':not(:selected)').prop('disabled', false);
                    if (runType != "load") {
                        $('#invoice_option').val("")
                    }
                    const invoiceCategory = invoiceCategories?.find(row => row?.billtype_code == "GTI")
                    if (invoiceCategory) {
                        $('#invoice_category').val(invoiceCategory?.id)
                    }
                    return
                }
                if (invoiceType == 3) {
                    $('#invoice_option').val(3)
                    $("#invoice_option").find(':not(:selected)').prop('disabled', true);
                    const invoiceCategory = invoiceCategories?.find(row => row?.billtype_code == "GSVT")
                    if (invoiceCategory) {
                        $('#invoice_category').val(invoiceCategory?.id)
                    }
                    return
                }
            } --}} --}}

            // function setinvoiceOption(invoiceType, runType) {
            //     if (invoiceType == 1) {
            //         $('#invoice_option').val(0)
            //         $("#invoice_option").find(':not(:selected)').prop('disabled', true);
            //         const invoiceCategory = invoiceCategories?.find(row => row?.billtype_code == "GIN")
            //         if (invoiceCategory) {
            //             $('#invoice_category').val(invoiceCategory?.id )
            //         }
            //         return
            //     }
            //     if (invoiceType == 2) {
            //         $("#invoice_option").find(':not(:selected)').prop('disabled', false);
            //         if (runType != "load") {
            //             $('#invoice_option').val("")
            //         }
            //         const invoiceCategory = invoiceCategories?.find(row => row?.billtype_code == "GTI")
            //         if (invoiceCategory) {
            //             $('#invoice_category').val(invoiceCategory?.id )
            //         }
            //         return
            //     }
            //     if (invoiceType == 3) {
            //         $('#invoice_option').val(3)
            //         $("#invoice_option").find(':not(:selected)').prop('disabled', true);
            //         const invoiceCategory = invoiceCategories?.find(row => row?.billtype_code == "GSVT")
            //         if (invoiceCategory) {
            //             $('#invoice_category').val(invoiceCategory?.id)
            //         }
            //         return
            //     }
            // }

            
        {{-- </script>
    @endpush
@endsection --}}
