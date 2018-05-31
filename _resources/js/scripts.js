const getJSON = function(serializedArray) {
    let data = {};
    $.each(serializedArray, function(i, item) {
        data[item.name] = item.value;
    });
    
    return data;
}

const readURL = function(input, image_container) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            image_container.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


let navbar = $("#pw-navbar");

if(navbar) {
    $(".maincontent").css("padding-top", navbar.height() + 20 + "px");
    
    window.onscroll = function() {
        let distance = window.scrollY;
        if(distance > 0) {
            navbar.addClass("pw-navbar_scroll");
        } else {
            navbar.removeClass("pw-navbar_scroll");
        }
    };
}
    

let button = $('.modal-reserve-room');
let button_target = $('#modal-reserv-room-target');
let button_close = $('#modal-reserv-room-target-close');
let reserve_form = $("#reserv-form");
let message_form = $("#reserve-form-room-message");

if(button && button_target && button_close && reserve_form) {
    let floor = reserve_form.children("#form-floor");
    let room_id_hidden = reserve_form.children("#reserve-form-room_id");
    
    button.on('click', function() {
        let floor_number = $(this).attr('floor_number');
        let room_id = $(this).attr('room_id');
        let room_number = $(this).attr('room_number');
        
        floor.val("Piso " + floor_number + " - Sala " + room_number);
        room_id_hidden.val(room_id);
        message_form.val("");
        
        button_target.addClass('active');
    });
    
    button_close.on('click', function() {
        button_target.removeClass('active');
    });
    
    reserve_form.on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        let formdata = getJSON(data);
        
        $.ajax({
            type: "POST",
            url: "/_services/reserve_room.php",
            data: formdata,
            success: function(msg) {
                var response = JSON.parse(msg);
                console.log(response);
                message_form.val(response.message);
                if(response.success) {
                    window.location = "/rooms";
                }
            },
            error: function() {
            }
        });
    });
}

// -------------------------Books

let create_book_button = $("#create-book");

if(create_book_button) {
    let modal_book = $("#modal-create-book-target");
    let message_book = $("#create-book-form-message");
    let select_book_button = $(".select-book");
    let delete_book_button = $(".delete-book");
    
    $("#modal-create-book-target-close").on('click', function() {
        modal_book.removeClass('active');
        $("body").css("overflow", "auto");
    });
    
    $("#create-book-form").on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        let formdata = getJSON(data);
        console.log(formdata);
        
        $.ajax({
            type: "POST",
            url: "/_services/create_book.php",
            data: formdata,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                message_book.val(response.message);
                if(response.success) {
                    window.location = "/books";
                }
            },
            error: function() {
            }
        });
    });
    
    create_book_button.on('click', function() {
        modal_book.addClass('active');
        $("body").css("overflow", "hidden");
    });
    
    select_book_button.on('click', function() {
        let targetid = $(this).attr("target");
        let target = $(targetid);
        let form = $(targetid + "-form");
        let message_form = $(targetid + "-message-form");
        let close = $(targetid + "-close").on('click', function() {
            target.removeClass("active");
            $("body").css("overflow", "auto");
        });
        let book_id = $(this).attr("bookid");
        let book_name = $(this).attr("bookname");
        $(targetid + "-form-id").val(book_id);
        $(targetid + "-form-name").val(book_name);
        
        
        target.addClass("active");
        $("body").css("overflow", "hidden");
        
        form.on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serializeArray();
            let formdata = getJSON(data);
            
            $.ajax({
                type: "POST",
                url: "/_services/reserve_book.php",
                data: formdata,
                success: function(msg) {
                    var response = JSON.parse(msg);
                    console.log(response);
                    message_form.val(response.message);
                    if(response.success) {
                        window.location = "/books";
                    }
                },
                error: function() {
                }
            });
        });
    });
    
    delete_book_button.on('click', function(e) {
        let id = $(this).attr("bookid");
        e.preventDefault();
        let data = {};
        data["delete-book"] = true;
        data["book-id"] = id;
        
        $.ajax({
            type: "POST",
            url: "/_services/delete_book.php",
            data: data,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                if(response.success) {
                    window.location = "/books";
                }
            },
            error: function() {
            }
        });
    });
}


// -------------------------Equipment

let create_equipment_button = $("#create-equipment");

if(create_equipment_button) {
    let modal_equipment = $("#modal-create-equipment-target");
    let message_equipment = $("#create-equipment-form-message");
    let image_equipment = $("#modal-equipment-image-preview");
    let select_equipment_button = $(".select-equipment");
    let delete_equipment_button = $(".delete-equipment");
    
    $("#modal-create-equipment-target-close").on('click', function() {
        modal_equipment.removeClass('active');
        $("body").css("overflow", "auto");
    });
    
    $("#create-equipment-form").on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        let formdata = getJSON(data);
        console.log(formdata);
        
        $.ajax({
            type: "POST",
            url: "/_services/create_equipment.php",
            data: formdata,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                message_equipment.val(response.message);
                if(response.success) {
                    window.location = "/equipment";
                }
            },
            error: function() {
            }
        });
    });
    
    $("#modal-image-input").on('change', function() {
        readURL(this, image_equipment);
    });
    
    create_equipment_button.on('click', function() {
        modal_equipment.addClass('active');
        $("body").css("overflow", "hidden");
    });
    
    select_equipment_button.on('click', function() {
        let targetid = $(this).attr("target");
        let target = $(targetid);
        let form = $(targetid + "-form");
        let message_form = $(targetid + "-message-form");
        let close = $(targetid + "-close").on('click', function() {
            target.removeClass("active");
            $("body").css("overflow", "auto");
        });
        let equipment_id = $(this).attr("equipmentid");
        let equipment_name = $(this).attr("equipmentname");
        $(targetid + "-form-id").val(equipment_id);
        $(targetid + "-form-name").val(equipment_name);
        
        
        target.addClass("active");
        $("body").css("overflow", "hidden");
        
        form.on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serializeArray();
            let formdata = getJSON(data);
            
            $.ajax({
                type: "POST",
                url: "/_services/reserve_equipment.php",
                data: formdata,
                success: function(msg) {
                    var response = JSON.parse(msg);
                    console.log(response);
                    message_form.val(response.message);
                    if(response.success) {
                        window.location = "/equipment";
                    }
                },
                error: function() {
                }
            });
        });
    });
    
    delete_equipment_button.on('click', function(e) {
        let id = $(this).attr("equipmentid");
        e.preventDefault();
        let data = {};
        data["delete-equipment"] = true;
        data["equipment-id"] = id;
        
        $.ajax({
            type: "POST",
            url: "/_services/delete_equipment.php",
            data: data,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                if(response.success) {
                    window.location = "/equipment";
                }
            },
            error: function() {
            }
        });
    });
}