@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Section Details View</h4>
            <form class="forms-sample" method="POST" action="{{ route('section.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Department Number :</label>
                        <span>{{$sections->department_number}}</span>
                       </div>
                    </div>
                       <div class="row">
                    <div class="form-group col-md-4">
                        <label>Section Number :</label>
                        <span>{{$sections->section_number}}</span>
                         </div>
                        </div>
                         <div class="row">
                    <div class="form-group col-md-4">
                        <label>Section Name :</label>
                        <span>{{$sections->section_name}}</span>
                       </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Section Description :</label>
                        <span>{{$sections->section_description}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remark :</label>
                        <span>{{$sections->remark}}</span>
                    </div>
                </div>
                <a href="{{ route('section.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>
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
