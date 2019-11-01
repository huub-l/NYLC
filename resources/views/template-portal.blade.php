{{--
  Template Name: Portal Template
--}}

@extends('layouts.app')

@section('content')

@include('partials.page-header')

@if ( ! post_password_required( $post ) )
  <section class='main-content'>
    <div class='container'>
      <div class="content flex flex-wrap">
        <aside class='sidebar w-full lg:w-1/3 pr-8 xxl:py-12 xxl:pr-32'>
          <h3>Trustee Portal</h3>
          @if (has_nav_menu('trustee_navigation'))
            {!! wp_nav_menu(['theme_location' => 'trustee_navigation', 'menu_class' => 'nav']) !!}
          @endif
        </aside>
        <main class="main w-full py-8 lg:w-2/3 xxl:py-12 ">
          @while(have_posts()) @php the_post() @endphp
            @include('partials.content-page')
          @endwhile
          <h2 class='mt-10 text-3xl mb-5'>{!! $section_title !!}</h2>
          <ul class='m-0 p-0 meeting-list'>
          @foreach($portal_calendar as $event)
            <li class='text-black text-lg text-bold mb-5 bg-grey-lightest flex'>
              <div class='date-block text-3xl bg-primary w-48 text-center flex flex-wrap text-white content-center justify-center'>
                <span class='date p-5 text-4xl uppercase font-light'>{!! $event['date'] !!}</span>
              </div>
              <div class="p-5 w-full">
                <span class='font-bold text-2xl'>{!! $event['title'] !!}</span>
                {!! $event['description'] !!}
                @if( $event['file'] )
                  <a href="{!! $event['file'] !!}" class='btn float-right text-sm m-0' download>Download File</a>
                @endif
              </div>
            </li>
          @endforeach
          </ul>
        </main>
      </div>
    </div>
  </section>
@else
<div class="container">
  <div class='content flex-flex-wrap'>

    <?php if(defined('INVALID_POST_PASS')) _e('The password you entered is funky'); ?>

    {!! get_the_password_form() !!}
  </div>
</div>
@endif
@endsection
