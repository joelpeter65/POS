</div>
<p><br><br><br><br><br></p>
<footer class="fixed-bottom bg-dark">
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4"><p class="text-center">developed by <a href="https://www.instagram.com/joelpeter98/">JoelPeter98</a>&nbsp;<script>
    var CurrentYear = new Date().getFullYear()
    document.write(CurrentYear)
    </script></p></div>
<div class="col-sm-4"></div>
</div>
</div>
</footer>
</body>
<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Custom scripts for this template -->
<script src="js/coming-soon.min.js"></script>
<script>
function SelectText(element) {
var doc = document,
text = element,
range, selection;
if (doc.body.createTextRange) {
range = document.body.createTextRange();
range.moveToElementText(text);
range.select();
} else if (window.getSelection) {
selection = window.getSelection();
range = document.createRange();
range.selectNodeContents(text);
selection.removeAllRanges();
selection.addRange(range);
}
}
function hasClass(ele, cls) {
return !!ele.getAttribute('class').match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}
window.onload = function() {
var trigger = document.getElementById('cd-nav-trigger'),
menu = document.getElementById('cd-main-nav'),
menuItems = menu.getElementsByTagName('li');
trigger.onclick = function toggleMenu() {
if (hasClass(trigger, 'menu-is-open')) {
trigger.setAttribute('class', 'cd-nav-trigger');
menu.setAttribute('class', '');
} else {
trigger.setAttribute('class', 'cd-nav-trigger menu-is-open');
menu.setAttribute('class', 'is-visible');
}
}
for (var i = 0; i < menuItems.length; i++) {
menuItems[i].onclick = function closeMenu() {
trigger.setAttribute('class', 'cd-nav-trigger');
menu.setAttribute('class', '');
}
}
}
</script>
</html>