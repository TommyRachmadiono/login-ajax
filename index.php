<!-- <?php
// $con = mysqli_connect("localhost","root","","tes-davinti");

// // Check connection
// if (mysqli_connect_errno())
// {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tes Davinti Group</title>
  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
</head>
<body>
  <div class="container mt-3">
    <div style="background-color: green;">
      <label>Username:</label>
      <input type="text" name="username" id="username">
      <br>    
      <label for="pwd">Password:</label>
      <input type="password" name="password" id="password">
    </div>

    <div style="background-color: brown;">  
      <button id="login" class="btn btn-primary">Login</button>
    </div>

    <br>    
    <div id="status"></div>
    <br>    

    <div id="copyright">Copy Right <?php echo date('Y') ?> Pekku</div>
  </div>

  <script>    
    $(document).ready(function() {
      $("#login").on('click', function(e) {
        // e.preventDefault();

        $("#status").html('Checking database...');

        var username = $("#username").val();
        var password = $("#password").val();

        if($.trim(username) == '' || $.trim(password) == '')
        {
          $("#status").html('Username atau Password tidak boleh kosong');
        }

        $.ajax({
         type: "POST",
         url: 'conn.php',
         data: {
          username: username,
          password: password,
        },

        success: function(response)
        {
          var data = $.parseJSON(response);
          if (data.status == 'sukses') {
            $("#status").html(data.pesan);
          }
          else if (data.status == 'salah') {
            $("#status").html(data.pesan);
          }
        }, error: function (jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
          } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
          } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
          } else if (exception === 'timeout') {
            msg = 'Time out error.';
          } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
          } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }
          console.log(msg);
        },
      });

      });
    });
  </script>
</body>
</html>