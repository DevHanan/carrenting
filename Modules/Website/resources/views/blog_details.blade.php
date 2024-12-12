@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','home')->first(),
        "title" => app('settings')->get('blog_title'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")


    @include('website::layouts.parts.page-banner',[
        "title" => app('settings')->get('blog_title')
    ])



    <section class="home__about list__item">
        <div class="container">
            <div class="row">

                @include('website::cars.parts.breadcrumb',[
                    "title_1" => app('settings')->get('blog_title'),
                    "title_2" =>  $blog->title 
                ])

              

            </div>
            <div class="row mt-50">
                <div class="col-lg-12">

                    @if( $blog)
                    <div class="home__about_content blog-item">
                                                <h2>{{$blog->title}}</h2>

                        @if($blog->image)
                        <img alt="{{$blog->title}}" src="/storage/{{$blog->image}}" />
                        @endif
                        {!!$blog->content!!}


                    </div>
                    @endif


                </div>
                
            </div>
        </div>
    </section>





@endsection
