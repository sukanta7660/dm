@extends('layouts.master')
@section('title')
    About
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>About</span></p>
                    <h1 class="mb-0 bread">About Us</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section bg-light custom-border-bottom pb-5 pt-5" data-aos="fade">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="block-16">
                <figure>
                  <img src="{{asset('public/user_asset/images/bg_1.jpg')}}" alt="Image placeholder" class="img-fluid rounded">

                </figure>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">


              <div class="site-section-heading pt-3 mb-4">
                <h2 class="text-black">How We Started</h2>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius repellat, dicta at laboriosam, nemo
                exercitationem itaque eveniet architecto cumque, deleniti commodi molestias repellendus quos sequi hic fugiat
                asperiores illum. Atque, in, fuga excepturi corrupti error corporis aliquam unde nostrum quas.</p>
              <p>Accusantium dolor ratione maiores est deleniti nihil? Dignissimos est, sunt nulla illum autem in, quibusdam
                cumque recusandae, laudantium minima repellendus.</p>

            </div>
          </div>
        </div>
      </div>



      <div class="site-section bg-light custom-border-bottom mb-2" data-aos="fade">
        <div class="container">
          <div class="row ">
            <div class="col-md-6 order-md-2">
              <div class="block-16">
                <figure>
                  <img src="{{asset('public/user_asset/images/bg_1.jpg')}}" alt="Image placeholder" class="img-fluid rounded">


                </figure>
              </div>
            </div>
            <div class="col-md-5 mr-auto">


              <div class="site-section-heading pt-3 mb-4">
                <h2 class="text-black">Some Questions About DoorMeds (FAQ)</h2>
              </div>
              <p class="text-black">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius repellat, dicta at laboriosam, nemo
                exercitationem itaque eveniet architecto cumque, deleniti commodi molestias repellendus quos sequi hic fugiat
                asperiores illum. Atque, in, fuga excepturi corrupti error corporis aliquam unde nostrum quas.</p>
              <p class="text-black">Accusantium dolor ratione maiores est deleniti nihil? Dignissimos est, sunt nulla illum autem in, quibusdam
                cumque recusandae, laudantium minima repellendus.</p>

            </div>
          </div>
        </div>
      </div>

      <div class="faq-section mb-4">
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                    <div class="accordion" id="accordion-first">
                        <div class="card hr-card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn  hr-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                              </button>
                            </h2>
                          </div>

                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-first">
                            <div class="card-body">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="accordion" id="accoordion-second">
                        <div class="card hr-card">
                          <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                              <button class="btn  hr-btn" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Collapsible Group Item #2
                              </button>
                            </h2>
                          </div>

                          <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accoordion-second">
                            <div class="card-body">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
@endsection
