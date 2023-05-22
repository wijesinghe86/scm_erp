<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>
    <style>
    .table{
        font-size: 12px;
        background-color: rgba(red, green, blue, alpha);
        margin: auto
    }
    </style>
</head>
<body>
    <table cellspacing ="0" cellpadding="0" border="0" width="100%">
        <thead>
            <tr style="width: 100%">
                <table class="table table-striped" id="items-table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <th>Customer Code</th>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Customer Type</th>
                        </tr>
                    </thead>
                    <tbody>

            @foreach ($customers as $customer)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $customer->customer_code }}</td>
                    <td>{{ $customer->customer_name }}</td>
                    <td>{{ $customer->customer_address_line1 }}</td>
                    <td>{{ $customer->customer_type_of_customer }}</td>
                </tr>
                @endforeach
</body>

</html>
