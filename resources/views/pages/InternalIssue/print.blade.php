<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<head>
<tiltle>
</tiltle>
</head>

<body>
<table class="table table-bordered" id="tbl_internalissue">
    <thead>
        <tr>
            <td></td>
            {{-- <td>STOCK NO</td>
            <td>DESCRIPTION</td>
            <td>U/M</td> --}}
            <td>ISSUED QUANTITY</td>
            <td>ISSUED WEIGHT</td>

        </tr>
    </thead>
    <tbody>
        @foreach ($internal_issues as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                {{-- <td>{{ optional(optional($item->iid_items)->item)->stock_number }}</td>
                <td>{{ optional(optional($item->iid_items)->item)->description }}</td>
                <td>{{ optional(optional($item->iid_items)->item)->unit }}</td> --}}
                <td>{{ optional($item->iid_items)->issue_qty }}</td>
                <td>{{ $optional($item->iid_items)->issue_weight }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>