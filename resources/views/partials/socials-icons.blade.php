<div class="row">
    <div class="col-12 mb-2 text-center">
        {!! HTML::icon_link(route('social.redirect',['provider' => 'facebook']), 'fa fa-facebook', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-facebook')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'twitter']), 'fa fa-twitter', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-twitter')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'google']), 'fa fa-google-plus', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-google')) !!}
        {!! HTML::icon_link(route('social.redirect',['provider' => 'github']), 'fa fa-github', '', array('class' => 'btn btn-social-icon btn-lg mb-1 btn-github')) !!}
      
    </div>
</div>
