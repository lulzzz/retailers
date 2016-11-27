@extends('site.layout.skeleton')

@section('header')
   <div class="row">
      <div class="col-xs-12 px-sm-0">
         <button type="button" class="drawer-hamburger js-drawer-open-left" aria-controls="LeftDrawer" aria-expanded="false"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
         </button>
      </div>
   </div>
@stop

@section('content')
<div class="row flex-items-xs-center flex-items-sm-left">
  <div class="col-xs-12 col-sm-6 push-sm-1">
    <div class="wiki-title text-xs-center text-sm-left">
      <span class="h1 text-xs-center">PANOPLY</span>
      <span class="h5 text-muted"><small>NOUN | ˈpanəpli </small></span>
      <p class="lead pt-2 text-xs-center text-sm-left">An extensive or impressive collection.</p>
    </div>
  </div>
</div>

<div class="row pt-3">
  <div class="col-xs-12 col-sm-10 push-sm-1">
    <div class="row wiki-texts">
      <div class="col-xs-12 col-sm pb-3">
        <h4 class="display-h4 text-uppercase">Wiki Niki</h4>
        <p>Hej! I'm Nicos. I am a full stack web developer from Australia but have called Europe home since 2011 and I'm now based out of Amsterdam.
          <p> Companies, fashion brands and retail stores hire me to digitally "create" for them. I design, develop and build web applications, components and sites that are engineered to increase organic growth, e-commerce conversion rates and online presence.</p>
          <p> I also work closely with fashion brands building strategic web based marketing, advertising and social media campaigns that are designed to reach the nexus of audiences that associate, engage and communicate.
          </p>
        </div>
        <div class="col-xs-12 col-sm text-xs-center text-sm-left pl-2">
          <div class="wiki-list">
          <ul class="ul-lists pl-3 px-sm-0">
            <li><br><br><h6 class="text-uppercase">Languages:</h6>
              <small>XML, HTML5, CSS3, SASS, JavaScript, <br> Liquid, PHP, MySQL, SQL</small></li>

            </li>
            <li class="pt-2"><h6 class="text-uppercase">Frameworks:</h6>
              <small>Bootstrap 3/4, Bourbon, Timber, jQuery, Riot, <br>Backbone, Laravel 5.3 +</small></li>
            </li>
          </li>
          <li class="pt-2"><h6 class="text-uppercase">Builds \ JS:</h6>
            <small>Gulp, Node, Jekyll, Broccoli, Composer, Bower, <br>Sprockets, Compass, Artisan</small></li>
          </li>
          <li class="pt-2"><h6 class="text-uppercase">Services \ SaaS:</h6>
            <small>Github, BitBucket, Shopify API / SDK, Magento, <br>Tictail API / SDK, Ngrok, Agolia, FortRabbit</small></li>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-xs-12 col-sm">
      <h4 class="display-h4 text-uppercase">Why Panoply?</h4>
      <p>Panoply is an English word that is derived from Greek / Modern Latin and used to describe a "complete" or "impressive" collection of things.</p>
      <p>The name <b>Panoply</b> began as a naming convention but soon evolved into this manifestation of creativity and a collection of digital concepts. </p>
      <p>After several years of creating, developing and designing viable digital solutions for companies, brands and successful start-ups this pseudonym "Panoply" had become a reference to my work and the word soon engrained itself in my projects and become an alias for my web development.</p>
    </div>
  </div>
</div>
</div>

   @stop
