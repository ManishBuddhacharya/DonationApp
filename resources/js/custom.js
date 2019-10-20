function validate(){
    let check = 0;
    $.each($('.validate'),function(){
      if(this.value == ""){
        check++;
        console.log($(this).parent().find('label').first().text());
        toastr.error( $(this).parent().find('label').first().text()+" cannot be empty.");
      }
    });
    return check;
  }