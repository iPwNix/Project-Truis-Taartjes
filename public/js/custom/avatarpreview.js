  //Pakt op of er iets gebeurt met het avatar veld (File upload)
    //Als de gekoze avatar groter is dan 3MB word er een error laten zien
    //Zo niet word readImage aangeroepen
    $("#avatar").change(function () {
        if(this.files[0].size > 3145728){
            $('#avatar_upload_preview').css({"display": "none"});
            $('.avatar-preview-error').css({"display": "block"});
        }else{
             readImage(this);  
        }
    });
    //krijgt de informatie van de file mee en laad de javascript FileReader in.
    //zodra deze geload is word de src van de preview image aangepast en eerdere error mochten die er zijn geweest word deze gehide.
    function readImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar_upload_preview').attr('src', e.target.result);
                $('#avatar_upload_preview').css({"display": "block"});
                $('.avatar-preview-error').css({"display": "none"});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }