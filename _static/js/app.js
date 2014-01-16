window.limespot = {
  /*
   * initialization function called for every page body.onload
   */
  init: function() {
    // set up smooth scrolling
    $(function() {
      $('a[href*=#][data-toggle!="tab"]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });
  },

  /*
   * utility function to randomize an array, taken from:
   * http://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array
   */
  shuffle: function(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
  }
}

