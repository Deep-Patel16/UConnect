// Get button that opens popup
var btn = document.querySelectorAll("button.popup-button");

// All page modals
var popups = document.querySelectorAll('.popup');

// Get element that closes popup
var spans = document.getElementsByClassName("close-button");

// Open popup when user clicks
for (var i = 0; i < btn.length; i++) {
 btn[i].onclick = function(e) {
    e.preventDefault();
    popup = document.querySelector(e.target.getAttribute("href"));
    popup.style.display = "block";
 }
}

// CLose model when user clicks x
for (var i = 0; i < spans.length; i++) {
 spans[i].onclick = function() {
    for (var index in popups) {
      if (typeof popups[index].style !== 'undefined') popups[index].style.display = "none";
    }
 }
}

// Close model when user clicks outside area of popup
window.onclick = function(event) {
    if (event.target.classList.contains('popup')) {
     for (var index in popups) {
      if (typeof popups[index].style !== 'undefined') popups[index].style.display = "none";
     }
    }
}
