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

    let nodes = document.querySelectorAll("#form");

    nodes.forEach(function (node) {
        const plus = node.querySelector("#plus");
        const min = node.querySelector("#min");
        const remove = node.querySelector("#remove");
        const amount = node.querySelector("#amount");
        const size = node.querySelector("#size");
        const id = node.querySelector("#id");
        const name = node.querySelector("#name");
        const price = node.querySelector("#price");
        const image = node.querySelector("#image");

        $(plus).click(function (event) {
            event.preventDefault();
            var formData = {
                amount: parseInt($(amount).val()),
                id: parseInt($(id).val()),
                size: $(size).val(),
                name: $(name).val(),
                price: $(price).val(),
                image: $(image).val(),


            };
            console.log(formData);
            $.ajax({
                url: "/updateCart/",
                method: "POST",
                data: formData,
            }).done(function (data) {
                // location.reload();
                console.log(data);
            });
        })

        $(min).click(function (event) {
            event.preventDefault();
            if(amount.value < 1){
                amount.value = 1;
            }
            var formData = {
                amount: parseInt($(amount).val()),
                id: parseInt($(id).val()),
                size: $(size).val(),
                name: $(name).val(),
                price: $(price).val(),
                image: $(image).val(),
            };


            console.log(formData);
            $.ajax({
                url: "/updateCart/",
                method: "POST",
                data: formData,
            }).done(function (data) {
                // location.reload();
                console.log(data);
            });


        })
        $(remove).click(function (event) {
            event.preventDefault();
            var formData = {
                id: parseInt($(id).val()),
                size: $(size).val(),
            };

            if(amount.value < 1){
                amount.value = 1;
            }
            console.log(formData);
            $.ajax({
                url: "/removeCart/",
                method: "POST",
                data: formData,
            }).done(function (data) {
                console.log(data);
                // location.reload();
            });


        })

    })
})
