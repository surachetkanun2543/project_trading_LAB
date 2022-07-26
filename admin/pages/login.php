<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <link href="../css/main.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

  <script language-="javascript">
    $().ready(function() {
      $('#bt').click(function() {
        $('#bt').attr('disabled', true);

        $.ajax({
          type: "POST",
          url: "checklogin.php",
          dataType: "json",
          data: "txt_user=" + $("#txt_user").val() + "&txt_pass=" + $("#txt_pass").val(),
          success: function(data) {
            if (data.status == "ok") {
              window.location = "index.php";
            } else {
              $("#report").removeClass('sr-only').html(data.msg);
            }
          },
          error: function(data) {
            console.log(data.responseText);
          }
        });
        $('#bt').attr('disabled', false);
      });

    });
  </script>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 style=" font-family: 'Roboto Mono', monospace;" align="center" class="panel-title">เข้าสู่ระบบสำหรับแอดมิน</h3>
          </div>
          <div class="panel-body">
            <div id="report" class="sr-only"></div>
            <form accept-charset="UTF-8" role="form" action="checklogin.php" method="POST">
              <fieldset>
                <div class="form-group">
                  <input class="form-control" style=" font-family: 'Roboto Mono', monospace;" type="text" name="txt_user" id="txt_user" placeholder="Username">
                </div>
                <div class="form-group">
                  <input class="form-control" style=" font-family: 'Roboto Mono', monospace;" type="password" name="txt_pass" id="txt_pass" placeholder="Password">
                </div>
                <button class="btn btn-lg btn btn-block" style=" font-family: 'Roboto Mono', monospace; background-color: '#775BC9' "type="submit" id="bt" >เข้าสู่ระบบ</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>