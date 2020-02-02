$("#order_transaction_type").on("change", function() {
    console.log("hii");
    if($("#order_transaction_type").val() === "Limit"){
      $("#trigger_label").html("Trigger");
      $("#hidden").empty();
      $("#hidden").append('<input type="text" name="trigger_quantity">');
    }
    else{
        $("#hidden").empty();
    }
    console.log($("#order_transaction_type").val());
    });
    console.log("hello");