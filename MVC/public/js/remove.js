$(document).ready(function () {
  // Listen for click events on delete icons
  $(".deletebtn").click(function (event) {
    event.preventDefault(); // prevent the link from redirecting to another page
    var icon = $(this);
    var itemId = icon.closest("a").attr("href").split("/").pop();
    // get the item ID from the link
    // Make an AJAX request remove items from list
    $.ajax({
      url: "/deleteitem/" + itemId,
      method: "GET",
      success: function (response) {
        if (response) {
          $(this).parentNode.parentNode.remove();
        }
      },
      error: function () {
        console.log(
          "An error occurred while adding/removing the song from favorites."
        );
      },
    });
  });
});
