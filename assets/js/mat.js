
    var myTemplate = $("#mytemplate").html().trim();
    var myTemplateClone = $(myTemplate);
    //myTemplateClone.find(".comment").html("test");

    //console.log(myTemplateClone.find(".comment"));

    myTemplateClone.appendTo('#test');

    var t = document.querySelector('#mytemplate');
    //t.content.querySelector('.comment');
     console.log( $(t)[0].content.querySelector('.comment'));


    $("#doit").on("click", function() {
        //$('#container').render(hello);
        //$("#container").clone().appendTo('#test').css("visibility","visible").css("opacity","1");
        //var t= $("#mytemplate");
        var t = document.querySelector('#mytemplate');
        console.log(t);
        // Populate the src at runtime.
        //t.content.querySelector('img').src = 'logo.png';
        t.content.querySelector('.comment').innerHTML = 'logo.png';

       // var clone = document.importNode(t.content, true);
        //document.body.appendChild(clone);
    });

    $.fn.doit = function() {
        $('#container').css("visibility","visible");
    }

    var hello = {
      hello:      'Hello',
      goodbye:    '<i>Goodbye!</i>',
      greeting:   'Howdy!',
      'hi-label': 'Terve!' // Finnish i18n
    };