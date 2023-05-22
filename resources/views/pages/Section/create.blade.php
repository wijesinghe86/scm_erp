@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Section Creation Master</h4>
            <form class="forms-sample" method="POST" action="{{ route('section.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Department Number</label>
                        <select class="form-control item-select" name="department_number">
                            @foreach ($departments as $department )
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Section Number</label>
                        <input type="text" class="form-control" name="section_number" placeholder="Section Number" value="{{$next_number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Section Name</label>
                        <input type="text" class="form-control" name="section_name" placeholder="Section Name">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Section Description</label>
                        <input type="text" class="form-control" name="section_description" placeholder="Section Description">
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="remark" placeholder="Remarks">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

  @push('scripts')
<script>
    $(document).ready(function(){
        $('.item-select').select2(
            {
                placeholder: "Select Item",
            });
    });

</script>
@endpush

@push('styles')
<style>
    .select2-container .select-selection--single{
        height: 46px;
    }
    </style>

@endpush
