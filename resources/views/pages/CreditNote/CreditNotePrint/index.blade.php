@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Credit Note Print</h2>
                        <form class="forms-sample" method="POST" action="{{route('credit_note_print.view')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Credit Note No</label>
                                    <select class="form-control creditnote-select" name="credit_note_no" id="credit_note_no"> 
                                        <option value="" selected disabled>Select Credit Note</option>
                                        @foreach ($creditNotes as $creditNote)
                                        <option value="{{ $creditNote->id }}">{{ $creditNote->credit_note_no }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>                     
                            <a href="{{route('credit_note_print.view')}}" class="btn btn-danger">View and Print</a> 
                            <a href="{{route('dashboard')}}" class="btn btn-danger">Back</a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
     
$(document).ready(function() {
    //console.log(invoices);
    $('.creditnote-select').select2({
        placeholder: "Select",
    });
});

</script>
@endpush