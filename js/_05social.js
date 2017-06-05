document.getElementById('shareBtn').onclick = function() {
  FB.ui({
    method: 'share',
    display: 'popup',
    href: socialParameters.siteUrl,
    quote: '',
  }, function(response){});
}