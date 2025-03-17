@extends('layouts.app')
@section('content')
    <div id="urgentInvoiceCreate"   
    data-employees="{{$employees}}"
    data-urgentDeliveries="{{$urgentDeliveries}}"
    data-billTypes="{{$billTypes}}"
    data-customers="{{$customers}}"
    data-warehouses="{{$warehouses}}"
    data-customerTerms="{{$customerTerms}}"
    data-customerCreditPeriod="{{$customerCreditPeriod}}"
    data-vatRate="18"
    >Loading</div>
@endsection
