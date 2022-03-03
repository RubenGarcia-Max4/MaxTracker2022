function whatsApp() {
    var phone = "";
    var seller = Math.floor(Math.random() * 2);
    var text = encodeURIComponent('¡Quiero más información de Más Mensajes!');
    switch (seller) {
        case 0:
            phone = '4495166832';
            break;
        case 1:
            phone = '4495504832';
            break;
    }
    window.open('https://api.whatsapp.com/send?phone=' + phone + '&text=' + text);
}