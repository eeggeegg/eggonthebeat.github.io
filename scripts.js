
/*---------BURGER MENU----------*/
function collapse() {
    var x = document.getElementByClassName("meny");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
} 

/*
-----
index
-----
*/
document.getElementsByClassName("msgbox")[0].addEventListener("click", function(event){
    event.preventDefault()
});

document.getElementsByClassName("msgbox")[0].focus();
var scrollto = 0;
if(typeof(EventSource) !== "undefined") {
var source = new EventSource("chatframe.php");
source.onmessage = function(event) {

document.getElementById("result").innerHTML += event.data;

};
source.addEventListener("update", function(e) {
scrollto = document.documentElement.scrollTop;
document.getElementById("result").innerHTML = '';
});
source.addEventListener("george", function(e) {
deleteAds();
document.documentElement.scrollTop = scrollto;
});
} else {
document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}


if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        setTimeout(() => {
          $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
        }, 100);
      } else {
        setTimeout(() => {
          window.scrollTo(0, document.body.scrollHeight);
          document.documentElement.scrollTop = document.documentElement.scrollHeight;
        }, 1000);
        
      }

      function deleteAds() {
        setTimeout(() => {
          document.getElementById("ads").remove();
          document.getElementById("ads_bottom_static").remove();
        }, 1000);

      }
      


      var mysql = require('mysql');

      var con = mysql.createConnection({
        host: "sql2.7mpl",
        user: "eggland_eggchat",
        password: "qgj9j02v16",
        database: "eggland_eggchat"
      });

      con.connect(function(err) {
        if (err) throw err;
        con.query("SELECT * FROM messages", function (err, result, fields) {
          if (err) throw err;
          console.log(result);
        });
      });

/*$("#submit").click(function() {

var url = "action_page.php"; // the script where you handle the form input.

$.ajax({
        type: "POST",
        url: url,
        msg: document.getElementsByClassName("msgbox")[0].value, // serializes the form's elements.
        success: function(data)
        {
        alert(data); // show response from the php script.
        }
});

return false; // avoid to execute the actual submit of the form.
});*/
