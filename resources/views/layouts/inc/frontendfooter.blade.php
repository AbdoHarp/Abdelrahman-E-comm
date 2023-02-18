<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce Cart/Wishlist Page Design</title>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{ $appsetting->website_name ?? 'website name' }}</h4>
                        <div class="footer-underline"></div>
                        <p>
                            {{ $appsetting->meta_description ?? 'meta_description' }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Quick Links</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{ url('/') }}" class="text-white">Home</a></div>
                        <div class="mb-2"><a href="{{ url('/aboutus') }}" class="text-white">About Us</a></div>
                        <div class="mb-2"><a href="{{ url('/contactus') }}" class="text-white">Contact Us</a></div>
                        <div class="mb-2"><a href="{{ url('/blogs') }}" class="text-white">Blogs</a></div>
                        <div class="mb-2"><a href="#" class="text-white">Sitemaps</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Shop Now</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{ url('/collections') }}" class="text-white">Collections</a></div>
                        <div class="mb-2"><a href="{{ url('/') }}" class="text-white">Trending Products</a></div>
                        <div class="mb-2"><a href="{{ url('/new-arrivals') }}" class="text-white">New Arrivals
                                Products</a></div>
                        <div class="mb-2"><a href="{{ url('/featured-products') }}" class="text-white">Featured
                                Products</a></div>
                        <div class="mb-2"><a href="{{ url('/cart') }}" class="text-white">Cart</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Reach Us</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2">
                            <p>
                                <i class="fa fa-map-marker"></i> {{ $appsetting->address ?? 'address' }}
                            </p>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-phone"></i> {{ $appsetting->phone1 ?? 'phone1' }}
                                <br> {{ $appsetting->phone2 ?? 'phone2' }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-envelope"></i> {{ $appsetting->email1 ?? 'email1 ' }}
                                <br>{{ $appsetting->email2 ?? 'email2' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p class=""> &copy; {{ $appsetting->created_at->format('m.Y') ?? 'website name' }} - {{ $appsetting->title ?? 'website name' }} .  All rights reserved.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="social-media">
                            Get Connected:
                            @if ($appsetting->facebook)
                                <a href="{{ $appsetting->facebook }}" target="_blank">
                                    <i class="fa fa-facebook">
                                    </i>
                                </a>
                            @endif
                            @if ($appsetting->linkedin)
                                <a href="{{ $appsetting->linkedin }}" target="_blank">
                                    <i class="fa fa-linkedin">
                                    </i>
                                </a>
                            @endif
                            @if ($appsetting->instegram)
                                <a href="{{ $appsetting->instegram }}" target="_blank">
                                    <i class="fa fa-instegram">
                                    </i>
                                </a>
                            @endif
                            @if ($appsetting->youtube)
                                <a href="{{ $appsetting->youtube }}" target="_blank">
                                    <i class="fa fa-youtube">
                                    </i>
                                </a>
                            @endif
                            @if ($appsetting->twitter)
                                <a href="{{ $appsetting->twitter }}" target="_blank">
                                    <i class="fa fa-twitter">
                                    </i>
                                </a>
                            @endif




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
