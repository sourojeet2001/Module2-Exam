$(document).ready(function () {
  $(".home").submit(function (event) {
    var inputItemName = $("input[name='item']").val();
    console.log(inputItemName);
    if (!inputItemName) {
      alert("All fields are necessary");
      event.preventDefault();
    }
  });
});
