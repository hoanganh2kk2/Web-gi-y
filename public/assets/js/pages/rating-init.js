$(document).ready(function () {
  $("#example-rating").barrating({
    theme: "fontawesome-stars",
    showSelectedRating: !1,
  }),
    $("#rating-css").barrating({ theme: "css-stars", showSelectedRating: !1 });
  var e = $("#rating-current-fontawesome-o").data("current-rating");
  $(".stars-example-fontawesome-o .current-rating").find("span").html(e),
    $(".stars-example-fontawesome-o .clear-rating").on("click", function (e) {
      e.preventDefault(), $("#rating-current-fontawesome-o").barrating("clear");
    }),
    $("#rating-current-fontawesome-o").barrating({
      theme: "fontawesome-stars-o",
      showSelectedRating: !1,
      initialRating: e,
      onSelect: function (e, a) {
        e
          ? ($(".stars-example-fontawesome-o .current-rating").addClass(
              "hidden"
            ),
            $(".stars-example-fontawesome-o .your-rating")
              .removeClass("hidden")
              .find("span")
              .html(e))
          : $("#rating-current-fontawesome-o").barrating("clear");
      },
      onClear: function (e, a) {
        $(".stars-example-fontawesome-o")
          .find(".current-rating")
          .removeClass("hidden")
          .end()
          .find(".your-rating")
          .addClass("hidden");
      },
    }),
    $("#rating-1to10").barrating("show", { theme: "bars-1to10" }),
    $("#rating-movie").barrating("show", { theme: "bars-movie" }),
    $("#rating-square").barrating("show", {
      theme: "bars-square",
      showValues: !0,
      showSelectedRating: !1,
    }),
    $("#rating-pill").barrating("show", {
      theme: "bars-pill",
      initialRating: "A",
      showValues: !0,
      showSelectedRating: !1,
      allowEmpty: !0,
      emptyValue: "-- no rating selected --",
      onSelect: function (e, a) {
        alert("Selected rating: " + e);
      },
    }),
    $("#rating-reversed").barrating("show", {
      theme: "bars-reversed",
      showSelectedRating: !0,
      reverse: !0,
    }),
    $("#rating-horizontal").barrating("show", {
      theme: "bars-horizontal",
      reverse: !0,
      hoverState: !1,
    });
});
