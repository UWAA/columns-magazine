document.getElementById('shareBtn').onclick = function() {
  FB.ui({
    method: 'share',
    display: 'popup',
    href: socialParameters.siteUrl,    
  }, function(response){});
}