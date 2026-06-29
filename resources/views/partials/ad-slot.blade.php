{{--
  Usage:
    @include('partials.ad-slot', ['slot' => config('seo.adsense_slot_article'), 'format' => 'auto'])
    @include('partials.ad-slot', ['slot' => config('seo.adsense_slot_sidebar'), 'format' => 'auto'])
--}}
@if(config('seo.adsense_client') && !empty($slot))
<div class="ad-slot-wrap">
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="{{ config('seo.adsense_client') }}"
       data-ad-slot="{{ $slot }}"
       data-ad-format="{{ $format ?? 'auto' }}"
       data-full-width-responsive="true"></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
@endif
