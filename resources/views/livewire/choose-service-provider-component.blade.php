<div>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_01_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Service Provider</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>/</li>
                        <li>Service Provider</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="container">
            <div class="row" style="margin-top: -30px;">
                <div class="titles">
                    <h2>Service <span>Provider</span></h2>
                    <i class="fa fa-plane"></i>
                    <hr class="tall">
                </div>
            </div>
        </div>
        <div class="content_info" style="margin-top: -70px;">
            <div>
                <div class="container">
                    <div class="portfolioContainer">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if ($sproviders->count() >0)
                            @foreach ($sproviders as $sprovider )
                                <div class="col-xs-6 col-sm-4 col-md-3 nature hsgrids" style="padding-right: 5px;padding-left: 5px;">
                                    <div class="img-hover">
                                        @if ($sprovider->image)
                                            <img src="{{asset('images/sproviders')}}/{{$sprovider->image}}" class="img-responsive">
                                        @else
                                            <img src="{{asset('images/sproviders/Default.jpg')}}" class="img-responsive">
                                        @endif
                                    </div>
                                    <div class="info-gallery">
                                        <h3>Name : {{$sprovider->user->name}}</h3>
                                        <hr class="separator">
                                        <p>{{$sprovider->about}}</p>
                                        <hr class="separator">
                                        <p><b>Email : </b>{{$sprovider->email}}</p>
                                        <p><b>Phone : </b>{{$sprovider->phone}}</p>
                                        <p><b>City: </b>{{$sprovider->city}}</p>
                                        <p><b>Service Locations : </b> {{$sprovider->service_locations}}</p>
                                        <hr class="separator">
                                        <div class="content-btn">
                                            <a href="#" wire:click.prevent='sendRequest({{ Auth::user()->id }},{{$sprovider->id}})' class="btn btn-primary">Send request</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <p class="text-center">There is any service providers.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>
