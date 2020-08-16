@extends('layouts.front')

@section('body')
    <div class="product-details-area slider-mt-7 pt-120 pb-70">
        <div class="container">
            <div class="product-details-top-content" style="margin-bottom:20px ">
                <div class="product-details-content">
                    <h2>{{$p['name']}}</h2>
                    <p class="pro-dec-paragraph-2">


                    </p>
                </div>
                <div class="product-details-content">
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting">
                                @for($x=1;$x<=5;$x++)
                                    @if($x>$pD['rating'])
                                        <i class="icon-star-empty"></i>
                                    @else
                                        <i class="icon-rating"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="product-digit">
                                <span>{{$pD['rating']}}</span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>{{$pD['review']}} Reviews</span>
                            <span>{{$pD['totalOrders']}} orders</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="product-details-tab">
                        <div class="product-dec-left">
                            <div class="pro-dec-big-img-slider-2 product-big-img-style slick-initialized slick-slider">
                                <div class="slick-list">
                                    <div class="slick-track"
                                         style="opacity: 1; width: 9248px; transform: translate3d(-544px, 0px, 0px);">
                                        <div class="easyzoom-style slick-slide slick-cloned" data-slick-index="-1" id=""
                                             aria-hidden="true" tabindex="-1" style="width: 544px;">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/images/product-details/b-large-5.jpg" tabindex="-1">
                                                    <img src="assets/images/product-details/large-5.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>

                                         @foreach($p['pimgs'] as $l)

                                            <div class="easyzoom-style slick-slide slick-current slick-active"
                                                 data-slick-index="{{$loop->index}}" aria-hidden="false" tabindex="{{$loop->index}}"
                                                 style="width: 544px;">
                                                <div class="easyzoom easyzoom--overlay is-ready">
                                                    <a href="{{$l}}" tabindex="{{$loop->index}}">
                                                        <img src="{{$l}}" alt="">
                                                    </a>
                                                </div>
                                            </div>

                                        @endforeach

                                        @foreach($p['pimgs'] as $l)

                                        <div class="easyzoom-style slick-slide" data-slick-index="{{$loop->iteration}}" aria-hidden="true"
                                             tabindex="-{{$loop->iteration}}" style="width: 544px;">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="{{$l}}" tabindex="-{{$loop->iteration}}">
                                                    <img src="{{$l}}" alt="">
                                            </a>
                                            </div>
                                        </div>

                                        @endforeach


