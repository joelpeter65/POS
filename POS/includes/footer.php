</div>
<br><br>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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