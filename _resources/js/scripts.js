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
    $("#pw-navbar-toggle").on('click', function() {
        $("#pw-navbar-items").slideToggle();
    });
    
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
        let formd = new FormData($(this)[0]);
        console.log(formdata);
        
        let imagejson = {};
        imagejson["file"] = formd.get("image_equipment");
        imagejson["fileupload"] = "true";
        
        $.ajax({
            url: "/_services/upload_photo.php",
            data: imagejson,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(e) {
                console.log(e);
            },
            error: function(e) {
                console.log(e);
            }
        });
        
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

// -------------------------Request

let request_form = $(".resquest-form");
let reuest_cancel = $(".pw-cancel-request");

if(request_form) {
    reuest_cancel.on('click', function(e) {
        e.preventDefault();
        let formdata = {};
        formdata["reservation-detail-id"] = $(this).attr("reservationdetailid");
        formdata["cancel-reservation-form"] = true;
        
        console.log(formdata);
        
        $.ajax({
            type: "POST",
            url: "/_services/cancel_reservation.php",
            data: formdata,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                if(response.success) {
                    window.location = "/requests";
                }
            },
            error: function() {
            }
        });
    });
    
    request_form.on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        let formdata = getJSON(data);
        
        console.log(formdata);
        
        $.ajax({
            type: "POST",
            url: "/_services/aprove_reservation.php",
            data: data,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                if(response.success) {
                    window.location = "/requests";
                }
            },
            error: function() {
            }
        });
    });
}

// -------------------------Event

let create_event_button = $("#create-event");

if(create_event_button) {
    let modal_event = $("#modal-create-event-target");
    let message_event = $("#create-event-form-message");
    let subscribe_event_button = $(".subscribe-event");
    let delete_event_button = $(".delete-event");
    
    $("#modal-create-event-target-close").on('click', function() {
        modal_event.removeClass('active');
        $("body").css("overflow", "auto");
    });
    
    $("#create-event-form").on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        let formdata = getJSON(data);
        let formd = new FormData($(this)[0]);
        console.log(formdata);
        
        $.ajax({
            type: "POST",
            url: "/_services/create_event.php",
            data: formdata,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                message_event.val(response.message);
                if(response.success) {
                    window.location = "/events";
                }
            },
            error: function() {
            }
        });
    });
    
    create_event_button.on('click', function() {
        modal_event.addClass('active');
        $("body").css("overflow", "hidden");
    });
    
    subscribe_event_button.on('click', function(e) {
        let id = $(this).attr("eventid");
        e.preventDefault();
        let data = {};
        data["subscribe-event"] = true;
        data["event-id"] = id;
            
        $.ajax({
            type: "POST",
            url: "/_services/subscribe_event.php",
            data: data,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                if(response.success) {
                    window.location = "/events";
                }
            },
            error: function() {
            }
        });
    });
    
    delete_event_button.on('click', function(e) {
        let id = $(this).attr("eventid");
        e.preventDefault();
        let data = {};
        data["delete-event"] = true;
        data["event-id"] = id;
        
        $.ajax({
            type: "POST",
            url: "/_services/delete_event.php",
            data: data,
            success: function(msg) {
                console.log(msg);
                var response = JSON.parse(msg);
                console.log(response);
                if(response.success) {
                    window.location = "/events";
                }
            },
            error: function() {
            }
        });
    });
}