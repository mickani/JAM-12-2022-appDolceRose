<?php include("header.php") ?>

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Mantenedor de Materias Primas</h3>
    </div>
    <style type="text/css">
        
        .bold {
    font-weight:bold;
}
.block {
    display:block;
}
input[type=text] {
    width:300px;
}
body {
    background-color: #fff;
    font-size: .80em;
    font-family:"Helvetica Neue", "Lucida Grande", "Segoe UI", Arial, Helvetica, Verdana, sans-serif;
    margin: 0px;
    padding: 0px;
    color: #696969;
}
/*
ul.myErrorClass, input.myErrorClass, textarea.myErrorClass, select.myErrorClass {
    border: 1px solid #cc0000 !important;
    background: #f3d8d8 url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/blitzer/images/ui-bg_diagonals-thick_75_f3d8d8_40x40.png) 50% 50% repeat !important;
}
*/
 ul.myErrorClass, input.myErrorClass, textarea.myErrorClass, select.myErrorClass {
    border-width: 1px !important;
    border-style: solid !important;
    border-color: #cc0000 !important;
    background-color: #f3d8d8 !important;
   /* background-image: url(http://goo.gl/GXVcmC) !important;*/
    background-position: 50% 50% !important;
    background-repeat: repeat !important;
}
ul.myErrorClass input {
    color: #666 !important;
}
label.myErrorClass {
    color: red;
    font-size: 11px;
    /*    font-style: italic;*/
    display: block;
}
    </style>


    <form id="frm">
     <h1>Sample form</h1>

    <div>
        <label for="txtName" class="bold block">Name:</label>
        <input type="text" name="txtName" id="txtName" class="required" />
    </div>
    <br />
    <div>
        <label for="txtBio" class="bold block">Bio:</label>
        <textarea cols="25" rows="4" name="txtBio" id="txtBio" class="required"></textarea>
    </div>
    <br />
    <div>
        <label for="lstColors" class="bold block">Favorite Colors:</label>
        <select name="lstColors" id="lstColors" size="1"  class="required">
            <option value=""></option>
            <option value="R">Red</option>
            <option value="W">White</option>
            <option value="B">Blue</option>
        </select>
    </div>
    <br />
    <br />
    <input type="submit" value="Submit" />
</form>

<?php include("footer.php") ?>
<script type="text/javascript">
$(document).ready(function() {

  //Transforms the listbox visually into a Select2.
  $("#lstColors").select2({
    placeholder: "Select a Color",
    width: "100px"
  });

  //Initialize the validation object which will be called on form submit.
  var validobj = $("#frm").validate({
    //onkeyup: false,
    errorClass: "myErrorClass",

    //put error message behind each form element
    errorPlacement: function(error, element) {
      var elem = $(element);
      error.insertAfter(element);
    },

    
    highlight: function(element, errorClass, validClass) {
      var elem = $(element);
      if (elem.hasClass("select2-offscreen")) {alert('hola');
        $("#s2id_" + elem.attr("id") + " ul").addClass(errorClass);
      } else {
        elem.addClass(errorClass);
      }
    },

    
  });

  //If the change event fires we want to see if the form validates.
  //But we don't want to check before the form has been submitted by the user
  //initially.
/*  $(document).on("change", ".select2-offscreen", function() {
    if (!$.isEmptyObject(validobj.submitted)) {
      validobj.form();
    }
  });
*/
  //A select2 visually resembles a textbox and a dropdown.  A textbox when
  //unselected (or searching) and a dropdown when selecting. This code makes
  //the dropdown portion reflect an error if the textbox portion has the
  //error class. If no error then it cleans itself up.
 /* $(document).on("select2-opening", function(arg) {
    var elem = $(arg.target);
    if ($("#s2id_" + elem.attr("id") + " ul").hasClass("myErrorClass")) {
      //jquery checks if the class exists before adding.
      $(".select2-drop ul").addClass("myErrorClass");
    } else {
      $(".select2-drop ul").removeClass("myErrorClass");
    }
  });*/
});

</script>