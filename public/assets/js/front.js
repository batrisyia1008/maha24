var FrontMhxCUp = {
    init: function () {
        FrontMhxCUp.select2();
    },

    select2: function () {
        $(".default-select2").select2();
    }
}

$(document).ready(function () {
    FrontMhxCUp.init()
})
