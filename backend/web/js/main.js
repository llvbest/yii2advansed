let Main = {
    init: function () {
        let self = this;
        $('#generate').on('click', function (e) {
            self.generateList();
        });
        $('.dropApple').on('click', function (e) {
            let id = $(this).parent().attr('id');
            console.log('dropApple'+id);
            self.dropApple(id);
        });
        $('.eatsApple').on('click', function (e) {
            let id = $(this).parent().parent().attr('id');
            let value = $(this).parent().find('input:first').val();
            console.log('eatApple'+id+':value'+value);
            if(value)
                self.eatsApple(id, value);
        });
    },
    generateList: function () {
        console.log('generateList');
        $.ajax({
            method: "GET",
            url: "/apple/generate",
            success: function (response) {
                document.location.reload();
                console.log('generate');
            },
            error: function () {
                console.log("cannot count items");
            }
        });
    },
    getList: function () {
        console.log('get list');
        $.ajax({
            method: "GET",
            url: "/apple/get-list",
            success: function (response) {
                console.log(response);
            },
            error: function () {
                console.log("cannot count items");
            }
        });
    },
    dropApple: function (id) {
        console.log('dropApple'+id);
        $('#'+id).remove().appendTo('#ground-apples-list');
        $.ajax({
            method: "GET",
            url: "/apple/drop/"+id,
            success: function (response) {
                document.location.reload();
            },
            error: function () {
                console.log("apple cannot drop");
            }
        });
    },
    eatsApple: function (id, value) {
        $.ajax({
            method: "GET",
            url: "/apple/eat/"+id+'/'+value,
            success: function (response) {
                document.location.reload();
            },
            error: function () {
                alert("apple cannot be eat");
            }
        });
    }
}