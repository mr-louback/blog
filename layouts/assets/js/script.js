// const idLog = document.getElementById('busca').value
// addEventListener("onload", () => {
//     // window.location.href
//     // addEventListener("click", () => {

//     // })
//     alert("ola")
// })

// addEventListener("click", () => {
//     const idLog = document.getElementById('cad')

//     console.log('urlFormElse()');

// })

// 
// A $( document ).ready() block.
$(document).ready(function () {
    $("#busca").keyup(function () {
        var busca = $(this).val();
        if (busca !== '') {
            ()=>({
                url: $('form').attr('data-url-busca'),
                method: 'post',
                data: {
                    busca: busca
                },
                success: function (data) {
                    if (data) {
                        //          console.log('data');
                        $('#buscaResultado').html("<div class='card h-100 '><div class='card-body '>" + data + "</div></div>")
                    } else {
                        $('#buscaResultado').html("<div class='card h-100 '><div class='{{alert_danger}}card-body '>" + data + "</div></div>")

                    }
                }
            })
            // $('#buscaResultado').show();

        } else {
            document.getElementById('buscaResultado').textContent = busca;
            // $('#buscaResultado').hide();
        }




        // document.getElementById('buscaResultado').innerHTML = "<div class='card h-100 '><div class='card-body '>" + busca + "</div></div>";


        // if (busca) {
        //     console.log('data');
        //     $('#buscaResultado').html("<div class='card h-100 '><div class='card-body '>" + data + "</div></div>")
        // } else {
        //     $('#buscaResultado').html("<div class='card h-100 '><div class='{{alert_danger}}card-body '>" + data + "</div></div>")

        // }




        // console.log(buscaResult);


    })
});
