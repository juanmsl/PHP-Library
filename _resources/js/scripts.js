const getJSON = function(serializedArray) {
    let data = {};
    $.each(serializedArray, function(i, item) {
        data[item.name] = item.value;
    });
    
    return data;
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
let modify_book_button = $(".modify-book");
let delete_book_button = $(".delete-book");

if(create_book_button && modify_book_button && delete_book_button) {
    let modal_book = $("#modal-create-book-target");
    let message_book = $("#create-book-form-message");
    
    $("#modal-create-book-target-close").on('click', function() {
        modal_book.removeClass('active');
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
    });
    
    modify_book_button.on('click', function() {
        alert($(this).text());
    });
    
    delete_book_button.on('click', function() {
        alert($(this).text());
    });
}


// -------------------------Equipment

let create_equipment_button = $("#create-equipment");
let modify_equipment_button = $(".modify-equipment");
let delete_equipment_button = $(".delete-equipment");


if(create_equipment_button && modify_equipment_button && delete_equipment_button) {
    let modal_equipment = $("#modal-create-equipment-target");
    let message_equipment = $("#create-equipment-form-message");
    
    $("#modal-create-equipment-target-close").on('click', function() {
        modal_equipment.removeClass('active');
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
    
    create_equipment_button.on('click', function() {
        modal_equipment.addClass('active');
    });
    
    modify_equipment_button.on('click', function() {
        alert($(this).text());
    });
    
    delete_equipment_button.on('click', function() {
        alert($(this).text());
    });
}