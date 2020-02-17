$(document).ready(function() {
  ClassicEditor.create(document.getElementById("post_content")).catch(error => {
    console.error(error);
  });
});
