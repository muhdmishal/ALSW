function processForm() {
    $('<input>').attr('type', 'hidden').attr('name', 'link').attr('value', window.location.href).appendTo('#contact');

    return true; //Submit the form now
    //Alternatively you can return false to NOT submit the form.
}
window.onload = function() {
  var facebook = document.getElementsByClassName("facebook");
  facebook[0].setAttribute("href", "https://www.facebook.com/sharer/sharer.php?u="+window.location.href);
  facebook[0].setAttribute("title", "Share this page on Facebook");
  var twitter = document.getElementsByClassName("twitter");
  twitter[0].setAttribute("title", "Tweet this page.");
};
