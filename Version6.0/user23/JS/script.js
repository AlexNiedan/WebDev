function changeText() {
    document.getElementById("textChange").innerHTML = "Thanks for liking my Webpage"
}

var space = " ";
var pos = 0;
var msg = "Joey St. George";

function Scroll() {
    document.title = msg.substring(pos, msg.length) + space + msg.substring(0, pos);

    pos++;
    if (pos > msg.length) pos = 0;
    window.setTimeout("Scroll()", 0);
}
Scroll();




function show_coords(event) {
    document.getElementById("demo").innerHTML = "X= " + event.clientX + "<br>Y= " + event.clientY;
}





function confirmInput() {
    fname = document.forms[0].fname.value;
    alert("Hello " + fname + "! You will now be redirected to a piano that I created.");
}




function upperCase() {
    var x = document.getElementById("gname");
    x.value = x.value.toUpperCase();
}




function clickColor(elmnt, clr) {
    elmnt.style.color = clr;
}




function pageLoad() {
    alert("Hello! Welcome to my Javascript examples.");
}




function keyPress() {
    alert("You pressed a key inside the input field");
}




function preferedBrowser() {
    prefer = document.forms[1].browsers.value;
    alert(prefer);
}