{{--                                        <div class="easyzoom-style slick-slide" data-slick-index="1" aria-hidden="true"--}}
{{--                                             tabindex="-1" style="width: 544px;">--}}
{{--                                            <div class="easyzoom easyzoom--overlay">--}}
{{--                                                <a href="assets/images/product-details/b-large-2.jpg" tabindex="-1">--}}
{{--                                                    <img src="assets/images/product-details/large-2.jpg" alt="">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="easyzoom-style slick-slide slick-cloned" data-slick-index="15" id=""--}}
{{--                                             aria-hidden="true" tabindex="-1" style="width: 544px;">--}}
{{--                                            <div class="easyzoom easyzoom--overlay">--}}
{{--                                                <a href="assets/images/product-details/b-large-5.jpg" tabindex="-1">--}}
{{--                                                    <img src="assets/images/product-details/large-5.jpg" alt="">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="product-dec-right">
                            <div
                                class="product-dec-slider-2 product-small-img-style slick-initialized slick-slider slick-vertical">
                                <div class="slick-list draggable" style="height: 679px;">
                                    <div class="slick-track"
                                         style="opacity: 1; height: 2231px; transform: translate3d(0px, -679px, 0px);">

                                        @foreach($p['pimgs'] as $l)

                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="-{{$loop->remaining}}"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="{{$l}}" alt="">
                                        </div>

                                        @endforeach


                                        @foreach($p['pimgs'] as $l)
                                        <div class="product-dec-small active slick-slide slick-current slick-active"
                                             data-slick-index="{{$loop->index}}" aria-hidden="false" tabindex="{{$loop->index}}"
                                             style="width: 101px;">
                                            <img src="{{$l}}" alt="">
                                        </div>
                                        @endforeach


                                   <div class="product-dec-small slick-slide slick-active" data-slick-index="6"
                                             aria-hidden="false" tabindex="0" style="width: 101px;">
                                            <img src="assets/images/product-details/small-4.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide" data-slick-index="7"
                                             aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-5.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small active slick-slide slick-cloned"
                                             data-slick-index="8" id="" aria-hidden="true" tabindex="-1"
                                             style="width: 101px;">
                                            <img src="assets/images/product-details/small-1.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="9"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-2.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="10"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-3.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="11"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-4.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="12"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-5.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="13"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-6.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="14"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-4.jpg" alt="">
                                        </div>
                                        <div class="product-dec-small slick-slide slick-cloned" data-slick-index="15"
                                             id="" aria-hidden="true" tabindex="-1" style="width: 101px;">
                                            <img src="assets/images/product-details/small-5.jpg" alt="">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12">
                    <div class="product-details-content quickview-content product-details-content-4">
                        <div class="pro-details-price pro-details-price-4">
                            <span>US $75.72</span>
                            <span class="old-price">US $95.72</span>
                        </div>
                        <div class="pro-details-color-wrap">
                            <span>Color:</span>
                            <div class="pro-details-color-content">
                                <ul>
                                    <li><a class="white" href="#">Black</a></li>
                                    <li><a class="azalea" href="#">Blue</a></li>
                                    <li><a class="dolly" href="#">Green</a></li>
                                    <li><a class="peach-orange" href="#">Orange</a></li>
                                    <li><a class="mona-lisa active" href="#">Pink</a></li>
                                    <li><a class="cupid" href="#">gray</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pro-details-size">
                            <span>Size:</span>
                            <div class="pro-details-size-content">
                                <ul>
                                    <li><a href="#">XS</a></li>
                                    <li><a href="#">S</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                    <li><a href="#">XXL</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pro-details-quality">
                            <span>Quantity:</span>
                            <div class="cart-plus-minus">
                                <div class="dec qtybutton">-</div>
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                <div class="inc qtybutton">+</div>
                            </div>
                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li><span>Model:</span> <a href="#">Odsy-1000</a></li>
                                <li><span>Ship To</span> <a href="#">2834 Laurel Lane</a>, <a href="#">Mentone</a> , <a
                                        href="#">Texas</a></li>
                            </ul>
                        </div>
                        <div class="pro-details-action-wrap">
                            <div class="pro-details-buy-now">
                                <a href="#">Buy Now</a>
                            </div>
                            <div class="pro-details-action">
                                <a title="Add to Cart" href="#"><i class="icon-basket"></i></a>
                                <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a>
                                <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                <div class="product-dec-social">
                                    <a class="facebook" title="Facebook" href="#"><i
                                            class="icon-social-facebook-square"></i></a>
                                    <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                    <a class="instagram" title="Instagram" href="#"><i
                                            class="icon-social-instagram"></i></a>
                                    <a class="pinterest" title="Pinterest" href="#"><i
                                            class="icon-social-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="description-review-wrapper pt-160 pb-155">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dec-review-topbar nav mb-65">
                        <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                        <a data-toggle="tab" href="#des-details2" class="">Specification</a>
                        <a data-toggle="tab" href="#des-details3" class="">Meterials </a>
                        <a data-toggle="tab" href="#des-details4" class="">Reviews and Ratting </a>
                    </div>
                    <div class="tab-content dec-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="description-wrap">
                                {!! $p['description'] !!}
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane">
                            <div class="specification-wrap table-responsive">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="width1">Name</td>
                                        <td>Salwar Kameez</td>
                                    </tr>
                                    <tr>
                                        <td>SKU</td>
                                        <td>0x48e2c</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Models</td>
                                        <td>FX 829 v1</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Categories</td>
                                        <td>Digital Print</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Size</td>
                                        <td>60’’ x 40’’</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Brand</td>
                                        <td>Individual Collections</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Color</td>
                                        <td>Black, White</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="des-details3" class="tab-pane">
                            <div class="specification-wrap table-responsive">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="width1">Top</td>
                                        <td>Cotton Digital Print Chain Stitch Embroidery Work</td>
                                    </tr>
                                    <tr>
                                        <td>Bottom</td>
                                        <td>Cotton Cambric</td>
                                    </tr>
                                    <tr>
                                        <td class="width1">Dupatta</td>
                                        <td>Digital Printed Cotton Malmal With Chain Stitch</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="des-details4" class="tab-pane">
                            <div class="review-wrapper">
                                <h2>{{$pD['review']}} review for {{$p['name']}}</h2>
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/images/product-details/client-1.png" alt="">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-name">
                                                <h5><span>John Snow</span> - March 14, 2019</h5>
                                            </div>
                                            <div class="review-rating">
                                                <i class="yellow icon-rating"></i>
                                                <i class="yellow icon-rating"></i>
                                                <i class="yellow icon-rating"></i>
                                                <i class="yellow icon-rating"></i>
                                                <i class="yellow icon-rating"></i>
                                            </div>
                                        </div>
                                        <p>Donec accumsan auctor iaculis. Sed suscipit arcu ligula, at egestas magna
                                            molestie a. Proin ac ex maximus, ultrices justo eget, sodales orci. Aliquam
                                            egestas libero ac turpis pharetra, in vehicula lacus scelerisque</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ratting-form-wrapper">
                                <span>Add a Review</span>
                                <p>Your email address will not be published. Required fields are marked <span>*</span>
                                </p>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <label>Name <span>*</span></label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <label>Email <span>*</span></label>
                                                    <input type="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="star-box-wrap">
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                        <a href="#"><i class="icon-rating"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label>Your review <span>*</span></label>
                                                    <textarea name="Your Review"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <input type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-155">
        <div class="container">
            <div class="section-title-8 mb-65">
                <h2>You May Like Also</h2>
            </div>
            <div class="product-slider-active-4 slick-initialized slick-slider">
                <div class="slick-list draggable">
                    <div class="slick-track"
                         style="opacity: 1; width: 4200px; transform: translate3d(-1200px, 0px, 0px);">
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="-4" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-152.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="-3" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-153.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="-2" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-154.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="-1" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-152.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-current slick-active" data-slick-index="0"
                             aria-hidden="false" tabindex="0" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="0">
                                        <img src="assets/images/product/product-151.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="0">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="0"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="0"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="0"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-active" data-slick-index="1"
                             aria-hidden="false" tabindex="0" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="0">
                                        <img src="assets/images/product/product-152.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="0">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="0"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="0"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="0"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-active" data-slick-index="2"
                             aria-hidden="false" tabindex="0" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="0">
                                        <img src="assets/images/product/product-153.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="0">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="0"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="0"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="0"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-active" data-slick-index="3"
                             aria-hidden="false" tabindex="0" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="0">
                                        <img src="assets/images/product/product-154.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="0">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="0">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="0"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="0"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="0"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide" data-slick-index="4" aria-hidden="true"
                             tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-152.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="5" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-151.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="6" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-152.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="7" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-153.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="8" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-154.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-wrap-plr-1 slick-slide slick-cloned" data-slick-index="9" id=""
                             aria-hidden="true" tabindex="-1" style="width: 300px;">
                            <div class="product-wrap">
                                <div class="product-img product-img-zoom mb-25">
                                    <a href="product-details.html" tabindex="-1">
                                        <img src="assets/images/product/product-152.jpg" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                    <div class="product-price">
                                        <span>$ 124</span>
                                        <span class="old-price">$ 130</span>
                                    </div>
                                </div>
                                <div class="product-action-position-1 text-center">
                                    <div class="product-content">
                                        <h4><a href="product-details.html" tabindex="-1">Product Title</a></h4>
                                        <div class="product-price">
                                            <span>$ 124</span>
                                            <span class="old-price">$ 130</span>
                                        </div>
                                    </div>
                                    <div class="product-action-wrap">
                                        <div class="product-action-cart">
                                            <button title="Add to Cart" tabindex="-1">Add to cart</button>
                                        </div>
                                        <button data-toggle="modal" data-target="#exampleModal" tabindex="-1"><i
                                                class="icon-zoom"></i></button>
                                        <button title="Add to Compare" tabindex="-1"><i class="icon-compare"></i>
                                        </button>
                                        <button title="Add to Wishlist" tabindex="-1"><i class="icon-heart-empty"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
