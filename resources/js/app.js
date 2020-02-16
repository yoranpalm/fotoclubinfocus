require("./bootstrap");
require("./keywordForm");

$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        loop: true,
        responsiveClass: true,
        autoplay: true,
        nav: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        navText: [
            '<i class="fas fa-angle-left"></i>',
            '<i class="fas fa-angle-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    $("#fotoForm")
    .off()
    .on("submit", e => {
        e.preventDefault();
        let keywords;

        $("#keywords input[type=hidden]").each((index, element) => {
            keywords = {
                ...keywords,
                [index]: element.getAttribute("value")
            };
        });
    });

    $("#addButton")
        .off("click")
        .on("click", e => {
            const fieldValue = $("#addText").val();
            const keywords = $("#keywords");
            let d = new Date();

            $("<input>")
                .attr({
                    type: "hidden",
                    name:
                        fieldValue +
                        "__" +
                        d.getHours().toString() +
                        d.getMinutes().toString() +
                        d.getSeconds().toString() +
                        "__h",
                    value: fieldValue
                })
                .appendTo(keywords);

            $("<label>")
                .attr({
                    id: fieldValue,
                    class: "label"
                })
                .text(fieldValue)
                .appendTo(keywords);
        });
});
