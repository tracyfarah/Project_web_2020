$(".bt_cat").on("click", function () {
  $(".bt_cat").removeAttr("id", "selected");
  $(this).attr("id", "selected");
  selected_category = $("#selected").val();
  localStorage["select_cat"] = selected_category;
  localStorage["playerID"] = $("#playerID").val();
  if (selected_category == "General Knowledge") {
    cat_number = 9;
  } else if (selected_category == "Entertainement: Film") {
    cat_number = 11;
  } else if (selected_category == "Entertainement: Music") {
    cat_number = 12;
  } else if (
    selected_category == "Entertainement: Video Games"
  ) {
    cat_number = 15;
  } else if (selected_category == "Science and Nature") {
    cat_number = 17;
  } else if (selected_category == "Mythology") {
    cat_number = 20;
  } else if (selected_category == "Sports") {
    cat_number = 21;
  } else if (selected_category == "Geography") {
    cat_number = 22;
  } else if (selected_category == "History") {
    cat_number = 23;
  } else if (selected_category == "Animals") {
    cat_number = 27;
  }
});
$("#bt_go").on("click", function () {
  localStorage["category"] = cat_number;
  window.location.href = "./quiz.php";
});
