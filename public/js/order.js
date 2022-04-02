

$(document).ready(function () {
  "use strict";

  // $(".btn").prop('disabled', true);

  var $tblrows = $("#tblProducts tbody tr");
  
  $tblrows.each(function (index) {
    var $tblrow = $(this);
  
    $tblrow.find('.qty').on('change', function () {

      var qty = $tblrow.find(".qty").val();
      var price = $tblrow.find(".price").val();

      // console.log("1 : " + $tblrow.find(".qty").val());

      var subTotal = parseInt(qty, 10) * parseFloat(price);

      // console.log(qty);


      if (!isNaN(subTotal)) {

        $tblrow.find('.subtot').val(subTotal.toFixed(2));
        var grandTotal = 0;

        // loop through each subtotal
        $(".subtot").each(function () {

          // loop through for input (price, qty, subtotal, grandtotal) that is NaN, set to 0.00
          if(isNaN($tblrow.find(".qty").val()) || console.log($tblrow.find(".qty").is(":empty"))) {
            // console.log("2 : " + $tblrow.find(".qty").val());
            resetQty();
            return;
          }
          
          var stval = parseFloat($(this).val());
          grandTotal += isNaN(stval) ? 0 : stval;

          if(grandTotal > 100) {
            // console.log("Amount excedeed RM 100. Please adjust your order.");
            alert("Amount excedeed RM 100. Please adjust your order.");
            grandTotal -= stval;
            resetQty();
          }  
        }); //end loop through

        function resetQty() {
          $tblrow.find(".qty").val(0);
          $tblrow.find('.subtot').val(0);        
          
        }

        $('.grdtot').val(grandTotal.toFixed(2));

      }

      
    });

  });

    

});




