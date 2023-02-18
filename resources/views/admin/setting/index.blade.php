@extends('layouts/admin')
@section('title', 'Settings')

@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ url('admin/site-setting') }}" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">Website Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Website Name</label>
                                <input type="text" value="{{ $setting->website_name ?? '' }}" name="website_name"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Website Url</label>
                                <input type="url" value="{{ $setting->website_url ?? '' }}"name="website_url"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Page Title</label>
                                <input type="text" value="{{ $setting->title ?? '' }}" name="title"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>meta keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="3">{{ $setting->meta_keyword ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ $setting->meta_description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">Website - Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $setting->address ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone 1 *</label>
                                <input type="number" value="{{ $setting->phone1 ?? '' }}" name="phone1"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone 2 *</label>
                                <input type="number" value="{{ $setting->phone2 ?? '' }}" name="phone2"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Id 1 * </label>
                                <input type="email" value="{{ $setting->email1 ?? '' }}"
                                    name="email1"class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Id 2 * </label>
                                <input type="email" value="{{ $setting->email2 ?? '' }}" name="email2"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white mb-0">Website - Soclial Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Facebook (Optional)</label>
                                <input type="text" value="{{ $setting->facebook ?? '' }}"name="facebook"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Twitter (Optional)</label>
                                <input type="text" value="{{ $setting->twitter ?? '' }}" name="twitter"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Instegram (Optional)</label>
                                <input type="text" value="{{ $setting->instegram ?? '' }}" name="instegram"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>YouTube (Optional)</label>
                                <input type="text" value="{{ $setting->youTube ?? '' }}"
                                    name="youTube"class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Linkedin (Optional)</label>
                                <input type="text" value="{{ $setting->linkedin ?? '' }}"
                                    name="linkedin"class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm text-white float-end">Save Settings</button>


            </form>
        </div>
    </div>



@endsection
