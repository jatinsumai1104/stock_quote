$("#order_type").on("change", function() {
if($("#order_type").val() === "Limit"){
  $("#trigger_label").html("Trigger");
  $("#hidden").empty();
  $("#hidden").append('<input type="text" name="trigger_quantity">');
}
else{
    $("#hidden").empty();
}
console.log($("#order_type").val());
});