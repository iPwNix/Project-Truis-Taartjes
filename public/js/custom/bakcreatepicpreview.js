    //Pakt op of er iets gebeurt met het foto veld (File upload)
    //Als de gekoze foto groter is dan 3MB word er een error laten zien
    //Zo niet word readImage aangeroepen
    $("#photoOne").change(function () {
        if(this.files[0].size > 10485760){
            $('#photoOne-preview').css({"display": "none"});
            $('.error-one').css({"display": "block"});
        }else{
             var photoNr = 1;
             readImageOne(this, photoNr);  
        }
    });

    $("#photoTwo").change(function () {
        if(this.files[0].size > 10485760){
            $('#photoTwo-preview').css({"display": "none"});
            $('.error-two').css({"display": "block"});
        }else{
             var photoNr = 2;
             readImageOne(this, photoNr);  
        }
    });

    $("#photoThree").change(function () {
        if(this.files[0].size > 10485760){
            $('#photoThree-preview').css({"display": "none"});
            $('.error-three').css({"display": "block"});
        }else{
             var photoNr = 3;
             readImageOne(this, photoNr);  
        }
    });

    $("#photoFour").change(function () {
        if(this.files[0].size > 10485760){
            $('#photoFour-preview').css({"display": "none"});
            $('.error-four').css({"display": "block"});
        }else{
             var photoNr = 4;
             readImageOne(this, photoNr);  
        }
    });
    //krijgt de informatie van de file mee en laad de javascript FileReader in.
    //zodra deze geload is word de src van de preview image aangepast en eerdere error mochten die er zijn geweest word deze gehide.
    //Door behulp van de mee gegeve photoNr word er gekeken welke foto er veranderd en dus welke div bijgewerkt moet worden
    function readImageOne(input, photoNr) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(photoNr);
            switch(photoNr){
              case 1:
              reader.onload = function (e) {
                $('#photoOne-preview').attr('src', e.target.result);
                $('#photoOne-preview').css({"display": "block"});
                $('.error-one').css({"display": "none"});
              }
              break;

              case 2:
              reader.onload = function (e) {
                  $('#photoTwo-preview').attr('src', e.target.result);
                  $('#photoTwo-preview').css({"display": "block"});
                  $('.error-two').css({"display": "none"});
              }
              break;

              case 3:
              reader.onload = function (e) {
                  $('#photoThree-preview').attr('src', e.target.result);
                  $('#photoThree-preview').css({"display": "block"});
                  $('.error-three').css({"display": "none"});
              }
              break;

              case 4:
              reader.onload = function (e) {
                  $('#photoFour-preview').attr('src', e.target.result);
                  $('#photoFour-preview').css({"display": "block"});
                  $('.error-four').css({"display": "none"});
              }
              break;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }