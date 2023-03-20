/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';


$(document).ready(function () {
    $("#form").click(function (event) {
        var formData = {
            amount: parseInt($("#amount").val()),
            id: parseInt($("#id").val()),
        };
        console.log(formData);
        $.ajax({
            url: "/updateCart/",
            method: "POST",
            data: formData,
        }).done(function (data) {
            console.log(JSON.parse(data) );
        });

        event.preventDefault();
    })
})
