

$(document).ready(function () {
  "use strict";

  var $tblrows = $("#tblProducts tbody tr");
  
  $tblrows.each(function (index) {
    var $tblrow = $(this);
  
    $tblrow.find('.qty').on('change', function () {

      var qty = $tblrow.find("[name=qty]").val();
      var price = $tblrow.find("[name=price]").val();
      var subTotal = parseInt(qty, 10) * parseFloat(price);


      if (!isNaN(subTotal)) {

        $tblrow.find('.subtot').val(subTotal.toFixed(2));
        var grandTotal = 0;
        var gt = 0;

        // loop through each subtotal
        $(".subtot").each(function () {
            var stval = parseFloat($(this).val());
            // grandTotal += isNaN(stval) ? 0 : stval;
            grandTotal += isNaN(stval) ? 0 : stval;

            if(grandTotal > 100) {
              console.log("Amount excedeed RM 100. Please adjust your order.");
              grandTotal -= stval;
              resetQty();
            }



            
        });

        function resetQty() {
          $tblrow.find("[name=qty]").val(0);
          $tblrow.find('.subtot').val(0);        
          
        }

        $('.grdtot').val(grandTotal.toFixed(2));

      }

      
    });

  });

    

});




