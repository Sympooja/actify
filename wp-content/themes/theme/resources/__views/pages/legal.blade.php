@extends('layouts.default')
@section('content')

<section class="py-16">
  <div class="container max-width-xl">
    <h1 class="text-[32px] md:text-[40px]  lg:text-[48px] leading-[1.15em] tracking-[-0.038em]">{{ get_the_title() }}</h1>
    <div class="prose wysiwyg">
      <?php the_content(); ?>
    </div>
  </div>
</section>

@endsection