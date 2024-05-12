function displayForm() {
  const form = document.getElementById("user__infor-form");

  if (form.style.display == "block") {
    form.style.display = "none";
  } else {
    form.style.display = "block";
  }
}


var Days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
// $('#update__form').ready(function () {
//     var option = '<option value="day" selected disabled>Day</option>';
//     var selectedDay = "day";
//     for (var i = 1; i <= Days[0]; i++) {
//         option += '<option value="' + i + '">' + i + '</option>';
//     }
//     $('#Day').append(option);
//     $('#Day').val(selectedDay);

//     var option = '<option value="month"selected disabled>Month</option>';
//     var selectedMon = "month";
//     for (var i = 1; i <= 12; i++) {
//         option += '<option value="' + i + '">' + i + '</option>';
//     }
//     $('#Month').append(option);
//     $('#Month').val(selectedMon);

//     var d = new Date();
//     var option = '<option value="year"selected disabled>Year</option>';
//     selectedYear = "year";
//     for (var i = 1930; i <= d.getFullYear(); i++) { // years start i
//         option += '<option value="' + i + '">' + i + '</option>';
//     }
//     $('#Year').append(option);
//     $('#Year').val(selectedYear);
// })

function isLeapYear(year) {
  year = parseInt(year);
  if (year % 4 != 0) {
    return false;
  } else if (year % 400 == 0) {
    return true;
  } else if (year % 100 == 0) {
    return false;
  } else {
    return true;
  }
}

function change_year(select) {
  if (isLeapYear($(select).val())) {
    Days[1] = 29;
    if ($("#Month").val() == 2) {
      var day = $("#Day");
      var val = $(day).val();
      $(day).empty();
      var option = '<option value="day" selected disabled>Day</option>';
      for (var i = 1; i <= Days[1]; i++) {
        //add option days
        option += '<option value="' + i + '">' + i + "</option>";
      }
      $(day).append(option);
      if (val > Days[month]) {
        val = 1;
      }
      $(day).val(val);
    }
  } else {
    Days[1] = 28;
  }
}

function change_month(select) {
  var day = $("#Day");
  var val = $(day).val();
  $(day).empty();
  var option = '<option value="day" selected disabled>Day</option>';
  var month = parseInt($(select).val()) - 1;
  for (var i = 1; i <= Days[month]; i++) {
    //add option days
    option += '<option value="' + i + '">' + i + "</option>";
  }
  $(day).append(option);
  if (val > Days[month]) {
    val = 1;
  }
  $(day).val(val);
}
