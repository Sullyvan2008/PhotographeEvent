document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('myModal');
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];

  // Au clic sur le lien "Contact", ouvrir la modale
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    modal.style.display = "block";
  });

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});
