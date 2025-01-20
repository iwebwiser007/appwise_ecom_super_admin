<table>
    <thead class="sticky-header">
        <tr>
            <th>ID</th>
            <th>Shop-Owner Name</th>
            <th>Package Name</th>
            <th>Number Of Section</th>
            <th>Number Of Category</th>
            <th>Number Of Product</th>
            <th>Price</th>
            <th>Days</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($packageBuy as $package)
        <tr>
            <td>{{ $package->id }}</td>
            <td>
                {{ $package->shop_owner->name }}
            </td>
            <td>{{ $package->package_name }}</td>
            <td>{{ $package->number_of_section }}</td>
            <td>{{ $package->number_of_category }}</td>
            <td>{{ $package->number_of_product }}</td>
            <td>{{ $package->price }}</td>
            <td>{{ $package->days }}</td>
        </tr>
        @endforeach
    </tbody>
</table>