//POST REQUEST

$(document).ready(function(){
    $('#postMessage').click(function(e){
        e.preventDefault();

        //serialize form data. This produces: "foo=1&bar=xxx&this=hi"
        var formData = $('form').serialize();

        //function to turn url to an object
        function getUrlVars(formData) {
            var hash;
            var myJson = {};
            var hashes = formData.slice(formData.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                myJson[hash[0]] = hash[1];
            }
            return JSON.stringify(myJson);
        }

        //pass serialized data to function
        var test = getUrlVars(formData);
        
        //post with ajax
        $.ajax({
            type:"POST",
            url: "http://localhost:8080/php_rest_myblog/api/post/create.php",
            data: test,
            ContentType:"application/json",

            success:function(){
                alert('successfully posted');
            },
            error:function(){
                alert('Could not be posted');
            }

        });
    });
});
    

//GET REQUEST

  document.addEventListener('DOMContentLoaded',function(){
  document.getElementById('getMessage').onclick=function(){
       
       var req;
       req=new XMLHttpRequest();
       req.open("GET", 'http://localhost:8080/php_rest_myblog/api/post/read.php',true);
       req.send();
      
       req.onload=function(){
       var json=JSON.parse(req.responseText);

       //limit data called
       var son = json.filter(function(val) {
              return (val.id >= 4);  
          });

      var html = "";

      //loop and display data
      son.forEach(function(val) {
          var keys = Object.keys(val);

          html += "<div class = 'cat'>";
              keys.forEach(function(key) {
              html += "<strong>" + key + "</strong>: " + val[key] + "<br>";
              });
          html += "</div><br>";
      });

      //append in message class
      document.getElementsByClassName('message')[0].innerHTML=html;         
      };
    };
  });