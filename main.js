function copyToClipboard(id) {
    var copyText = document.getElementById("shortUrl_" + id).href;
    var inp = document.createElement('input');
    document.body.appendChild(inp);
    inp.value = copyText;
    inp.select();
    document.execCommand('copy',false);
    inp.remove();
}

function deleteLink(id, row) {
    jQuery.ajax({type: "GET",
        url: "/shortener.php?action=delete&id=" + id,
        success:function(result) {
            $(row).parent().parent().remove();
        },
        error:function(result) {
            alert('error');
        }
    });


}
function genShortUrl() {
    var table = $("table.table tbody");
    jQuery.ajax({type: "POST",
        url: "/shortener.php",
        data: { link: jQuery("#orig_url").val() },
        success:function(result) {
            var json = JSON.parse(result);
            console.log(json);
            if (!json.id) {
                if (json.error) {
                    alert(json.error);
                }
                return;
            }
            table.append('<tr><td>' + json.source + '</td>' +
                '<td><a href="/s/' + json.destination + '" id="shortUrl_' + json.id + '" target=\"_blank\">' + json.destination + '</td>' +
                '<td><button class="btn btn-info" onclick="copyToClipboard(' + json.id + ')" id="' + json.id + '">Copy</button></td>' +
                // '<td><a class="btn btn-danger" href="/shortener.php?action=delete&id=' + json.id + '">Delete</a></td></tr>');
                '<td><button class="btn btn-danger" onclick="deleteLink(' + json.id + ', this)">Delete</button></td></tr>');
        },
        error:function(result) {
            // alert('error');
        }
    });
}
$(document).ready(function() {
    $(".generate").on("click", function() {genShortUrl()});
    $('input[name="link"]').keypress(function (e) {
        console.log(e.which);
        var key = e.which;
        if(key == 13) {
            e.preventDefault();
            genShortUrl();
            return false;
        }
    });
});