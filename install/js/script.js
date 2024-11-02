BX.ready(function() 
{
    // if (csoft_test.show_popup != 'N') 
    // {
        var getIpWindow = new BX.PopupWindow("my_answer", null, {
            content: BX('ajax-server-ip'),
            content: 'Ваш IP: ' + csoft_test.server_ip,
            closeIcon: {right: "20px", top: "10px"},
            titleBar: 'IP сервера - это отправим на дев сервер разработки',
            zIndex: 0,
            offsetLeft: 0,
            offsetTop: 0,
            draggable: {restrict: false},
            buttons: [
                new BX.PopupWindowButton({
                    text: "Закрыть",
                    events: {click: function(){
                      this.popupWindow.close();
                    }}
                })
            ]
        });  
        getIpWindow.show();
    // }  
});
