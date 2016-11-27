//=include ../vendors/jquery.geocomplete.js

$(function(){
  $(".geocomplete").geocomplete({
    details: "form",
    detailsAttribute: "data-geo",
    types: ["geocode", "establishment"],
    map: ".map_canvas"
  });
  $(".finder").click(function(){
    $(".geocomplete").trigger("geocode");
  });
});