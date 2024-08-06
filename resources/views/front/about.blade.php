@extends('front.layouts.app')
@section('content')
    <div class="p-5 flex flex-col gap-12  container px-6 md:px-0 md:w-8/12 mx-auto">
        <div class="flex justify-start items-start ">
            <div data-aos="fade-down" class="my-6">
                <h1
                    class="w-fit  text-3xl md:text-4xl text-primary relative z-20 font-light mb-8 flex items-center justify-center gap-6">

                    <span>
                        {{ __('front.about_us') }}
                    </span>
                </h1>
                <div class="min-h-96 text-neutral-800">
                    {!! $about !!}
                </div>
            </div>
        </div>
        <div class="flex justify-start items-start " id="terms">
            <div data-aos="fade-down" class="my-6">
                <h1
                    class="w-fit text-3xl md:text-4xl text-primary relative z-20 font-light mb-8 flex items-center justify-center gap-6">

                    <span>
                        {{ __('front.terms') }}
                    </span>
                </h1>
                <div class="min-h-96 text-neutral-800">
                    {!! $terms !!}
                </div>
            </div>
        </div>
        <div class="flex justify-start items-start ">
            <div data-aos="fade-down" class="my-6">
                <h1
                    class="w-fit  text-3xl md:text-4xl text-primary relative z-20 font-light mb-8 flex items-center justify-center gap-6">

                    <span>
                        {{ __('front.privacy') }}
                    </span>
                </h1>
                <div class="min-h-96 text-neutral-800">
                    {!! $privacy !!}
                </div>
            </div>
        </div>
    </div>
@endsection
