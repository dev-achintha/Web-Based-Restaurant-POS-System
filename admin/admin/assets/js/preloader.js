document.addEventListener('DOMContentLoaded', function() {
    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    var preloader = document.getElementById('preloader');

    if (!isChrome) {
        var infinityChrome = document.getElementsByClassName('infinityChrome')[0];
        var infinity = document.getElementsByClassName('infinity')[0];
        infinityChrome.style.display = "none";
        infinity.style.display = "block";
    }

    function closePreloader(){
        if(loadingMealItems) {
            preloader.classList.add('loaded');
        } else {
            setTimeout(closePreloader, 100); // Retry after a short delay
        }
    }

    setTimeout(function() {
        closePreloader();
    }, 1000);
});


// document.addEventListener('DOMContentLoaded', function() {
//     var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
//     var preloader = document.getElementById('preloader');
//     var loadingMealItems = false; // Assuming loadingMealItems is initially false

//     function tryClosePreloader() {
//         if (loadingMealItems && (!isChrome || isChrome)) {
//             preloader.classList.add('loaded');
//         }
//     }

//     if (!isChrome) {
//         var infinityChrome = document.getElementsByClassName('infinityChrome')[0];
//         var infinity = document.getElementsByClassName('infinity')[0];
//         infinityChrome.style.display = "none";
//         infinity.style.display = "block";
//     }
//     tryClosePreloader();
// });
