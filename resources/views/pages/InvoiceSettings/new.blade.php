@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Invoice
                            Setting</h4><br>

                        @livewire('invoice-settings')



                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
