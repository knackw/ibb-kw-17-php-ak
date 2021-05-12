<script type="text/javascript" >
    function absenden1() {
        var request = new XMLHttpRequest();
        request.open("get", "ajax1.php", true);
        request.onreadystatechange = ankommen1;
        request.send();
    }
    
    function ankommen1(event) {
        if (event.target.readyState === 4 && event.target.status === 200) {
            document.getElementById("absatz1").firstChild.nodeValue = event.target.responseText;
        }
        if (event.target.status === 404) {
            document.getElementById("absatz1").firstChild.nodeValue = "Resource nicht gefunden";
        }
    }
</script>
<h3>AJAX - der erste Versuch</h3>
<p>
    <a href="javascript:absenden1()" >klick</a>
</p>
<p id="absatz1">&nbsp;</p>