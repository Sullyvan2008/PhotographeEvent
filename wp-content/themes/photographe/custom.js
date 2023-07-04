document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('myModal');
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];

  // Vérifier si l'élément btn existe avant de définir l'événement onclick
  if (btn) {
    btn.onclick = function() {
      modal.style.display = "block";
    };
  }

  if (span) {
    span.onclick = function() {
      modal.style.display = "none";
    };
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});




