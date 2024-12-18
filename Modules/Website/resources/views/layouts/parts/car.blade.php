
        <div class="product__vertical">

            <div class="product__vertical_top">
                <div class="product__vertical_meta">
                    @if($car->is_refresh)
                    <span class="bg-blue">{{__('lang.Featured')}}</span>
                    @endif
                    <span class="bg-orange">{{__('lang.Verified')}}</span>
                    <span class="wishlist wishlist-toggle" data-auth="{{auth()->guard('customers')->check() ? 1 : 0}}" data-id="{{$car->id}}">
                        @if(auth()->guard('customers')->check())
                            @if(!auth()->guard('customers')->user()->wishlist->contains($car->id))
                            {{__('lang.Save to wishlist')}}
                            @else
                            {{__('lang.Remove from wishlist')}}
                            @endif
                        @else
                        {{__('lang.Save to wishlist')}}
                        @endif

                    </span>

                </div>
                <a aria-label="{{$car->name}}" href="{{secure_url('/')}}/{{$car->id}}/{{$car->slug()}}">
                <img loading="lazy" alt="{{$car->name}}" src="{{secure_url('/')}}/storage/{{$car->image}}"/>
                </a>
            </div>
            <a aria-label="{{$car->name}}" href="{{secure_url('/')}}/{{$car->id}}/{{$car->slug()}}">
            <div class="product__vertical_bottom">
                <h2>{{$car->name}}</h2>
                <div class="product__vertical_bottom_features">
                    <ul>
                        <li>{{$car->type == "default" ? __('lang.Day') : __('lang.Hour')}} / {{app('currencies')->convert($car->price_per_day)}} {{app('currencies')->getCurrency()->code}}</li>

                        @if($car->price_per_week)
                        <li>
                            @if(!$car->price_per_week) <s> @endif
                            {{$car->type == "default" ? __('lang.Week') : "3 " . __('lang.Hours')}} / {{app('currencies')->convert($car->price_per_week)}} {{app('currencies')->getCurrency()->code}}
                            @if(!$car->price_per_week) </s> @endif
                        </li>
                        @else

                        @if($car->type != "yacht")
                        <li>{{__('lang.Brand')}} / {{$car->brand ? $car->brand->title : ""}}</li>
                        @endif

                        @endif


                        @if($car->price_per_month)
                        <li>
                            @if(!$car->price_per_month) <s> @endif
                            {{$car->type == "default" ? __('lang.Month') : "8 " . __('lang.Hours')}} / {{app('currencies')->convert($car->price_per_month)}} {{app('currencies')->getCurrency()->code}}
                            @if(!$car->price_per_month) </s> @endif
                        </li>
                        @else

                        <!--@if($car->type != "yacht")-->
                        <!--<li>{{__('lang.Year')}} / {{$car->year ? $car->year->title : ""}}</li>-->
                        <!--@endif-->


                        @endif

                        @if($car->type == "default")


                            @if($car->security_deposit)
                                <li>{{__('lang.Deposit')}} / {{app('currencies')->convert($car->security_deposit)}} {{app('currencies')->getCurrency()->code}}</li>
                            @else
                                <li>{{__('lang.Model')}} / {{$car->model ? $car->model->title : ""}}</li>

                            @endif

                            @if($car->minimum_day_booking)
                            <li>
                                {{$car->type == 'default' ? __('lang.Minimum of Days') : __('lang.Minimum of Hours') }} / {{$car->minimum_day_booking}}</li>
                            @else

                            <li>{{__('lang.Color')}} / {{$car->color ? $car->color->title : ""}}</li>
                            @endif

                            <li>

                                {{__('lang.KM Limit Day')}} / {{$car->km_per_day ? $car->km_per_day : 250}}

                            </li>

                            @if($car->km_per_month)
                            <li>

                                {{__('lang.KM Limit Month')}} / {{$car->km_per_month ? $car->km_per_month : 0}}

                            </li>
                            @else
                            <li>{{__('lang.Insurance Type')}} / {{__('lang.Full')}} </li>
                            @endif

                        @else

                            @if($car->minimum_day_booking)
                            <li>
                                {{$car->type == 'default' ? __('lang.Minimum of Days') : __('lang.Minimum of Hours') }} / {{$car->minimum_day_booking}}</li>
                            @else

                            <li>{{__('lang.Color')}} / {{$car->color ? $car->color->title : ""}}</li>
                            @endif

                            <li>{{$car->type == 'yacht' ? __('lang.Guests')  : __('lang.Passengers')}} / {{$car->passengers}}</li>

                        @endif

                        <li>{{__('lang.Year')}} / {{$car->year ? $car->year->title : ""}}</li>
                    </ul>

                    @if($car->company)
                    <a aria-label="{{$car->name}}" href="{{secure_url('/')}}/c/{{$car->company->id}}/{{$car->company->slug()}}" class="flex-1">
                        <div class="home__brands_item">
                                <img loading="lazy" alt="{{$car->company->name . rand(0,999)}}" src="{{secure_url('/')}}/storage/{{$car->company->image}}"/>
                                <h3>{{$car->company->name}}</h3>
                        </div>
                    </a>
                    @endif
                </div>
                <div class="product__vertical_actions">
                    <ul>
                        @include('website::layouts.parts.car-actions', ['car' => $car])
                    </ul>
                </div>
            </div>
            </a>
        </div>
