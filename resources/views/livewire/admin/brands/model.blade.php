    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addbrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>
                    <button type="button" class="btn-close" wire:click='closamodel' data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Select Category</label>
                            <select wire:model.defer="category_id" required class="form-control">
                                <option value="{{ url('/') }}">---Select Categories---</option>
                                @foreach ($categories as $categitem)
                                    <option value="{{ $categitem->id }}">{{ $categitem->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Brand Name</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Brand slug</label>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>status</label><br />
                            <input type="checkbox" wire:model.defer="status" /> (checked=Hidden,Un-checked=show)
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click='closamodel' class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Brand Update Modal -->
    <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Brands</h5>
                    <button type="button" class="btn-close" wire:click='closamodel' data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div wire:loading class="p-2">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>Loading...
                </div>
                <div wire:loading.remove>


                    <form wire:submit.prevent="updateBrand">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Select Category</label>
                                <select wire:model.defer="category_id" required class="form-control">
                                    <option value="{{ url('/') }}">---Select Categories---</option>
                                    @foreach ($categories as $categitem)
                                        <option value="{{ $categitem->id }}">{{ $categitem->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Brand Name</label>
                                <input type="text" wire:model.defer="name" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Brand slug</label>
                                <input type="text" wire:model.defer="slug" class="form-control">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>status</label><br />
                                <input type="checkbox" wire:model.defer="status" style="width: 70px; height: ;70px; " />
                                (checked=Hidden,Un-checked=show)
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click='closamodel' class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Brand Update Modal -->
    <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Brands</h5>
                    <button type="button" class="btn-close" wire:click='closamodel' data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div wire:loading class="p-2">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>Loading...
                </div>
                <div wire:loading.remove>


                    <form wire:submit.prevent="destroyBrand">
                        <div class="modal-body">
                            <h4>Are You sure you Want to delete this Brand ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click='closamodel' class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">yas. Delete </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
