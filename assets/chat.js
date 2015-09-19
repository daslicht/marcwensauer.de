  function Chat() {

    this.socket = null;
    this.user = null;

    this.init = function() {
        
        // If the username is valid
        if (this.user) {
          // Tell the server your username
          this.socket.emit('add user', this.user);
        }

        this.switchRoom = function(room){
            this.socket.emit('switchRoom', room);
        }

        this.sendMessage = function(message) {
            //socket.broadcast.emit('chat message', $('#message').val() );
            //socket.emit('chat message', message);
            //$('#message_box').append($('<li>').text(username +": "+message));
            this.socket.emit('new message', message);
        }
        
        this.socket.on('updaterooms', function(rooms, current_room) {
            console.log('update rooms', rooms, current_room);
            $('#rooms').empty();
            $.each(rooms, function(key, value) {
                console.log('check:', '<div><a href="#" class="room" data-room="room'+value+'" </a></div>');
                if(value == current_room){
                    $('#rooms').append('<div>' + value + '</div>');
                }
                else {
                    $('#rooms').append('<div><a href="#" class="room" data-room="'+value+'" </a>'+value+'</div>');
                }
            });
        });

        this.socket.on('new message', function(data) {
            console.log('data: ',data);
            $('#message_box').append($('<li>').text( data.username +": "+data.message));
        });

        this.socket.on('server notice', function( data) {
            console.log('data: ',data);
            $('#message_box').append($('<li>').text(data));
        });

        // Whenever the server emits 'user joined', log it in the chat body
        this.socket.on('user joined', function (data) {
            console.log('user joined: ', data);
            $('#message_box').append($('<li>').text(data.username +" Joined"));
        });

        // Whenever the server emits 'user left', log it in the chat body
        this.socket.on('user left', function (data) {
            console.log('user left: ', data);
            $('#message_box').append($('<li>').text(data.username +" Left"));

        });
    }

}