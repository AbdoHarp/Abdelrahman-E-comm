<div>
    @include('livewire/admin/brands/model')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Brands List
                        <a href="{{ url('admin/add_brands') }}" data-bs-toggle="modal" data-bs-target="#addbrandModal"
                            class="btn btn-primary btn-sm text-white float-end">Add
                            Brands</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brands_item)
                                <tr>
                                    <td>{{ $brands_item->id }}</td>
                                    <td>{{ $brands_item->name }}</td>
                                    <td>
                                        @if ($brands_item->category)
                                            {{ $brands_item->category->name }}
                                        @endif
                                    </td>
                                    <td>{{ $brands_item->slug }}</td>
                                    <td>{{ $brands_item->status == '1' ? 'Hidden' : 'show' }}</td>
                                    <td>
                                        <a href="#" wire:click="editBrand({{ $brands_item->id }})"
                                            data-bs-toggle="modal" data-bs-target="#updateBrandModal"
                                            class="btn btn-success btn-sm text-white">Edit</a>
                                        <a href="#" wire:click="deleteBrand({{ $brands_item->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteBrandModal"class="btn btn-danger btn-sm text-white">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Brands Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>{{ $brands->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('clase-model', event => {
            $('#addbrandModal').modal('hide');
            $('#updateBrandModal').modal('hide');
            $('#deleteBrandModal').modal('hide');
        });
    </script>
@endpush
