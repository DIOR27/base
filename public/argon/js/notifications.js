function sendNotification(icon, title, text, effect = 'fade') {
    new Notify({
        status: icon,
        title: title,
        text: text,
        effect: effect,
        speed: 300,
        customClass: null,
        customIcon: null,
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: 3000,
        gap: 20,
        distance: 20,
        type: 1,
        position: 'right top'
    });
}