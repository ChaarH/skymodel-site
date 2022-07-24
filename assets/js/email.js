$(".main-button").on("click", function(e) {
    e.preventDefault();
    
    const data = $('#contact').serialize();

    if (data) {
        $(".main-button").html("Aguarde...")

        $.ajax({
            type: 'POST',
            url: "https://www.skymodelmgmt.com.br/Email.php",
            data: data,
            dataType: 'json',
            xhrFields: {
                withCredentials: true
            },
            success: function(json) {
                $(".main-button").html(json.message)

                if ( !json.error ) {
                    $('.main-button').css('background', '#000000')
                } else {
                    $('.main-button').css('background', '#f64444')
                }
            }
        });       

    }
})