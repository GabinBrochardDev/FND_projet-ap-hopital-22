<!DOCTYPE html>
<html>
<body>

<h2>Test AJAX</h2>
<input type="text" name="recherche" id="recherche" oninput="loadDoc()">
<button type="button" onclick="loadDoc()">Rechercher</button>

<p id="demo"></p>

<script>
function loadDoc() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "rendezvous_ajax_personnel.php?filtre="+ document.getElementById("recherche").value);
  xhttp.send();

  xhttp.onload = function() {
    document.getElementById("demo").innerHTML = this.responseText;
  }
}
</script>
 
</body>
</html>
