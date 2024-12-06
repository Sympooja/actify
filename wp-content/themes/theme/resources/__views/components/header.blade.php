@include('components.top-bar')

<div class="container relative bg-white" style="z-index:50;">
  <div class="flex items-center py-4 md:space-x-10">

    <div class="flex justify-start md:w-0 md:flex-1">
      <a href="/{!! ICL_LANGUAGE_CODE !== 'en' ? ICL_LANGUAGE_CODE : '' !!}">
        <span class="sr-only">Actify</span>
        @img($options['logo']['ID'])
      </a>
    </div>

    <div class="ml-auto -mr-2 -my-2 md:hidden">
      <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false" toggle="#mobile-menu">
        <span class="sr-only">Open menu</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    @include('components.menu')

  </div>

  @include('components.mobile-menu')

</div>
