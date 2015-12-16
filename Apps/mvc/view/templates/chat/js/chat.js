Chat = {
    baseURL         : "",
    getMessages     : function () {
        Chat.ajaxCall()
    },
    getMessage      : function (id) {
        Chat.ajaxCall(Chat.URL,{
            message_id:id
        })
    },
    setMessage      : function () {
        Chat.ajaxCall()
    },
    updateMessage   : function () {
        Chat.ajaxCall()
    },
    deleteMessage   : function () {
        Chat.ajaxCall()
    },
    ajaxCall        : function (url,data) {
        var xmlHttp;

        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        } else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == XMLHttpRequest.DONE ) {
                if(xmlHttp.status == 200){
                    console.log(xmlHttp.response);
                }
                else if(xmlHttp.status == 400) {
                    alert('There was an error 400')
                }
                else {
                    alert('something else other than 200 was returned')
                }
            }
        };

        xmlHttp.open("POST", url);
        xmlHttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlHttp.send(JSON.stringify(data));
    }
};
