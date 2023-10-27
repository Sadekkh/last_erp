<div class="table-responsive">
    <table id="copy-print-csv" class="table custom-table">
        <thead>
            <tr>
                <th>{{ __('image') }}</th>
                <th>{{ __('code') }}</th>
                <th>{{ __('name') }}</th>
                <th>{{ __('category') }}</th>
                <th>{{ __('description') }}</th>
                <th>{{ __('price') }}</th>
                <th>{{ __('tax') }}</th>
                <th>{{ __('total_price') }}</th>
                <th>{{ __('type') }}</th>
                <th>{{ __('edit') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>

                    </td>
                    <td>{{ $d->code }}</td>
                    <td>{{ $d->{'name' . localePrefix()} }}</td>
                    <td>{{ $d->category->{'name' . localePrefix()} }}</td>
                    <td>{{ $d->{'description' . localePrefix()} }}</td>
                    <td></td>
                    <td></td>
                    <td>


                    </td>
                    <td>{{ $d->type }}</td>
                    <td><a href="" class="btn btn-primary btn-sm ">{{ __('edit') }}</a>



                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
