<select class="form-control" name="serial">
    <option selected disabled>Select Serial No</option>
    @foreach ($list as $row)
        <option value="{{ $row->id }}">{{ $row->serial_no }}</option>
    @endforeach
</select>
<script>
    window.codes =   '{!! $list->toJson()!!}';
</script>
