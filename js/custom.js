function processForm() {
    $('<input>').attr('type', 'hidden').attr('name', 'link').attr('value', window.location.href).appendTo('#contact');

    return true; //Submit the form now
    //Alternatively you can return false to NOT submit the form.
  }
