$(document).ready(function() {
    $("#fotoForm")
        .off()
        .on("submit", e => {
            if (!$("input[name=keywordsJSON]").length) {
                e.preventDefault();
                let keywords;

                $("#keywords input[type=hidden]").each((index, element) => {
                    keywords = {
                        ...keywords,
                        [index]: element.getAttribute("value")
                    };
                });

                $("<input>")
                    .attr({
                        type: "hidden",
                        name: "keywordsJSON",
                        id: "keywordsJSON",
                        value: JSON.stringify(keywords)
                    })
                    .appendTo("#fotoForm");
                $("#fotoForm").submit();
            }
        });

    $("#addButton")
        .off("click")
        .on("click", e => {
            const fieldValue = $("#addText").val();
            const keywords = $("#keywords");
            let d = new Date();
            const randomNumberId = Math.floor(
                (d.getHours().toString() +
                    d.getMinutes().toString() +
                    d.getSeconds().toString()) *
                    Math.random()
            );

            const newInputName = fieldValue + "__" + randomNumberId + "__h";

            $("<input>")
                .attr({
                    type: "hidden",
                    name: newInputName,
                    value: fieldValue
                })
                .appendTo(keywords);

            $("<p>")
                .attr({
                    id: newInputName
                })
                .css("display", "inline-block")
                .text(fieldValue)
                .appendTo(keywords);

            $("<i>")
                .attr({
                    class: "material-icons-outlined",
                    id: newInputName,
                    name: "deleteButton"
                })
                .css("float", "right")
                .text("delete")
                .appendTo(keywords);

            $("<hr/>")
            .attr({
                id: newInputName
            })
            .css("margin", "0.5rem 0")
            .appendTo(keywords);

            $("i[id=" + newInputName + "]")
                .off("click")
                .on("click", e => {
                    $("input[name=" + newInputName + "]").remove();
                    $("i[id=" + newInputName + "]").remove();
                    $("p[id=" + newInputName + "]").remove();
                    $("hr[id=" + newInputName + "]").remove();
                });

            if ($("#keywords").has("input")) {
                $("#keywordsEmptyMessage").hide();
            }
        });

    $("i[name=deleteButton").each((index, value) => {
        const name = value.getAttribute("id");

        console.log("i[id=" + name + "]");

        $("i[id=" + name + "]")
            .off("click")
            .on("click", e => {
                $("input[name=" + name + "]").remove();
                $("i[id=" + name + "]").remove();
                $("p[id=" + name + "]").remove();
                $("hr[id=" + name + "]").remove();
            });
    });
});
