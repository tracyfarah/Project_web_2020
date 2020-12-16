$(".form").find("input, textarea").on("keyup blur focus", function (e) {
  let elem = $(this),
    label = elem.prev("label");

  if (e.type === "keyup") {
    if (elem.val() === "") {
      label.removeClass("active highlight");
    } else {
      label.addClass("active highlight");
    }
  } else if (e.type === "blur") {
    if (elem.val() === "") {
      label.removeClass("active highlight");
    } else {
      label.removeClass("highlight");
    }
  } else if (e.type === "focus") {
    if (elem.val() === "") {
      label.removeClass("highlight");
    } else if (elem.val() !== "") {
      label.addClass("highlight");
    }
  }
});

$(".tab a").on("click", function (e) {
  e.preventDefault();
  $(this).parent().addClass("active");
  $(this).parent().siblings().removeClass("active");
  target = $(this).attr("href");
  $(".tab-content > div").not(target).hide();
  $(target).fadeIn(600);
});