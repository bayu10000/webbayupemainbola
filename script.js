$(document).ready(function () {
  // hilangkan tombol cari
  $("#tombolcari").hide();

  // event ketika keyword ditulis
  $("#keyword").on("keyup", function () {
    // munculkan icon load
    $(".loader").show();

    // ajax menggunakan load
    // $("#container").load("ajax/pemain.php?keyword=" + $("#keyword").val());

    $.get("ajax/pemain.php?keyword=" + $("#keyword").val(), function (data) {
      $("#container").html(data);
      $(".loader").hide();
    });
  });
});
