@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="bg-light-grey py-8 px-8 mt-8 max-w-[500px]">
            <h3 class="text-[28px] font-medium">Demo Site Index</h3>
            <div class="pt-5 space-y-3">
                <h3 class="text-[16px] font-medium">Blocks</h3>
                <a class="block text-blue" href="/demo/masthead/">Masthead</a>
                <a class="block text-blue" href="/demo/content/">Content</a>
                <a class="block text-blue" href="/demo/how-it-works/">How It Works</a>
                <a class="block text-blue" href="/demo/testimonials/">Testimonials</a>
                <a class="block text-blue" href="/demo/faqs/">FAQs</a>
                <a class="block text-blue" href="/demo/benefits/">Benefits</a>
                <a class="block text-blue" href="/demo/cta/">CTA</a>
                <a class="block text-blue" href="/demo/format/">Format</a>
                <a class="block text-blue" href="/demo/forms/">Forms</a>
                <a class="block text-blue" href="/demo/archive/">Archive</a>
                <hr />
                <h3 class="text-[16px] font-medium">Pages</h3>
                <a class="block text-blue" href="/company/">Company</a>
                <a class="block text-blue" href="/careers/">Careers</a>
                <hr />
                <h3 class="text-[16px] font-medium">Blog</h3>
                <a class="block text-blue" href="/blog/">Blog</a>
                <a class="block text-blue" href="/?s=example">Search</a>
                <a class="block text-blue" href="/category/example/">Example</a>
            </div>
        </div>
    </div>

    @include('flexible.index', ['flexible_content' => $acf['flexible_content']])
@endsection
