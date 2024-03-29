<x-app-layout>
  <!-- Start Hero Area -->
  <section class="hero-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-12 custom-padding-right">
                  <div class="slider-head">
                      <!-- Start Hero Slider -->
                      <div class="hero-slider">
                          <!-- Start Single Slider -->
                          <div class="single-slider"
                              style="background-image: url(assets/images/hero/slider-bg1.jpg);">
                              <div class="content">
                                  <h2><span>No restocking fee (35€ savings)</span>
                                      M75 Sport Watch
                                  </h2>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                      incididunt ut labore et dolore magna aliqua.</p>
                                  <h3><span>Now Only</span> 320.99€</h3>
                                  <div class="button">
                                      <a href="product-grids.html" class="btn">Shop Now</a>
                                  </div>
                              </div>
                          </div>
                          <!-- End Single Slider -->
                          <!-- Start Single Slider -->
                          <div class="single-slider"
                              style="background-image: url(assets/images/hero/slider-bg2.jpg);">
                              <div class="content">
                                  <h2><span>Big Sale Offer</span>
                                      Get the Best Deal on CCTV Camera
                                  </h2>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                      incididunt ut labore et dolore magna aliqua.</p>
                                  <h3><span>Combo Only:</span> 590.00€</h3>
                                  <div class="button">
                                      <a href="product-grids.html" class="btn">Shop Now</a>
                                  </div>
                              </div>
                          </div>
                          <!-- End Single Slider -->
                      </div>
                      <!-- End Hero Slider -->
                  </div>
              </div>
              <div class="col-lg-4 col-12">
                  <div class="row">
                      <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                          <!-- Start Small Banner -->
                          <div class="hero-small-banner"
                              style="background-image: url('assets/images/hero/slider-bnr.jpg');">
                              <div class="content">
                                  <h2>
                                      <span>New line required</span>
                                      iPhone 12 Pro Max
                                  </h2>
                                  <h3>259.99€</h3>
                              </div>
                          </div>
                          <!-- End Small Banner -->
                      </div>
                      <div class="col-lg-12 col-md-6 col-12">
                          <!-- Start Small Banner -->
                          <div class="hero-small-banner style2">
                              <div class="content">
                                  <h2>Weekly Sale!</h2>
                                  <p>Saving up to 50% off all online store items this week.</p>
                                  <div class="button">
                                      <a class="btn" href="product-grids.html">Shop Now</a>
                                  </div>
                              </div>
                          </div>
                          <!-- Start Small Banner -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End Hero Area -->

  <!-- Start Trending Product Area -->
  <section class="trending-product section" style="margin-top: 12px;">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="section-title">
                      <h2>Last Products</h2>
                      <p>Shop latest tech products. Top brands: Apple, Samsung, Microsoft. Find the perfect device for your needs. Stay ahead of the tech curve.</p>
                  </div>
              </div>
          </div>
          <div class="row">
          @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-12">
                <x-product-list-item :$product />
            </div>
          @endforeach
          </div>
      </div>
  </section>
  <!-- End Trending Product Area -->

  <!-- Start Call Action Area -->
  <section class="call-action section">
      <div class="container">
          <div class="row ">
              <div class="col-lg-8 offset-lg-2 col-12">
                  <div class="inner">
                      <div class="content">
                          <h2 class="wow fadeInUp" data-wow-delay=".4s">Currently You are using free<br>
                              Lite version of ShopGrids</h2>
                          <p class="wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template
                              to get all pages,<br> features and commercial license.</p>
                          <div class="button wow fadeInUp" data-wow-delay=".8s">
                              <a href="javascript:void(0)" class="btn">Purchase Now</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End Call Action Area -->

  <!-- Start Banner Area -->
  <section class="banner section">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 col-md-6 col-12">
                  <div class="single-banner" style="background-image:url('assets/images/banner/banner-1-bg.jpg')">
                      <div class="content">
                          <h2>Smart Watch 2.0</h2>
                          <p>Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p>
                          <div class="button">
                              <a href="product-grids.html" class="btn">View Details</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 col-12">
                  <div class="single-banner custom-responsive-margin"
                      style="background-image:url('assets/images/banner/banner-2-bg.jpg')">
                      <div class="content">
                          <h2>Smart Headphone</h2>
                          <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                              incididunt ut labore.</p>
                          <div class="button">
                              <a href="product-grids.html" class="btn">Shop Now</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End Banner Area -->
</x-app-layout>
