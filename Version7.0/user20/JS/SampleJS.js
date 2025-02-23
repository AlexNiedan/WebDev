function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

/**

* Sets a Cookie with the given name and value.

*

* name       Name of the cookie

* value      Value of the cookie

* [expires]  Expiration date of the cookie (default: end of current session)

* [path]     Path where the cookie is valid (default: path of calling document)

* [domain]   Domain where the cookie is valid

*              (default: domain of calling document)

* [secure]   Boolean value indicating if the cookie transmission requires a

*              secure transmission

*/                        

function setCookie(name, value, expires, path, domain, secure) {

  document.cookie= name + "=" + escape(value) +

      ((expires) ? "; expires=" + expires.toGMTString() : "") +

      ((path) ? "; path=" + path : "") +

      ((domain) ? "; domain=" + domain : "") +

      ((secure) ? "; secure" : "");

}
/**

* Gets the value of the specified cookie.

*

* name  Name of the desired cookie.

*

* Returns a string containing value of specified cookie,

*   or null if cookie does not exist.

*/

function getCookie(name) {

  var dc = document.cookie;

  var prefix = name + "=";

  var begin = dc.indexOf("; " + prefix);

  if (begin == -1) {

      begin = dc.indexOf(prefix);

      if (begin != 0) return null;

  } else {

      begin += 2;

  }
  /**

* Deletes the specified cookie.

*

* name      name of the cookie

* [path]    path of the cookie (must be same as path used to create cookie)

* [domain]  domain of the cookie (must be same as domain used to create cookie)

*/

function deleteCookie(name, path, domain) {

  if (getCookie(name)) {

      document.cookie = name + "=" +

          ((path) ? "; path=" + path : "") +

          ((domain) ? "; domain=" + domain : "") +

          "; expires=Thu, 01-Jan-70 00:00:01 GMT";

  }

}


  var end = document.cookie.indexOf(";", begin);

  if (end == -1) {

      end = dc.length;

  }

  return unescape(dc.substring(begin + prefix.length, end));

}
var images = new Array();

function preloadImages(){

    for (i=0; i < preloadImages.arguments.length; i++){

         images[i] = new Image();

        images[i].src = preloadImages.arguments[i];

    }

}

preloadImages("data:image/jpeg;base64,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", "https://images.solecollector.com/complex/images/c_crop,h_1139,w_2025,x_209,y_665/c_fill,dpr_2.0,f_auto,fl_lossy,q_auto,w_680/urpmek7kqlqejcpaqld5/adidas-yeezy-foam-runner-white-g55486", "https://sneakernews.com/wp-content/uploads/2021/05/adidas-Yeezy-Quantum-Flash-Orange-GW5314-5.jpg", "");
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {

  if (document.cookie.indexOf("iphone_redirect=false") == -1) {

      window.location = "http://m.espn.go.com/wireless/?iphone&i=COMR";

  }

}
