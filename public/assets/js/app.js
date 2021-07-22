$( document ).ready(function() {
  // Calling Plugin Select2 
  $('#province').select2({
    placeholder: 'Pilih Provinsi',
    language: "id"
  });
  $('#city').select2({
    placeholder: 'Pilih Kota/Kabupaten',
    language: "id"
  });
  $('#district').select2({
    placeholder: 'Pilih Kecamatan',
    language: "id"
  });
  $('#sub-district').select2({
    placeholder: 'Pilih Kelurahan',
    language: "id"
  });


  // Taking Data when Province selected
  $("#province").change(function(){
    $("img#load1").show();
    var id_provinces = $(this).val();
    // var name_provinces = $("#province option:selected").text();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "../data-wilayah.php?jenis=city",
      data: "id_provinces="+id_provinces,
      success: function(msg){
        $("select#city").html(msg);
        $("img#load1").hide();
        getAjaxCity();
      }
    });  
  });

  $("#city").change(getAjaxCity);
  function getAjaxCity() {
    $("img#load2").show();
    var id_regencies = $("#city").val();
    // var name_provinces = $("#city option:selected").text();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "../data-wilayah.php?jenis=district",
      data: "id_regencies="+id_regencies,
      success: function(msg){
        $("select#district").html(msg);
        $("img#load2").hide();
        getAjaxDistrict();
      }
    });
  }

  $("#district").change(getAjaxDistrict);
  function getAjaxDistrict() {
    $("img#load3").show();
    var id_district = $("#district").val();
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "../data-wilayah.php?jenis=sub-district",
      data: "id_district="+id_district,
      success: function(msg) {
        $("select#sub-district").html(msg);
        $("img#load3").hide();
      }
    });
  }
});