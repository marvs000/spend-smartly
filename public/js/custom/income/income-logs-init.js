/**
 * Bootstrap Validation
 * 
 * */

// Flat pickr
const flatPickrEL = $(".flatpickr-validation");
if (flatPickrEL.length) {
    flatPickrEL.flatpickr({
        allowInput: true,
        monthSelectorType: "static"
    });
}

/**
 * Numeral Fields Masking
 * 
 * */
var numeralCollection = document.getElementsByClassName("numeral-mask");
var numeralFields = Array.from(numeralCollection);

numeralFields.forEach(function (fields) {
    new Cleave(fields, {
        numeral: true,
        numeralThousandsGroupStyle: "thousand"
    })
});

$(".numeral-maxlength").each(function () {
    $(this).maxlength({
        warningClass: "label label-dark bg-dark text-white",
        limitReachedClass: "label label-danger",
        separator: " out of ",
        preText: "You typed ",
        postText: " digits available.",
        validate: true,
        threshold: +this.getAttribute("maxlength")
    });
});

/**
 * Date Fields Masking
 * 
 * */
new Cleave(".date-mask", {
    date: true,
    delimiter: "-",
    datePattern: ["Y", "m", "d"]
});

/**
 * Initialize Select2
 * 
 * */ 
$(".select2").select2({
    dropdownParent: $('#add-log-body')
});


/**
 * Tooltip
 * 
 * */ 
// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//     return new Tooltip(tooltipTriggerEl);
// });

/**
 * Form Repeater
 * 
 */
var formRepeater = $(".form-repeater");

var row = 2;
var col = 1;
formRepeater.on('submit', function(e) {
  e.preventDefault();
});
formRepeater.repeater({
  show: function() {
    var formControl = $(this).find('.form-control, .form-select');
    var formLabel = $(this).find('.form-label');

    formControl.each(function(i) {
      var id = 'form-repeater-' + row + '-' + col;
      $(formControl[i]).attr('id', id);
      $(formLabel[i]).attr('for', id);
      col++;
    });

    row++;

    $(this).slideDown();
  },
  hide: function(e) {
    $(this).slideUp(e)
  }
});