

$(document).ready(function () {
  "use strict";

  var grandTotal = 0;




  $("table").on("change", "input", function() {
    // var row = $(this).closest("tr");
    // var qty = parseFloat(row.find(".qty").val());
    // var price = parseFloat(row.find(".price").val());
    // var total = qty * price;
    // row.find(".total").val(isNaN(total) ? "" : total);

    $("tr").each(function() {
      var price = parseFloat($(this).find("input.price").val());
      var qty   = parseFloat($(this).find("input.qty").val());
      var total = price * qty;

      grandTotal += total;
      console.log(total);
    });

    // grandTotal += total;

    // if(grandTotal > 100) {
    //   alert('Total exceeded RM 100');
    //   row.find(".qty").val(0)
    //   // console.log("grandTotal : " + grandTotal);
    //   grandTotal = grandTotal - total;
    // }

    // $(".grandTotal").val(parseFloat(grandTotal).toFixed(2) - total);

  });



});




