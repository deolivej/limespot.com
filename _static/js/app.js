function init() {
  // randomly choose background image
  var x = Math.floor(Math.random()*10);
  var banner = document.getElementById('ls-banner-img');
  if (banner != null) {
    banner.setAttribute(
      "src", x % 2 == 0 ? "img/bg-male.jpg" : "img/bg-female.jpg");
  }

  // smooth scroll
  // $(function() {
  //   $('a[href*=#]:not([href=#])').click(function() {
  //     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
  //       var target = $(this.hash);
  //       target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
  //       if (target.length) {
  //         $('html,body').animate({
  //           scrollTop: target.offset().top
  //         }, 1000);
  //         return false;
  //       }
  //     }
  //   });
  // });
}