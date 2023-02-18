<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='destroyCategory'>
                    <div class="modal-body">
                        <h5>Are you sure you want to datele this data ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes. Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-header">
                    <h3>Category
                        <a href="{{ url('admin/category/create') }}"
                            class="text-white btn btn-primary btn-sm float-end">Add
                            Category</a>
                    </h3>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>IMAGE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cate_item)
                                <tr>
                                    <td>{{ $cate_item->id }}</td>
                                    <td>{{ $cate_item->name }}</td>
                                    <td>
                                        <img src="{{ asset($cate_item->image) }}" alt="img" width="80px"
                                            height="80px" />
                                    </td>
                                    <td>{{ $cate_item->status == '1' ? 'Hidden' : 'show' }}</td>
                                    <td>
                                        <a href="{{ url('admin/category/' . $cate_item->id . '/edit') }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="" wire:click='deleteCategory({{ $cate_item->id }})'
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="btn btn-danger ">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventlistener('clase-model', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
