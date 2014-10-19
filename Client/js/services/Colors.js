spreadout.factory("Colors",
    function () {
        var colors = ["spr-bgcolor-green", "spr-bgcolor-purple", "spr-bgcolor-red", "spr-bgcolor-blue", "spr-bgcolor-orange"];
        var chosenColor = Math.floor((Math.random() * 4));
        return colors[chosenColor].toString();
    }
);