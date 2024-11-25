(function ($) {
  "use strict";

  jQuery(document).ready(function ($) {
    /*****==================================
 * Click Menu & Search Active Start
=====================================*****/

    $(".click-icon").click(function () {
      $(".header-menu").addClass("show-menu");
    });

    $(".close-icons i").click(function () {
      $(".header-menu").removeClass("show-menu");
    });

    $(".searchIcon").click(function () {
      $(".searchBar").addClass("showSearch");
    });

    $(".remove").click(function () {
      $(".searchBar").removeClass("showSearch");
    });

    /*****==================================
 * Click Menu & Search Active End
=====================================*****/

    /*****==================================
 * Menu Active Start
=====================================*****/
    $(".stellarnav").stellarNav({
      theme: "dark",
      breakpoint: 660,
      position: "left",
      phoneBtn: false,
      locationBtn: false,
      sticky: false,
      showArrows: true,
      openingSpeed: 500,
      closingDelay: 500,
    });

    window.onscroll = function () {
      myFunction();
    };

    var header = document.getElementById("themeMenu");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
    /*****==================================
 * Menu Active End
=====================================*****/

    $(".popup").magnificPopup({
      type: "iframe",
    });

    $("img.lazyload").lazyload();

    $("#wordpress").datepicker();

    /*========= Top Scroll Active Start ==============*/
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $(".themesBazar_scroll").fadeIn();
      } else {
        $(".themesBazar_scroll").fadeOut();
      }
    });

    //Click event to scroll to top
    $(".themesBazar_scroll").on("click", function () {
      $("html, body").animate({ scrollTop: 0 }, 800);
      return false;
    });
    /*========= Top Scroll Active End ==============*/
  });
})(jQuery);



let isPlaying = false; // Track the speaking state

function playPostContent() {
  const content = document.getElementById("postContent").innerText;
  const icon = document.getElementById("playIcon");

  if (isPlaying) {
    // Stop the speech if already playing
    responsiveVoice.cancel();
    isPlaying = false;

    // Update icon to indicate stopped state
    icon.classList.remove("la-play-circle");
    icon.classList.add("la-volume-up");
  } else {
    // Start speaking the content
    responsiveVoice.speak(content, "Bangla Bangladesh Female", {
      onend: function () {
        // Reset icon when speech ends
        icon.classList.remove("la-play-circle");
        icon.classList.add("la-volume-up");
        isPlaying = false;
      },
    });

    isPlaying = true;

    // Update icon to indicate playing state
    icon.classList.remove("la-volume-up");
    icon.classList.add("la-play-circle");
  }
}
