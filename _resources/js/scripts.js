const getJSON = function(serializedArray) {
    let data = {};
    $.each(serializedArray, function(i, item) {
        data[item.name] = item.value;
    });
    
    return data;
}

let navbar = document.getElementById("pw-navbar");

if(navbar) {
    window.onscroll = function() {
        let distance = window.scrollY;
        if(distance > 0) {
            navbar.classList.add("pw-navbar_scroll");
        } else {
            navbar.classList.remove("pw-navbar_scroll");
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
        console.log(formdata);
        
        $.ajax({
            type: "POST",
            url: "/_services/reserve_room.php",
            data: formdata,
            success: function(msg) {
                var response = JSON.parse(msg);
                console.log(response);
                message_form.val(response.message);
                if(response.success) {
                    console.log("js 65 click");
                    window.location = "/rooms";
                }
            },
            error: function() {
            }
        });
    });
}