$(document).ready(function () {
    $('#load').click(() => loadMore());    
});

function loadMore() {
    let val = document.getElementById("result_no").value;
    let url = document.getElementById("url").value;
    $.ajax({
        type: "post",
        url: url + "/getposts",
        data: {
            getresult:val
        },
        success: function (response) {
            let content = document.getElementById("posts");
            content.innerHTML += response;
            document.getElementById("result_no").value = Number(val) + 2;
        }
    });
}