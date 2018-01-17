        $(document).ready(function() {
          $('.text-editor').summernote({
            height: 250,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline']],
              ]
            });
        });