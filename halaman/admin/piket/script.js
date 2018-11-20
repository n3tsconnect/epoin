//Getting value from "ajax.php".

function fill(Value) {

   //Assigning value to "search" div in "search.php" file.

   $('#namapelajar').val(Value);

   //Hiding "display" div in "search.php" file.

   $('#display').hide();

}

$(document).ready(function() {

  $("#izin-dynamic").load("halaman/admin/piket/table.php");
  var refreshId = setInterval(function() {
     $("#izin-dynamic").load('halaman/admin/piket/table.php');
  }, 10000);
  $.ajaxSetup({ cache: false });


$("#namapelajar").keyup(function() {

       //Assigning search box value to javascript variable named as "name".

       var name = $('#namapelajar').val();

       //Validating, if "name" is empty.

       if (name == "") {

           //Assigning empty value to "display" div in "search.php" file.

           $("#display").html("");

       }

       //If name is not empty.

       else {

           //AJAX is called.

           $.ajax({

               //AJAX type is "Post".

               type: "POST",

               //Data will be sent to "ajax.php".

               url: "halaman/admin/piket/cari.php",

               //Data, that will be sent to "ajax.php".

               data: {

                   //Assigning value of "name" into "search" variable.

                   search: name

               },

               //If result found, this funtion will be called.

               success: function(html) {

                   //Assigning result to "display" div in "search.php" file.

                   $("#display").html(html).show();

               }

           });

       }

   });

});
